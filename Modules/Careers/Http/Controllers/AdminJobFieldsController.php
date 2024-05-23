<?php

namespace Modules\Careers\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\Careers\Entities\JobFields;

use Session,Image;

class AdminJobFieldsController extends Controller
{
    public function index()
    {
        return view('careers::jobfields.index');
    }

    public function list(Request $request)
    {
        $search   = $request->search['value'];
        $sort     = $request->order;
        $column   = $sort[0]['column'];
        $order    = $sort[0]['dir'] == 'asc' ? "ASC" : "DESC" ;

        $banners = JobFields::with('jobs');

        if ($search != '') 
        {
            $banners->where('title', 'LIKE', '%'.$search.'%')->orWhere('description', 'LIKE', '%'.$search.'%');
        }

        $total  = $banners->count();

        $result['data'] = $banners->orderBy('id','desc')->take($request->length)->skip($request->start)->get();
        $result['recordsTotal'] = $total;
        $result['recordsFiltered'] =  $total;

        echo json_encode($result);
    }


    public function add()
    {
        return view('careers::jobfields.add');
    }

    public function store(Request $request)
    {
        $banner = new JobFields;
        $banner->title = $request->title;
        $banner->image = $request->file('image')->store('jobfields');
        $banner->description = $request->description;
        $banner->save();


        Session::flash('message', 'Entry added successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/jobFields');
    }

    public function edit($id)
    {
        $banner = JobFields::find($id);

        return view('careers::jobfields.edit',compact('banner'));
    }

    public function update(Request $request)
    {
        $banner = JobFields::find($request->id);
        $banner->title = $request->title;
        if($request->image)
            $banner->image = $request->file('image')->store('jobfields');
        $banner->description = $request->description;
        $banner->save();

        Session::flash('message', 'Entry updated successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/jobFields');
    }

    public function delete($id)
    {
        $banner = JobFields::find($id);
        $banner->delete();

        Session::flash('message', 'Entry deleted successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/jobFields');
    }
}
