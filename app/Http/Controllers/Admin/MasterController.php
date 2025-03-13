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
        $classes = Classes::find($id);
        $classes->delete();
        return redirect()->back()->with('warning','Class deleted successfully');
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
        $section = Section::find($id);
        $section->delete();
        return redirect()->back()->with('warning','Class arms deleted successfully');
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
        if(!$request->admin_id){
            $request->validate([
                'name' => 'required|string|max:100',
                'email' => 'required|email|max:255|unique:admins',
                'password' => 'required|string|min:8|confirmed',
                'class_id' => 'required|numeric',
                'section_id' => 'required|numeric'
            ]);
        }else{
            $request->validate([
                'name' => 'required|string|max:100',
                'class_id' => 'required|numeric',
                'section_id' => 'required|numeric'
            ]);
        }
        
        $teacherClassMapping = TeacherClassMapping::where('class_id', $request->class_id)->where('section_id', $request->section_id)->first();
        if($teacherClassMapping != null){
            $teacherName  = GetTeacher($teacherClassMapping->teacher_id);
            return redirect()->back()->withError('This class is already assigned to ' . $teacherName->name);
        }
        
        $data = $request->all();
        $data['usertype'] = 0;
        $teacher = storeAdminAndTeacher($data);
        if($request->admin_id){
            $teacherClassMapping = TeacherClassMapping::where('teacher_id', $request->admin_id)->first();
        }else{
            $teacherClassMapping = new TeacherClassMapping;
            $teacherClassMapping->teacher_id = $teacher;
        }
        $teacherClassMapping->class_id = $request->class_id;
        $teacherClassMapping->section_id = $request->section_id;
        $teacherClassMapping->save();

        return $teacher == "update" ? redirect()->back()->with('info','Teacher details updated successfully') : redirect()->back()->withSuccess('Teacher register successfully');
    }

    public function destroyTeachers($id)
    {
        $admin = Admin::find($id);
        $admin->delete();
        return redirect()->back()->with('warning','Teachers deleted successfully');
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
        }else{
            Session::query()->update(['status' => 0]);
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
        $session = Session::find($id);
        $session->delete();
        return redirect()->back()->with('warning','Session deleted successfully');
    }
    //Roll number 
    // public function getRollNumber($session_id, $class_id, $section_id)
    // {
    //     $user = User::get();
        
    // }
}