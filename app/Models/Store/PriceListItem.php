<?php

namespace App\Models\Store;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceListItem extends Model
{
    use HasFactory;

    protected $table    = 'price_list_items';
    protected $fillable = ['price','custom_price','item_id','unit_id','list_id'];

}
