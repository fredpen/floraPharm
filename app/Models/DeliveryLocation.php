<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryLocation extends Model
{
    //
    public function order(){
        return $this->hasMany('App\Models\Order');
    }
}
