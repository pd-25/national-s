<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherClassMapping extends Model
{
    use HasFactory;

    public function teacherClass()
    {
        return $this->belongsTo(Classes::class,'class_id', 'id');
    }
    
    public function teacherSection()
    {
        return $this->belongsTo(Section::class,'section_id', 'id');
    }

}