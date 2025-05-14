<?php

namespace App\Http\Controllers;

use App\Models\CampusGalary;
use Illuminate\Http\Request;

class CampusGalaryController extends Controller
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
        return view('admin.websiteSettings.campusgalary.list');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'program_name' => 'required|string|max:255',
            'image' => 'required|array',
            'image.*' => 'image|max:1024',
        ]);
        
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $campusGalary = new CampusGalary;
                $campusGalary->program_name = $request->program_name;
                $image_path = date('Y-m-d-H_i_s') . '_' . $image->getClientOriginalName();
                $image->storeAs('campusGalary', $image_path, ['disk' => 'public']);
                $campusGalary->image = '/storage/campusGalary/' . $image_path;
                $campusGalary->save();
            }
        }

        return redirect()->back()->withSuccess('Galary images added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(CampusGalary $campusGalary)
    {
        $campusGalary =  CampusGalary::get();
        return ['data'=> $campusGalary];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CampusGalary $campusGalary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CampusGalary $campusGalary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try{
            $campusGalary =  CampusGalary::find($request->id);
            $campusGalary->delete();
            return response()->json(['warning'=>'Galary Images Deleted successfully']);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error'.$th->getMessage()]);
        }
    }
}