<?php

namespace App\Models\Store;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class StoCategory extends Model
{
    use HasFactory ,LogsActivity;

    protected $fillable = ['title_ar','title_en','level','parent_id'];

    // activity log
    protected static $logAttributes           =   ['title_ar','title_en','level','parent_id'];
    protected static $logName                 =  'category';
    protected static $logOnlyDirty            =  true;


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
