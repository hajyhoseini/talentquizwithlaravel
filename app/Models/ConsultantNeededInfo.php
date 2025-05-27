<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsultantNeededInfo extends Model
{
    // نام جدول اگر با نام مدل متفاوت است، مشخص می‌کنیم
    protected $table = 'consultant_needed_info';

    // فیلدهایی که می‌خواهیم بتوان به صورت Mass Assignment مقداردهی کنیم
    protected $fillable = [
        'first_name',
        'last_name',
        'national_code',
        'mobile',
    ];

    // اگر بخوای تاریخ‌ها به صورت Carbon برگردند، این خط رو بذار
    public $timestamps = true;
}
