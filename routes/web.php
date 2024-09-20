<?php

use App\Http\Controllers\PollingController;
use Illuminate\Support\Facades\Route;


Route::get('/', [PollingController::class, 'welcome'])->name('welcome');
Route::get('/create-survey', [PollingController::class, 'create'])->name('poll.create');
Route::post('/store-survey', [PollingController::class, 'store'])->name('poll.store');
Route::get('/take-survey/{filename}', [PollingController::class, 'take'])->name('poll.take');
Route::post('/submit-survey/{filename}', [PollingController::class, 'submit'])->name('poll.submit');
Route::get('/submitted-surveys', [PollingController::class, 'submittedSurveys'])->name('poll.submitted');