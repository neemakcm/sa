<?php

namespace Modules\DropPoint\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Pages\Entities\Pages;
use Modules\Stores\Entities\Stores;
use Modules\DropPoint\Entities\DropPoint;

use Session,DB;
class DropPointController extends Controller
{
    public function index()
    {
    	$states = DropPoint::select('state')->groupBy('state')->get();
        $banner = Pages::where('slug','lets-change-the-nature-of-e-waste')->first();

    	$points = DropPoint::all();

        $page = Pages::where('slug','drop-point')->first();

        return view('droppoint::front.index',compact('states','points','page','banner'));
    }

    public function getStateDistricts($state)
    {
        $districts = DropPoint::select('district')->where('state',$state)->groupBy('district')->get();

        echo json_encode($districts);
    }
    public function mapContent(Request $request)
    {
        $points = DropPoint::whereIn('id',explode(',',$request->id))->get();

        echo json_encode($points);
    }
    
    public function districtDrop(Request $request)
    {
        $points = DropPoint::whereNotNull('id');
        if($request->state!='all' && $request->district!='all')
        {
            $points =$points->where('district',$request->district);
        }
        else{
            if($request->state!='all' && $request->district=='all')
            {
                $points =$points->where('state',$request->state);
            }
        }
        $points =$points->get();
        echo json_encode($points);
    }
}
