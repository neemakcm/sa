<?php

namespace Modules\Careers\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\Pages\Entities\Pages;
use Modules\Careers\Entities\Jobs;
use Modules\Careers\Entities\JobFields;
use Modules\Careers\Entities\JobRequests;
use Modules\Careers\Entities\JobRequestEducations;
use Modules\Careers\Entities\JobRequestExperiences;
use Modules\WarrantyExtension\Entities\State;

use Session;

class CareersController extends Controller
{
    public function index()
    {
        $page = Pages::whereIn('slug',array('working-at-impex','job-fields'))->get();

        $banner = Pages::where('slug','impex-careers')->first();

        return view('careers::front.index',compact('page','banner'));
    }

    public function working()
    {
        $page = Pages::whereIn('slug',array('take-on-big-challenges','shape-the-future','make-an-impact'))->get();

        $banner = Pages::where('slug','working-at-impex-1')->first();

        return view('careers::front.working',compact('page','banner'));
    }

    public function jobFields()
    {
        $jobs = JobFields::all();

        $banner = Pages::where('slug','job-fields-1')->first();

        return view('careers::front.jobFields',compact('jobs','banner'));
    }

    public function search(Request $request)
    {

        $banner = Pages::where('slug','be-a-part-of-impex')->first();


        $jobs = Jobs::select('id','slug','title','location','created_at')
                    ->where('status',1);

        if(isset($request->Keyword) && $request->Keyword != '')
        {
            $jobs->where('title','LIKE','%'.$request->Keyword.'%')
                ->orWhereHas('jobField', function($q) use($request)
                {
                    $q->where('title', 'LIKE', '%'.$request->Keyword.'%');
                });
        }

        if(isset($request->location) && $request->location != '')
            $jobs->where('location','LIKE',$request->location);

        if(isset($request->sort))
        {
            if($request->sort == 'latest')
                $jobs->orderBy('created_at','desc');
            else
                $jobs->orderBy('created_at','asc');
        }
        else
            $jobs->orderBy('created_at','desc');

        $jobs = $jobs->paginate(6);

        $locations = Jobs::select('location')->where('status',1)->groupBy('location')->get()->pluck('location')->toArray();

        return view('careers::front.search',compact('jobs','locations','banner'));
    }

    public function detail($slug)
    {
        $banner = Pages::where('slug','be-a-part-of-impex-1')->first();

        $job = Jobs::where('slug',$slug)->first();
        $locations = Jobs::select('location')->where('status',1)->groupBy('location')->get()->pluck('location')->toArray();
        $states = State::where('country_id',101)->get();

        return view('careers::front.detail',compact('job','locations','states','banner'));

    }

    public function submitJobRequest(Request $request)
    {
        $job = new JobRequests;
        $job->job_id = $request->id;
        $job->first_name = $request->first_name;
        $job->last_name = $request->last_name;
        $job->email = $request->email;
        $job->mobile = $request->mobile;
        $job->city = $request->city;
        $job->state = $request->state;
        $job->address = $request->address;
        $job->skill_set = $request->skill_set;
        $job->resume = $request->file('resume')->store('job');
        $job->cover_letter = $request->file('cover_letter')->store('job');
        $job->save();

        if(count($request->institute) > 0)
        {
            foreach($request->institute as $key => $institute)
            {
                $from = explode('/',$request->from[$key]);
                $to = explode('/',$request->to[$key]);

                $education = new JobRequestEducations;
                $education->job_request_id = $job->id;
                $education->institute = $institute;
                $education->department = $request->department[$key];
                $education->degree = $request->degree[$key];
                $education->from_month = date('F',strtotime('01-'.$from[0].'-2020'));
                $education->from_year = $from[1];
                $education->to_month = date('F',strtotime('01-'.$to[0].'-2020'));
                $education->to_year = $to[1];
                $education->save();
            }
        }

        if(count($request->exp_institute) > 0)
        {
            foreach($request->exp_institute as $key => $exp_institute)
            {
                $from = explode('/',$request->exp_from[$key]);
                $to = explode('/',$request->exp_to[$key]);

                $education = new JobRequestExperiences;
                $education->job_request_id = $job->id;
                $education->institute = $exp_institute;
                $education->job_title = $request->job_title[$key];
                $education->experience = $request->experience[$key];
                $education->from_month = date('F',strtotime('01-'.$from[0].'-2020'));
                $education->from_year = $from[1];
                $education->to_month = date('F',strtotime('01-'.$to[0].'-2020'));
                $education->to_year = $to[1];
                $education->save();
            }
        }

        Session::flash('message', 'Application applied successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect()->back();
    }
}
