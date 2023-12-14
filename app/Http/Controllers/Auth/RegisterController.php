<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegisterPage(){
        return view('admin.auth.register');
    }

    public function adminRegister(Request $request){
        $request->validate([
            'name' =>  'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password'
        ]);

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('index.showLoginPage')->with('success', 'Admin register successfullly !!');
    }
}
