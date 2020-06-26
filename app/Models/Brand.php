<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    //
    protected $guarded = [];

    protected $table = "brand";

    public function products()
    {
        return $this->hasMany(Product::class);
    }



}
