<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllQuestion extends Model
{
    use HasFactory;

    // مشخص کردن نام جدول در دیتابیس
    protected $table = 'all_questions';

    // ستون‌هایی که قابل پر شدن هستند (Mass Assignment)
    protected $fillable = [
        'section',
        'question',
        'quiz_id',
    ];

    // اگر نیاز به خاموش کردن خودکار زمان‌های created_at و updated_at ندارید، می‌توانید این گزینه را به false تغییر دهید
    public $timestamps = true;
}
