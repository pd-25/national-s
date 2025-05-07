<?php

namespace App\Http\Controllers;

use App\Models\PaymentSettings;
use Illuminate\Http\Request;

class PaymentSettingsController extends Controller
{
    private $students;
    public function __construct(\App\Http\Controllers\Admin\StudentController $studentController) {
        $this->students = $studentController;
    }
    
    public function index()
    {
        return view('admin.paymentsettings.paymentsettings');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $payementSettings = PaymentSettings::where('session_id', $request->session_id)->where('class_id', $request->class_id)->where('section_id', $request->section_id)->where('user_id', $request->user_id)->first();
        return $payementSettings;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            if($request->payment_setting_id != null){
                $request->validate([
                    'admission_charges' => 'nullable|numeric',
                    'enrolment_fee' => 'nullable|numeric',
                    'tuition_fee' => 'nullable|numeric',
                    'terminal_fee' => 'nullable|numeric',
                    'sports' => 'nullable|numeric',
                    'misc_charges' => 'nullable|numeric',
                    'scholarship_concession' => 'nullable|numeric',
                    'admission_charges_months_validation' => 'required_with:admission_charges|array',
                    'enrolment_fee_months_validation' => 'required_with:enrolment_fee|array',
                    'tuition_fee_months_validation' => 'required_with:tuition_fee|array',
                    'terminal_fee_months_validation' => 'required_with:terminal_fee|array',
                    'sports_months_validation' => 'required_with:sports|array',
                    'misc_charges_months_validation' => 'required_with:misc_charges|array',
                    'scholarship_concession_validation' => 'required_with:scholarship_concession|array',
                ]);

                $paymentSettings = PaymentSettings::find($request->payment_setting_id);
                $paymentSettings->admission_charges = $request->admission_charges;
                $paymentSettings->enrolment_fee = $request->enrolment_fee;
                $paymentSettings->tuition_fee = $request->tuition_fee;
                $paymentSettings->terminal_fee = $request->terminal_fee;
                $paymentSettings->misc_charges = $request->misc_charges;
                $paymentSettings->sports = $request->sports;
                $paymentSettings->scholarship_concession = $request->scholarship_concession;
                
                $paymentSettings->admission_charges_months_validation = json_encode($request->admission_charges_months_validation);
                $paymentSettings->enrolment_fee_months_validation = json_encode($request->enrolment_fee_months_validation);
                $paymentSettings->tuition_fee_months_validation = json_encode($request->tuition_fee_months_validation);
                $paymentSettings->terminal_fee_months_validation = json_encode($request->terminal_fee_months_validation);
                $paymentSettings->sports_months_validation = json_encode($request->sports_months_validation);
                $paymentSettings->misc_charges_months_validation = json_encode($request->misc_charges_months_validation);
                $paymentSettings->scholarship_concession_validation = json_encode($request->scholarship_concession_validation);
                $paymentSettings->save();
                return redirect()->back()->with('info', 'Payment Settings Updated Successfully');
            }else{
                
                $request->validate([
                    'session_id' => 'required|exists:sessions,id',
                    'class_id' => 'required|exists:classes,id',
                    'section_id' => 'required|exists:sections,id',
                    'admission_charges' => 'nullable|numeric',
                    'enrolment_fee' => 'nullable|numeric',
                    'tuition_fee' => 'nullable|numeric',
                    'terminal_fee' => 'nullable|numeric',
                    'sports' => 'nullable|numeric',
                    'misc_charges' => 'nullable|numeric',
                    'scholarship_concession' => 'nullable|numeric',
                    'admission_charges_months_validation' => 'required_with:admission_charges|array',
                    'enrolment_fee_months_validation' => 'required_with:enrolment_fee|array',
                    'tuition_fee_months_validation' => 'required_with:tuition_fee|array',
                    'terminal_fee_months_validation' => 'required_with:terminal_fee|array',
                    'sports_months_validation' => 'required_with:sports|array',
                    'misc_charges_months_validation' => 'required_with:misc_charges|array',
                    'scholarship_concession_validation' => 'required_with:scholarship_concession|array',
                ]);

                if(isset($request->apply_to_all) != null){
                    $studentsList = $this->students->studentsListUsingSessionClassSection($request);
                    if (isset($studentsList)) {
                        foreach ($studentsList as $key => $value) {
                            $ValidationOnPayementSettings = PaymentSettings::where('session_id', $value->session_id)->where('class_id', $value->class_id)->where('section_id', $value->section_id)->where('user_id', $value->user_id)->count();
                            if($ValidationOnPayementSettings == 0){
                                $paymentSettings = new PaymentSettings;
                                $paymentSettings->session_id = $request->session_id;
                                $paymentSettings->class_id = $request->class_id;
                                $paymentSettings->section_id = $request->section_id;
                                $paymentSettings->user_id = $value->user_id;
                                $paymentSettings->apply_to_all = $request->apply_to_all;
                                $paymentSettings->admission_charges = $request->admission_charges;
                                $paymentSettings->enrolment_fee = $request->enrolment_fee;
                                $paymentSettings->tuition_fee = $request->tuition_fee;
                                $paymentSettings->terminal_fee = $request->terminal_fee;
                                $paymentSettings->misc_charges = $request->misc_charges;
                                $paymentSettings->sports = $request->sports;
                                $paymentSettings->scholarship_concession = $request->scholarship_concession;
                                $paymentSettings->admission_charges_months_validation = json_encode($request->admission_charges_months_validation);
                                $paymentSettings->enrolment_fee_months_validation = json_encode($request->enrolment_fee_months_validation);
                                $paymentSettings->tuition_fee_months_validation = json_encode($request->tuition_fee_months_validation);
                                $paymentSettings->terminal_fee_months_validation = json_encode($request->terminal_fee_months_validation);
                                $paymentSettings->sports_months_validation = json_encode($request->sports_months_validation);
                                $paymentSettings->misc_charges_months_validation = json_encode($request->misc_charges_months_validation);
                                $paymentSettings->scholarship_concession_validation = json_encode($request->scholarship_concession_validation);
                                $paymentSettings->status = 1;
                                $paymentSettings->save();
                            }
                        }
                    }
                    
                }else{
                    $ValidationOnPayementSettings = PaymentSettings::where('session_id', $request->session_id)->where('class_id', $request->class_id)->where('section_id', $request->section_id)->where('user_id', $request->user_id)->count();
                    if($ValidationOnPayementSettings > 0){
                        return redirect()->back()->with('error', 'Duplicate entry: Student data is already exists.');
                    }
                    $paymentSettings = new PaymentSettings;
                    $paymentSettings->session_id = $request->session_id;
                    $paymentSettings->class_id = $request->class_id;
                    $paymentSettings->section_id = $request->section_id;
                    $paymentSettings->user_id = $request->user_id;
                    $paymentSettings->admission_charges = $request->admission_charges;
                    $paymentSettings->enrolment_fee = $request->enrolment_fee;
                    $paymentSettings->tuition_fee = $request->tuition_fee;
                    $paymentSettings->terminal_fee = $request->terminal_fee;
                    $paymentSettings->misc_charges = $request->misc_charges;
                    $paymentSettings->sports = $request->sports;
                    $paymentSettings->scholarship_concession = $request->scholarship_concession;
                    $paymentSettings->admission_charges_months_validation = json_encode($request->admission_charges_months_validation);
                    $paymentSettings->enrolment_fee_months_validation = json_encode($request->enrolment_fee_months_validation);
                    $paymentSettings->tuition_fee_months_validation = json_encode($request->tuition_fee_months_validation);
                    $paymentSettings->terminal_fee_months_validation = json_encode($request->terminal_fee_months_validation);
                    $paymentSettings->sports_months_validation = json_encode($request->sports_months_validation);
                    $paymentSettings->misc_charges_months_validation = json_encode($request->misc_charges_months_validation);
                    $paymentSettings->scholarship_concession_validation = json_encode($request->scholarship_concession_validation);
                    $paymentSettings->status = 1;
                    $paymentSettings->save();
                }
                return redirect()->back()->with('success', 'Payment Settings Saved Successfully');
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
        $payementSettings = PaymentSettings::with('studentSession','studentClass','studentSection','studentDetails')->where('session_id', $request->session_id)->where('class_id', $request->class_id)->where('section_id', $request->section_id)->orderBy('class_id', 'asc')->get();
        return $payementSettings;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaymentSettings $paymentSettings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaymentSettings $paymentSettings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $paymentSettings = PaymentSettings::find($request->id);
            if ($paymentSettings) {
                $paymentSettings->delete();
                return response()->json(['warning' => 'Payment settings deleted successfully']);
            }
            return response()->json(['error' => 'Payment settings error'], 404);
          
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error'.$th->getMessage()]);
        }
    }
}