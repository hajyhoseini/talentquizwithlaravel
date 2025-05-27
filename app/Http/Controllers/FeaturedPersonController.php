<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FeaturedPerson;

class FeaturedPersonController extends Controller
{
    // دریافت افراد برجسته مربوط به یک آزمون خاص
    public function getByQuiz($quizId)
    {
        $people = FeaturedPerson::where('quiz_id', $quizId)->get();

        return response()->json([
            'data' => $people,
        ]);
    }
}
