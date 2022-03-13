<?php

namespace App\Models\Store;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoQuantity extends Model
{
    use HasFactory;
    protected $fillable = ['store_id','item_id','quantity','id','created_at','updated_at'];
}
