<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForgetPasswordToken extends Model
{
    //
    protected $table = 'forget_password_tokens';

    public function user(){
        return $this->belongsTo('App\User');
    }



}
