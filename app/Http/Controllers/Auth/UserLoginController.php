<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLoginController extends Controller
{
    public function showUserLoginPage(){
        return view('admin.auth.userLogin');
    }
    public function submitUserLogin(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('show.user.dashboard')->with('success','login successfully !!');
        }
        return back()->with('error','Email and password is not matched !!');
    }
}
