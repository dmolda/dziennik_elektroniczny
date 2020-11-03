<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teachers extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'second_name',
        'last_name',
        'date_of_birth',
        'sex'
    ];
}
