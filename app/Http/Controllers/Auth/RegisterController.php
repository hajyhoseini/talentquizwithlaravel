<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        // اعتبارسنجی ورودی‌ها
        $request->validate([
            'name' => 'required|string|max:255',
            'national_code' => 'required|digits:10',
        ]);

        // بررسی وجود کاربر با کد ملی
        $existingUser = User::where('national_code', $request->national_code)->first();

        if ($existingUser) {
            Auth::login($existingUser);
            return redirect()->route('quiz.show')->with('success', 'شما با موفقیت وارد شدید.');
        }

        // ساخت کاربر جدید
        $user = User::create([
            'name' => $request->name,
            'national_code' => $request->national_code,
            'password' => Hash::make($request->national_code), // رمز برابر کد ملی
        ]);

        Auth::login($user);
        return redirect()->route('quiz.show')->with('success', 'ثبت‌نام با موفقیت انجام شد.');
    }
}
