<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TalentInsight extends Model
{
    protected $table = 'talent_insights'; // مطمئن شو جدول درسته

    protected $fillable = [
        'section', 'level', 'interpretation', 'suggestions'
    ];

    protected $casts = [
        'suggestions' => 'string', // 👈 این مهمه: اگه اشتباهی 'array' باشه، خراب می‌کنه
    ];
}
