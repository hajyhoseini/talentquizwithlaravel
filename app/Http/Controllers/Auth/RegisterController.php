<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
public function register(Request $request)
{
    // اعتبارسنجی (phone اختیاری)
    $request->validate([
        'full_name'     => 'required|string|max:255',
        'national_code' => 'required|digits:10',
        'phone'         => 'nullable|regex:/^09[0-9]{9}$/',
    ]);

    // بررسی وجود کاربر با کد ملی
    $existingUser = User::where('national_code', $request->national_code)->first();

    if ($existingUser) {
        // اگر وجود داشت: لاگین و ریدایرکت
        Auth::login($existingUser);
        return redirect()->route('quiz.show')->with('success', 'شما با موفقیت وارد شدید.');
    }

    // اگر کاربر وجود نداشت: ایجاد، لاگین، ریدایرکت
    $user = User::create([
        'name'           => $request->full_name,
        'national_code'  => $request->national_code,
        'phone'          => $request->phone,
        'password'       => Hash::make($request->national_code), // یا رمز تصادفی
    ]);

    Auth::login($user);

    return redirect()->route('quiz.show')->with('success', 'ثبت‌نام با موفقیت انجام شد.');
}

}
