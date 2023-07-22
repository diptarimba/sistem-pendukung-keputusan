<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SymptomController;
use App\Http\Controllers\ConditionController;
use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KnowledgeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

// Delimiter //
// Generated routes

Route::get('/auth/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/auth/login', [LoginController::class, 'login'])->name('login.post');

Route::group(['middleware' => ['auth:web']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::get('/me', [ProfileController::class, 'edit'])->name('profile.index');

    Route::resource('user', UserController::class);
    Route::resource('symptom', SymptomController::class);
    Route::resource('condition', ConditionController::class);
    Route::resource('disease', DiseaseController::class);
    Route::resource('knowledge', KnowledgeController::class);
    Route::resource('result', ResultController::class);
    Route::resource('post', PostController::class);

    Route::get('/auth/logout', [LoginController::class, 'logout'])->name('logout.index');
});
