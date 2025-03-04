<?php

namespace App\Http\Controllers;

use App\Models\EventRegister;
use Illuminate\Http\Request;
use App\Mail\EventRegistered;
use Illuminate\Support\Facades\Mail;

class EventRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $request->validate([
            'event_id' => 'required',
            'email' => 'required',
            'name' => 'required',
            'date' => 'required',
            'school_name' => 'required',
            'class' => 'required',
            'father_name' => 'required',
            'contact_number' => 'required',
            'amount' => 'required'
        ]);
        $eventRegister = new EventRegister;
        $eventRegister->event_id = $request->event_id;
        $eventRegister->email = $request->email;
        $eventRegister->name = $request->name;
        $eventRegister->date = $request->date;
        $eventRegister->school_name = $request->school_name;
        $eventRegister->class = $request->class;
        $eventRegister->father_name = $request->father_name;
        $eventRegister->contact_number = $request->contact_number;
        $eventRegister->amount = $request->amount;
        $eventRegister->contact_number_ii = $request->contact_number_ii;
        $eventRegister->status = $request->status;
        $eventRegister->save();
        if($eventRegister->status == 1){
            Mail::to($request->email)->send(new EventRegistered($eventRegister));
            return redirect()->back()->withSuccess('Event registered successfully. Check your email for a copy of the response.');
        }else{
            return redirect()->back()->withSuccess('Event registered successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(EventRegister $eventRegister)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EventRegister $eventRegister)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EventRegister $eventRegister)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EventRegister $eventRegister)
    {
        //
    }
}