<?php

namespace Modules\UserManual\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Modules\UserManual\Entities\UserManual;
use Modules\Products\Entities\Products;

use Session,DB;

class AdminUserManualController extends Controller
{
    public function index()
    {
        return view('usermanual::admin.index');
    }

    public function list(Request $request)
    {
        $search   = $request->search['value'];
        $sort     = $request->order;
        $column   = $sort[0]['column'];
        $order    = $sort[0]['dir'] == 'asc' ? "ASC" : "DESC" ;

        $category = UserManual::with('product')->has('product');

        if ($search != '') 
        {
            $category->where('title', 'LIKE', '%'.$search.'%');
            $category->whereHas('product', function($q) use ($search) {
                        $q->where('name', 'LIKE', '%'.$search.'%');
                    });
        }

        $total  = $category->count();

        $result['data'] = $category->take($request->length)->skip($request->start)->get();
        $result['recordsTotal'] = $total;
        $result['recordsFiltered'] =  $total;

        echo json_encode($result);
    }


    public function add()
    {
        $products = Products::whereIn('type',array(0,2))->where('is_active',1)->get();
        return view('usermanual::admin.add',compact('products'));
    }

    public function store(Request $request)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $request->validate([
            'product_id' => 'required',
            'title' => 'required',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'manual' => 'required|mimetypes:application/pdf|max:6096"',
        ]);
        $product = Products::find($request->product_id);

        $category = new UserManual;
        $category->category_id = $product->category_id;
        $category->product_id = $request->product_id;
        $category->title = $request->title;
        $category->thumbnail = $request->file('thumbnail')->store('manual');
        $category->manual = $request->file('manual')->store('manual');
        $category->save();

        Session::flash('message', 'Entry added successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/user-manuals');
    }

    public function edit($id)
    {
        $manual = UserManual::with('product')->find($id);

        return view('usermanual::admin.edit',compact('manual'));
    }

    public function update(Request $request)
    {
        $category = UserManual::find($request->id);
        $category->title = $request->title;
        if($request->thumbnail)
            $category->thumbnail = $request->file('thumbnail')->store('manual');
        if($request->manual)
            $category->manual = $request->file('manual')->store('manual');
        $category->save();

        Session::flash('message', 'Entry updated successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/user-manuals');
    }

    public function delete($id)
    {
        $category = UserManual::find($id);
        $category->delete();

        Session::flash('message', 'Entry deleted successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/user-manuals');
    }
}
