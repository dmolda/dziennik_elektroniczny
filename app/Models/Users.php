<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $fillable = [
        'name','email','password'
    ];

    public function setPasswordAttribute($password){
        if (!empty($password)){
            $this->attributes['password'] = bcrypt($password);
        }
    }
}
