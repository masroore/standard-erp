<?php

namespace App\Models\Store;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoItemCard extends Model
{
    use HasFactory;

    protected $fillable = [ 'purch_id','sale_id','receive_id','delivery_id','store_id',
                            'quantity_in','price_in','value_in','item_id',
                            'quantity_out','price_out','value_out',
                            'quantity_balance','price_balance','value_balance',
                            'description','type'];
}
