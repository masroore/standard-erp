<?php

namespace App\Models\Finance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinBank extends Model
{
    use HasFactory;

    protected $fillable = [ 'title_ar','title_en','account_id','notes'];

    public function account()
    {
        return $this->belongsTo(FinAccount::class, 'account_id');
    }

}
