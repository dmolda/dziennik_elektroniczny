<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonHours extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'time',
        'start_time',
        'end_time'
    ];
}
