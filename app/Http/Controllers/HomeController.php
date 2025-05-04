<?php

namespace App\Http\Controllers;

use App\Models\Quiz;

class HomeController extends Controller
{
    public function index()
    {
        $exams = Quiz::all();
        return view('welcome', compact('exams'));
    }
    
    
}
