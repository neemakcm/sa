<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Modules\Admin\Entities\Admin;
use Illuminate\Support\Facades\Crypt;
use Mail;
use Auth;
use URL;


class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/admin';

    public function showLoginForm()
    {
        if(Auth::guard('admin')->check())
            return redirect('admin');
        return view('admin::login');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email', 
            'password' => 'required',
        ]);

        $admin = Admin::where('email',$request->email)->first();

        if($admin == null)
        {
            return redirect('/admin/login')->withErrors(['Account doesnot exist.']);
        }
        else if($admin->status == 0)
        {
            return redirect('/admin/login')->withErrors(['Account inactive. Please contact admin.']);
        }
        else
        {
            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1]))
            {
                return redirect('/admin');
            }
            else
            {
                return redirect('/admin/login')->withErrors(['Provide a valid username or password']);
            }
        }
        
    }
}
