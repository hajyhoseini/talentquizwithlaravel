<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MbtiQuestion extends Model
{
    use HasFactory;

    protected $table = 'mbti_questions'; // نام دقیق جدول در دیتابیس
}
