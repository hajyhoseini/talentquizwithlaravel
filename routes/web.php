<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizBuilderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

    use App\Http\Controllers\ExamController;

    Route::middleware(['auth'])->group(function () {
        Route::get('/exams/{id}', [ExamController::class, 'show'])->name('exams.show');
        Route::get('/exams', [ExamController::class, 'index'])->name('exams.index');
        Route::get('/exams/start/{id}', [ExamController::class, 'start'])->name('exams.start');
    });

    use App\Http\Controllers\QuizController;

    Route::get('/quiz', [QuizController::class, 'showQuiz'])->name('quiz.show');
    Route::post('/quiz', [QuizController::class, 'submitAnswers'])->name('quiz.submit');
    Route::get('/quiz/results', [QuizController::class, 'showResults'])->name('quiz.results');

    use App\Http\Controllers\MbtiQuizController;

    Route::get('/mbti-quiz', [MbtiQuizController::class, 'show'])->name('mbti.quiz');

Route::get('/mbti-quiz/start', [MBTIQuizController::class, 'start'])->name('quiz.start');
Route::get('/mbti-quiz/questions', [MBTIQuizController::class, 'showQuestions'])->name('mbti.questions');
Route::post('/mbti-quiz/submit', [MBTIQuizController::class, 'submit'])->name('mbti.submit');
Route::post('/mbti-quiz/submit', [MbtiQuizController::class, 'storeAnswers'])->name('mbti.submit');

Route::post('/mbti-quiz/answers', [MBTIQuizController::class, 'storeAnswers'])->name('mbti.storeAnswers');
// در فایل routes/web.php

Route::get('/mbti-quiz/results', [MBTIQuizController::class, 'showResults'])->name('mbti.results');

Route::get('/mbti-quiz/start', [MBTIQuizController::class, 'showQuestions'])->name('quiz.start');


// نمایش فرم ساخت آزمون مرحله‌ای
Route::get('/quiz-builder', function () {
    return view('quiz-builder');
})->name('quiz.builder');





Route::get('/test', [MBTIQuizController::class, 'test'])->name('test');
Route::get('/test2', [MBTIQuizController::class, 'test2'])->name('test2');
Route::get('/exams/{id}/interpretation', [ExamController::class, 'interpretation'])->name('exams.interpretation');

use App\Http\Controllers\ProfileController;

Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});
Route::middleware(['auth'])->get('/completed-tests', [ExamController::class, 'completedExams'])->name('exams.completed');



Route::get('/user/results', [QuizController::class, 'showResults2'])->name('user.results');

