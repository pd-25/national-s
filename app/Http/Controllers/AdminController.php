<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->usertype == 1){
            return redirect()->route('admin.dashboard');
        }else{
            return view('admin.auth.login');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dashboard');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function loginProcess(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        
        $credentials = $request->only('email', 'password');
        $admin = Admin::where('email', $request->email)->first();
        if($admin){
            if (Auth::guard('admin')->attempt($credentials)) {
                if($admin->usertype == 1 || $admin->usertype == 2){
                    return redirect()->route('admin.dashboard')->withSuccess('You have Successfully loggedin');
                }else{
                    return redirect()->route('teacher.dashboard')->withSuccess('Class Teacher logged In');
                }
            }
        }
        return redirect()->route('admin.index')->withError('Oppes! You have entered invalid credentials');
    }


    /**
     * Display the specified resource.
     */
    public function teacherDashboard()
    {
        return view('admin.teacher_dashboard');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    
    public function destroy()
    {
        //
    }
    
    public function logout() 
    {
        Auth::guard('admin')->logout();
        return Redirect()->route('admin.index')->with('info', 'Successfully Logged Out');
    }
}