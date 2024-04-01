<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Department;
use App\Models\ShowUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function AdminDashboard()
    {
        return view('admin.dashboard');
    }
    public function AdminUsers()
    {
        $users = User::all();
        return view('admin.users', compact('users'), ['users' => $users]);
    }
    public function AdminDepartments()
    {
        return view('admin.departments');
    }
    public function AdminUserAddForm()
    {
        $departments = Department::all();
        return view('admin.user-add', compact('departments'), ['departments' => $departments]);
    }
    public function AdminUserStore(UserRequest $request)
    {
//        dd($request->all());
        $user = new ShowUser();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->contact = $request->contact;
        $user->department_id = $request->department;
        $user->address = $request->address;
        $user->address_latitude = $request->address_latitude;
        $user->address_longitude = $request->address_longitude;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('images/', $filename);
            $user->image = $filename;
        }
        $user->save();
        return redirect()->route('admin.users')->with('success', 'User Added Successfully');
    }
}
