<?php

namespace App\Models\Store;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class StoItem extends Model
{
    use HasFactory;

    protected $fillable =
                    ['title_ar','title_en','barcode','cost','sale_price','purchase_unit_id','weight','made_in','item_type',
                    'alert_quantity','cat_id','brand_id','branch_id','code','sale_unit_id','width','height','qty_list',
                    'created_by','updated_by','tax_id','tax_method','image','unit_id','lenght','discount_group',
                    'description','barcode_symbology','is_batch','is_variant','price_list','is_active','product_list'];


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

    /**
     * Get the user that owns the StoItem
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function purchUnit()
    {
        return $this->belongsTo(StoUnit::class, 'purchase_unit_id');
    }

    public function saleUnit()
    {
        return $this->belongsTo(StoUnit::class, 'sale_unit_id');
    } 

    public function baseUnit()
    {
        return $this->belongsTo(StoUnit::class, 'unit_id');
    }

    public function tags(){

        return $this->belongsToMany(StoTag::class);
    }

    public function user(){
        return $this->belongsTo(User::class, 'created_by');
    }

    public function collectionProduct(){
        return $this->hasMany(StoItemCollection::class, 'belongs_product');
    }
}
