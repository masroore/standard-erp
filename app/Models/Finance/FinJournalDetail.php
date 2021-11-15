<?php

namespace App\Models\Finance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinJournalDetail extends Model
{
    use HasFactory;

    protected $fillable = [ 'credit','debit','account_id','journal_id'];


    /**
     * Get the user that owns the FinJournalDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo(FinAccount::class, 'account_id');
    }

    public function journal()
    {
        return $this->belongsTo(FinJournal::class, 'journal_id');
    }
}
