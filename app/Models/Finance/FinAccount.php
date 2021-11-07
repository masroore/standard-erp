<?php

namespace App\Models\Finance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinAccount extends Model
{
    use HasFactory;
    protected $fillable = [
        'cat_id' , 'title_ar','title_en','start_amount','parent_id','level','description'
    ];

    public function categories()
    {
        return $this->hasMany(FinAccount::class, 'parent_id');
    }

    public function childrenCategories()
    {
        return $this->hasMany(FinAccount::class, 'parent_id')->with('categories');
    }

    public function parentCategory()
    {
        return $this->belongsTo(FinAccount::class, 'parent_id');
    }

}
