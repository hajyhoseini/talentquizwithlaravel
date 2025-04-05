<?php

namespace App\Http\Controllers;
use App\Models\MbtiQuestion;
use Illuminate\Http\Request;
use App\Models\MbtiAnswer;
use Illuminate\Support\Facades\Auth;

class MbtiQuizController extends Controller
{
    public function show()
    {
        return view('exams.mbti'); // صفحه آزمون MBTI
    }
    public function showResults(Request $request)
    {
        // دریافت پاسخ‌های کاربر از دیتابیس
        $answers = MbtiAnswer::where('user_id', auth()->id())->get();
    
        // تعریف متغیرهای امتیاز
        $scoreE = $scoreI = $scoreS = $scoreN = $scoreT = $scoreF = $scoreJ = $scoreP = 0;
    
        foreach ($answers as $answer) {
            if ($answer->answer_value == 'yes') {
                if ($answer->section == 'شیوه تعامل با دنیا: برون‌گرایی (E) / درون‌گرایی (I)') $scoreE++;
                elseif ($answer->section == 'حسی (S) / شهودی (N)') $scoreS++;
                elseif ($answer->section == 'تفکری (T) / احساسی (F)') $scoreT++;
                elseif ($answer->section == 'قضاوتی (J) / ادراکی (P)') $scoreJ++;
            } else {
                if ($answer->section == 'شیوه تعامل با دنیا: برون‌گرایی (E) / درون‌گرایی (I)') $scoreI++;
                elseif ($answer->section == 'حسی (S) / شهودی (N)') $scoreN++;
                elseif ($answer->section == 'تفکری (T) / احساسی (F)') $scoreF++;
                elseif ($answer->section == 'قضاوتی (J) / ادراکی (P)') $scoreP++;
            }
        }
    
        // تعیین تیپ شخصیتی
        $result = [
            'E_I' => $scoreE > $scoreI ? 'برون‌گرا (E)' : 'درون‌گرا (I)',
            'S_N' => $scoreS > $scoreN ? 'حسی (S)' : 'شهودی (N)',
            'T_F' => $scoreT > $scoreF ? 'تفکری (T)' : 'احساسی (F)',
            'J_P' => $scoreJ > $scoreP ? 'قضاوتی (J)' : 'ادراکی (P)',
        ];
    
        return view('quiz.results_mbti', compact('result'));
    }
    public function start() {
        return view('quiz.mbti_questions'); // یا مسیر صحیح فایل بلید
    }
    
    public function questions()
{
    return view('quiz.mbti_questions');
}


public function showQuestions()
{
    $questions = MbtiQuestion::all(); // دریافت سوالات
    return view('quiz.mbti_questions', ['questions' => $questions]); // ارسال به ویو
}



public function storeAnswers(Request $request)
{
    // اعتبارسنجی پاسخ‌ها
    $request->validate([
        'answers' => 'required|array',
    ]);

    $userId = Auth::id(); // شناسه کاربر لاگین‌شده

    foreach ($request->input('answers') as $questionId => $answerValue) {
        $question = MbtiQuestion::find($questionId);

        if ($question) {
            MbtiAnswer::updateOrCreate(
                [
                    'user_id' => $userId,
                    'question_id' => $questionId,
                ],
                [
                    'section' => $question->section, // دریافت بخش سوال
                    'answer_value' => $answerValue,
                ]
            );
        }
    }

    return redirect()->route('mbti.results')->with('success', 'پاسخ‌های شما ذخیره شد!');
}
}

