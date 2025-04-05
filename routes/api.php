<?php
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnswerController;
// routes/api.php


Route::post('/users', [UserController::class, 'store']);

Route::post('/answers', [AnswerController::class, 'store']);  // ذخیره پاسخ‌ها
