<?php

use App\Http\Controllers\AnimeController;

Route::apiResource('animes', AnimeController::class);
Route::post('animes/generate-sample', [AnimeController::class, 'generateSampleAnime']);