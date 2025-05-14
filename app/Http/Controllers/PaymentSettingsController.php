<?php

namespace App\Http\Controllers;

use App\Models\PaymentSettings;
use Illuminate\Http\Request;
use App\Models\Deposite;
use Illuminate\Support\Arr;

class PaymentSettingsController extends Controller
{
    private $students;
    public function __construct(\App\Http\Controllers\Admin\StudentController $studentController) {
        $this->students = $studentController;
    }
    
    public function index()
    {
        return view('admin.payroll.payment_settings');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
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
                'charges_amount' => 'nullable|array',
                'months_validation' => 'nullable|array',
            ]);
            if($request->payment_setting_id != null){
                $paymentSettings = PaymentSettings::find($request->payment_setting_id);
                $paymentSettings->session_id = $request->session_id;
                $paymentSettings->class_id = $request->class_id;
                $paymentSettings->section_id = $request->section_id;
                $paymentSettings->charges_amount = json_encode($request->charges_amount);
                $paymentSettings->months_validation = json_encode($request->months_validation);
                $paymentSettings->status = 1;
                $paymentSettings->save();
                return redirect()->back()->with('info', 'Fees Settings Updated Successfully');
            }else{
                $ValidationOnPayementSettings = PaymentSettings::where('session_id', $request->session_id)->where('class_id', $request->class_id)->where('section_id', $request->section_id)->count();
                
                if($ValidationOnPayementSettings == 0){
                    $paymentSettings = new PaymentSettings;
                    $paymentSettings->session_id = $request->session_id;
                    $paymentSettings->class_id = $request->class_id;
                    $paymentSettings->section_id = $request->section_id;
                    $paymentSettings->charges_amount = json_encode($request->charges_amount);
                    $paymentSettings->months_validation = json_encode($request->months_validation);
                    $paymentSettings->status = 1;
                    $paymentSettings->save();
                }else{
                    return redirect()->back()->with('error', 'Fees Settings Already saved.');
                }
                return redirect()->back()->with('success', 'Fees Settings Saved Successfully');
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
        $payementSettings = PaymentSettings::with('studentSession','studentClass','studentSection');
        if($request->session_id){
            $payementSettings->where('session_id', $request->session_id);
        }
        if($request->class_id){
            $payementSettings->where('class_id', $request->class_id);
        }
        if($request->section_id){
            $payementSettings->where('section_id', $request->section_id);
        }
        $payementSettings = $payementSettings->orderBy('class_id', 'asc')->get();
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


    public function paymentdue(Request $request)
    {
        return view('admin.fees.payment_due');
    }

    public function show_due_payment(Request $request)
    {
        $DuePaymentDetails = [];
        $studentList = $this->students->studentsListUsingSessionClassSection($request);
        if(GetallMonths() != null){
            foreach (GetallMonths() as $key => $month) {
                if ($month == $request->month) {
                    foreach ($studentList as $key => $value) {
                        $query = Deposite::where('session_id', $request->session_id)
                            ->where('section_id', $request->section_id);
    
                        if ($request->month) {
                            $query->where('month', $request->month);
                        }
                        if ($request->year) {
                            $query->where('year', $request->year);
                        }
                        if ($request->user_id) {
                            $query->where('user_id', $request->user_id);
                        }
    
                        $depositHistory = $query->get();
    
                        $tempPayment = array(
                            'student_id' => $value->studentDetails->id,
                            'student_name' => $value->studentDetails->student_name,
                            'admission_number' => $value->studentDetails->admission_number,
                            'month' => $month,
                            'year' => $request->year, 
                            'status' => 'Unpaid'
                        );
    
                        if ($depositHistory->isEmpty() || !$depositHistory->contains('user_id', $value->user_id)) {
                            array_push($DuePaymentDetails, $tempPayment);
                        }
                    }
                }   
            }
        }
        return $DuePaymentDetails;
    }
}