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
    
    // نمایش تفسیر نتایج آزمون برای یک کاربر خاص
    public function showInterpretation($quiz_id, $user_id)
    {
        // بررسی اینکه آیا کاربر فعلی به این داده‌ها دسترسی دارد یا خیر
        if (auth()->id() !== (int) $user_id) {
            abort(403, 'شما اجازه دسترسی به این صفحه را ندارید.');
        }
    
        // دریافت تمام جواب‌های مربوط به این آزمون و کاربر
        $answers = DB::table('all_answers')
            ->where('user_id', $user_id)
            ->where('quiz_id', $quiz_id)
            ->get();
    
        // اگر جواب‌ها پیدا نشدند، بازگشت به صفحه قبلی با پیغام خطا
        if ($answers->isEmpty()) {
            return redirect()->back()->with('error', 'نتیجه‌ای یافت نشد.');
        }
    
        // ایجاد آرایه‌ای برای ذخیره نتایج تحلیل
        $results = [];
    
        // پردازش جواب‌ها و محاسبه نتایج بر اساس بخش‌های مختلف
        foreach ($answers as $answer) {
            $section = $answer->section;
    
            if (!isset($results[$section])) {
                $results[$section] = [
                    'score' => 0,
                    'count' => 0,
                    'suggestions' => [],
                ];
            }
    
            $results[$section]['score'] += (int) $answer->answer_value;
            $results[$section]['count'] += 1;
        }
    
        // محاسبه میانگین امتیاز و تحلیل نتایج هر بخش
        foreach ($results as $section => &$data) {
            $averageScore = $data['score'] / $data['count'];
            $data['score'] = round($averageScore, 2); // میانگین امتیاز با دو رقم اعشار
    
            // دریافت تفسیر و پیشنهادات
            $data['interpretation'] = $this->getInterpretation($section, $data['score']);
            $data['suggestions'] = $this->getSuggestions($section, $data['score']);
        }
    
        // نمایش نتایج در ویو
        return view('exams.interpretation', compact('results'));
    }
    
    // نمایش اطلاعات جزئیات یک آزمون بر اساس شناسه آن
    public function show($id)
    {
        // دریافت اطلاعات آزمون بر اساس شناسه
        $quiz = Quiz::findOrFail($id);
    
        // دریافت سوالات مربوط به این آزمون
        $questions = DB::table('all_questions')
                       ->where('quiz_id', $quiz->id)
                       ->get();
    
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
        // دریافت اطلاعات آزمون و شناسه کاربر فعلی
        $quiz = Quiz::findOrFail($id);
        $userId = Auth::id();
    
        // دریافت جواب‌های مربوط به این آزمون برای کاربر فعلی
        $answers = AllAnswer::where('user_id', $userId)
        ->where('quiz_id', $quiz->id)
        ->get();

        // ایجاد آرایه برای ذخیره نتایج
        $results = [];
    
        // پردازش جواب‌ها و محاسبه نمرات
        foreach ($answers as $answer) {
            $section = $answer->section;
            if (!isset($results[$section])) {
                $results[$section] = ['score' => 0];
            }
            $results[$section]['score'] += $answer->answer_value;
        }
    
        // تفسیر نتایج بر اساس نمره‌های هر بخش
        foreach ($results as $section => &$data) {
            $score = $data['score'];
    
            if ($score >= 17) {
                $level = 'high'; // نمره بالا
            } elseif ($score >= 12) {
                $level = 'medium'; // نمره متوسط
            } else {
                $level = 'low'; // نمره پایین
            }
    
            // دریافت تفسیر و پیشنهادات از مدل TalentInsight
            $insight = TalentInsight::where('section', $section)
                                    ->where('level', $level)
                                    ->first();
    
            $data['level'] = $level;
            $data['interpretation'] = $insight ? $insight->interpretation : 'تفسیر یافت نشد.'; // تفسیر
            $data['suggestions'] = [];
    
            // اگر پیشنهادات وجود داشتند، آن‌ها را پردازش می‌کنیم
            if ($insight && !empty($insight->suggestions)) {
                $lines = preg_split('/\r\n|\r|\n/', trim($insight->suggestions));
                $data['suggestions'] = array_filter($lines, fn($line) => !empty(trim($line))); // تمیز کردن پیشنهادات
            }
        }
    
        // ارسال نتایج به ویو
        return view('exams.interpretation', compact('quiz', 'results'));
    }

    // شروع یک آزمون جدید بر اساس شناسه
    public function start($id)
    {
        return view('exams.start', compact('id'));
    }
}
