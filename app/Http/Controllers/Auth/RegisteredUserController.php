<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    /**
     * نمایش فرم ثبت‌نام
     */
    public function create()
    {
        return view('auth.register'); // مسیر ویو فرم ثبت‌نام
    }

    /**
     * ذخیره کاربر جدید در دیتابیس
     */
public function store(Request $request)
{
    // اعتبارسنجی (phone اختیاری است)
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'national_code' => ['required', 'digits:10'],
        'phone' => ['nullable', 'regex:/^09\d{9}$/'],
    ]);

    // ابتدا کاربر رو بر اساس national_code جستجو می‌کنیم
    $user = User::where('national_code', $request->national_code)->first();

    if ($user) {
        // اگر کاربر قبلا وجود داشت، فقط لاگینش می‌کنیم
        Auth::login($user);
    } else {
        // اگر نبود، جدید می‌سازیم
        $user = User::create([
            'name' => $request->name,
            'national_code' => $request->national_code,
            'phone' => $request->phone,
            'password' => Hash::make($request->national_code), // رمز به صورت هش شده
        ]);

        event(new Registered($user));

        Auth::login($user);
    }

    // هدایت به صفحه نتایج آزمون یا داشبورد
return redirect()->route('quiz.show', ['quizId' => 1, 'userId' => $user->id]);
}

}
