<?php

namespace App\Models\Store;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoBrand extends Model
{
    use HasFactory;

    protected $fillable = ['title_ar','title_en'];
}
