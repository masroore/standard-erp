<?php

namespace App\Models\Store;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class StoBrand extends Model
{
    use HasFactory ,LogsActivity;

    protected $fillable = ['title_ar','title_en'];

    // activity log
    protected static $logAttributes           =  ['title_ar','title_en'];
    protected static $logName                 =  'brand';
    protected static $logOnlyDirty            =  true;

}
