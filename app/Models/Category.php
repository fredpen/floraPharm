<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    protected $table = "category";

    public function subCategories()
    {
        return $this->hasMany('App\Models\SubCategory', 'category_id', 'sub_category_id');
    }

}
