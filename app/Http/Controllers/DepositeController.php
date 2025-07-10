<?php

namespace App\Http\Controllers;

use App\Models\Deposite;
use App\Models\User;
use Illuminate\Http\Request;

class DepositeController extends Controller
{
    public function index()
    {
        return view('admin.fees.add_deposite');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.fees.list_deposite');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'session_id' => 'required|exists:sessions,id',
            'class_id' => 'required|exists:classes,id',
            'section_id' => 'required|exists:sections,id',
            'month' => 'required|string',
            'year' => 'required|string',
            'amount' => 'nullable|array',
            'comments' => 'nullable|array',
            'total_payable' => 'required|numeric',
            'payment_mode' => 'required|string|max:30',
            'transaction_id' => 'nullable|string',
            'cheque_no' => 'nullable|string',
            'cheque_date' => 'nullable|string',
            'bank_name' => 'nullable|string',
            'branch' => 'nullable|string',
        ]);
        $today = now()->format('ymd');
        $sequence = 1;
        do {
            $paymentOrderNumber = sprintf('%s%s', $today, str_pad($sequence, 3, '0', STR_PAD_LEFT));
            $exists = Deposite::where('payment_number', $paymentOrderNumber)->exists();
            $sequence++;
        } while ($exists);
        //     $depositCount = Deposite::where('session_id', $request->session_id)->where('class_id', $request->class_id)->where('section_id', $request->section_id)->where('user_id', $request->user_id)->where('month', $request->month)->where('year', $request->year)->count();
        // if($depositCount > 0){
        //     return back()->withError('Payment already done');
        // }
        
        $user = User::find($request->user_id);
        $deposit = Deposite::create([
            'payment_number' => $paymentOrderNumber,
            'user_id' => $request->user_id,
            'student_name' => $user->student_name,
            'parents_name' => $user->parent_name,
            'address' => $user->address . ', ' . $user->pin_code,
            'mobile_no' => $user->mobile_no,
            'session_id' => $request->session_id,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'month' => $request->month,
            'year' => $request->year,
            'amount' => json_encode($request->amount),
            'comments' => json_encode($request->comments),
            'total_payable' => $request->total_payable,
            'payment_mode' => $request->payment_mode,
            'transaction_id' => $request->transaction_id,
            'cheque_no' => $request->cheque_no,
            'cheque_date' => $request->cheque_date,
            'bank_name' => $request->bank_name,
            'branch' => $request->branch,
            'payment_ref_no' => $request->payment_ref_no,
            'payment_getway_id' => $request->payment_getway_id,
            'status' => $request->status == null ? "Completed" : "Pending",
        ]);
        return redirect()->route('deposite.viewDownloadDeposite',$paymentOrderNumber)->withSuccess('Payment processed successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $payment_number = $request->payment_number;
        $session_id = $request->session_id;
        $class_id = $request->class_id;
        $section_id = $request->section_id;
        $user_id = $request->user_id;
        $month = $request->month;
        $year = $request->year;

        $query = Deposite::with('studentDetails', 'studentSession', 'studentClass', 'studentSection');
        
        if ($payment_number) {
            $query->where('payment_number', $payment_number);
        }
        if ($session_id) {
            $query->where('session_id', $session_id);
        }
        if ($class_id) {
            $query->where('class_id', $class_id);
        }
        if ($section_id) {
            $query->where('section_id', $section_id);
        }
        if ($user_id) {
            $query->where('user_id', $user_id);
        }
        if ($month) {
            $query->where('month', $month);
        }
        if ($year) {
            $query->where('year', $year);
        }
        
        $allDeposite = $query->orderBy('month', 'desc')->orderBy('payment_number', 'desc')->get();
        return $allDeposite;
    }

    public function viewDownloadDeposite($payment_number)
    {
        $deposite = Deposite::with('studentDetails', 'studentSession', 'studentClass', 'studentSection')->where('payment_number', $payment_number)->first();
        
        $depositeAmountRaw = json_decode($deposite->amount);
        $depositeAmount = new \stdClass();
        foreach ($depositeAmountRaw as $key => $value) {
            if ($value) {
                $KeyName = PayrollComponentName($key);
                $propName = $KeyName->name;
                $depositeAmount->$propName = $value;
            }
        }
        $deposite->amount = $depositeAmount;
        
        $depositeCommentsRaw = json_decode($deposite->comments);
        $depositeComments = new \stdClass();
        foreach ($depositeCommentsRaw as $key => $value) {
            if ($value != null) {
                $KeyName = PayrollComponentName($key);
                $parentName = PayrollComponentName($KeyName->parent_id);
                $propName = $KeyName->name.' - '.$parentName->name;
                $depositeComments->$propName = $value;
            }
        }
        $deposite->comments = $depositeComments;
        return view('admin.fees.view_download_deposite', compact('deposite'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($payment_number)
    {
        $deposite = Deposite::where('payment_number', $payment_number)->first();
        return view('admin.fees.edit_deposite', compact('deposite'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Deposite $deposite)
    {
        $request->validate([
            'amount' => 'nullable|array',
            'comments' => 'nullable|array',
            'total_payable' => 'required|numeric',
            'payment_mode' => 'required|string|max:30',
            'transaction_id' => 'nullable|string',
            'cheque_no' => 'nullable|string',
            'cheque_date' => 'nullable|string',
            'bank_name' => 'nullable|string',
            'branch' => 'nullable|string',
        ]);
        $deposite->update([
            'amount' => $request->amount,
            'comments' => $request->comments,
            'total_payable' => $request->total_payable,
            'payment_mode' => $request->payment_mode,
            'transaction_id' => $request->transaction_id ?? null,
            'cheque_no' => $request->cheque_no ?? null,
            'cheque_date' => $request->cheque_date ?? null,
            'bank_name' => $request->bank_name ?? null,
            'branch' => $request->branch ?? null,
            'payment_ref_no' => $request->payment_ref_no ?? null,
            'payment_getway_id' => $request->payment_getway_id ?? null,
            'status' => $request->status ?? "Completed",
        ]);
        return redirect()->route('deposite.viewDownloadDeposite', $deposite->payment_number)
            ->with('info','Payment updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $deposite = Deposite::find($request->id);
            $deposite->delete();
            return ['warning'=>'Deposite Data Deleted successfully'];
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error'.$th->getMessage()]);
        }
    }
    
}