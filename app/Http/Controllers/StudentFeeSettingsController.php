<?php

namespace App\Http\Controllers;

use App\Models\StudentFeeSettings;
use Illuminate\Http\Request;

class StudentFeeSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.payroll.student_fee_settings');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'session_id' => 'required|exists:sessions,id',
                'class_id' => 'required|exists:classes,id',
                'section_id' => 'required|exists:sections,id',
                'user_id' => 'required|exists:users,id',
                'charges_amount' => 'nullable|array',
                'months_validation' => 'nullable|array',
            ]);
            if($request->payment_setting_id != null){
                $studentFeeSettings = StudentFeeSettings::find($request->payment_setting_id);
                $studentFeeSettings->session_id = $request->session_id;
                $studentFeeSettings->class_id = $request->class_id;
                $studentFeeSettings->section_id = $request->section_id;
                $studentFeeSettings->user_id = $request->user_id;
                $studentFeeSettings->charges_amount = json_encode($request->charges_amount);
                $studentFeeSettings->months_validation = json_encode($request->months_validation);
                $studentFeeSettings->status = 1;
                $studentFeeSettings->save();
                return redirect()->back()->with('info', 'Student Fees Settings Updated Successfully');
            }else{
                $ValidationOnPayementSettings = StudentFeeSettings::where('session_id', $request->session_id)->where('class_id', $request->class_id)->where('section_id', $request->section_id)->where('user_id', $request->user_id)->count();
                if($ValidationOnPayementSettings == 0){
                    $studentFeeSettings = new StudentFeeSettings;
                    $studentFeeSettings->session_id = $request->session_id;
                    $studentFeeSettings->class_id = $request->class_id;
                    $studentFeeSettings->section_id = $request->section_id;
                    $studentFeeSettings->user_id = $request->user_id;
                    $studentFeeSettings->charges_amount = json_encode($request->charges_amount);
                    $studentFeeSettings->months_validation = json_encode($request->months_validation);
                    $studentFeeSettings->status = 1;
                    $studentFeeSettings->save();
                }else{
                    return redirect()->back()->with('error', 'Student Fees Settings Already saved.');
                }
                return redirect()->back()->with('success', 'Student Fees Settings Saved Successfully');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Error'.$th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $studentFeeSettings = StudentFeeSettings::with('studentSession','studentClass','studentSection', 'studentDetails');
        if($request->session_id){
            $studentFeeSettings->where('session_id', $request->session_id);
        }
        if($request->class_id){
            $studentFeeSettings->where('class_id', $request->class_id);
        }
        if($request->section_id){
            $studentFeeSettings->where('section_id', $request->section_id);
        }
        if($request->user_id){
            $studentFeeSettings->where('user_id', $request->user_id);
        }
        $studentFeeSettings = $studentFeeSettings->orderBy('class_id', 'asc')->get();
        return $studentFeeSettings;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentFeeSettings $studentFeeSettings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StudentFeeSettings $studentFeeSettings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $studentFeeSettings = StudentFeeSettings::find($request->id);
            if ($studentFeeSettings) {
                $studentFeeSettings->delete();
                return response()->json(['warning' => 'Student fee settings deleted successfully']);
            }
            return response()->json(['error' => 'Student fee settings error'], 404);
          
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error'.$th->getMessage()]);
        }
    }
}