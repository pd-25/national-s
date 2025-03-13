<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\StudentClassMapping;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function StudentRegister(Request $request)
    {
        return view('admin.studentmanagement.student_register');
    }
    public function storeStudentDetails(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'section_id' => 'required|exists:sections,id',
            'session_id' => 'required|exists:sessions,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'student_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'aadhar_no' => 'required|string|unique:users',
            'nationality' => 'required|string|max:100',
            'religion' => 'required|string|max:100',
            'gender' => 'required|string|max:10',
            'caste' => 'required|string|max:100',
            'address' => 'required|string',
            'pin_code' => 'required|string|max:10',
            'mother_tongue' => 'required|string|max:100',
            'blood_group' => 'required|string|max:5',
            'stream' => 'nullable|string|max:100',
            'combination_text' => 'nullable|string|max:255',
            'school_name' => 'nullable|array',
            'academic_session' => 'nullable|array',
            'class' => 'nullable|array',
            'second_language' => 'nullable|array',
            'achievements' => 'nullable|string',
            'previous_school_info' => 'nullable|string',
            'parent_name' => 'required|string|max:255',
            'parent_relation' => 'required|string|max:100',
            'qualification' => 'required|string|max:100',
            'occupation' => 'required|string|max:100',
            'organization' => 'nullable|string|max:100',
            'designation' => 'nullable|string|max:100',
            'mobile_no' => 'required|string|max:15',
            'parent_aadhar_number' => 'nullable|string',
            'annual_income' => 'nullable|numeric',
            'office_contact_number' => 'nullable|string|max:15',
            'mention_relationship' => 'nullable|string|max:100',
            'transport_facility' => 'nullable|string|max:100',
            'route' => 'nullable|string|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $imagePath = null;
                if ($request->hasFile('image')) {
                    $image_path = date('Y-m-d-H_i_s').'_' .$request->file('image')->getClientOriginalName();
                    $request->file('image')->storeAs('student_images', $image_path,['disk' => 'public']);
                    $imagePath = '/storage/student_images/'.$image_path;
                }
                $user = new User();
                $user->admission_number = generateAdmissionNumber();
                $user->image = $imagePath;
                $user->student_name = Str::ucfirst($request->student_name);
                $user->date_of_birth = $request->date_of_birth;
                $user->aadhar_no = $request->aadhar_no;
                $user->nationality = Str::ucfirst($request->nationality);
                $user->religion = $request->religion;
                $user->gender = $request->gender;
                $user->caste = $request->caste;
                $user->address = Str::ucfirst($request->address);
                $user->pin_code = $request->pin_code;
                $user->mother_tongue = $request->mother_tongue;
                $user->blood_group = $request->blood_group;
                $user->stream = $request->stream;
                $user->combination_text = $request->combination_text;
                $user->school_name = json_encode($request->school_name);
                $user->academic_session = json_encode($request->academic_session);
                $user->class = json_encode($request->class);
                $user->second_language = json_encode($request->second_language);
                $user->achievements = $request->achievements;
                $user->previous_school_info = $request->previous_school_info;
                $user->parent_name = $request->parent_name;
                $user->parent_relation = $request->parent_relation;
                $user->qualification = $request->qualification;
                $user->occupation = $request->occupation;
                $user->organization = $request->organization;
                $user->designation = $request->designation;
                $user->mobile_no = $request->mobile_no;
                $user->parent_aadhar_number = $request->parent_aadhar_number;
                $user->annual_income = $request->annual_income;
                $user->office_contact_number = $request->office_contact_number;
                $user->mention_relationship = $request->mention_relationship;
                $user->transport_facility = $request->transport_facility;
                $user->route = $request->route;
                $user->email = Str::lower($request->email);
                $user->password = Hash::make($request->password);
                $user->status = 1;
                $user->save();
    
                $studentClassMapping = new StudentClassMapping;
                $studentClassMapping->user_id = $user->id;
                $studentClassMapping->session_id = $request->session_id;
                $studentClassMapping->class_id = $request->class_id;
                $studentClassMapping->section_id = $request->section_id;
                $studentClassMapping->status = 1;
                $studentClassMapping->save();
            });
    
            return redirect()->back()->withSuccess('Student created successfully');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function studentList(Request $request)
    {
        return view('admin.studentmanagement.student_list');
    }

    public function getStudentData(Request $request)
    {
        $session_id = $request->session_id;
        $class_id = $request->class_id;
        $section_id = $request->section_id;
        $admission_number = $request->admission_number;
        $first_name = $request->first_name;
        $mobile_no = $request->mobile_no;
        $email_address = $request->email_address;
    
        $query = StudentClassMapping::with('studentDetails', 'studentSession', 'studentClass', 'studentSection');
        
        if ($session_id) {
            $query->where('session_id', $session_id);
        }
        if ($class_id) {
            $query->where('class_id', $class_id);
        }
        if ($section_id) {
            $query->where('section_id', $section_id);
        }
        if ($mobile_no) {
            $query->whereHas('studentDetails', function($q) use ($mobile_no) {
                $q->where('mobile_no', $mobile_no);
            });
        }
        if ($admission_number) {
            $query->whereHas('studentDetails', function($q) use ($admission_number) {
                $q->where('admission_number', $admission_number);
            });
        }
        if ($first_name) {
            $query->whereHas('studentDetails', function($q) use ($first_name) {
                $q->where('first_name', 'like', "%{$first_name}%");
            });
        }
        if ($email_address) {
            $query->whereHas('studentDetails', function($q) use ($email_address) {
                $q->where('email_address', $email_address);
            });
        }
        $StudentClassMappings = $query->get();
        return ["data"=>$StudentClassMappings];

        
    }

    public function teacherManageStudent(Request $request)
    {
        return view('admin.teachermanagestudent.managestudent');
    }

    public function studentsInClass(Request $request)
    {
        $session_id = GetSession('active_session')[0]->id;
        $teacher_details = GetTeacher(auth()->guard('admin')->user()->id);
        $teacher_class_assigned = $teacher_details->teacherclassmapping[0]->class_id;
        $teacher_section_assigned = $teacher_details->teacherclassmapping[0]->section_id;
        $query = StudentClassMapping::with('studentDetails', 'studentSession', 'studentClass', 'studentSection')->where('session_id', $session_id)->where('class_id', $teacher_class_assigned)->where('section_id', $teacher_section_assigned)->get();
        return ["data"=>$query];
    }

    public function studentsListUsingSessionClassSection(Request $request)
    {
        $student = StudentClassMapping::with('studentDetails')->where('session_id', $request->session_id)->where('class_id', $request->class_id)->where('section_id', $request->section_id)->get();
        return $student;
    }
    
    public function studentsEntrollment(Request $request)
    {
        return view('admin.studentmanagement.studentsentrollment');
    }

    public function studentsEntrollmentStore(Request $request)
    {
        $studentClassMapping = StudentClassMapping::where('user_id', $request->user_id)->where('session_id', $request->session_id)->where('class_id', $request->class_id)->where('section_id', $request->section_id)->count();
        if($studentClassMapping > 0){
            return  ['error'=>'Student already enrolled'];
        }
        $studentClassMapping = new StudentClassMapping;
        $studentClassMapping->user_id = $request->user_id;
        $studentClassMapping->session_id = $request->session_id;
        $studentClassMapping->class_id = $request->class_id;
        $studentClassMapping->section_id = $request->section_id;
        $studentClassMapping->status = 1;
        $studentClassMapping->save();
        return  ['success'=>'Student enrolled successfully'];
    }
}