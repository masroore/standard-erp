<?php

namespace App\Models\Purchase;

use App\Models\Sales\SalOrderedSupplyCustomer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyOperation extends Model
{
    use HasFactory;

    protected $fillable = ['start_at','code','end_at','is_created_pr','created_by'
                            ,'is_created_cust_po' , 'is_created_receive','is_created_po','is_created_inv','is_created_return'];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function custOrderSuplly(){
        return $this->hasMany(SalOrderedSupplyCustomer::class , 'opration_id');
    }

    public function purchRequet(){
        return $this->hasMany(BuyPurchaseRequisition::class , 'opration_id');
    }

    public function purchPo(){
        return $this->hasMany(BuyPurchaseOrder::class , 'opration_id');
    }

    public function opReceive(){
        return $this->hasMany(BuyReceive::class , 'opration_id');
    }

    public function opInvoice(){
        return $this->hasMany(BuyPurchaseInvoice::class , 'opration_id');
    }




}
