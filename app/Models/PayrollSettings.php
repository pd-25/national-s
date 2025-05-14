<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayrollSettings extends Model
{
    use HasFactory;
    public function parent()
    {
        return $this->belongsTo(PayrollSettings::class, 'parent_id', 'id');
    }
}