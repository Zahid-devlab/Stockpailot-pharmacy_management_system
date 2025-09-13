<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'mobile',
        'password',
        'img'
    ];

    protected $attributes = ['otp' => '0'];

    protected $hidden = [
        'password',
        'otp'
    ];
}
