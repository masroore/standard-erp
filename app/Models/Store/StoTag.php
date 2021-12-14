<?php

namespace App\Models\Store;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoTag extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public function items(){
        return $this->belongsToMany(StoItem::class);
    }
}
