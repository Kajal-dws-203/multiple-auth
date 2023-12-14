<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function createUser(){
        return view('admin.createUser');
    }

    public function storeUser(Request $request){
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('show.admin.dashboard')->with('success','User Created successfully !!');
    }

    public function postLogin(UserLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if(Auth::user()->role == "admin"){
                return redirect()->route('user.displayAdminDashboard')->with('success','You have Successfully loggedin');
            }
            else{
                return redirect()->route('user.displayUserDashboard')->with('success','You have Successfully loggedin');
            }
        }
        return redirect()->route('index.showLoginPage')->with('error','You entered invalide credential !!');  
    }

    public function displayAdminDashboard(){
        return view('admin.auth.adminDashboard');
    }

    public function displayUserDashboard(){
        return view('admin.auth.userDashboard');
    }
}
