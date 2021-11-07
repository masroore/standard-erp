<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name', 'mobile' , 'department','photo','phone','linkedin','email','address','twitter','position','whatsapp','facebook','customer_id','supplier_id' 
    ];


    /** use when you need delete 
     * public static function boot() {
		parent::boot();
		// Auto Cleanup casecade Delete
		static::deleting(function ($product) {
			$product->favorites()->delete();
			$product->images()->delete();
		});

	}
     */
}
