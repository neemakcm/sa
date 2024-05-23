<?php

namespace Modules\Careers\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\Careers\Entities\Jobs;
use Modules\Careers\Entities\JobFields;
use Modules\Careers\Entities\JobRequests;
use Modules\Careers\Entities\JobRequestEducations;
use Modules\Careers\Entities\JobRequestExperiences;

use Session,Image,DB;

class AdminJobsController extends Controller
{
    public function index()
    {
        return view('careers::jobs.index');
    }

    public function list(Request $request)
    {
        $search   = $request->search['value'];
        $sort     = $request->order;
        $column   = $sort[0]['column'];
        $order    = $sort[0]['dir'] == 'asc' ? "ASC" : "DESC" ;

        $banners = Jobs::select('*',DB::raw('DATE_FORMAT(DATE_ADD(created_at, INTERVAL "5:30" HOUR_MINUTE),"%Y-%c-%d") as change_date'))->with('jobField','jobRequest')->has('jobField');

        if ($search != '') 
        {
            $banners->where('title', 'LIKE', '%'.$search.'%')
                    ->orWhere('location', 'LIKE', '%'.$search.'%')
                    ->orWhere('company', 'LIKE', '%'.$search.'%')
                    ->orWhereHas('jobField', function($q) use($search)
                    {
                        $q->where('title', 'LIKE', '%'.$search.'%');
                    });
        }

        $total  = $banners->count();

        $result['data'] = $banners->orderBy('id','desc')->take($request->length)->skip($request->start)->get();
        $result['recordsTotal'] = $total;
        $result['recordsFiltered'] =  $total;

        echo json_encode($result);
    }


    public function add()
    {
        $fields = JobFields::all();

        return view('careers::jobs.add',compact('fields'));
    }

    public function store(Request $request)
    {
        $banner = new Jobs;
        $banner->title = $request->title;
        $banner->job_field_id = $request->job_field_id;
        $banner->location = $request->location;
        $banner->company = $request->company;
        $banner->qualifications = $request->qualifications;
        $banner->responsibilities = $request->responsibilities;
        $banner->status = $request->status;
        $banner->generateSlug();
        $banner->save();


        Session::flash('message', 'Entry added successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/jobs');
    }

    public function edit($id)
    {
        $banner = Jobs::find($id);
        $fields = JobFields::all();

        return view('careers::jobs.edit',compact('banner','fields'));
    }

    public function update(Request $request)
    {
        $banner = Jobs::find($request->id);
        $banner->title = $request->title;
        $banner->job_field_id = $request->job_field_id;
        $banner->location = $request->location;
        $banner->company = $request->company;
        $banner->qualifications = $request->qualifications;
        $banner->responsibilities = $request->responsibilities;
        $banner->status = $request->status;
        $banner->generateSlug();
        $banner->save();

        Session::flash('message', 'Entry updated successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/jobs');
    }

    public function delete($id)
    {
        $banner = Jobs::find($id);
        $banner->delete();

        Session::flash('message', 'Entry deleted successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/jobs');
    }

    public function requestIndex($id)
    {
        $job = Jobs::find($id);

        return view('careers::jobs.requestIndex',compact('job'));
    }

    public function requestList(Request $request)
    {
        $search   = $request->search['value'];
        $sort     = $request->order;
        $column   = $sort[0]['column'];
        $order    = $sort[0]['dir'] == 'asc' ? "ASC" : "DESC" ;

        $banners = JobRequests::select('*',DB::raw('DATE_FORMAT(DATE_ADD(created_at, INTERVAL "5:30" HOUR_MINUTE),"%Y-%c-%d") as change_date'))
                            ->where('job_id',$request->id);

        if ($search != '') 
        {
            $banners->where('first_name', 'LIKE', '%'.$search.'%')
                    ->orWhere('last_name', 'LIKE', '%'.$search.'%')
                    ->orWhere('email', 'LIKE', '%'.$search.'%')
                    ->orWhere('city', 'LIKE', '%'.$search.'%')
                    ->orWhere('mobile', 'LIKE', '%'.$search.'%');
        }

        $total  = $banners->count();

        $result['data'] = $banners->orderBy('id','desc')->take($request->length)->skip($request->start)->get();
        $result['recordsTotal'] = $total;
        $result['recordsFiltered'] =  $total;

        echo json_encode($result);
    }

    public function requestView($id)
    {
        $job = JobRequests::with('jobs','requestEducations','requestExperience')->find($id);

        return view('careers::jobs.requestView',compact('job'));
    }
}
