<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $fillable = [];

   public function category()
   {
       return $this->belongsTo('App\Models\Category');
   }



}
