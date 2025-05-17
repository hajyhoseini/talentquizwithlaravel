<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $table = 'options';  // نام جدول خود را اینجا وارد کنید

    protected $fillable = [
        'label',   // فیلدهای مورد نظر برای پر کردن
        'question_id',  // فیلدی که به سوالات ارتباط دارد
    ];

    public $timestamps = true;

    // تعریف رابطه با مدل AllQuestion
    public function question()
    {
        return $this->belongsTo(AllQuestion::class, 'question_id');
    }
}
