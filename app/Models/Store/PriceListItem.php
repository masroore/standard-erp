<?php

namespace App\Models\Store;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class PriceListItem extends Model
{
    use HasFactory, LogsActivity;

    protected $table    = 'price_list_items';
    protected $fillable = ['price','custom_price','item_id','unit_id','list_id'];
    // activity log use Spatie\Activitylog\Traits\LogsActivity;
    protected static $logAttributes           =   ['price','custom_price','item_id','unit_id','list_id'];
    protected static $logName                 =  'priceListItem';
    protected static $logOnlyDirty            =  true;

}
