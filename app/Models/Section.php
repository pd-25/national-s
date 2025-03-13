<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    public function className()
    {
        return $this->belongsTo(Classes::class,'class_id', 'id');
    }
}