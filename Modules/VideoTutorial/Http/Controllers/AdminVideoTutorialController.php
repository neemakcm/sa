<?php

namespace Modules\VideoTutorial\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Session,DB;
use Modules\VideoTutorial\Entities\VideoTutorial;
use Modules\Categories\Entities\Categories;
use Image;
class AdminVideoTutorialController extends Controller
{
    public function index()
    {
        return view('videotutorial::admin.index');
    }
    public function list(Request $request)
    {
        $videoTutorial=(new VideoTutorial())->listVideoTutorial($request);
        echo json_encode($videoTutorial);
    }

    public function add()
    {
        $categories=(new Categories())->listIsLastChildCategories();
       return view('videotutorial::admin.add',compact('categories'));
    }

    public function store(Request $request)
    {
        $videos = new VideoTutorial;
        $videos->title = $request->title;
        $videos->category_id = $request->category_id;
        $videos->description = $request->description;
        $videos->thumbnail = $request->file('thumbnail')->store('videoTutorial');
        $videos->type = $request->type;
        if($request->type == 0)
            $videos->video = $request->file('video')->store('videoTutorial');
        else
            $videos->video = $request->video;
        $videos->save();
        if($request->thumbnail)
        {
            Image::make(storage_path('app/' . $videos->thumbnail))
            ->resize(340, 220)
            ->save(storage_path('app/' . $videos->thumbnail));
        }
        Session::flash('message', 'Entry updated successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        echo json_encode(array('status' => true));
    }

    public function edit($id)
    {
        $categories=(new Categories())->listIsLastChildCategories();
        $video=(new VideoTutorial())->videoTutorialDetailById($id);
        return view('videotutorial::admin.edit',compact('video'));
    }

    public function update(Request $request)
    {
        $videos = VideoTutorial::find($request->id);
        $videos->title = $request->title;
        $videos->description = $request->description;
        if($request->thumbnail)
            $videos->thumbnail = $request->file('thumbnail')->store('videoTutorial');
        if($request->type == 0 && $request->video)
            $videos->video = $request->file('video')->store('videoTutorial');
        else
            $videos->video = $request->video;
        $videos->save();
        if($request->thumbnail)
        {
            Image::make(storage_path('app/' . $videos->thumbnail))
            ->resize(340, 220)
            ->save(storage_path('app/' . $videos->thumbnail));
        }
        Session::flash('message', 'Entry updated successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        echo json_encode(array('status' => true));
    }

    public function delete($id)
    {
        $tutorial = VideoTutorial::find($id);
        $tutorial->delete();

        Session::flash('message', 'Entry deleted successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/video-tutorials');
    }
}
