<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Quiz;

class ExamController extends Controller
{
   
    public function show($id)
{
    // دریافت اطلاعات آزمون بر اساس ID
    $exam = Quiz::findOrFail($id);

    // دریافت سوالات مربوط به این آزمون
    $questions = DB::table('all_questions')
                   ->where('quiz_id', $exam->id)
                   ->get();

    // ارسال اطلاعات به ویو
    return view('quiz.show', compact('exam', 'questions'));
}

    public function index()
    {
        // اگر قصد دارید لیستی از آزمون‌ها رو ارسال کنید:
        $exams = Quiz::all();
        
        // بارگذاری ویو و ارسال داده‌ها
        return view('exams.index', compact('exams'));
    }
    

    public function start($id)
    {
        return view('exams.start', compact('id'));
    }
}

