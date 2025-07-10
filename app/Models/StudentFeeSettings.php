<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentFeeSettings extends Model
{
    use HasFactory;
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
    
    public function studentDetails()
    {
        return $this->belongsTo(User::class,'user_id', 'id');
    }
}