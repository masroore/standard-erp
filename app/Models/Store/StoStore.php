<?php

namespace App\Models\Store;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class StoStore extends Model
{
    use HasFactory;
    protected $fillable = ['title_ar','title_en','address','phone','user_id','is_active','branch_id'];

    /**
     * Get the user that owns the StoStore
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
