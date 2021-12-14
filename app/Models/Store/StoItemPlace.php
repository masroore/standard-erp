<?php

namespace App\Models\Store;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoItemPlace extends Model
{
    use HasFactory;
    protected $table    = 'sto_item_store_places';
    protected $fillable = ['place','item_id','store_id'];


}
