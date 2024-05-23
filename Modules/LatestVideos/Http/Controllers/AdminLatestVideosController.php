<?php

namespace Modules\LatestVideos\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Modules\LatestVideos\Entities\LatestVideos;
use Str;
use Session;

class AdminLatestVideosController extends Controller
{
    public function index()
    {
        return view('latestvideos::admin.index');
    }

    public function list(Request $request)
    {
        $search   = $request->search['value'];
        $sort     = $request->order;
        $column   = $sort[0]['column'];
        $order    = $sort[0]['dir'] == 'asc' ? "ASC" : "DESC" ;
        $type     = $request->type;
        $floor     = $request->floor;

        $plan = LatestVideos::where('id','>',0);

        if ($search != '') 
        {
            $plan->where('title', 'LIKE', '%'.$search.'%')->orWhere('description', 'LIKE', '%'.$search.'%');
        }

        $total  = $plan->count();

        $result['data'] = $plan->orderBy('created_at','desc')->take($request->length)->skip($request->start)->get();

        $result['recordsTotal'] = $total;
        $result['recordsFiltered'] =  $total;

        echo json_encode($result);
    }


    public function add()
    {
        return view('latestvideos::admin.add');
    }

    public function store(Request $request)
    {
        $videos = new LatestVideos;
        $videos->title = $request->title;
        $videos->description = $request->description;
        if($request->description_font_size)
            $videos->description_font_size = $request->description_font_size;
        if($request->description_color_code)
            $videos->description_color_code = $request->description_color_code;
        if($request->title_font_size)
            $videos->title_font_size = $request->title_font_size;
        if($request->title_color_code)
            $videos->title_color_code = $request->title_color_code;
    
        // $videos->thumbnail = $request->file('thumbnail')->store('latestVideos');
        if($request->thumbnail){
            $org_name         =   $request->file('thumbnail')->getClientOriginalName();
            $names                =   pathinfo($org_name, PATHINFO_FILENAME);
            $slug_name=Str::slug($names,'-');
            $videoextension       =   $request->file('thumbnail')->getClientOriginalExtension();
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $image_name = substr(str_shuffle($str_result), 0, 10);
            $imageToStore         =   $slug_name."-" . $image_name . '.' . $videoextension;
            $request->file('thumbnail')->storeAs('latestVideos', $imageToStore);
            $videos->thumbnail  =   'latestVideos/'.$imageToStore;
        }
        

        $videos->type = $request->type;
        if($request->type == 0)
            $videos->video = $request->file('video')->store('latestVideos');
        else
            $videos->video = $request->video;
        $videos->save();

        LatestVideos::createThumbnail($videos);

        Session::flash('message', 'Entry updated successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        echo json_encode(array('status' => true));
    }

    public function edit($id)
    {
        $video = LatestVideos::where('id',$id)->first();

        return view('latestvideos::admin.edit',compact('video'));
    }

    public function update(Request $request)
    {
        $videos = LatestVideos::find($request->id);
        $videos->title = $request->title;
        $videos->description = $request->description;
        if($request->description_font_size)
        $videos->description_font_size = $request->description_font_size;
    if($request->description_color_code)
        $videos->description_color_code = $request->description_color_code;
    if($request->title_font_size)
        $videos->title_font_size = $request->title_font_size;
    if($request->title_color_code)
        $videos->title_color_code = $request->title_color_code;
    if($request->thumbnail){
        $org_name         =   $request->file('thumbnail')->getClientOriginalName();
        $names                =   pathinfo($org_name, PATHINFO_FILENAME);
        $slug_name=Str::slug($names,'-');
        $videoextension       =   $request->file('thumbnail')->getClientOriginalExtension();
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $image_name = substr(str_shuffle($str_result), 0, 10);
        $imageToStore         =   $slug_name."-" . $image_name . '.' . $videoextension;
        $request->file('thumbnail')->storeAs('latestVideos', $imageToStore);
        $videos->thumbnail  =   'latestVideos/'.$imageToStore;
    }
        // if($request->thumbnail)
        //     $videos->thumbnail = $request->file('thumbnail')->store('latestVideos');
        $videos->type = $request->type;
        if($request->type == 0 && $request->video)
            $videos->video = $request->file('video')->store('latestVideos');
        else
            $videos->video = $request->video;
        $videos->save();

        LatestVideos::createThumbnail($videos);

        Session::flash('message', 'Entry updated successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        echo json_encode(array('status' => true));
    }

    public function delete($id)
    {
        $event = LatestVideos::find($id);
        $event->delete();

        Session::flash('message', 'Entry deleted successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/latestVideos');
    }
}
