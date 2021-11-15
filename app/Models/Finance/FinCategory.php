<?php

namespace App\Models\Finance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'title_ar', 'title_en'
    ];
}
