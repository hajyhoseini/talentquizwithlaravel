<?php
namespace App\Http\Controllers;
use App\Models\Question;

use Illuminate\Http\Request;
use App\Models\Answer;
use Illuminate\Support\Facades\Auth;


class QuizController extends Controller
{
   

    public function index() {
        $questions = Question::all();
        dd($questions); // این خط اطلاعات رو نمایش میده
    }
    
    public function showQuiz()
    {
        $questions = Question::all()->groupBy('section'); // گروه‌بندی بر اساس بخش
    
        return view('quiz.show', compact('questions'));
    }
    

    public function submitAnswers(Request $request)
    {
        $userId = Auth::id();
    
        if (!$request->has('answers') || empty($request->answers)) {
            return back()->withErrors(['error' => 'لطفاً حداقل به یک سوال پاسخ دهید.']);
        }
    
        // حذف پاسخ‌های قبلی
        Answer::where('user_id', $userId)->delete();
    
        // ذخیره پاسخ‌های جدید
        foreach ($request->answers as $questionId => $answerValue) {
            $question = Question::find($questionId);
    
            if (!$question) {
                return back()->withErrors(['error' => "سوال با ID $questionId یافت نشد!"]);
            }
    
            Answer::create([
                'user_id'      => $userId,
                'section'      => $question->section, // مقداردهی `section`
                'question_id'  => $questionId,
                'answer_value' => $answerValue,
            ]);
        }
    
        return redirect()->route('quiz.results')->with('success', 'پاسخ‌ها با موفقیت ثبت شدند.');
    }
    

    
    

    

    // متد نمایش نتایج
   // در کنترلر QuizController

   public function showResults()
   {
       // گرفتن پاسخ‌های کاربر جاری
       $answers = Answer::where('user_id', Auth::id())->get();
   
       // پردازش امتیازات برای هر بخش
       $results = [];
       foreach ($answers as $answer) {
           $section = $answer->section;
           if (!isset($results[$section])) {
               $results[$section] = ['score' => 0, 'result' => ''];
           }
           $results[$section]['score'] += $answer->answer_value;
       }
   
       // تعیین سطح استعداد بر اساس امتیاز
       foreach ($results as $section => &$data) {
           if ($data['score'] >= 17) {
               $data['result'] = "استعداد بالا";
           } elseif ($data['score'] >= 12) {
               $data['result'] = "استعداد متوسط، که با تقویت می‌تواند رشد کند";
           } else {
               $data['result'] = "استعداد کم، اما با تمرین می‌توان مهارت را بهبود بخشید";
           }
       }
   
       return view('quiz.results', compact('results'));
   }

}



