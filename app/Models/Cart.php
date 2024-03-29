<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $guarded = [];

    protected $table = "carts";


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

     public function scopeUpdatedAtDescending($query)
    {
        return $query->orderBy('updated_at', 'desc');
    }
}
