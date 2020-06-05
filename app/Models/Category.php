<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    protected $table = "category";


    public function subCategories()
    {
        return $this->hasMany(SubCategory::class, 'sub_category_id', 'category_id');
    }

}
