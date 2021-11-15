<?php

namespace App\Models\Store;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class StoItem extends Model
{
    use HasFactory;

    protected $fillable = 
                    ['title_ar','title_en','barcode','cost','sale_price',
                    'alert_quantity','cat_id','brand_id','branch_id','code',
                    'created_by','updated_by','tax_id','tax_method','image',
                    'description','barcode_symbology','is_batch','is_variant'];


    /**
     * Get the category that owns the StoItem
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(StoCategory::class, 'cat_id');
    }


     /**
     * Get the Brand that owns the StoItem
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand()
    {
        return $this->belongsTo(StoBrand::class, 'brand_id');
    }

}
