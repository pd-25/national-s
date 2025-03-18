<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposite extends Model
{
    use HasFactory;
    protected $fillable = [
        'payment_number',
        'user_id',
        'student_name',
        'student_roll',
        'parents_name',
        'address',
        'mobile_no',
        'session_id',
        'class_id',
        'section_id',
        'month',
        'year',
        'enrolment_fee',
        'tuition_fee',
        'terminal_fee',
        'misc_charges',
        'identity_card',
        'total',
        'payment_mode',
        'transaction_id',
        'cheque_no',
        'cheque_date',
        'bank_name',
        'branch',
        'payment_ref_no',
        'payment_getway_id',
        'status',
    ];

    public function studentDetails()
    {
        return $this->belongsTo(User::class,'user_id', 'id');
    }
    
    public function studentSession()
    {
        return $this->belongsTo(Session::class,'session_id', 'id');
    }
    
    public function studentClass()
    {
        return $this->belongsTo(Classes::class,'class_id', 'id');
    }
    
    public function studentSection()
    {
        return $this->belongsTo(Section::class,'section_id', 'id');
    }
}