<?php

namespace App\Models\Store;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoUnit extends Model
{
    use HasFactory;

    protected $fillable = ['unit_code','unit_name','base_unit','operator','operation_value','is_active'];
}
 