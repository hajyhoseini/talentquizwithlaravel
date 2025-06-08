<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuggestedCareer extends Model
{
    // اگر جدول به صورت غیراستاندارد (جمع انگلیسی) نام‌گذاری شده
    protected $table = 'suggested_careers';

    // فیلدهایی که قابل پر کردن (mass assignable) هستند
    protected $fillable = [
        'quiz_id',
        'talent_name',
        'career_title',
        'career_description',
        'career_image_url',
    ];

    // اگر از تاریخ‌های created_at و updated_at استفاده می‌کنی، نیازی به تغییر نیست
    // اگر نه، اینو می‌تونی بذاری:
    // public $timestamps = false;

    // 👇 اگر ارتباط با مدل دیگه مثل Quiz داری:
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
