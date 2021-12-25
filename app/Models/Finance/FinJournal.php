<?php

namespace App\Models\Finance;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinJournal extends Model
{
    use HasFactory;
    protected $fillable = [ 'attachment' , 'date','ref','details','user_id'  ];

    public function journal()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function items(){
        return $this->hasMany(FinJournalDetail::class, 'journal_id');
    }


}
