<?php

namespace App\Http\Controllers;

use App\Models\PayrollSettings;
use Illuminate\Http\Request;

class PayrollSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.payroll.payroll_settings');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $payrollSettings = PayrollSettings::where('type', $request->type)->where('parent_id', null)->get();
        return $payrollSettings;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'name' => 'required|string',
            'fixed_amount' => 'nullable|numeric',
        ]);
        try {
            if($request->payroll_id){
                $payrollSettings = PayrollSettings::find($request->payroll_id);
            }else{
                $payrollSettings = new PayrollSettings;
            }
            $payrollSettings->type = $request->type;
            $payrollSettings->parent_id = $request->parent_id;
            $payrollSettings->name = $request->name;
            $payrollSettings->fixed_amount = $request->fixed_amount;
            $payrollSettings->apply_on_fee_Settings = $request->apply_on_fee_Settings == "applied" ? 1 : 0;
            $payrollSettings->save();
            if($request->payroll_id){
                return redirect()->back()->with('info', 'Payroll Updated Successfully');
            }
            return redirect()->back()->with('success', 'Payroll Added Successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Error'.$th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $payrollSettings = PayrollSettings::with('parent')->where('type', $request->type)->get();
        return $payrollSettings;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PayrollSettings $payrollSettings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PayrollSettings $payrollSettings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $payrollSettings = PayrollSettings::find($request->payroll_id);
            $payrollSettings->delete();
            return response()->json(['warning'=>'Payroll Deleted successfully']);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error'.$th->getMessage()]);
        }
    }

}