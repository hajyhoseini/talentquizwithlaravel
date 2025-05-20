<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuizColumn extends Model
{
    use HasFactory;

    protected $table = 'quiz_columns'; // نام جدول در دیتابیس

    protected $fillable = [
        'quiz_id',
        'column_name',
        'max_score',
    ];

    // اگر از تاریخ‌های اتوماتیک استفاده می‌کنی (created_at, updated_at)
    public $timestamps = true;

    /**
     * ارتباط با مدل Quiz
     */
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
