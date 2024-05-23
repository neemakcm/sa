<?php

namespace Modules\Pages\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\Pages\Entities\Settings;
use Modules\Pages\Entities\Management;

use Session,Str;

class AdminManagementController extends Controller
{
    public function index()
    {
        return view('pages::management.index');
    }

    public function list(Request $request)
    {
        $search   = $request->search['value'];
        $sort     = $request->order;
        $column   = $sort[0]['column'];
        $order    = $sort[0]['dir'] == 'asc' ? "ASC" : "DESC" ;

        $pages = Management::where('id','>',0);
        if ($search != '') 
        {
            $pages->where('title', 'LIKE', '%'.$search.'%')->orWhere('position', 'LIKE', '%'.$search.'%');
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
        return view('pages::management.add');
    }

    public function store(Request $request)
    {
        $industry = new Management;
        $industry->title = $request->title;
        $industry->name = $request->name;
        $industry->description = $request->description;
        $industry->position = $request->position;
        if($request->image)
        {
            $org_name         =   $request->file('image')->getClientOriginalName();
            $names                =   pathinfo($org_name, PATHINFO_FILENAME);
            $slug_name=Str::slug($names,'-');
            $certificateextension       =   $request->file('image')->getClientOriginalExtension();
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $image_name = substr(str_shuffle($str_result), 0, 10);
            $imageToStore         =   $slug_name."-" . $image_name . '.' . $certificateextension;
            $request->file('image')->storeAs('management', $imageToStore);
            $industry->image  =   'management/'.$imageToStore;
        }
        // if($request->image)
        //     $industry->image = $request->file('image')->store('management');
        $industry->save();

        Session::flash('message', 'Entry added successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/managements');

    }

    public function edit($id)
    {
        $page = Management::find($id);
        return view('pages::management.edit',compact('page'));
    }

    public function update(Request $request)
    {
        $industry = Management::find($request->id);
        $industry->title = $request->title;
        
        $industry->name = $request->name;
        $industry->description = $request->description;
        $industry->position = $request->position;
        if($request->image)
        {
            $org_name         =   $request->file('image')->getClientOriginalName();
            $names                =   pathinfo($org_name, PATHINFO_FILENAME);
            $slug_name=Str::slug($names,'-');
            $certificateextension       =   $request->file('image')->getClientOriginalExtension();
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $image_name = substr(str_shuffle($str_result), 0, 10);
            $imageToStore         =   $slug_name."-" . $image_name . '.' . $certificateextension;
            $request->file('image')->storeAs('management', $imageToStore);
            $industry->image  =   'management/'.$imageToStore;
        }
        // if($request->image)
        //     $industry->image = $request->file('image')->store('management');
        $industry->save();

        Session::flash('message', 'Entry updated successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/managements');

    }

    public function delete($id)
    {
        $page = Management::find($id);
        $page->delete();

        Session::flash('message', 'Entry deleted successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/managements');
    }
}
