<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['status','payment_status','custom_fields','attachment','package_name','package_price','package_id'];

    public function package(){
        return $this->hasOne(\App\PricePlan::class,'id','package_id');
    }

}
