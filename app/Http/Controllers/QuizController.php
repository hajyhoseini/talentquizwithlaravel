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
    public function showQuiz()
    {
        // گرفتن سوالات و گروه‌بندی آنها بر اساس بخش
        $questions = AllQuestion::all()->groupBy('section');
        // گرفتن آخرین کوییز (می‌تونی این رو برای نمایش quiz_id استفاده کنی)
        $quiz = Quiz::latest()->first();

        return view('quiz.show', compact('questions', 'quiz'));
    }

    public function submitAnswers(Request $request)
    {
        $userId = Auth::id();

        // بررسی وجود پاسخ‌ها در فرم
        if (!$request->has('answers') || empty($request->answers)) {
            return back()->withErrors(['error' => 'لطفاً حداقل به یک سوال پاسخ دهید.']);
        }

        // دریافت quiz_id از درخواست (فرض می‌کنیم در فرم قرار داده شده باشد)
        $quizId = $request->input('quiz_id');

        // بررسی موجودیت quiz_id
        if (!$quizId) {
            return back()->withErrors(['error' => 'آیدی کوییز معتبر نیست.']);
        }

        // حذف پاسخ‌های قبلی کاربر
        AllAnswer::where('user_id', $userId)->where('quiz_id', $quizId)->delete();

        // ذخیره پاسخ‌های جدید
        foreach ($request->answers as $questionId => $answerValue) {
            $question = AllQuestion::find($questionId);

            if (!$question) {
                return back()->withErrors(['error' => "سوال با ID $questionId یافت نشد!"]);
            }

            // ذخیره پاسخ‌ها با اضافه کردن quiz_id
            AllAnswer::create([
                'user_id'      => $userId,
                'section'      => $question->section,
                'question_id'  => $questionId,
                'answer_value' => $answerValue,
                'quiz_id'      => $quizId,  // اضافه کردن quiz_id به پاسخ‌ها
            ]);
        }

        // هدایت به صفحه نتایج
        return redirect()->route('quiz.results')->with('success', 'پاسخ‌ها با موفقیت ثبت شدند.');
    }
    public function showUserQuizzes(Request $request)
    {
        $userId = auth()->id();
    
        // گرفتن لیست آزمون‌ها که کاربر انجام داده
        $quizzes = DB::table('all_answers')
            ->where('user_id', $userId)
            ->select('quiz_id', DB::raw('MAX(created_at) as taken_at'))
            ->groupBy('quiz_id')
            ->orderByDesc('taken_at')
            ->get();
    
        return view('user.quizzes', compact('quizzes'));
    }
    public function showInterpretation(Request $request)
{
    $userId = auth()->id();
    $quizId = $request->quiz_id;

    // دریافت پاسخ‌ها برای این آزمون
    $answers = DB::table('all_answers')
        ->where('user_id', $userId)
        ->where('quiz_id', $quizId)
        ->get();

    // تحلیل امتیازات و ساختاردهی داده‌ها
    $results = [];

    foreach ($answers as $answer) {
        $section = $answer->section;
        $value = $answer->answer_value;

        if (!isset($results[$section])) {
            $results[$section] = [
                'score' => 0,
                'count' => 0,
                'interpretation' => '', // می‌تونی اینو از جایی لود کنی
                'suggestions' => [],    // همینطور
            ];
        }

        $results[$section]['score'] += $value;
        $results[$section]['count'] += 1;
    }

    // محاسبه میانگین و افزودن تفسیر و پیشنهادات (اختیاری)
    foreach ($results as $section => &$data) {
        $data['score'] = round($data['score'] / $data['count'], 1);
        $data['interpretation'] = getInterpretation($section, $data['score']);
        $data['suggestions'] = getSuggestions($section, $data['score']);
    }

    return view('exams.interpretation', compact('results'));
}

    public function showResults()
    {
        $userId = Auth::id();
        $answers = AllAnswer::where('user_id', $userId)->get();
    
        $results = [];
    
        // محاسبه امتیاز در هر بخش
        foreach ($answers as $answer) {
            $section = $answer->section;
            if (!isset($results[$section])) {
                $results[$section] = ['score' => 0];
            }
            $results[$section]['score'] += $answer->answer_value;
        }
    
        // تحلیل نتایج
        foreach ($results as $section => &$data) {
            $score = $data['score'];
    
            if ($score >= 17) {
                $level = 'high';
            } elseif ($score >= 12) {
                $level = 'medium';
            } else {
                $level = 'low';
            }
    
            $insight = TalentInsight::where('section', $section)
                                    ->where('level', $level)
                                    ->first();
    
            $data['level'] = $level;
            $data['interpretation'] = $insight ? $insight->interpretation : 'تفسیر یافت نشد.';
            $data['suggestions'] = [];
    
            if ($insight && !empty($insight->suggestions)) {
                $lines = preg_split('/\r\n|\r|\n/', trim($insight->suggestions));
                $data['suggestions'] = array_filter($lines, fn($line) => !empty(trim($line)));
            }
        }

        // گرفتن آخرین کوییز برای نمایش در نتایج (این خط برای نمایش quiz_id است)
        $quiz = Quiz::latest()->first(); 

        return view('quiz.results', compact('results', 'quiz'));
    }
}
