<?php
// app/Services/Strategies/InterpretationStrategyInterface.php

namespace App\Services\Strategies;

interface InterpretationStrategyInterface
{
    public function analyze(array $answers): array;
}
