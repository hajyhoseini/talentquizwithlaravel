<?php

namespace App\Http\Controllers;

use App\Models\Quiz;

class HomeController extends Controller
{
    public function index()
    {
        $exams = Quiz::all();
        $quiz = $exams->last(); // یا ->first() اگه می‌خوای اولین آزمون باشه
        return view('welcome', compact('exams', 'quiz'));
    }
    
    
    
}
