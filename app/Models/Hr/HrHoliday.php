<?php

namespace App\Models\Hr;

use Illuminate\Database\Eloquent\Model;

class HrHoliday extends Model
{
    protected $fillable = [
        'note', 'date_from','date_to',
    ];
}
