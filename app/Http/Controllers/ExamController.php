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
    

    public function completedExams()
    {
        // گرفتن اطلاعات تکمیل شده‌ی آزمون‌ها به همراه عنوان و تصویر
        $completedExams = AllAnswer::where('user_id', auth()->id())
                                    ->join('quizzes', 'quizzes.id', '=', 'all_answers.quiz_id')
                                    ->select('quizzes.id', 'quizzes.title', 'quizzes.image', 'all_answers.updated_at')
                                    ->orderBy('all_answers.updated_at', 'desc')
                                    ->first();
    
        // بررسی وجود داده‌ها و فرمت کردن تاریخ
        if ($completedExams && $completedExams->updated_at) {
            $dateTime = Carbon::parse($completedExams->updated_at)->subHour();
            $completedExams->formatted_date = Jalalian::fromCarbon($dateTime)->format('%Y/%m/%d - H:i');
        }
    
        // ارسال داده‌ها به ویو
        return view('completed_exams', compact('completedExams'));
    }
    
    
    public function showInterpretation($quiz_id, $user_id)
    {
        // اطمینان از اینکه کاربر فعلی به داده‌ها دسترسی دارد
        if (auth()->id() !== (int) $user_id) {
            abort(403, 'شما اجازه دسترسی به این صفحه را ندارید.');
        }
    
        // دریافت جواب‌های آزمون
        $answers = DB::table('all_answers')
            ->where('user_id', $user_id)
            ->where('quiz_id', $quiz_id)
            ->get();
    
        if ($answers->isEmpty()) {
            return redirect()->back()->with('error', 'نتیجه‌ای یافت نشد.');
        }
    
        // تحلیل نتایج
        $results = [];
    
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
    
        foreach ($results as $section => &$data) {
            $averageScore = $data['score'] / $data['count'];
            $data['score'] = round($averageScore, 2);
    
            $data['interpretation'] = $this->getInterpretation($section, $data['score']);
            $data['suggestions'] = $this->getSuggestions($section, $data['score']);
        }
    
        return view('exams.interpretation', compact('results'));
    }
    
    public function show($id)
    {
        // دریافت اطلاعات آزمون بر اساس ID
        $quiz = Quiz::findOrFail($id);
    
        // دریافت سوالات مربوط به این آزمون
        $questions = DB::table('all_questions')
                       ->where('quiz_id', $quiz->id)
                       ->get();
    
        // ارسال اطلاعات به ویو با نام درست متغیر
        return view('quiz.show', compact('quiz', 'questions'));
    }
    
    

    public function index()
    {
        // اگر قصد دارید لیستی از آزمون‌ها رو ارسال کنید:
        $exams = Quiz::all();
        
        // بارگذاری ویو و ارسال داده‌ها
        return view('exams.index', compact('exams'));
    }

    public function interpretation($id)
    {
        $quiz = Quiz::findOrFail($id);
        $userId = Auth::id();
    
        $answers = AllAnswer::where('user_id', $userId)
        ->where('quiz_id', $quiz->id)
        ->get();

        $results = [];
    
        foreach ($answers as $answer) {
            $section = $answer->section;
            if (!isset($results[$section])) {
                $results[$section] = ['score' => 0];
            }
            $results[$section]['score'] += $answer->answer_value;
        }
    
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
    
        return view('exams.interpretation', compact('quiz', 'results'));
    }
    


    public function start($id)
    {
        return view('exams.start', compact('id'));
    }
    
}

