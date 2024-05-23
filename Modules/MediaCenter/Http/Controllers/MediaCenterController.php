<?php

namespace Modules\MediaCenter\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\Pages\Entities\Pages;
use Modules\MediaCenter\Entities\MediaCenter;

use Session,Str,DB;

class MediaCenterController extends Controller
{
    public function index()
    {
        $medias = MediaCenter::limit(6)->get();
        $media_count = MediaCenter::count();
        $banner = Pages::where('slug','media-center')->first();

        return view('mediacenter::front.index',compact('medias','media_count','banner'));
    }

    public function getPaginatedMedia(Request $request)
    {
        $medias = MediaCenter::select('title','media',DB::raw('DATE_FORMAT(DATE_ADD(created_at, INTERVAL "5:30" HOUR_MINUTE),"%M %d, %Y") as change_date'))->take(6)->skip($request->page*6)->get();
        $media_count = MediaCenter::count();

        $media_count = $media_count-(($request->page+1)*6);

        echo json_encode(array('media'=>$medias,'count'=>$media_count));
    }

    public function details($id)
    {
        $banner = Pages::where('slug','media-center')->first();
        $blog = MediaCenter::where('id',$id)->first();
        return view('mediacenter::front.detail',compact('blog','banner'));
    }

}
