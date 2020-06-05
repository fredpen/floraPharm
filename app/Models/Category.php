<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [];

    public function sub_categories()
    {
        return $this->hasMany('App\Models\SubCategory', 'category_id');
    }

}
