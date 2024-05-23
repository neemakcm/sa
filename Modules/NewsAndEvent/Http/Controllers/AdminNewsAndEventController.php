<?php

namespace Modules\NewsAndEvent\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\NewsAndEvent\Entities\NewsAndEvent;
use Session,Str;
class AdminNewsAndEventController extends Controller
{
    public function index()
    {
        return view('newsandevent::admin.index');
    }

    public function list(Request $request)
    {
        $search   = $request->search['value'];
        $sort     = $request->order;
        $column   = $sort[0]['column'];
        $order    = $sort[0]['dir'] == 'asc' ? "ASC" : "DESC" ;

        $pages = NewsAndEvent::where('id','>',0);
        if ($search != '') 
        {
            $pages->where('title', 'LIKE', '%'.$search.'%')->orWhere('description', 'LIKE', '%'.$search.'%');
        }

        $total  = $pages->count();

        $result['data'] = $pages->take($request->length)->skip($request->start)->get();
        //dd($result['data']);
        $result['recordsTotal'] = $total;
        $result['recordsFiltered'] =  $total;

        echo json_encode($result);
    }

    public function add()
    {
        return view('newsandevent::admin.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
        ]);
        $news = new NewsAndEvent;
        $news->title = $request->title;
        $news->description = $request->description;
        if($request->media){
            $org_name         =   $request->file('media')->getClientOriginalName();
            $names                =   pathinfo($org_name, PATHINFO_FILENAME);
            $slug_name=Str::slug($names,'-');
            $mediaextension       =   $request->file('media')->getClientOriginalExtension();
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $image_name = substr(str_shuffle($str_result), 0, 10);
            $imageToStore         =   $slug_name."-" . $image_name . '.' . $mediaextension;
            $request->file('media')->storeAs('news', $imageToStore);
            $news->media  =   'news/'.$imageToStore;
        }
        // $news->media = $request->file('media')->store('news');
        $news->save();

        Session::flash('message', 'Entry added successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/news-and-events');

    }

    public function edit($id)
    {
        $page = NewsAndEvent::find($id);
        return view('newsandevent::admin.edit',compact('page'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'description' => 'required',
        ]);
        $blog = NewsAndEvent::find($request->id);
        $blog->title = $request->title;
        $blog->description = $request->description;
        if($request->media){
            $org_name         =   $request->file('media')->getClientOriginalName();
            $names                =   pathinfo($org_name, PATHINFO_FILENAME);
            $slug_name=Str::slug($names,'-');
            $mediaextension       =   $request->file('media')->getClientOriginalExtension();
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $image_name = substr(str_shuffle($str_result), 0, 10);
            $imageToStore         =   $slug_name."-" . $image_name . '.' . $mediaextension;
            $request->file('media')->storeAs('news', $imageToStore);
            $blog->media  =   'news/'.$imageToStore;
        }
        // if($request->media)
        //     $blog->media = $request->file('media')->store('news');
        $blog->save();
        Session::flash('message', 'Entry updated successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/news-and-events');

    }

    public function delete($id)
    {
        $page = NewsAndEvent::find($id);
        $page->delete();

        Session::flash('message', 'Entry deleted successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/news-and-events');
    }
}
