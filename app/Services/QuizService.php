<?php
namespace App\Services;

use App\Models\AllAnswer;
use App\Models\AllQuestion;
use App\Models\Quiz;
use App\Models\TalentInsight;
use Illuminate\Support\Facades\DB;
use App\Services\Strategies\InterpretationStrategyInterface;
class QuizService
{
    /**
     * دریافت سوالات کوییز مشخص به همراه گزینه‌ها و گروه‌بندی بر اساس بخش (section)
     *
     * @param int|null $quizId
     * @return \Illuminate\Support\Collection
     */
public function getGroupedQuestions($quizId)
{
    // بارگذاری سوالات همراه با گزینه‌ها فقط برای کوییز مشخص
    $questions = AllQuestion::with('options')
        ->where('quiz_id', $quizId)
        ->orderBy('section')
        ->orderBy('id')
        ->get();

    return $questions->groupBy('section');
}



    /**
     * گرفتن جدیدترین کوییز
     *
     * @return Quiz|null
     */
    public function getLatestQuiz()
    {
        return Quiz::latest()->first();
    }

    /**
     * ذخیره پاسخ‌ها برای یک کوییز توسط کاربر
     *
     * @param array $answers  // [question_id => answer_value, ...]
     * @param int $quizId
     * @param int $userId
     *
     * @throws \Exception
     */
    public function saveAnswers(array $answers, int $quizId, int $userId)
    {
        // حذف پاسخ‌های قبلی کاربر برای این کوییز
        AllAnswer::where('user_id', $userId)
                 ->where('quiz_id', $quizId)
                 ->delete();

        foreach ($answers as $questionId => $answerValue) {
            $question = AllQuestion::find($questionId);

            if (!$question) {
                throw new \Exception("سوال با ID $questionId یافت نشد!");
            }

            AllAnswer::create([
                'user_id'      => $userId,
                'section'      => $question->section,
                'question_id'  => $questionId,
                'answer_value' => $answerValue,
                'quiz_id'      => $quizId,
            ]);
        }
    }

    /**
     * دریافت کوییزهای گرفته شده توسط کاربر به ترتیب جدیدترین
     *
     * @param int $userId
     * @return \Illuminate\Support\Collection
     */
    public function getUserQuizzes(int $userId)
    {
        return DB::table('all_answers')
            ->where('user_id', $userId)
            ->select('quiz_id', DB::raw('MAX(created_at) as taken_at'))
            ->groupBy('quiz_id')
            ->orderByDesc('taken_at')
            ->get();
    }

    /**
     * گرفتن نتایج کوییز برای یک کاربر شامل نمره، سطح و تفسیر
     *
     * @param int $userId
     * @return array
     */
  protected InterpretationStrategyInterface $strategy;

    public function __construct(InterpretationStrategyInterface $strategy)
    {
        $this->strategy = $strategy;
    }

    public function getQuizResults(int $userId, int $quizId): array
    {
        $answers = AllAnswer::where('user_id', $userId)
                            ->where('quiz_id', $quizId)
                            ->get()
                            ->all();

        return $this->strategy->analyze($answers);
    }

}
