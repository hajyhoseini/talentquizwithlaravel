<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'quizzes';

    protected $fillable = [
        'title',
        'description',
        'description_min',
        'slug',
        'image',
        'image_main',  // ← اضافه کردن ستون جدید
    ];
}
