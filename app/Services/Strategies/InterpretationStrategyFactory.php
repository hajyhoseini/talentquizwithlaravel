<?php
namespace App\Services\Strategies;

class InterpretationStrategyFactory
{
    public static function make(int $quizId): InterpretationStrategyInterface
    {
        $map = [
            1 => DefaultInterpretationStrategy::class,
            2 =>Quiz2InterpretationStrategy ::class,
            // اگر کوییزهای دیگه‌ای هست اینجا اضافه کن
        ];

        if (!isset($map[$quizId])) {
            return new DefaultInterpretationStrategy(); // استراتژی پیش‌فرض
        }

        $strategyClass = $map[$quizId];
        return new $strategyClass();
    }
}
