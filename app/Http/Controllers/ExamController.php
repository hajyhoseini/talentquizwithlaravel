<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index()
    {
        $exams = [
            ['id' => 1, 'title' => 'آزمون اول', 'description' => 'این آزمون مقدماتی است.'],
            ['id' => 2, 'title' => 'آزمون دوم', 'description' => 'این آزمون پیشرفته‌تر است.'],
        ];
        return view('exams.index', compact('exams'));
    }

    public function start($id)
    {
        return view('exams.start', compact('id'));
    }
}

