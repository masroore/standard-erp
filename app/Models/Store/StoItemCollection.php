<?php

namespace App\Models\Store;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoItemCollection extends Model
{
    use HasFactory;
    protected $table    = 'sto_item_collections';
    protected $fillable = ['belongs_product','item_id','price','qty'];


}
