<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [QuestionController::class, 'allQuestions'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/dashboard', [QuestionController::class, 'allQuestions'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/start-test', [ProfileController::class, 'startTest'])->name('start.test');
Route::post('/update-score', [ProfileController::class, 'updateScore'])->name('update.score');

Route::get('/setup', function () {
    Artisan::call('exec', ['command' => 'npm run build']);
    Artisan::call('migrate');
    return "Setup completed successfully!";
});


require __DIR__.'/auth.php';
