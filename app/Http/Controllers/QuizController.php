<?php

namespace App\Http\Controllers;

use App\Models\AllQuestion;
use App\Models\AllAnswer;
use App\Models\TalentInsight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function showQuiz()
    {
        $questions = AllQuestion::all()->groupBy('section');
        return view('quiz.show', compact('questions'));
    }

    public function submitAnswers(Request $request)
    {
        $userId = Auth::id();

        if (!$request->has('answers') || empty($request->answers)) {
            return back()->withErrors(['error' => 'لطفاً حداقل به یک سوال پاسخ دهید.']);
        }

        AllAnswer::where('user_id', $userId)->delete();

        foreach ($request->answers as $questionId => $answerValue) {
            $question = AllQuestion::find($questionId);

            if (!$question) {
                return back()->withErrors(['error' => "سوال با ID $questionId یافت نشد!"]);
            }

            AllAnswer::create([
                'user_id'      => $userId,
                'section'      => $question->section,
                'question_id'  => $questionId,
                'answer_value' => $answerValue,
            ]);
        }

        return redirect()->route('quiz.results')->with('success', 'پاسخ‌ها با موفقیت ثبت شدند.');
    }

    public function showResults()
    {
        $userId = Auth::id();
        $answers = AllAnswer::where('user_id', $userId)->get();

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

            $data['level'] = $level; // 👈 این خط رو حتی اگه insight پیدا نشد باید ست کنی

            if ($insight) {
                $data['interpretation'] = $insight->interpretation ?? 'تفسیر یافت نشد.';
                $data['suggestions'] = [];

                if (!empty($insight->suggestions)) {
                    $lines = preg_split('/\r\n|\r|\n/', trim($insight->suggestions));
                    $data['suggestions'] = array_filter($lines, fn($line) => !empty(trim($line)));
                }
                
            } else {
                $data['interpretation'] = 'تفسیر یافت نشد.';
                $data['suggestions'] = [];
            }
        }
       ;

        return view('quiz.results', compact('results'));
    }
}
