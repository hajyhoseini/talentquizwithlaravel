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
        // اعتبارسنجی داده‌ها
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|regex:/^09[0-9]{9}$/',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // اگر اعتبارسنجی شکست خورد
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // ذخیره‌سازی کاربر جدید
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),  // رمزعبور با هش ذخیره می‌شود
        ]);

        // پس از ذخیره‌سازی، ریدایرکت به صفحه لاگین یا داشبورد
        return redirect()->route('login')->with('success', 'ثبت نام با موفقیت انجام شد.');
    }
}
