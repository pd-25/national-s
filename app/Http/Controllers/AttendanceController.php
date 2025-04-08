<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\StudentClassMapping;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    
    public function index()
    {
        return view('admin.attendancestudent.takeattendance');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if($request->session_id && $request->class_id && $request->section_id && $request->dateAttendance){
            $session_id = $request->session_id;
            $teacher_class_assigned = $request->class_id;
            $teacher_section_assigned = $request->section_id;
            $date = date('Y-m-d', strtotime($request->dateAttendance));
        }else{
            $session_id = GetSession('active_session')[0]->id;
            $teacher_details = GetTeacher(auth()->guard('admin')->user()->id);
            $teacher_class_assigned = $teacher_details->teacherclassmapping[0]->class_id;
            $teacher_section_assigned = $teacher_details->teacherclassmapping[0]->section_id;
            $date = date('Y-m-d');
        }
        
        $attendance = Attendance::where('session_id', $session_id)->where('class_id', $teacher_class_assigned)->where('section_id', $teacher_section_assigned)->where('date_taken', $date)->get();
        
        return  $attendance;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'class_id' => 'required|exists:classes,id',
            'section_id' => 'required|exists:sections,id',
            'late' => 'nullable|string|max:255',
            'status' => 'required|boolean'
        ]);

        $attendance = Attendance::where('user_id',  $request->user_id)->whereDate('date_taken', date('Y-m-d'))->count();
        if($attendance > 0){
            return response()->json([
                'error' => 'Attendance already taken'
            ], 201);
        }
    
        $attendance = new Attendance;
        if($request->session_id && $request->dateAttendance){
            $session_id = $request->session_id;
            $date_taken =  date('Y-m-d', strtotime($request->dateAttendance));
        }else{
            $session_id = GetSession('active_session')[0]->id;
            $date_taken = date('Y-m-d');
        }
        
        $attendance->teacher_id = auth()->guard('admin')->user()->id;
        $attendance->user_id = $request->user_id;
        $attendance->session_id = $session_id;
        $attendance->class_id = $request->class_id;
        $attendance->section_id = $request->section_id;
        $attendance->date_taken = $date_taken;
        $attendance->time_taken = date('H:i');
        $attendance->late = $request->late;
        $attendance->status = $request->status;
        $attendance->save();
        
        if ($attendance->status == 1 && $attendance->late == 0) {
            $returnValue = ['success' => 'Attendance recorded successfully.'];
        } elseif ($attendance->status == 0 && $attendance->late == 0) {
            $returnValue = ['error' => 'Absent today.'];
        } elseif ($attendance->status == 1 && $attendance->late == 1) {
            $returnValue = ['warning' => 'Late attendance recorded successfully.'];
        }
        return response()->json($returnValue, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        return view('admin.attendancestudent.viewattendance');
    }

    public function getTodayAttendanceData(Request $request)
    {
        // ->where('teacher_id', auth()->guard('admin')->user()->id)
        $attendance = Attendance::with('studentDetails','studentSession','studentClass',
        'studentSection')->where('session_id', $request->session_id)->where('class_id', $request->class_id)->where('section_id', $request->section_id)->whereDate('date_taken', $request->dateAttendance)->get();
        return ['today' => $attendance];
    }

    public function viewStudentAttendance()
    {
        $session_id = GetSession('active_session')[0]->id;
        $teacher_details = GetTeacher(auth()->guard('admin')->user()->id);
        $teacher_class_assigned = $teacher_details->teacherclassmapping[0]->class_id;
        $teacher_section_assigned = $teacher_details->teacherclassmapping[0]->section_id;
        $studentList = StudentClassMapping::with('studentDetails', 'studentSession', 'studentClass', 'studentSection')->where('session_id', $session_id)->where('class_id', $teacher_class_assigned)->where('section_id', $teacher_section_assigned)->get();
        return view('admin.attendancestudent.viewstudentattendance', compact('studentList'));
    }

    public function viewStudentList(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            // 'class_id' => 'required',
            // 'section_id' => 'required',
            'typeData' => 'required|integer', 
            'single_date' => 'nullable|date',
            'from_date' => 'nullable|date',
            'to_date' => 'nullable|date',
        ]);
        $session_id = $request->session_id == 0 ? GetSession('active_session')[0]->id : $request->session_id;
        $attendance = Attendance::with('studentDetails', 'studentSession', 'studentClass', 'studentSection')
            ->where('user_id', $request->student_id)
            ->where('session_id', $session_id)
            ->orderBy('date_taken', 'desc');

        if ($request->class_id) {
            $attendance->where('class_id', $request->class_id);
        }
            
        if ($request->section_id) {
            $attendance->where('section_id', $request->section_id);
        }
            
        if ($request->typeData == 2 && $request->single_date) {
            $attendance->whereDate('date_taken', $request->single_date);
        }

        if ($request->typeData == 3 && $request->from_date && $request->to_date) {
            $attendance->whereBetween('date_taken', [$request->from_date, $request->to_date]);
        }

        $attendanceRecords = $attendance->get();
        return response()->json($attendanceRecords);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $attendance = Attendance::find($request->id);
        $attendance->delete();
        return ['warning'=>'Attendance Deleted successfully'];
    }
    
    public function classAttendance(Request $request)
    {
        return view('admin.manageattendance.classattendance');
    }

    public function classAttendanceData(Request $request)
    {
        $request->validate([
            'session_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'dateAttendance' => 'date',
        ]);
        
        $attendance = Attendance::with('teacherDetails','studentDetails','studentSession','studentClass',
        'studentSection')->where('session_id', $request->session_id)->where('class_id', $request->class_id)->where('section_id', $request->section_id)->whereDate('date_taken', $request->dateAttendance)->get();
        return $attendance;
    }

    public function studentAttendance(Request $request)
    {
        return view('admin.manageattendance.studentattendance');
    }

    public function takeClassAttendance()
    {
        return view('admin.manageattendance.attendance');
    }
}