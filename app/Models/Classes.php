<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function Subjects(){
        return $this->belongsToMany(Subjects::class,'Classes_has_Subjects','classes_id','subjects_id')->withTimestamps();

    }
}
