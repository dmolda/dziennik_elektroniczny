<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentsHasStudents extends Model
{
    use HasFactory;

    protected $fillable = [
        'students_id ',
        'parents_id '
    ];
}
