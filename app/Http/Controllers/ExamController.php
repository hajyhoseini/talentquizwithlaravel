<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\AllAnswer;
use App\Models\TalentInsight;
use Carbon\Carbon;
use Morilog\Jalali\Jalalian;
use Illuminate\Http\Request;
use App\Models\Quiz;
 use App\Models\AllQuestion;
 use App\Services\QuizEvaluationContext;
use App\Strategies\DefaultEvaluationStrategy;

class ExamController extends Controller
{
    // نمایش اطلاعات آخرین آزمون تکمیل شده توسط کاربر
    public function completedExams()
    {
        // گرفتن اطلاعات آزمون‌های تکمیل شده با عنوان و تصویر، به همراه تاریخ آخرین به‌روزرسانی
        $completedExams = AllAnswer::where('user_id', auth()->id())
                                    ->join('quizzes', 'quizzes.id', '=', 'all_answers.quiz_id')
                                    ->select('quizzes.id', 'quizzes.title', 'quizzes.image', 'all_answers.updated_at')
                                    ->orderBy('all_answers.updated_at', 'desc')
                                    ->first();
    
        // اگر داده‌ها وجود داشتند، تاریخ را فرمت می‌کنیم
        if ($completedExams && $completedExams->updated_at) {
            $dateTime = Carbon::parse($completedExams->updated_at)->subHour(); // کاهش یک ساعت از تاریخ (اگر نیاز باشد)
            $completedExams->formatted_date = Jalalian::fromCarbon($dateTime)->format('%Y/%m/%d - H:i'); // فرمت تاریخ به شمسی
        }
    
        // ارسال داده‌ها به ویو برای نمایش
        return view('completed_exams', compact('completedExams'));
    }
    
  
    
    // نمایش اطلاعات جزئیات یک آزمون بر اساس شناسه آن
    public function show($id)
    {
        // دریافت اطلاعات آزمون بر اساس شناسه
        $quiz = Quiz::findOrFail($id);
    
        // دریافت سوالات مربوط به این آزمون


$questions = AllQuestion::with('options')
           ->where('quiz_id', $quiz->id)
           ->get()
           ->groupBy('section');


        // ارسال اطلاعات آزمون و سوالات به ویو
        return view('quiz.show', compact('quiz', 'questions'));
    }
    
    // نمایش لیست تمامی آزمون‌ها
    public function index()
    {
        // دریافت تمامی آزمون‌ها
        $exams = Quiz::all();
        
        // ارسال داده‌ها به ویو برای نمایش لیست آزمون‌ها
        return view('exams.index', compact('exams'));
    }

    // تفسیر نتایج آزمون برای یک آزمون خاص

public function interpretation($id)
{
    $quiz = Quiz::findOrFail($id);
    $userId = Auth::id();

    // انتخاب استراتژی مناسب - فعلاً فقط یکی داریم
    $strategy = new DefaultEvaluationStrategy();
    $context = new QuizEvaluationContext($strategy);

    $results = $context->evaluate($quiz->id, $userId);

    return view('exams.interpretation', compact('quiz', 'results'));
}

    // شروع یک آزمون جدید بر اساس شناسه
    public function start($id)
    {
        return view('exams.start', compact('id'));
    }
}
