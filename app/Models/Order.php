<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $casts = [
        'user_detail' => 'array'
    ];

    public function orderDetail(){
        return $this->hasMany('App\Models\OrderDetail');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }


    public function address() {
        return $this->belongsTo(UserAddress::class);
    }

    public function deliveryLocation() {
        return $this->belongsTo('App\Models\DeliveryLocation');
    }


}
