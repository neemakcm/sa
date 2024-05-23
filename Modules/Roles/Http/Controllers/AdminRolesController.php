<?php

namespace Modules\Roles\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

use Modules\Roles\Entities\Roles;
use Modules\Admin\Entities\Permissions;

use Session;

class AdminRolesController extends Controller
{
    public function index()
    {
        return view('roles::admin.index');
    }

    public function list(Request $request)
    {
        $search   = $request->search['value'];
        $sort     = $request->order;
        $column   = $sort[0]['column'];
        $order    = $sort[0]['dir'] == 'asc' ? "ASC" : "DESC" ;

        $roles = Roles::where('id','>',0);

        if ($search != '') 
        {
            $roles->where('title', 'LIKE', '%'.$search.'%')->orWhere('description', 'LIKE', '%'.$search.'%');
        }

        $total  = $roles->count();

        $result['data'] = $roles->take($request->length)->skip($request->start)->get();
        $result['recordsTotal'] = $total;
        $result['recordsFiltered'] =  $total;

        echo json_encode($result);
    }

    public function add()
    {
        $permissions = Permissions::all();

        return view('roles::admin.add',compact('permissions'));
    }

    public function store(Request $request)
    {
        if(!isset($request->perms) || count($request->perms) == 0)
        {
            return redirect()->back()->with('message', 'Select permissions');
        }
        $role = new Roles;
        $role->title = $request->title;
        $role->slug = Str::slug($request->title,'-');
        $role->description = $request->description;
        $role->save();

        if(count($request->perms) > 0)
            $role->permissions()->sync($request->perms);

        Session::flash('message', 'Entry added successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/roles');

    }

    public function edit($id)
    {
        $permissions = Permissions::all();
        $role = Roles::find($id);

        return view('roles::admin.edit',compact('permissions','role'));
    }

    public function update(Request $request)
    {
        if(!isset($request->perms) || count($request->perms) == 0)
        {
            return redirect()->back()->with('message', 'Select permissions');
        }
        
        $role = Roles::find($request->id);
        $role->title = $request->title;
        $role->description = $request->description;
        $role->save();

        if(count($request->perms) > 0)
            $role->permissions()->sync($request->perms);

        Session::flash('message', 'Entry updated successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/roles');

    }
}
