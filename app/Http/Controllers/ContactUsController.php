<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('website.contact');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.contact.list');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|max:120',
            'last_name' => 'nullable|max:120',
            'email' => 'required|email',
            'phone_no' => 'nullable|min:10|numeric',
            'message' => 'required|string|max:1000'
        ]);
        
        $pattern = '/\b(SELECT|INSERT|UPDATE|DELETE|DROP|CREATE|ALTER|WHERE|;|--|#|\/\*|\*\/|http|https|www)\b/i';
        $testString = $request->message;

        if (preg_match($pattern, $testString)) {
            return redirect()->back()->with('error', 'An unexpected error has occurred. Please try again later.');
        }

        $contactUs = new ContactUs;
        $contactUs->first_name = $request->first_name;
        $contactUs->last_name = $request->last_name;
        $contactUs->email = $request->email;
        $contactUs->phone_no = $request->phone_no;
        $contactUs->message = $request->message;
        $contactUs->ip_address = request()->ip();
        $contactUs->save();
        return redirect()->back()->with('success', 'Thank you we have received your enquiry. We will contact you asap.');

    }

    /**
     * Display the specified resource.
     */
    public function show(ContactUs $contactUs)
    {
        $contactUs =  ContactUs::get();
        return ['data'=> $contactUs];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContactUs $contactUs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $contactUs = ContactUs::find($request->id);
        $contactUs->status = $request->status == 0 ? 1 : 0;
        $contactUs->save();
        return ['info'=>'Contact updated successfully'];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $contactUs =  ContactUs::find($request->id);
        $contactUs->delete();
        return ['warning'=>'Contact Deleted successfully'];
    }
}