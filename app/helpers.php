<?php
use App\Models\News;
use App\Models\Notice;
use App\Models\AdmissionNotice;
use App\Models\CampusGalary;
use App\Models\Events;
use App\Models\Classes;
use App\Models\Section;
use App\Models\Session;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;


function Allstatus()
{
    $status = [ 
        ["id" => 1, "status" => 'Active'],
        ["id" => 0, "status" => 'Deactive'],
    ];
    return $status;
}

function Relation()
{
    $relations = [ 
        ["name" => 'Father'],
        ["name" => 'Mother'],
        ["name" => 'Brother'],
        ["name" => 'Sister'],
        ["name" => 'Cousin'],
        ["name" => 'Uncle'],
        ["name" => 'Aunt'],
        ["name" => 'Grandfather'],
        ["name" => 'Grandmother'],

    ];
    return $relations;
}

function Religion()
{
    $relations = [ 
        ["name" => 'Hindu'],
        ["name" => 'Muslim'],
        ["name" => 'Christian'],
        ["name" => 'Buddhist'],
        ["name" => 'Sikh'],
        ["name" => 'Jain'],
        ["name" => 'Other'],
    ];
    return $relations;
}

function Gender()
{
    $genders = [ 
        ["name" => 'Male'],
        ["name" => 'Female'],
        ["name" => 'Other'],
    ];
    return $genders;
}

function Caste()
{
    $castes = [ 
        ["name" => 'General'],
        ["name" => 'SC'],
        ["name" => 'ST'],
        ["name" => 'OBC'],
        ["name" => 'Other'],
    ];
    return $castes;
}

function BloodGroup()
{
    $bloodGroups = [ 
        ["name" => 'A+'],
        ["name" => 'A-'],
        ["name" => 'B+'],
        ["name" => 'B-'],
        ["name" => 'O+'],
        ["name" => 'O-'],
        ["name" => 'AB+'],
        ["name" => 'AB-'],
    ];
    return $bloodGroups;
}

function Getnews()
{
    $news =  News::where('news_status', 1)->orderBy('news_date', 'desc')->get();
    return $news;
}

function GetEvents()
{
    $events =  Events::where('status', 1)->orderBy('event_date', 'desc')->get();
    return $events;
}

function Getnotice()
{
    $notice =  Notice::orderBy('notice_date', 'desc')->get();
    return $notice;
}

function GetAdmissionnotice()
{
    $admissionNotice =  AdmissionNotice::orderBy('admi_notice_date', 'desc')->get();
    return $admissionNotice;
}

function GetCampusGalary()
{
    $campusGalary =  CampusGalary::orderBy('created_at', 'desc')->get();
    return $campusGalary;
}

function GetClasses()
{
    $classes = Classes::all();
    return $classes;
}

function GetClassesArms()
{
    $section = Section::with('className')->orderBy('class_id', 'desc')->orderBy('section_name', 'asc')->paginate(10);
    return $section;
}

function GetArmsByClassId($class_id)
{
    $section = Section::with('className')->where('class_id', $class_id)->get();
    return $section;
}

function GetTeacher($teacher_id= null)
{
    if($teacher_id){
        $admin = Admin::with('teacherclassmapping','teacherclassmapping.teacherClass', 'teacherclassmapping.teacherSection')->find($teacher_id);
    }else{
        $admin = Admin::with('teacherclassmapping','teacherclassmapping.teacherClass', 'teacherclassmapping.teacherSection')->where('usertype', 0)->orderBy('name', 'asc')->paginate(10);
    }
    return $admin;
}

function storeAdminAndTeacher($data)
{
    if($data['admin_id']){
        $admin = Admin::find($data['admin_id']);
        $admin->name = $data['name'];
        //$admin->password = Hash::make($data['password']);
        $admin->save();
        $returnVal = "update";
    }else{
        $admin = new Admin;
        $admin->email = $data['email'];
        $admin->usertype = $data['usertype'];
        $admin->name = $data['name'];
        $admin->password = Hash::make($data['password']);
        $admin->save();
        $returnVal = $admin->id;
    }
    return $returnVal;
}

function GetSession($session_manage=null)
{
    if($session_manage == "all_session"){
        $session = Session::orderBy('section_valid_from', 'desc')->get();
    } else if($session_manage == "active_session"){
        $session = Session::where('status', 1)->orderBy('section_valid_from', 'desc')->get();
    }else{
        $session = Session::orderBy('section_valid_from', 'desc')->paginate(10);
    }
    return $session;
}

function generateAdmissionNumber()
{
    $year = Carbon::now()->format('Y');

    $lastAdmission = User::where('admission_number', 'like', "NPS$year%")
        ->orderBy('admission_number', 'desc')
        ->first();
    if ($lastAdmission) {
        $explode = explode('NPS',$lastAdmission->admission_number);
        $lastNumber = (int) substr($explode[1], -3);
        $nextNumber = $lastNumber + 1;
    } else {
        $nextNumber = 1;
    }
    

    $formattedNumber = str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
    return "NPS$year$formattedNumber";
}


function GetallMonths(){
    $months = [];
    for ($m = 1; $m <= 12; $m++) {
        $monthNumber = str_pad($m, 2, '0', STR_PAD_LEFT);
        $monthName = date('F', mktime(0, 0, 0, $m, 1, date('Y')));
        $months[$monthNumber] = $monthName;
    }
    return $months;
}

function LastFiveYear(){
    $years = [];
    for ($y = date('Y'); $y >= date('Y')-5; $y--) {
        array_push($years, (int)$y);
    }
    return $years;
}