<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Attendance;
use App\Models\StudentClassMapping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
        $session_id = GetSession('active_session')[0]->id;
        $teacher_details = GetTeacher(auth()->guard('admin')->user()->id);
        if($teacher_details){
            if($teacher_details->teacherclassmapping->count() == 0){
                if($teacher_details->teacherclassmapping[0]->class_id && $teacher_details->teacherclassmapping[0]->section_id){
                    return redirect()->route('admin.index')->withError('Oppes! The teacher does not have any class or section assigned.');
                }
            }
        }
        $teacher_class_assigned = $teacher_details->teacherclassmapping[0]->class_id;
        $teacher_section_assigned = $teacher_details->teacherclassmapping[0]->section_id;
        $totalStudent = StudentClassMapping::where('session_id', $session_id)->where('class_id', $teacher_class_assigned)->where('section_id', $teacher_section_assigned)->count();
        $attendance = Attendance::where('session_id', $session_id)->where('class_id', $teacher_class_assigned)->where('section_id', $teacher_section_assigned)->whereDate('date_taken', date('Y-m-d'))->get();
        
        $totalPresent = 0;
        $totalAbsent = 0;
        $totalLate = 0;

        foreach ($attendance as $record) {
            if ($record->status == 1) {
                if ($record->late == 1) {
                    $totalLate++;
                } else {
                    $totalPresent++;
                }
            } elseif ($record->status == 0) {
                $totalAbsent++;
            }
        }

        $dashboardData = [
            'total_present' => $totalPresent,
            'total_absent' => $totalAbsent,
            'total_late' => $totalLate,
            'totalStudent' => $totalStudent,
        ];

        return view('admin.teacher_dashboard', compact('dashboardData'));
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
        Session::forget('session_session_id');
        Session::forget('session_class_id');
        Session::forget('session_section_id');
        return Redirect()->route('admin.index')->with('info', 'Successfully Logged Out');
    }
}