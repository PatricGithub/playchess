<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\ChessExperiment;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\InformedConsentController;
use App\Http\Controllers\ChessExperimentController;
use App\Http\Controllers\ImageRatingController; 
use App\Models\Image;
use App\Models\Judge;



Route::get('/', function () {
    Judge::where('taken', 1)->update(['taken' => 0]);
    Image::where('taken', 1)->update(['taken' => 0]);
    return view('welcome');
});

Route::get('/informed-consent', [InformedConsentController::class, 'show']);
Route::get('/entry-survey', [SurveyController::class, 'show']);
Route::get('/einleitung', [ChessExperimentController::class, 'einleitung'])->name('einleitung');
Route::get('/puzzle-1', [ChessExperimentController::class, 'puzzle_1'])->name('puzzle_1');
Route::post('/post-puzzle-1', [ChessExperimentController::class, 'puzzle_1_post']);
Route::get('/puzzle-2', [ChessExperimentController::class, 'puzzle_2'])->name('puzzle_2');
Route::post('/post-puzzle-2', [ChessExperimentController::class, 'puzzle_2_post']);
Route::get('/puzzle-3', [ChessExperimentController::class, 'puzzle_3'])->name('puzzle_3');
Route::post('/post-puzzle-3', [ChessExperimentController::class, 'puzzle_3_post']);
Route::get('/einleitung-2', [ChessExperimentController::class, 'einleitung_2'])->name('einleitung_2');
Route::get('/einleitung-3', [ChessExperimentController::class, 'einleitung_3'])->name('einleitung_3');
Route::get('/rate-images/{image_number}', [ImageRatingController::class, 'showRatingForm'])->name('rate.images');
Route::post('/rate-images/{image_number}', [ImageRatingController::class, 'storeRating'])->name('rate.images.store');
Route::get('/einleitung-4', [ChessExperimentController::class, 'einleitung_4'])->name('einleitung_4');
Route::get('/condition', [ChessExperimentController::class, 'condition'])->name('condition');
Route::get('/chess-experiment-new/{nextimg}', [ChessExperimentController::class, 'chess_experiment'])->name('chess_experiment2');
Route::post('/submit-chess-experiment', [ChessExperimentController::class, 'submitChessExperiment'])->name('submit-chess-experiment');
Route::get('/exit-survey', [SurveyController::class, 'exit_survey'])->name('exit_survey');
Route::get('/thank-you', [SurveyController::class, 'thanks'])->name('thanks');
