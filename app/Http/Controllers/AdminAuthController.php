<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminLoginRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }
    public function AdminLoginCheck(AdminLoginRequest $request)
    {
        $admin = Admin::where('email', $request->email)->first();
        if($admin){
            if(Hash::check($request->password, $admin->password)){
                if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])){
                    return redirect()->route('admin.dashboard')->with('success', 'Login Successful');
                }else{
                    return redirect()->back()->with('error', 'Invalid Email or Password');
                }
            }else{
                return redirect()->back()->with('error', 'Invalid Password');
            }
        }else{
            return redirect()->back()->with('error', 'Invalid Email or Password');
        }

    }
    public function AdminLogout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('success', 'Successfully Logged Out');
    }
}
