<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('website.events');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.websiteSettings.events.list');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'event_name' => 'required',
            'event_desc' => 'required',
            'event_image' => 'required',
            'event_slug' => 'required|unique:events'
        ]);
        $events = new Events;
        $events->event_name = $request->event_name;
        $events->event_slug = Str::slug($request->event_slug);
        $events->event_date = $request->event_date;
        $events->event_desc = $request->event_desc;
        if ($request->hasFile('event_image')) {
            $image_path = date('Y-m-d-H_i_s').'_' .$request->file('event_image')->getClientOriginalName();
            $request->file('event_image')->storeAs('event_images', $image_path,['disk' => 'public']);
            $events->event_image = '/storage/event_images/'.$image_path;
        }
        $events->save();
        return redirect()->back()->withSuccess('Events added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Events $events)
    {
        $events =  Events::get();
        return ['data'=> $events];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $events =  Events::where('event_slug', $slug)->first();
        return view('website.event_details', compact('events'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Events $events)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try{
            $events =  Events::find($request->id);
            $events->delete();
            return response()->json(['warning'=>'Events Deleted successfully']);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error'.$th->getMessage()]);
        }
    }
}