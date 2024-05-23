<?php

namespace Modules\Service\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Modules\Service\Entities\ServiceCenter;

use Session,DB;

class AdminServiceCenterController extends Controller
{
    public function index()
    {
        return view('service::center.index');
    }

    public function list(Request $request)
    {
        $search   = $request->search['value'];
        $sort     = $request->order;
        $column   = $sort[0]['column'];
        $order    = $sort[0]['dir'] == 'asc' ? "ASC" : "DESC" ;

        $category = ServiceCenter::where('id','>',0);

        if ($search != '') 
        {
            $category->where('name', 'LIKE', '%'.$search.'%');
            $category->orWhere('address', 'LIKE', '%'.$search.'%');
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
        return view('service::center.add');
    }

    public function store(Request $request)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $category = new ServiceCenter;
        $category->title = $request->title;
        $category->description = $request->description;
        $category->state = $request->state;
        $category->district = $request->district;
        $category->mobile = $request->mobile;
        $category->email = $request->email;
        $category->open_hour = $request->open_hour;
        $category->location = $request->location;
        $category->latitude = $request->lat;
        $category->longitude = $request->lng;
        $category->save();

        Session::flash('message', 'Entry added successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/serviceCenters');
    }

    public function edit($id)
    {
        $store = ServiceCenter::find($id);

        return view('service::center.edit',compact('store'));
    }

    public function update(Request $request)
    {
        $category = ServiceCenter::find($request->id);
        $category->title = $request->title;
        $category->description = $request->description;
        $category->state = $request->state;
        $category->district = $request->district;
        $category->mobile = $request->mobile;
        $category->email = $request->email;
        $category->open_hour = $request->open_hour;

         $category->location = $request->location;
        $category->latitude = $request->lat;
        $category->longitude = $request->lng;

        $category->save();

        Session::flash('message', 'Entry updated successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/serviceCenters');
    }

    public function delete($id)
    {
        $category = ServiceCenter::find($id);
        $category->delete();

        Session::flash('message', 'Entry deleted successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/serviceCenters');
    }
}
