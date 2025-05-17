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

