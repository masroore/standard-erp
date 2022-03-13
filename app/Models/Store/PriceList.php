<?php

namespace App\Models\Store;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class PriceList extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['name','details'];
    protected $table    = 'price_lists';
     // activity log use Spatie\Activitylog\Traits\LogsActivity;
     protected static $logAttributes           =  ['name','details'];
     protected static $logName                 =  'priceList';
     protected static $logOnlyDirty            =  true;




}
