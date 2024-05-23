<?php

namespace Modules\Stores\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Modules\Stores\Entities\Stores;
use Modules\Pages\Entities\Pages;

use Session,DB;

class StoresController extends Controller
{
    public function index()
    {
    	$states = Stores::select('state')->groupBy('state')->get();
        $banner = Pages::where('slug','visit-store')->first();

    	$stores = Stores::all();

        return view('stores::front.index',compact('states','stores','banner'));
    }

    public function getStateDistricts(Request $request)
    {
        $districts = Stores::select('district')->where('state',$request->id)->groupBy('district')->get();

        echo json_encode($districts);
    }
    public function mapContent(Request $request)
    {
        $stores = Stores::whereIn('id',explode(',',$request->id))->get();
        // dd($stores);

        echo json_encode($stores);
    }
    public function districtStore(Request $request)
    {
        $points = Stores::whereNotNull('id');
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
