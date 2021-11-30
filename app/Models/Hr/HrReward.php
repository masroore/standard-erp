<?php

namespace App\Models\Hr;

use Illuminate\Database\Eloquent\Model;

class HrReward extends Model
{
    protected $fillable = [
        'employee_id', 'date','reason','reward_type','amount'
    ];
}
