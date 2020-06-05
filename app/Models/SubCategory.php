<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $guarded = [];

    protected $table = "sub_category";

   public function category()
   {
       return $this->belongsTo('App\Models\Category');
   }



}
