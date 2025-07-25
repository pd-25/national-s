<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\Section;
use App\Models\Admin;
use App\Models\Session;
use App\Models\TeacherClassMapping;

class MasterController extends Controller
{
    //Manage Classes
    public function manageClasses()
    {
        return view('admin.manageclass.manage_class');
    }

    public function addClasses(Request $request)
    {
        $request->validate([
            'class_name' => 'required'
        ]);
        if($request->class_id){
            $classes = Classes::find($request->class_id);
            $classes->class_name = $request->class_name;
        }else{
            $classes = new Classes;
            $classes->class_name = $request->class_name;
        }
        $classes->save();
        return $request->class_id == null ? redirect()->back()->withSuccess('Class created successfully') : redirect()->back()->with('info','Class updated successfully');
    }

    public function destroyClasses($id)
    {
        try {
            $classes = Classes::find($id);
            $classes->delete();
            return redirect()->back()->with('warning','Class deleted successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Error'.$th->getMessage());
        }

    }

    //Manage Section
    public function manageClassesSections()
    {
        return view('admin.managesection.manage_section');
    }

    public function addClassesSection(Request $request)
    {
        $request->validate([
            'class_id' => 'required',
            'section_name' => 'required'
        ]);
        if($request->arm_id){
            $section = Section::find($request->arm_id);
            $section->class_id = $request->class_id;
            $section->section_name = $request->section_name;
        }else{
            $section = new Section;
            $section->class_id = $request->class_id;
            $section->section_name = $request->section_name;
        }
        $section->save();
        return $request->arm_id == null ? redirect()->back()->withSuccess('Class arm created successfully') : redirect()->back()->with('info','Class arm updated successfully');
    }

    public function destroyClassesArms($id)
    {
        try {
            $section = Section::find($id);
            $section->delete();
            return redirect()->back()->with('warning','Class arms deleted successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Error'.$th->getMessage());
        }
    }

    public function getclassarm($class_id)
    {
       return $section = GetArmsByClassId($class_id);
    }

    //Manage Teachers
    public function manageTeacher()
    {
        return view('admin.manageteacher.manage_teacher');
    }

    public function addTeacher(Request $request)
    {
        // dd($request->all());
        if(!$request->admin_id && !isset($request->admin_list_id)){
            $request->validate([
                'name' => 'required|string|max:100',
                'email' => 'required|email|max:255|unique:admins',
                'password' => 'required|string|min:8|confirmed',
                'class_id' => 'required|numeric',
                'section_id' => 'required|numeric'
            ]);
        }else{
            $request->validate([
                'class_id' => 'required|numeric',
                'section_id' => 'required|numeric'
            ]);
        }
        
        // $teacherClassMapping = TeacherClassMapping::where('class_id', $request->class_id)->where('section_id', $request->section_id)->first();
        // if($teacherClassMapping != null){
        //     $teacherName  = GetTeacher($teacherClassMapping->teacher_id);
        //     return redirect()->back()->withError('This class is already assigned to ' . $teacherName->name);
        // }
        
        if(!isset($request->admin_list_id)){
            $data = $request->all();
            $data['usertype'] = 0;
            $teacher = storeAdminAndTeacher($data);
        }
        if($request->admin_id){
            $teacherClassMapping = TeacherClassMapping::where('teacher_id', $request->admin_id)->where('class_id', $request->class_id)->first();
            if($teacherClassMapping == null){
                $teacherClassMapping = new TeacherClassMapping;
                $teacherClassMapping->teacher_id = $request->admin_id;    
            }
        }else{
            $teacherClassMapping = new TeacherClassMapping;
            if(!isset($request->admin_list_id)){
                $teacherClassMapping->teacher_id = $teacher;
            }else{
                $teacherClassMapping->teacher_id = $request->admin_list_id;
            }
        }

        $teacherClassMapping->class_id = $request->class_id;
        $teacherClassMapping->section_id = $request->section_id;
        $teacherClassMapping->save();
        if(!isset($request->admin_list_id)){
            return $teacher == "update" ? redirect()->back()->with('info','Teacher details updated successfully') : redirect()->back()->withSuccess('Teacher register successfully');
        }else{
            return redirect()->back()->with('success','Teacher new class added successfully');
        }
    }

    public function destroyTeachers(Request $request)
    {
        try {
            if($request->multipleClassTeacherId){
                $teacherClassMapping = TeacherClassMapping::where('id', $request->multipleClassTeacherId)->first();
                $teacherClassMapping->delete();
                return redirect()->back()->with('warning','Assigned class deleted successfully');
            }
            $admin = Admin::find($request->id);
            $teacherClassMapping = TeacherClassMapping::where('teacher_id', $request->id)->first();
            $teacherClassMapping->delete();
            $admin->delete();
            return redirect()->back()->with('warning','Teachers deleted successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Error'.$th->getMessage());
        }
    }

    //session
    public function manageSessionTerm()
    {
        return view('admin.managesessionterm.manage_session_term');
    }

    public function addSessionTerm(Request $request)
    {
        $request->validate([
            'session_name' => 'required',
            'section_valid_from' => 'required',
            'section_valid_to' => 'required',
        ]);
        if($request->session_id){
            $session = Session::find($request->session_id);
            if($request->status == 1){
                Session::query()->update(['status' => 0]);
            }
        }else{
            if($request->status != 0){
                Session::query()->update(['status' => 0]);
            }
            $session = new Session;
        }
        $session->sessions_name = $request->session_name;
        $session->section_valid_from = $request->section_valid_from;
        $session->section_valid_to = $request->section_valid_to;
        $session->status = $request->status;
        $session->save();
        return $request->session_id == null ? redirect()->back()->withSuccess('Session created successfully') : redirect()->back()->with('info','Session updated successfully');
    }

    public function destroySession($id)
    {
        try {
            $session = Session::find($id);
            $session->delete();
            return redirect()->back()->with('warning','Session deleted successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Error'.$th->getMessage());
        }
    }
 
}