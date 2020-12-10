<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Educators extends Model
{
    protected $fillable = [
        'teachers_id',
        'classes_id',
    ];
}
