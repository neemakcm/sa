<?php

namespace Modules\Attributes\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Modules\Attributes\Entities\Attributes;

use Session;

class AdminAttributesController extends Controller
{
    public function index()
    {
        return view('attributes::admin.index');
    }

    public function list(Request $request)
    {
        $search   = $request->search['value'];
        $sort     = $request->order;
        $column   = $sort[0]['column'];
        $order    = $sort[0]['dir'] == 'asc' ? "ASC" : "DESC" ;

        $banners = Attributes::with('products');

        if ($search != '') 
        {
            $banners->where('name', 'LIKE', '%'.$search.'%');
        }

        $total  = $banners->count();

        $result['data'] = $banners->take($request->length)->skip($request->start)->get();
        $result['recordsTotal'] = $total;
        $result['recordsFiltered'] =  $total;

        echo json_encode($result);
    }


    public function add()
    {
        return view('attributes::admin.add');
    }

    public function store(Request $request)
    {
        
        $banner = new Attributes;
        $banner->name = $request->name;
        $banner->save();


        Session::flash('message', 'Entry added successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/attributes');
    }

    public function edit($id)
    {
        $banner = Attributes::find($id);

        return view('attributes::admin.edit',compact('banner'));
    }

    public function update(Request $request)
    {
        $banner = Attributes::find($request->id);
        $banner->name = $request->name;
        $banner->save();

        Session::flash('message', 'Entry updated successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/attributes');
    }

    public function delete($id)
    {
        $banner = Attributes::find($id);
        $banner->delete();

        Session::flash('message', 'Entry deleted successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/attributes');
    }
}
