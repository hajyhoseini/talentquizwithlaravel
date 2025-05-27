<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AllAnswer;
use App\Models\Quiz;
use App\Models\QuizColumn;

class AdminResultController extends Controller
{
    // نمایش لیست کاربران آزمون‌داده
    public function index()
    {
        $users = User::whereHas('answers')->with(['answers' => function ($query) {
            $query->select('id', 'user_id', 'quiz_id', 'created_at')->distinct();
        }])->get();

        return view('admin.results.index', compact('users'));
    }

    // نمایش نتایج یک کاربر خاص
public function show($userId, $quizId)
{
    $quizService = app(\App\Services\QuizService::class);

    $user = User::findOrFail($userId);
    $quiz = $quizService->getQuizById($quizId);
$desResults = $quiz ? $quiz->des_results : 'توضیحی برای آزمون یافت نشد.';

    $results = $quizService->getQuizResults($userId, $quizId); // این خروجی آنالیز شده است (score و تفسیر و ...)

    $maxScores = $quizService->getMaxScoresBySection($quizId);

    return view('quiz.results', compact(
        'user',
        'quiz',
        'quizId',
        'userId',
        'results',
        'desResults',
        'maxScores'
    ));
}

}
