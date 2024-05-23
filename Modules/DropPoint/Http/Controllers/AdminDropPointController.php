<?php

namespace Modules\DropPoint\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Stores\Entities\Stores;
use Modules\DropPoint\Entities\DropPoint;

use Session,DB;
class AdminDropPointController extends Controller
{
    public function index()
    {
        return view('droppoint::admin.index');
    }

    public function list(Request $request)
    {
        $search   = $request->search['value'];
        $sort     = $request->order;
        $column   = $sort[0]['column'];
        $order    = $sort[0]['dir'] == 'asc' ? "ASC" : "DESC" ;
        $drop_point = DropPoint::where('id','>',0);

        if ($search != '') 
        {
            $drop_point->where('name', 'LIKE', '%'.$search.'%');
            $drop_point->orWhere('address', 'LIKE', '%'.$search.'%');
            $drop_point->orWhere('state', 'LIKE', '%'.$search.'%');
            $drop_point->orWhere('district', 'LIKE', '%'.$search.'%');
            $drop_point->orWhere('mobile', 'LIKE', '%'.$search.'%');
            $drop_point->orWhere('email', 'LIKE', '%'.$search.'%');
        }
        $total  = $drop_point->count();
        $result['data'] = $drop_point->take($request->length)->skip($request->start)->get();
        $result['recordsTotal'] = $total;
        $result['recordsFiltered'] =  $total;

        echo json_encode($result);
    }


    public function add()
    {
        return view('droppoint::admin.add');
    }

    public function store(Request $request)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $category = new DropPoint;
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

        return redirect('admin/drop-point');
    }

    public function edit($id)
    {
        $point = DropPoint::find($id);

        return view('droppoint::admin.edit',compact('point'));
    }

    public function update(Request $request)
    {
        $category = DropPoint::find($request->id);
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

        return redirect('admin/drop-point');
    }

    public function delete($id)
    {
        $category = DropPoint::find($id);
        $category->delete();

        Session::flash('message', 'Entry deleted successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/drop-point');
    }
}
