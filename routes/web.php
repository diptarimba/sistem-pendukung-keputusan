<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SymptomController;
use App\Http\Controllers\ConditionController;
use App\Http\Controllers\DiagnoseController;
use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KnowledgeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SymptomCategoryController;
use App\Http\Controllers\UserController;
use App\Models\SymptomCategory;

// Delimiter //
// Generated routes

Route::get('/auth/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/auth/login', [LoginController::class, 'login'])->name('login.post');


Route::group(['as' => 'guest.'],function () {
    Route::get('/', [HomeController::class, 'index_guest'])->name('home.index');

    Route::get('/diagnose', [DiagnoseController::class, 'create'])->name('diagnose.create');
    Route::post('/diagnose', [DiagnoseController::class, 'execDiagnose'])->name('diagnose.post');

    Route::resource('symptom', SymptomController::class)->only(['index']);
    Route::resource('category', SymptomCategoryController::class)->only(['index']);
    Route::resource('condition', ConditionController::class)->only(['index']);
    Route::resource('disease', DiseaseController::class)->only(['index']);
    Route::resource('knowledge', KnowledgeController::class)->only(['index']);
    Route::resource('result', ResultController::class)->only(['index', 'edit']);
    Route::resource('post', PostController::class)->only(['index', 'edit']);
});

Route::group(['middleware' => ['auth:web'], 'prefix' => 'admin'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::get('/me', [ProfileController::class, 'edit'])->name('profile.index');

    Route::resource('user', UserController::class);
    Route::resource('symptom', SymptomController::class);
    Route::resource('category', SymptomController::class);
    Route::resource('condition', ConditionController::class);
    Route::resource('disease', DiseaseController::class);
    Route::resource('knowledge', KnowledgeController::class);
    Route::resource('result', ResultController::class);
    Route::resource('post', PostController::class);

    Route::get('/auth/logout', [LoginController::class, 'logout'])->name('logout.index');
});
