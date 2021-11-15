<?php

namespace App\Models\Store;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoCategory extends Model
{
    use HasFactory;
    
    protected $fillable = ['title_ar','title_en','level','parent_id'];

    public function categories()
    {
        return $this->hasMany(StoCategory::class, 'parent_id');
    }

    public function childrenCategories()
    {
        return $this->hasMany(StoCategory::class, 'parent_id')->with('categories');
    }

    public function parentCategory()
    {
        return $this->belongsTo(StoCategory::class, 'parent_id');
    }

}
