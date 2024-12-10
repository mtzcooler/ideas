<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::group(['prefix' => 'ideas/', 'as' => 'ideas.'], function () {
    Route::get('/{idea}', [IdeaController::class, 'show'])->name('show')->middleware(['throttle:global']);

    Route::middleware(['auth', 'throttle:api'])->group(function () {
        Route::get('/{idea}/edit', [IdeaController::class, 'edit'])->name('edit')->middleware(['throttle:global']);
        Route::post('', [IdeaController::class, 'store'])->name('store');
        Route::put('/{idea}', [IdeaController::class, 'update'])->name('update');
        Route::post('/{idea}', [IdeaController::class, 'destroy'])->name('destroy');

        Route::post('/{idea}/comments', [CommentController::class, 'store'])->name('comments.store');

        Route::post('/{idea}/like', [IdeaController::class, 'like'])->middleware('auth')->name('like');
        Route::post('/{idea}/unlike', [IdeaController::class, 'unlike'])->middleware('auth')->name('unlike');
    });
});

/* Alternative to automatically define default routes */
//Route::resource('ideas', IdeaController::class)->except(['index', 'create']);
//Route::resource('ideas.comments', CommentController::class)->only(['store'])

Route::group([], function () {
    Route::get('/register', [AuthController::class, 'index'])->name('register');
    Route::post('/register', [AuthController::class, 'store']);

    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->middleware('throttle:login');;
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/profile', [AuthController::class, 'profile'])->middleware('auth')->name('profile');
});

// Route::group(['prefix' => 'ideas/', 'as' => 'ideas.'], function () {
Route::resource('users', UserController::class)->only(['show', 'edit', 'update'])->middleware('auth');
Route::post('users/{user}/follow', [UserController::class, 'follow'])->middleware('auth')->name('users.follow');
Route::post('users/{user}/unfollow', [UserController::class, 'unfollow'])->middleware('auth')->name('users.unfollow');

Route::get('/terms', function () {
    return view('terms');
});
