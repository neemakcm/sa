<?php

namespace Modules\MediaCenter\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\MediaCenter\Entities\MediaCenter;

use Session,Str;

class AdminMediaCenterController extends Controller
{
    public function index()
    {
        return view('mediacenter::admin.index');
    }

    public function list(Request $request)
    {
        $search   = $request->search['value'];
        $sort     = $request->order;
        $column   = $sort[0]['column'];
        $order    = $sort[0]['dir'] == 'asc' ? "ASC" : "DESC" ;

        $pages = MediaCenter::where('id','>',0);
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
        return view('mediacenter::admin.add');
    }

    public function store(Request $request)
    {
        $industry = new MediaCenter;
        $industry->title = $request->title;
        if($request->description == '')
            $industry->description = '';
        else
            $industry->description = $request->description;
        if($request->media){
            // $industry->media = $request->file('media')->store('media_center');
            $org_name         =   $request->file('media')->getClientOriginalName();
            $names                =   pathinfo($org_name, PATHINFO_FILENAME);
            $slug_name=Str::slug($names,'-');
            $mediaextension       =   $request->file('media')->getClientOriginalExtension();
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $image_name = substr(str_shuffle($str_result), 0, 10);
            $imageToStore         =   $slug_name."-" . $image_name . '.' . $mediaextension;
            $request->file('media')->storeAs('media_center', $imageToStore);
            $industry->media  =   'media_center/'.$imageToStore;
        }
        $industry->save();

        Session::flash('message', 'Entry added successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/mediaCenter');

    }

    public function edit($id)
    {
        $page = MediaCenter::find($id);
        return view('mediacenter::admin.edit',compact('page'));
    }

    public function update(Request $request)
    {
        $industry = MediaCenter::find($request->id);
        $industry->title = $request->title;
        if($request->description == '')
            $industry->description = '';
        else
            $industry->description = $request->description;
        if($request->media){
            // $industry->media = $request->file('media')->store('media_center');
            $org_name         =   $request->file('media')->getClientOriginalName();
            $names                =   pathinfo($org_name, PATHINFO_FILENAME);
            $slug_name=Str::slug($names,'-');
            $mediaextension       =   $request->file('media')->getClientOriginalExtension();
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $image_name = substr(str_shuffle($str_result), 0, 10);
            $imageToStore         =   $slug_name."-" . $image_name . '.' . $mediaextension;
            $request->file('media')->storeAs('media_center', $imageToStore);
            $industry->media  =   'media_center/'.$imageToStore;
        }
        // if($request->media)
        //     $industry->media = $request->file('media')->store('media_center');
        $industry->save();

        Session::flash('message', 'Entry updated successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/mediaCenter');

    }

    public function delete($id)
    {
        $page = MediaCenter::find($id);
        $page->delete();

        Session::flash('message', 'Entry deleted successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/mediaCenter');
    }
}
