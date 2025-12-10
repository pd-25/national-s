<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use App\Models\Classes;
use App\Models\Section;
use App\Models\Session;
use App\Models\Attendance;
use App\Models\StudentClassMapping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        $teachers = Admin::where('usertype', 0)->count();
        $staff = Admin::where('usertype', 2)->count();
        $students = User::count();
        $classes = Classes::count();
        $sections = Section::count();

        $dashboardData = [
            'teachers'=>$teachers,
            'staff'=>$staff,
            'students'=>$students,
            'classes' => $classes,
            'sections' => $sections
        ];
        return view('admin.dashboard.dashboard', compact("dashboardData"));
    }

    public function registerUser()
    {
        return view('admin.auth.registration');   
    }

    public function store(Request $request)
    {
        $request->validate([
            'usertype'  => 'required',
            'status'    => 'required'
        ]);
        if( $request->user_id == null){
            Admin::create([
                'name'           => $request->name,
                'usertype'       => $request->usertype,
                'status'         => $request->status,
                'email'          => $request->email,
                'password'       => Hash::make($request->password),
                'role_permission'=> $request->role_permission ?? [],
            ]);
            return redirect()->back()->with('success', 'Admin registered successfully');
        }else{
            $admin = Admin::findOrFail($request->user_id);
            if ($request->name) {
                $admin->name          = $request->name;
            }
            if ($request->usertype) {
                $admin->usertype      = $request->usertype;
            }
            if ($request->status) {
                $admin->status        = $request->status;
            }
            // $admin->email         = $request->email;
            if ($request->password) {
                $admin->password = Hash::make($request->password);
            }
            $admin->role_permission = $request->role_permission ?? [];
            $admin->save();
            return redirect()->back()->with('success', 'Updated successfully');
        }
        
    }

    public function roleandpermission()
    {
        return view('admin.auth.rolepermission');   
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
            if($admin->status != 1){
                return redirect()->route('admin.index')->withError('Oppes! Your credentials have been deactivated.');
            }
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

        return view('teacher.teacherDashboard.teacher_dashboard', compact('dashboardData'));
    }
    
    public function logout() 
    {
        Auth::guard('admin')->logout();
        return Redirect()->route('admin.index')->with('info', 'Successfully Logged Out');
    }
}