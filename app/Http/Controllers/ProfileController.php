<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // اعتبارسنجی اطلاعات ورودی
        $request->validate([
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        // به‌روزرسانی اطلاعات کاربر در دیتابیس
        $user->update($request->only('first_name', 'last_name', 'phone', 'name', 'email'));

        // بعد از به‌روزرسانی، ریدایرکت به صفحه اصلی و نمایش پیام موفقیت
        return redirect('/')->with('success', 'اطلاعات با موفقیت به‌روزرسانی شد.');
    }
}
