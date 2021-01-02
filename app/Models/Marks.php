<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marks extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'mark_desc',
        'description',
        'weight'
    ];

    public static function getMark($mark_desc){
        if($mark_desc == "1"){
            $mark = 1;
        }elseif($mark_desc == "1+"){
            $mark = 1.3;
        }elseif($mark_desc == "2-"){
            $mark = 1.7;
        }elseif($mark_desc == "2"){
            $mark = 2;
        }elseif($mark_desc == "2+"){
            $mark = 2.3;
        }elseif($mark_desc == "3-"){
            $mark = 2.7;
        }elseif($mark_desc == "3"){
            $mark = 3;
        }elseif($mark_desc == "3+"){
            $mark = 3.3;
        }elseif($mark_desc == "4-"){
            $mark = 3.7;
        }elseif($mark_desc == "4"){
            $mark = 4;
        }elseif($mark_desc == "4+"){
            $mark = 4.3;
        }elseif($mark_desc == "5-"){
            $mark = 4.7;
        }elseif($mark_desc == "5"){
            $mark = 5;
        }elseif($mark_desc == "5+"){
            $mark = 5.3;
        }elseif($mark_desc == "6-"){
            $mark = 5.7;
        }elseif($mark_desc == "6"){
            $mark = 6;
        }

        return $mark;

    }
}
