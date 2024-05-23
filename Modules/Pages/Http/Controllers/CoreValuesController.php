<?php

namespace Modules\Pages\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Pages\Entities\Settings;
use Modules\Pages\Entities\CoreValues;

use Session,Str;
class CoreValuesController extends Controller
{
    public function index()
    {
        return view('pages::values.index');
    }

    public function list(Request $request)
    {
        $search   = $request->search['value'];
        $sort     = $request->order;
        $column   = $sort[0]['column'];
        $order    = $sort[0]['dir'] == 'asc' ? "ASC" : "DESC" ;

        $pages = CoreValues::where('id','>',0);
        if ($search != '') 
        {
            $pages->where('title', 'LIKE', '%'.$search.'%');
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
        return view('pages::values.add');
    }

    public function store(Request $request)
    {
        $industry = new CoreValues;
        $industry->title = $request->title;
        $industry->description = $request->description;
        $industry->status = $request->status;
        if($request->image)
        {
            $org_name         =   $request->file('image')->getClientOriginalName();
            $names                =   pathinfo($org_name, PATHINFO_FILENAME);
            $slug_name=Str::slug($names,'-');
            $certificateextension       =   $request->file('image')->getClientOriginalExtension();
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $image_name = substr(str_shuffle($str_result), 0, 10);
            $imageToStore         =   $slug_name."-" . $image_name . '.' . $certificateextension;
            $request->file('image')->storeAs('values', $imageToStore);
            $industry->image  =   'values/'.$imageToStore;
        }
        // if($request->image)
        //     $industry->image = $request->file('image')->store('values');
        $industry->save();
        Session::flash('message', 'Entry added successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/values');

    }

    public function edit($id)
    {
        $page = CoreValues::find($id);
        return view('pages::values.edit',compact('page'));
    }

    public function update(Request $request)
    {
        $industry = CoreValues::find($request->id);
        $industry->title = $request->title;
        $industry->description = $request->description;
        $industry->status = $request->status;
        if($request->image)
        {
            $org_name         =   $request->file('image')->getClientOriginalName();
            $names                =   pathinfo($org_name, PATHINFO_FILENAME);
            $slug_name=Str::slug($names,'-');
            $certificateextension       =   $request->file('image')->getClientOriginalExtension();
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $image_name = substr(str_shuffle($str_result), 0, 10);
            $imageToStore         =   $slug_name."-" . $image_name . '.' . $certificateextension;
            $request->file('image')->storeAs('values', $imageToStore);
            $industry->image  =   'values/'.$imageToStore;
        }
        // if($request->image)
        //     $industry->image = $request->file('image')->store('awards');
        $industry->save();

        Session::flash('message', 'Entry updated successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/values');

    }

    public function delete($id)
    {
        $page = CoreValues::find($id);
        $page->delete();

        Session::flash('message', 'Entry deleted successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/values');
    }
}
