<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SymptomController;
use App\Http\Controllers\ConditionController;
use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\KnowledgeController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\PostController;

// Delimiter //
// Generated routes
Route::resource('symptom', SymptomController::class);
Route::resource('condition', ConditionController::class);
Route::resource('disease', DiseaseController::class);
Route::resource('knowledge', KnowledgeController::class);
Route::resource('result', ResultController::class);
Route::resource('post', PostController::class);
