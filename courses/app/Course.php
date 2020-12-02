<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Course extends Model
{
    
    public $timestamps = false;
    protected $fillable = [
        'name', 'description', 'category', 'teacher', 'video_link'
    ];
}
