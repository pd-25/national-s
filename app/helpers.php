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
use App\Models\PayrollSettings;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Str;

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
        $admin->email = Str::lower($data['email']);
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
    } else if($session_manage == "deactive_session"){
        $session = Session::where('status', 0)->orderBy('section_valid_from', 'desc')->get();
    }
    else{
        $session = Session::orderBy('section_valid_from', 'desc')->get();
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
    for ($y = date('Y')+1; $y >= date('Y')-5; $y--) {
        array_push($years, (int)$y);
    }
    return $years;
}

function NumberToWord($values)
{
    $number = $values;
    $no = floor($number);
    $point = round(($number - $no) * 100);
    $hundred = null;
    $digits_1 = strlen($no);
    $i = 0;
    $str = array();
    $words = array(
        '0' => '', '1' => 'One', '2' => 'Two', '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
        '7' => 'Seven', '8' => 'Eight', '9' => 'Nine', '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
        '13' => 'Thirteen', '14' => 'Fourteen', '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
        '18' => 'Eighteen', '19' => 'Nineteen', '20' => 'Twenty', '30' => 'Thirty', '40' => 'Forty',
        '50' => 'Fifty', '60' => 'Sixty', '70' => 'Seventy', '80' => 'Eighty', '90' => 'Ninety'
    );
    $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
    while ($i < $digits_1) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += ($divider == 10) ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? 'and ' : null;
            $str[] = ($number < 21) ? 
                $words[$number] . " " . $digits[$counter] . $plural . " " . $hundred
                : 
                $words[floor($number / 10) * 10] . " " . $words[$number % 10] . " " . 
                $digits[$counter] . $plural . " " . $hundred;
        } else {
            $str[] = null;
        }
    }
    $str = array_reverse(array_filter($str));
    $result = implode(' ', $str);
    $points = "";
    if ($point > 0) {
        $points = " and " . ($point < 21 ? $words[$point] : $words[floor($point / 10) * 10] . " " . $words[$point % 10]) . " Paise";
    }
    return $result . " Rupees" . $points . " Only";
}

function GetPayrollComponent($data){
    $payrollSettings = PayrollSettings::with('parent')->orderBy('id', 'asc');
    if($data == 'fee_settings'){
        $payrollSettings->where('apply_on_fee_Settings', 1)->where('parent_id', null)->where('status', 1);
    }
    if($data == 'student_fee_settings'){
        $payrollSettings->where('apply_on_fee_Settings', '!=', 1)->where('parent_id', null)->where('status', 1);
    }
    if($data == 'all_fee_settings'){
        $payrollSettings->where('status', 1)->orderBy('name', 'asc');
    }
    $payrollSettings = $payrollSettings->get();
    return $payrollSettings;
}

function PayrollComponentName($id){
    $payrollSettings = PayrollSettings::with('parent')->select('id','name','parent_id')->find($id);
    return $payrollSettings;
}

// ....................................................Future referances 
// function activeSessionMonths()
// {
//     $sessionDetails = GetSession('active_session');
//     $startDate = strtotime($sessionDetails[0]->section_valid_from);
//     $endDate = strtotime($sessionDetails[0]->section_valid_to);
    
//     $months = [];
//     $currentDate = $startDate;
//     while ($currentDate <= $endDate) {
//         $months[] = [
//             'month' => date('F', $currentDate),
//             'year' => date('Y', $currentDate),
//         ];
//         $currentDate = strtotime("+1 month", $currentDate);
//     }
//     return  $months;
// }

// function activeSessionYears()
// {
//     $sessionDetails = GetSession('active_session');
//     $startDate = strtotime($sessionDetails[0]->section_valid_from);
//     $endDate = strtotime($sessionDetails[0]->section_valid_to);
    
//     $months = [];
//     $currentDate = $startDate;
//     while ($currentDate <= $endDate) {
//         $months[] = [
//             'month' => date('F', $currentDate),
//             'year' => date('Y', $currentDate),
//         ];
//         $currentDate = strtotime("+1 month", $currentDate);
//     }
    
//     $unique_array = [];
//     foreach($months as $element) {
//         $hash = $element['year'];
//         $unique_array[$hash] = $element;
//     }
//     $result = array_values($unique_array);
//     return  $result;
// }