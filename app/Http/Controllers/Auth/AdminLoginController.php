<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function showAdminLoginPage(){
        return view('admin.auth.adminLogin');
    }
    public function submitAdminLogin(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('show.admin.dashboard')->with('success','login successfully !!');
        }
        return back()->with('error','Email and password is not matched !!');
    }
}
