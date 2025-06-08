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

    // ✅ واکشی کتاب‌های پیشنهادی مرتبط با این آزمون
    $featuredBooks = \App\Models\FeaturedBook::where('quiz_id', $quizId)->get();

    return view('quiz.results', [
        'user' => $user,
        'results' => $results,
        'desResults' => $desResults,
        'maxScores' => $maxScores,
        'userId' => $userId,
        'quizId' => $quizId,
        'resultLevels' => $resultLevels,
        'columns' => $columns,
        'featuredPeople' => $featuredPeople,
        'featuredBooks' => $featuredBooks, // ✅ اضافه به ویو
    ]);
}







    /**
     * نمایش نتایج کوییز (نمایش متفاوت)
     */
public function showResults2($userId, $quizId)
{
    $results = $this->quizService->getQuizResults((int)$userId, (int)$quizId);

    // گرفتن توضیحات استعداد برای هر ستون
    $columns = \App\Models\QuizColumn::where('quiz_id', $quizId)->get()->keyBy('column_name');

    foreach ($results as $section => &$data) {
        $data['description'] = $columns[$section]->talent_description ?? null;
    }
    unset($data);

    // گرفتن همه افراد شاخص این آزمون و گروه‌بندی براساس استعداد
    $featuredPeople = \App\Models\FeaturedPerson::where('quiz_id', $quizId)->get();
$peopleGrouped = $featuredPeople->groupBy('related_talent');

    // گرفتن کتاب‌های شاخص این آزمون و گروه‌بندی براساس استعداد
    $featuredBooks = \App\Models\FeaturedBook::where('quiz_id', $quizId)->get();
    $booksGrouped = $featuredBooks->groupBy('general_talent');

    // گرفتن شغل‌های پیشنهادی و گروه‌بندی براساس استعداد
    $suggestedCareers = \App\Models\SuggestedCareer::where('quiz_id', $quizId)->get();
    $careersGrouped = $suggestedCareers->groupBy('talent_name');

    // ساخت آرایه خروجی براساس نام ستون‌های نتایج
    $featuredBySectionPeople = [];
    $featuredBySectionBooks = [];
    $featuredBySectionCareers = [];

    foreach ($results as $section => $data) {
        // افراد شاخص
        $people = $peopleGrouped->get($section, collect());
        $featuredBySectionPeople[$section] = $people->chunk(4);

        // کتاب‌ها
        $books = $booksGrouped->get($section, collect());
        $featuredBySectionBooks[$section] = $books->chunk(2);

        // شغل‌ها
        $careers = $careersGrouped->get($section, collect());
        $featuredBySectionCareers[$section] = $careers->chunk(6);
    }


    return view('user.results', [
        'results' => $results,
        'featuredPeople' => $featuredBySectionPeople,
        'featuredBooks' => $featuredBySectionBooks,
        'featuredCareers' => $featuredBySectionCareers,
    ]);
}






}
