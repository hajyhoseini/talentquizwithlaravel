<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * فیلدهایی که قابل درج گروهی (mass assignable) هستند
     */
    protected $fillable = [
        'name',
        'national_code',
        'phone',
        'password',
    ];

    /**
     * فیلدهایی که در زمان تبدیل به JSON یا آرایه پنهان می‌شن
     */
  

    /**
     * تبدیل نوع فیلدها (کستینگ)
     */
 public function answers()
{
    return $this->hasMany(AllAnswer::class, 'user_id');
}

}
