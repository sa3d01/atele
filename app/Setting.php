<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'email', 'mobile', 'about', 'facebook','twitter','insta', 'terms'
    ];
    protected $casts = [
        'about' => 'json',
        'terms' => 'json',
    ];
}
