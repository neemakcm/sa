<?php

namespace Modules\Blogs\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Pages\Entities\Pages;
use Modules\Blogs\Entities\Blog;
use Modules\NewsAndEvent\Entities\NewsAndEvent;
use Modules\LatestVideos\Entities\LatestVideos;

use DB;
class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $blogs = Blog::limit(9)->orderBy('id','desc')->get();
        $blogs_count = Blog::count();
        $news = NewsAndEvent::limit(9)->orderBy('id','desc')->get();
        $news_count = NewsAndEvent::count();
        $videos = LatestVideos::limit(9)->orderBy('id','desc')->get();
        $video_count = LatestVideos::count();
        $banner = Pages::where('slug','news-blogs')->first();
        return view('blogs::front.index',compact('videos','video_count','blogs','blogs_count','news','news_count','banner'));
    }

    public function pageIndex(Request $request)
    {
        if ($request->ajax()) {
            $results = Blog::orderBy('id','desc')->paginate(9);
        }
        echo json_encode($results);
    }
    public function newsPagiation(Request $request)
    {
        if ($request->ajax()) {
            $results = NewsAndEvent::orderBy('id','desc')->paginate(9);
        }
       echo json_encode($results);
    }
    public function videoPagiation(Request $request)
    {
        if ($request->ajax()) {
            $results = LatestVideos::orderBy('id','desc')->paginate(9);
        }
       echo json_encode($results);
    }
    public function details($id)
    {
        $banner = Pages::where('slug','news-blogs')->first();
        $blog = Blog::where('id',$id)->first();
        return view('blogs::front.details',compact('blog','banner'));
    }
    public function newsDetails($id)
    {
        $banner = Pages::where('slug','news-blogs')->first();
        $news = NewsAndEvent::where('id',$id)->first();
        return view('blogs::front.news-details',compact('news','banner'));
    }
}
