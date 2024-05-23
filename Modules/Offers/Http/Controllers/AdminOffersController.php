<?php

namespace Modules\Offers\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\Offers\Entities\Offers;
use Modules\Offers\Entities\OfferInterests;
use Modules\Products\Entities\Products;

use Session,DB;

class AdminOffersController extends Controller
{
    public function index()
    {
        return view('offers::admin.index');
    }

    public function list(Request $request)
    {
        $search   = $request->search['value'];
        $sort     = $request->order;
        $column   = $sort[0]['column'];
        $order    = $sort[0]['dir'] == 'asc' ? "ASC" : "DESC" ;

        $offers = Offers::with('products');

        if ($search != '') 
        {
            $offers->whereHas('products', function($q) use($search){
                        $q->where('title', 'LIKE', '%'.$search.'%');
                    });
        }

        $total  = $offers->count();

        $result['data'] = $offers->take($request->length)->skip($request->start)->get();
        $result['recordsTotal'] = $total;
        $result['recordsFiltered'] =  $total;

        echo json_encode($result);
    }


    public function add()
    {
        $products = Products::whereIn('type',array(0,2))->get();
        return view('offers::admin.add',compact('products'));
    }

    public function store(Request $request)
    {
        $exist = Offers::where('from_date','<=',$request->to_date)->where('to_date','>=',$request->from_date)->first();

        if($exist != null)
        {
            return redirect()->back()->withInput($request->input())->with('message_duplicate', 'Offer already added in these days');
        }

        $banner = new Offers;
        $banner->product_id = $request->product_id;
        $banner->type = $request->type;
        $banner->from_date = $request->from_date;
        $banner->to_date = $request->to_date;
        $banner->title = $request->title;
        $banner->sub_title = $request->sub_title;
        $banner->description = $request->description;
        $banner->save();


        Session::flash('message', 'Entry added successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/offers');
    }

    public function edit($id)
    {
        $offer = Offers::find($id);
        $products = Products::whereIn('type',array(0,2))->get();

        return view('offers::admin.edit',compact('offer','products'));
    }

    public function update(Request $request)
    {
        $exist = Offers::where('from_date','<=',$request->to_date)->where('to_date','>=',$request->from_date)->where('id','!=',$request->id)->first();

        if($exist != null)
        {
            return redirect()->back()->withInput($request->input())->with('message_duplicate', 'Offer already added in these days');
        }

        $banner = Offers::find($request->id);
        $banner->product_id = $request->product_id;
        $banner->from_date = $request->from_date;
        $banner->to_date = $request->to_date;
        $banner->type = $request->type;
        $banner->title = $request->title;
        $banner->sub_title = $request->sub_title;
        $banner->description = $request->description;
        $banner->save();


        Session::flash('message', 'Entry added successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/offers');
    }

    public function delete($id)
    {
        $banner = Offers::find($id);
        $banner->delete();

        Session::flash('message', 'Entry deleted successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/offers');
    }

    public function interest()
    {
        return view('offers::admin.interest');
    }

    public function interestList(Request $request)
    {
        $search   = $request->search['value'];
        $sort     = $request->order;
        $column   = $sort[0]['column'];
        $order    = $sort[0]['dir'] == 'asc' ? "ASC" : "DESC" ;

        $offers = OfferInterests::select('*',DB::raw('DATE_FORMAT(DATE_ADD(created_at, INTERVAL "5:30" HOUR_MINUTE),"%Y-%c-%d") as change_date'))->with('offer.products')->has('offer');

        if ($search != '') 
        {
            $offers->whereHas('offer.products', function($q) use($search){
                        $q->where('title', 'LIKE', '%'.$search.'%');
                    });
        }

        $total  = $offers->count();

        $result['data'] = $offers->take($request->length)->skip($request->start)->get();
        $result['recordsTotal'] = $total;
        $result['recordsFiltered'] =  $total;

        echo json_encode($result);
    }
}
