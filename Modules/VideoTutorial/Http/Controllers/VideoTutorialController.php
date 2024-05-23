<?php

namespace Modules\VideoTutorial\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\VideoTutorial\Entities\VideoTutorial;
use Modules\Categories\Entities\Categories;
use Modules\Pages\Entities\Pages;

class VideoTutorialController extends Controller
{
    public function index(Request $request,$id=null)
    {
        $banner = Pages::where('slug','video-tutorials')->first();

        $results = VideoTutorial::orderBy('id','desc')->paginate(9);
        $categories=(new Categories())->listIsLastChildCategories();
        if($request->id )
        {
            if($request->id=='all')
            {
                $results = VideoTutorial::orderBy('id','desc')->paginate(9);
            }
            else{
                $results = VideoTutorial::where('category_id',$request->id)->orderBy('id','desc')->paginate(9);
            }
            echo json_encode($results);
        }
        else{
            if ($request->ajax()) {
                $results = VideoTutorial::orderBy('id','desc')->paginate(9);
            echo json_encode($results);

                // return view('videotutorial::front.video-tutorial',['tutorials'=>$results]);
            }
            else{
        $total_videos = VideoTutorial::orderBy('id','desc')->get()->count();

                return view('videotutorial::front.index',['total_videos'=>$total_videos,'tutorials'=>$results,'categories'=>$categories,'banner'=>$banner]);
            }
        }
        
    }
    public function pageIndex(Request $request,$id=null)
    {
       if ($request->ajax()) {
           if($request->id)
           {
            if($request->id=='all')
            {
                $results = VideoTutorial::orderBy('id','desc')->paginate(9);
            }
            else{
                $results = VideoTutorial::where('category_id',$request->id)->orderBy('id','desc')->paginate(9);
            }
           
        }
           else{
            $results = VideoTutorial::orderBy('id','desc')->paginate(9);
           }
           echo json_encode($results);

                // return view('videotutorial::front.video-tutorial',['tutorials'=>$results]);
            }  
    }
}
