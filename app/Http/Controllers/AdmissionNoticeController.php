<?php

namespace App\Http\Controllers;

use App\Models\AdmissionNotice;
use Illuminate\Http\Request;

class AdmissionNoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('website.admissionnotice');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.websiteSettings.admissionnotice.list');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'admi_notice_name' => 'required',
            'admi_notice_date' => 'required',
        ]);
        $admissionNotice = new AdmissionNotice;
        $admissionNotice->admi_notice_name = $request->admi_notice_name;
        $admissionNotice->admi_notice_date = $request->admi_notice_date;
        if ($request->hasFile('image')) {
            $image_path = date('Y-m-d-H_i_s').'_' .$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('admissionnotice', $image_path,['disk' => 'public']);
            $admissionNotice->image = '/storage/admissionnotice/'.$image_path;
        }
        $admissionNotice->save();
        return redirect()->back()->withSuccess('Admission Notice added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(AdmissionNotice $admissionNotice)
    {
        $admissionNotice =  AdmissionNotice::get();
        return ['data'=> $admissionNotice];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdmissionNotice $admissionNotice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AdmissionNotice $admissionNotice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try{
            $admissionNotice =  AdmissionNotice::find($request->id);
            $admissionNotice->delete();
            return response()->json(['warning'=>'Admission Notice Deleted successfully']);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error'.$th->getMessage()]);
        }
    }
}