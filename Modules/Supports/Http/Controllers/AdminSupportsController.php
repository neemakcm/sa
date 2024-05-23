<?php

namespace Modules\Supports\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Modules\Supports\Entities\Supports;

use Session;

class AdminSupportsController extends Controller
{
    public function index()
    {
        return view('supports::admin.index');
    }

    public function list(Request $request)
    {
        $search   = $request->search['value'];
        $sort     = $request->order;
        $column   = $sort[0]['column'];
        $order    = $sort[0]['dir'] == 'asc' ? "ASC" : "DESC" ;

        $supports = Supports::with('products');

        if ($search != '') 
        {
            $supports->where('name', 'LIKE', '%'.$search.'%')->orWhere('description', 'LIKE', '%'.$search.'%');
        }

        $total  = $supports->count();

        $result['data'] = $supports->take($request->length)->skip($request->start)->get();
        $result['recordsTotal'] = $total;
        $result['recordsFiltered'] =  $total;

        echo json_encode($result);
    }

    public function add()
    {
        return view('supports::admin.add');
    }

    public function store(Request $request)
    {
        $support = new Supports;
        $support->name = $request->name;
        $support->icon = $request->file('icon')->store('support');
        $support->description = $request->description;
        $support->save();

        Session::flash('message', 'Entry added successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/support-options');

    }

    public function edit($id)
    {
        $support = Supports::find($id);

        return view('supports::admin.edit',compact('support'));
    }

    public function update(Request $request)
    {
        $support = Supports::find($request->id);
        $support->name = $request->name;
        if($request->icon)
            $support->icon = $request->file('icon')->store('support');
        $support->description = $request->description;
        $support->save();

        Session::flash('message', 'Entry updated successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/support-options');

    }

    public function delete($id)
    {
        $support = Supports::find($id);
        $support->delete();

        Session::flash('message', 'Entry deleted successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/support-options');
    }
}
