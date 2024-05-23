<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\Admin\Entities\Admin;
use Modules\Roles\Entities\Roles;

use Session,DB,Validator;

class AdminUserController extends Controller
{
    public function index()
    {
        $role_split = DB::table('admin_users')
                        ->select(DB::raw('count(admin_users.id) as user_count, status, roles.title,role_id'))
                        ->leftJoin('roles','roles.id','=','admin_users.role_id')
                        ->whereNull('admin_users.deleted_at')
                        ->groupBy('role_id','status')
                        ->get();

        $user_count = array();

        foreach ($role_split as $value) 
        {
            $user_count[$value->title][$value->status] = $value->user_count;
        }

        return view('admin::admin.index', compact('user_count'));
    }

    public function list(Request $request)
    {
        $search   = $request->search['value'];
    	$type     = $request->type;
        $sort     = $request->order;
        $column   = $sort[0]['column'];
        $order    = $sort[0]['dir'] == 'asc' ? "ASC" : "DESC" ;

        $admin = Admin::select('*',DB::raw('DATE_FORMAT(DATE_ADD(created_at, INTERVAL "5:30" HOUR_MINUTE),"%Y-%c-%d %r") as change_date'))
                      ->with('roles');

        if ($search != '') 
        {
            $admin->where('name', 'LIKE', '%'.$search.'%')
                  ->orWhere('email', 'LIKE', '%'.$search.'%')
                  ->orWhereHas('roles', function($q) use($search){
                        $q->where('title', 'LIKE', '%'.$search.'%');
                    });
            
        }

        $total  = $admin->count();

        $result['data'] = $admin->take($request->length)->skip($request->start)->get();
        $result['recordsTotal'] = $total;
        $result['recordsFiltered'] =  $total;

        echo json_encode($result);
    }


    public function add()
    {
        $roles = Roles::all();

        return view('admin::admin.add',compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:admin_users',
        ]);

        $user = new Admin;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role_id = $request->role_id;
        $user->status = $request->status;
        $user->save();


        Session::flash('message', 'Entry added successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/admin-users');
    }

    public function edit($id)
    {
        $roles = Roles::all();
        $user = Admin::find($id);

        return view('admin::admin.edit',compact('roles','user'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'email' => "required|email|unique:admin_users,email,$request->id,id,deleted_at,NULL"
        ]);


        $user = Admin::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password != '')
            $user->password = bcrypt($request->password);
        $user->role_id = $request->role_id;
        $user->status = $request->status;
        $user->save();

        Session::flash('message', 'Entry updated successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/admin-users');

    }

    public function view($id)
    {
        $user = Admin::with('roles')
                    ->with(['userLog' => function($q)
                    {
                        $q->orderBy('created_at', 'desc');
                        $q->limit(1);
                    }])->where('id',$id)->first();

        return view('admin::admin.view', compact('user'));
    }

    public function delete($id)
    {
        $user = Admin::where('id',$id)->first();
        $user->delete();

        Session::flash('message', 'Entry deleted successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/admin-users');
    }
}
