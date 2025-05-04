<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    // اگر نام جدول متفاوت باشد
    protected $table = 'quizzes'; // نام جدول را به طور دستی وارد کنید

    protected $fillable = ['title', 'description', 'slug', 'image'];
}
