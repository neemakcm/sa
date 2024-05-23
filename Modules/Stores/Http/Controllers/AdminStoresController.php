<?php

namespace Modules\Stores\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Modules\Stores\Entities\Stores;

use Session,DB;

class AdminStoresController extends Controller
{
    public function index()
    {
        return view('stores::admin.index');
    }

    public function list(Request $request)
    {
        $search   = $request->search['value'];
        $sort     = $request->order;
        $column   = $sort[0]['column'];
        $order    = $sort[0]['dir'] == 'asc' ? "ASC" : "DESC" ;

        $category = Stores::where('id','>',0);

        if ($search != '') 
        {
            $category->where('title', 'LIKE', '%'.$search.'%');
            $category->orWhere('description', 'LIKE', '%'.$search.'%');
            $category->orWhere('state', 'LIKE', '%'.$search.'%');
            $category->orWhere('district', 'LIKE', '%'.$search.'%');
            $category->orWhere('mobile', 'LIKE', '%'.$search.'%');
            $category->orWhere('email', 'LIKE', '%'.$search.'%');
        }

        $total  = $category->count();

        $result['data'] = $category->take($request->length)->skip($request->start)->get();
        $result['recordsTotal'] = $total;
        $result['recordsFiltered'] =  $total;

        echo json_encode($result);
    }


    public function add()
    {
        return view('stores::admin.add');
    }

    public function store(Request $request)
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $category = new Stores;
        $category->title = $request->title;
        $category->description = $request->description;
        $category->latitude = $request->lat;
        $category->longitude = $request->lng;
        $category->location = $request->location;
        $category->state = $request->state;
        $category->district = $request->district;
        $category->mobile = $request->mobile;
        $category->email = $request->email;
        $category->open_hour = $request->open_hour;

         // print_r($category); die;

        $category->save();

        Session::flash('message', 'Entry added successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/stores');
    }

    public function edit($id)
    {
        $store = Stores::find($id);

        return view('stores::admin.edit',compact('store'));
    }

    public function update(Request $request)
    {
        $category = Stores::find($request->id);
        $category->title = $request->title;
        $category->description = $request->description;
        $category->state = $request->state;
        $category->district = $request->district;
        $category->location = $request->location;
        $category->mobile = $request->mobile;
        $category->latitude = $request->lat;
        $category->longitude = $request->lng;
        $category->email = $request->email;
        $category->open_hour = $request->open_hour;
        $category->save();

        Session::flash('message', 'Entry updated successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/stores');
    }

    public function delete($id)
    {
        $category = Stores::find($id);
        $category->delete();

        Session::flash('message', 'Entry deleted successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/stores');
    }
}
