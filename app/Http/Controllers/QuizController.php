<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\QuizService;

class QuizController extends Controller
{
    protected QuizService $quizService;

    public function __construct(QuizService $quizService)
    {
        $this->quizService = $quizService;
    }

    /**
     * نمایش صفحه کوییز به همراه سوالات و گزینه‌ها
     */
    public function showQuiz()
    {
        $quiz = $this->quizService->getLatestQuiz();

        if (!$quiz) {
            return abort(404, 'کوییزی پیدا نشد.');
        }

        $questions = $this->quizService->getGroupedQuestions($quiz->id);

        return view('quiz.show', compact('quiz', 'questions'));
    }

    /**
     * ثبت پاسخ‌ها
     */
  public function submitAnswers(Request $request)
{
    $userId = Auth::id();

    // جمع آوری پاسخ‌ها به شکل question_*
    $answers = [];
  foreach ($request->all() as $key => $value) {
    if (str_starts_with($key, 'question_')) {
        $questionId = str_replace('question_', '', $key);
        $answers[$questionId] = $value;
    }
}

    if (empty($answers)) {
        return back()->withErrors(['error' => 'لطفاً حداقل به یک سوال پاسخ دهید.']);
    }

    $quizId = $request->input('quiz_id');
    if (!$quizId) {
        return back()->withErrors(['error' => 'آیدی کوییز معتبر نیست.']);
    }

    try {
        $this->quizService->saveAnswers($answers, $quizId, $userId);
    } catch (\Exception $e) {
        \Log::error("Error saving answers: " . $e->getMessage());
        return back()->withErrors(['error' => $e->getMessage()]);
    }

    // ریدایرکت با پاس دادن userId
return redirect()->route('quiz.results', ['userId' => $userId, 'quizId' => $quizId]);
}


    /**
     * نمایش کوییزهای گرفته شده توسط کاربر
     */
    public function showUserQuizzes()
    {
        $userId = Auth::id();
        $quizzes = $this->quizService->getUserQuizzes($userId);

        return view('user.quizzes', compact('quizzes'));
    }

    /**
     * نمایش نتایج کوییز اخیر کاربر
     */
   
public function showResults($userId, $quizId)
{
    $results = $this->quizService->getQuizResults($userId, $quizId);
    $maxScores = $this->quizService->getMaxScoresBySection($quizId);
    
    // گرفتن مدل کوییز از دیتابیس
    $quiz = \App\Models\Quiz::find($quizId);

    $desResults = $quiz ? $quiz->des_results : null;

    return view('quiz.results', [
        'results' => $results,
        'desResults' => $desResults, // مقدار صحیح داده می‌شود
        'maxScores' => $maxScores,
        'userId' => $userId,
        'quizId' => $quizId,
    ]);
}





    /**
     * نمایش نتایج کوییز (نمایش متفاوت)
     */
 public function showResults2($quizId)
{
    $userId = Auth::id();
    $results = $this->quizService->getQuizResults($userId, $quizId);
    return view('user.results', compact('results'));
}

}
