<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('website.notice');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.notice.list');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'notice_name' => 'required',
            'notice_date' => 'required',
        ]);
        $notice = new Notice;
        $notice->notice_name = $request->notice_name;
        $notice->notice_date = $request->notice_date;
        if ($request->hasFile('image')) {
            $image_path = date('Y-m-d-H_i_s').'_' .$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('notice', $image_path,['disk' => 'public']);
            $notice->image = '/storage/notice/'.$image_path;
        }
        $notice->save();
        return redirect()->back()->withSuccess('Notice added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Notice $notice)
    {
        $notice =  Notice::get();
        return ['data'=> $notice];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notice $notice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notice $notice)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $notice =  Notice::find($request->id);
        $notice->delete();
        return ['warning'=>'Notice Deleted successfully'];
    }
}