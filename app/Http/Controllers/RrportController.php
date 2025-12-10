<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Deposite;
use App\Models\StudentClassMapping;

class RrportController extends Controller
{
    public function index()
    {
        $sections = Section::with('className')->get();
        $newSections = [];
        foreach ($sections as $section) {
            $newSections[] = [
                'id' => $section->id,
                'class_id' => $section->class_id,
                'section_name' => $section->section_name,
                'class_name' => $section->className->class_name,
                'class_section' => $section->className->class_name . ' - ' . $section->section_name,
            ];
        }
         return view('admin.report.attendance_report', compact('newSections'));
    }

    public function classAttendanceReport(Request $request)
    {
        $request->validate([
            'session_id' => 'required',
            'class_id'   => 'required',
            'section_id' => 'required',
        ]);
        $query = Attendance::with([
            'teacherDetails',
            'studentDetails',
            'studentSession',
            'studentClass',
            'studentSection'
        ]);
        // Required filters
        $query->where('session_id', $request->session_id)
            ->where('class_id', $request->class_id)
            ->where('section_id', $request->section_id);
        // Optional: Date Range
        if (!empty($request->from_date) && !empty($request->to_date)) {
            $query->whereBetween('date_taken', [
                $request->from_date,
                $request->to_date
            ]);
        }
         
        // Optional: Single student
        if ($request->student_id != 'All') {
            $query->where('user_id', $request->student_id);
        }
        
        if (!empty($request->status)) {
            if ($request->status === 'P') {
                $query->where('status', 1)->where('late', 0);
            } elseif ($request->status === 'A') {
                $query->where('status', 0);
            } elseif ($request->status === 'L') {
                $query->where('status', 1)->where('late', 1);
            }
        }
        $attendance = $query->orderBy('date_taken', 'desc')->get();
        return response()->json($attendance);
    }

    public function feesindex()
    {
        $sections = Section::with('className')->get();
        $newSections = [];
        foreach ($sections as $section) {
            $newSections[] = [
                'id' => $section->id,
                'class_id' => $section->class_id,
                'section_name' => $section->section_name,
                'class_name' => $section->className->class_name,
                'class_section' => $section->className->class_name . ' - ' . $section->section_name,
            ];
        }
         return view('admin.report.fees_report', compact('newSections'));
    }

    public function feesreportshow(Request $request)
    {
        $session_id = $request->session_id;
        $class_id = $request->class_id;
        $section_id = $request->section_id;
        $user_id = $request->user_id;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $payment_mode = $request->payment_mode;
        $status_id = $request->status_id;
        $query = Deposite::with('studentDetails', 'studentSession', 'studentClass', 'studentSection');
        
        if ($session_id) $query->where('session_id', $session_id);
        if ($class_id) $query->where('class_id', $class_id);
        if ($section_id) $query->where('section_id', $section_id);
        if ($user_id != 'All') $query->where('user_id', $user_id);

        if (!empty($from_date) && !empty($to_date)) 
        {
            // $from = Carbon::createFromFormat('d-m-Y', $from_date);
            // $to = Carbon::createFromFormat('d-m-Y', $to_date);
            $from = Carbon::createFromFormat('Y-m-d', $from_date);
            $to = Carbon::createFromFormat('Y-m-d', $to_date);
            $monthsList = [];
            $period = Carbon::parse($from)->startOfMonth();
            while ($period <= $to) {
                $monthsList[] = [
                    'month' => $period->format('F'),
                    'year'  => $period->year
                ];
                $period->addMonth();
            }
            
            $query->where(function ($q) use ($monthsList) {
                foreach ($monthsList as $m) {
                    $q->orWhere(function ($sub) use ($m) {
                        $sub->where('month', $m['month'])
                        ->where('year', $m['year']);
                    });
                }
            });
        }
        if ($payment_mode && $payment_mode != 'All') {
            $query->where('payment_mode', $payment_mode);
        }

        if ($status_id && $status_id != 'All') {
            $query->where('status', $status_id);
        }
        
        return $query->orderBy('year','desc')
                    ->orderBy('month','desc')
                    ->orderBy('payment_number','desc')
                    ->get();
    }


}