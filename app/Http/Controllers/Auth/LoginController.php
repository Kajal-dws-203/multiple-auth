<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class LoginController extends Controller
{
    public function __construct(){
        $this->middleware('guest')->except('logout');
    }

    public function showLoginPage(){
        if(Auth::guard('user')->check()){
            return redirect()->route('show.user.dashboard');
        }
        else if (Auth::guard('admin')->check()) {
            return redirect()->route('show.admin.dashboard');
        }
        return view('admin.auth.login');
    }

    public function showAdminDashboard(Request $request){
        if(Auth::guard('admin')->check()){
            if ($request->ajax()) {
                $data = User::select('*')->where('role','user');
                return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
           
                                $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
          
                                return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
            }
            return view('admin.top-nav');
        }
        return view('admin.auth.login');
    }

    public function showUserDashboard(){
        return view('admin.auth.userDashboard');
    }

    public function adminLogin(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $userData = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        
        $guards = ['user','admin'];

        foreach($guards as $guard){

            if (Auth::guard($guard)->attempt($userData)) {

                $redirectRoute = $guard == 'user' ? 'show.user.dashboard' : 'show.admin.dashboard';

                return redirect()->route($redirectRoute)->with('success','login successfully !!');
            }
        }
        return back()->with('error','Email and password is not matched !!');
    }

    public function logout(Request $request){
        foreach(['admin','user'] as $guard){
            if(Auth::guard($guard)->check()){
                Auth::guard($guard)->logout();
            }
        }
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('index.showLoginPage');
    }

}
