<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    protected $table = "category";


    public function subCategory()
    {
        return $this->hasMany(SubCategory::class);
    }

}
