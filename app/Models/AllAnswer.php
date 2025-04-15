<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllAnswer extends Model
{
    use HasFactory;

    // جدول مربوطه
    protected $table = 'all_answers';

    // فیلدهای قابل پر کردن
    protected $fillable = [
        'user_id',
        'section',
        'question_id',
        'answer_value',
    ];

    // برای تاریخ‌های ایجاد و به‌روزرسانی
    public $timestamps = true;
}
