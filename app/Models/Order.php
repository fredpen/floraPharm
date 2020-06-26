<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    public function orderDetail(){
        return $this->hasMany('App\Models\OrderDetail');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }


    public function address() {
        return $this->belongsTo(UserAddress::Class);
    }


}
