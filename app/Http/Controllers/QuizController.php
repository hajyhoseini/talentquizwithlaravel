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
    $data = $request->all();

    // گرفتن quiz_id
    $quizId = $data['quiz_id'];
    $userId = auth()->id(); // یا هر روش گرفتن یوزر

    // آماده کردن آرایه پاسخ‌ها
    $answers = [];

    foreach ($data as $key => $value) {
        if (str_starts_with($key, 'question_')) {
            $questionId = intval(str_replace('question_', '', $key));
            $answers[$questionId] = $value;
        }
    }

    // دیباگ جواب‌ها
    // dd($answers);

    // ذخیره پاسخ‌ها
    app(\App\Services\QuizService::class)->saveAnswers($answers, $quizId, $userId);

return redirect()->route('quiz.results', ['userId' => $userId, 'quizId' => $quizId])
                 ->with('success', 'پاسخ‌ها ثبت شدند');
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
    $user = \App\Models\User::findOrFail($userId);

    $results = $this->quizService->getQuizResults($userId, $quizId);
    $maxScores = $this->quizService->getMaxScoresBySection($quizId);

    $quiz = \App\Models\Quiz::find($quizId);
    $desResults = $quiz ? $quiz->des_results : null;

    // گرفتن ستون‌ها و کلیدگذاری روی نام ستون (column_name)
    $columns = \App\Models\QuizColumn::where('quiz_id', $quizId)->get()->keyBy('column_name');

    // اضافه کردن توضیحات هر بخش به نتایج
    foreach ($results as $section => &$data) {
        $data['description'] = $columns[$section]->talent_description ?? null;
    }
    unset($data); // جلوگیری از مرجع باقی‌مانده

    // واکشی سطح‌بندی نتایج
    $resultLevels = \App\Models\QuizResultLevel::where('quiz_id', $quizId)
                        ->orderBy('min_score', 'desc')
                        ->get();

    // واکشی افراد برجسته مرتبط با این آزمون
    $featuredPeople = \App\Models\FeaturedPerson::where('quiz_id', $quizId)->get();

    return view('quiz.results', [
        'user' => $user,
        'results' => $results,
        'desResults' => $desResults,
        'maxScores' => $maxScores,
        'userId' => $userId,
        'quizId' => $quizId,
        'resultLevels' => $resultLevels,
        'columns' => $columns,
    'featuredPeople' => $featuredPeople, // ✅ این خط مهمه
    ]);
}






    /**
     * نمایش نتایج کوییز (نمایش متفاوت)
     */
public function showResults2($quizId)
{
    $userId = Auth::id(); // گرفتن آیدی از کاربر لاگین‌شده
    $results = $this->quizService->getQuizResults((int)$userId, (int)$quizId);

    // واکشی افراد برجسته مرتبط با این آزمون
    $featuredPeople = \App\Models\FeaturedPerson::where('quiz_id', $quizId)->get();

    return view('user.results', [
        'results' => $results,
        'featuredPeople' => $featuredPeople, // ✅ اضافه شد
    ]);
}



}
