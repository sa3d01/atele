<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;
    protected $guard = 'admin';

    protected $fillable = [
        'name', 'email', 'mobile', 'status', 'image', 'password',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setImageAttribute($image)
    {
        $file = request()->file('image');
        $destinationPath = 'images/user/';
        $filename = $file->getClientOriginalName();
        $file->move($destinationPath, $filename);
        $this->attributes['image'] = $filename;
    }
    public function getImageAttribute()
    {
        if ($this->attributes['image']) {
            return asset('images/user/') . '/' . $this->attributes['image'];
        }
        return asset('images/user/admin.png');
    }

    public function setPasswordAttribute($password)
    {
        if (isset($password)) {
            $this->attributes['password'] = bcrypt($password);
        }
    }
}
