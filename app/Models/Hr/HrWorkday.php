<?php

namespace App\Models\Hr;

use Illuminate\Database\Eloquent\Model;

class HrWorkday extends Model
{
    protected $fillable = [
        'name', 'status',
    ];
}
