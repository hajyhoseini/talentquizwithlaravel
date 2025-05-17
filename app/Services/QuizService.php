<?php
namespace App\Services;

use App\Models\AllAnswer;
use App\Models\AllQuestion;
use App\Models\Quiz;
use App\Models\TalentInsight;
use Illuminate\Support\Facades\DB;

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
   public function getQuizResults(int $userId, int $quizId)
{
    $answers = AllAnswer::where('user_id', $userId)
                        ->where('quiz_id', $quizId)
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

    return $results;
}

}
