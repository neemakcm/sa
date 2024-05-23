<?php

namespace Modules\Blogs\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Blogs\Entities\Blog;
use Session,Str,Validator;
use Image,File;
class AdminBlogsController extends Controller
{
    public function index()
    {
        return view('blogs::admin.index');
    }

    public function list(Request $request)
    {
        $search   = $request->search['value'];
        $sort     = $request->order;
        $column   = $sort[0]['column'];
        $order    = $sort[0]['dir'] == 'asc' ? "ASC" : "DESC" ;

        $pages = Blog::where('id','>',0)->orderBy('id','desc');
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
        return view('blogs::admin.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'media' => 'required',
        ]);
        $blog = new Blog;
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
            $request->file('media')->storeAs('blogs', $imageToStore);
            $blog->media  =   'blogs/'.$imageToStore;
        }
        // $blog->media = $request->file('media')->store('blogs');
        $blog->save();
        Image::make(storage_path('app/' . $blog->media))
        ->resize(340, 220)
        ->save(storage_path('app/' . $blog->media));
        
        Session::flash('message', 'Entry added successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/blog');

    }

    public function edit($id)
    {
        $page = Blog::find($id);
        return view('blogs::admin.edit',compact('page'));
    }

    public function update(Request $request)
    {
        $blog = Blog::find($request->id);
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
            $request->file('media')->storeAs('blog', $imageToStore);
            $blog->media  =   'blog/'.$imageToStore;
        }
        // if($request->media)
            // $blog->media = $request->file('media')->store('blog');
        $blog->save();
        if($request->media)
        {
            // Image::make($request->file('photo')->getRealPath());
            Image::make(storage_path('app/' . $blog->media))
            ->resize(340, 220)
            ->save(storage_path('app/' . $blog->media));
        }
        
        Session::flash('message', 'Entry updated successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/blog');

    }

    public function delete($id)
    {
        $page = Blog::find($id);
        $page->delete();

        Session::flash('message', 'Entry deleted successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/blog');
    }
}
