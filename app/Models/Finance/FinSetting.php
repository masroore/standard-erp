<?php

namespace App\Models\Finance;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinSetting extends Model
{
    use HasFactory;

    protected $fillable = [ 'title_ar','title_en','account_id','user_id','account_key'];

    public function account()
    {
        return $this->belongsTo(FinAccount::class, 'account_id');
    }

    public function journal()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
