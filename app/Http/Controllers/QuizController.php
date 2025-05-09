<?php

namespace App\Http\Controllers;

use App\Models\AllQuestion;
use App\Models\AllAnswer;
use App\Models\TalentInsight;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    // نمایش آزمون به همراه سوالات گروه‌بندی شده بر اساس بخش
    public function showQuiz()
    {
        // گرفتن تمام سوالات و گروه‌بندی آنها بر اساس بخش
        $questions = AllQuestion::all()->groupBy('section');
        
        // گرفتن آخرین کوییز ثبت شده
        $quiz = Quiz::latest()->first();

        // ارسال سوالات و آزمون به ویو
        return view('quiz.show', compact('questions', 'quiz'));
    }

    // دریافت پاسخ‌های فرم و ذخیره آنها
    public function submitAnswers(Request $request)
    {
        $userId = Auth::id(); // دریافت شناسه کاربر فعلی

        // بررسی اینکه آیا کاربر پاسخ‌هایی ارسال کرده است
        if (!$request->has('answers') || empty($request->answers)) {
            return back()->withErrors(['error' => 'لطفاً حداقل به یک سوال پاسخ دهید.']);
        }

        // دریافت quiz_id از درخواست
        $quizId = $request->input('quiz_id');

        // بررسی وجود quiz_id
        if (!$quizId) {
            return back()->withErrors(['error' => 'آیدی کوییز معتبر نیست.']);
        }

        // حذف پاسخ‌های قبلی کاربر برای همین آزمون
        AllAnswer::where('user_id', $userId)->where('quiz_id', $quizId)->delete();

        // ذخیره پاسخ‌های جدید به همراه quiz_id
        foreach ($request->answers as $questionId => $answerValue) {
            $question = AllQuestion::find($questionId);

            // بررسی وجود سوال با شناسه مشخص
            if (!$question) {
                return back()->withErrors(['error' => "سوال با ID $questionId یافت نشد!"]);
            }

            // ذخیره پاسخ‌ها در پایگاه داده
            AllAnswer::create([
                'user_id'      => $userId,
                'section'      => $question->section,
                'question_id'  => $questionId,
                'answer_value' => $answerValue,
                'quiz_id'      => $quizId,  // اضافه کردن quiz_id
            ]);
        }

        // هدایت به صفحه نتایج آزمون
        return redirect()->route('quiz.results')->with('success', 'پاسخ‌ها با موفقیت ثبت شدند.');
    }

    // نمایش لیست آزمون‌هایی که کاربر انجام داده است
    public function showUserQuizzes(Request $request)
    {
        $userId = auth()->id(); // دریافت شناسه کاربر فعلی
    
        // دریافت لیست آزمون‌هایی که کاربر انجام داده است
        $quizzes = DB::table('all_answers')
            ->where('user_id', $userId)
            ->select('quiz_id', DB::raw('MAX(created_at) as taken_at'))
            ->groupBy('quiz_id')
            ->orderByDesc('taken_at') // مرتب‌سازی بر اساس آخرین تاریخ انجام آزمون
            ->get();
    
        // ارسال داده‌ها به ویو برای نمایش
        return view('user.quizzes', compact('quizzes'));
    }

    // تحلیل نتایج آزمون و نمایش تفسیر
    public function showInterpretation(Request $request)
    {
        $userId = auth()->id(); // شناسه کاربر فعلی
        $quizId = $request->quiz_id; // دریافت quiz_id از درخواست

        // دریافت پاسخ‌های مربوط به این آزمون
        $answers = DB::table('all_answers')
            ->where('user_id', $userId)
            ->where('quiz_id', $quizId)
            ->get();

        // ساختاردهی نتایج
        $results = [];

        foreach ($answers as $answer) {
            $section = $answer->section;
            $value = $answer->answer_value;

            // در صورتی که بخش جدید باشد، آن را مقداردهی اولیه می‌کنیم
            if (!isset($results[$section])) {
                $results[$section] = [
                    'score' => 0,
                    'count' => 0,
                    'interpretation' => '', // می‌توان تفسیر را از یک منبع خارجی دریافت کرد
                    'suggestions' => [],    // پیشنهادات نیز به همین شکل
                ];
            }

            // افزودن امتیاز به مجموع
            $results[$section]['score'] += $value;
            $results[$section]['count'] += 1;
        }

        // محاسبه میانگین امتیاز و افزودن تفسیر و پیشنهادات
        foreach ($results as $section => &$data) {
            $data['score'] = round($data['score'] / $data['count'], 1); // محاسبه میانگین
            $data['interpretation'] = getInterpretation($section, $data['score']);
            $data['suggestions'] = getSuggestions($section, $data['score']);
        }

        // ارسال نتایج به ویو برای نمایش تفسیر
        return view('exams.interpretation', compact('results'));
    }

    // نمایش نتایج آزمون
    public function showResults()
    {
        $userId = Auth::id(); // دریافت شناسه کاربر فعلی
        $answers = AllAnswer::where('user_id', $userId)->get(); // دریافت تمامی پاسخ‌ها

        $results = [];
    
        // محاسبه امتیاز در هر بخش
        foreach ($answers as $answer) {
            $section = $answer->section;
            if (!isset($results[$section])) {
                $results[$section] = ['score' => 0];
            }
            $results[$section]['score'] += $answer->answer_value; // افزودن امتیاز به بخش مربوطه
        }
    
        // تحلیل نتایج
        foreach ($results as $section => &$data) {
            $score = $data['score'];
    
            // تعیین سطح بر اساس امتیاز
            if ($score >= 17) {
                $level = 'high';
            } elseif ($score >= 12) {
                $level = 'medium';
            } else {
                $level = 'low';
            }
    
            // دریافت تفسیر و پیشنهادات از مدل TalentInsight
            $insight = TalentInsight::where('section', $section)
                                    ->where('level', $level)
                                    ->first();
    
            $data['level'] = $level;
            $data['interpretation'] = $insight ? $insight->interpretation : 'تفسیر یافت نشد.';
            $data['suggestions'] = [];
    
            // اگر پیشنهاداتی موجود باشد، آنها را پردازش می‌کنیم
            if ($insight && !empty($insight->suggestions)) {
                $lines = preg_split('/\r\n|\r|\n/', trim($insight->suggestions));
                $data['suggestions'] = array_filter($lines, fn($line) => !empty(trim($line)));
            }
        }

        // دریافت آخرین کوییز برای نمایش در نتایج
        $quiz = Quiz::latest()->first(); 

        // ارسال نتایج و اطلاعات آزمون به ویو
        return view('quiz.results', compact('results', 'quiz'));
    }
   public function showResults2()
{
    $userId = Auth::id(); // دریافت شناسه کاربر فعلی
    $answers = AllAnswer::where('user_id', $userId)->get(); // دریافت تمامی پاسخ‌ها

    $results = [];
    
    // محاسبه امتیاز در هر بخش
    foreach ($answers as $answer) {
        $section = $answer->section;
        if (!isset($results[$section])) {
            $results[$section] = ['score' => 0];
        }
        $results[$section]['score'] += $answer->answer_value; // افزودن امتیاز به بخش مربوطه
    }

    // تحلیل نتایج
    foreach ($results as $section => &$data) {
        $score = $data['score'];

        // تعیین سطح بر اساس امتیاز
        if ($score >= 17) {
            $level = 'high'; // سطح بالا
        } elseif ($score >= 12) {
            $level = 'medium'; // سطح متوسط
        } else {
            $level = 'low'; // سطح پایین
        }

        // دریافت تفسیر و پیشنهادات از مدل TalentInsight
        $insight = TalentInsight::where('section', $section)
                                ->where('level', $level)
                                ->first();

        $data['level'] = $level;
        $data['interpretation'] = $insight ? $insight->interpretation : 'تفسیر یافت نشد.';
        $data['suggestions'] = [];

        // اگر پیشنهاداتی موجود باشد، آنها را پردازش می‌کنیم
        if ($insight && !empty($insight->suggestions)) {
            // تقسیم پیشنهادات بر اساس خطوط
            $lines = preg_split('/\r\n|\r|\n/', trim($insight->suggestions));
            $data['suggestions'] = array_filter($lines, fn($line) => !empty(trim($line)));
        }
    }

    // ارسال نتایج به ویو برای نمایش تفسیر
    return view('user.results', compact('results'));
}


}
