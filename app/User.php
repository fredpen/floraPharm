<?php

namespace App;

use App\Models\Cart;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userAddress(){
        return $this->hasMany('App\Models\UserAddress');
    }

    public function forgetPasswordToken(){
        return $this->hasMany('App\Models\ForgetPasswordToken');
    }

    public function order(){
        return $this->hasMany('App\Models\Order');
    }

    public function cart(){
        return $this->hasMany(Cart::class);
    }
}
