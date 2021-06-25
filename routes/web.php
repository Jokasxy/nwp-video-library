<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\StarController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => '/directors', 'middleware' => 'can:modify'], function () {
    Route::get('/create', [DirectorController::class, 'create'])->name('directors.create');
    Route::post('/store', [DirectorController::class, 'store'])->name('directors.store');
    Route::get('/edit/{director}', [DirectorController::class, 'edit'])->name('directors.edit');
    Route::put('/update/{director}', [DirectorController::class, 'update'])->name('directors.update');
    Route::delete('/destroy/{director}', [DirectorController::class, 'destroy'])->name('directors.destroy');
});

Route::get('/directors', [DirectorController::class, 'index'])->name('directors.index');
Route::get('/directors/{director}', [DirectorController::class, 'show'])->name('directors.show');

Route::group(['prefix' => '/genres', 'middleware' => 'can:modify'], function () {
    Route::get('/create', [GenreController::class, 'create'])->name('genres.create');
    Route::post('/store', [GenreController::class, 'store'])->name('genres.store');
    Route::get('/edit/{genre}', [GenreController::class, 'edit'])->name('genres.edit');
    Route::put('/update/{genre}', [GenreController::class, 'update'])->name('genres.update');
    Route::delete('/destroy/{genre}', [GenreController::class, 'destroy'])->name('genres.destroy');
});

Route::get('/genres', [GenreController::class, 'index'])->name('genres.index');
Route::get('/genres/{genre}', [GenreController::class, 'show'])->name('genres.show');

Route::group(['prefix' => '/stars', 'middleware' => 'can:modify'], function () {
    Route::get('/create', [StarController::class, 'create'])->name('stars.create');
    Route::post('/store', [StarController::class, 'store'])->name('stars.store');
    Route::get('/edit/{star}', [StarController::class, 'edit'])->name('stars.edit');
    Route::put('/update/{star}', [StarController::class, 'update'])->name('stars.update');
    Route::delete('/destroy/{star}', [StarController::class, 'destroy'])->name('stars.destroy');
});

Route::get('/stars', [StarController::class, 'index'])->name('stars.index');
Route::get('/stars/{star}', [StarController::class, 'show'])->name('stars.show');

Route::group(['prefix' => '/videos', 'middleware' => 'can:modify'], function () {
    Route::get('/create', [VideoController::class, 'create'])->name('videos.create');
    Route::post('/store', [VideoController::class, 'store'])->name('videos.store');
    Route::get('/edit/{video}', [VideoController::class, 'edit'])->name('videos.edit');
    Route::put('/update/{video}', [VideoController::class, 'update'])->name('videos.update');
    Route::delete('/destroy/{video}', [VideoController::class, 'destroy'])->name('videos.destroy');
});

Route::get('/videos', [VideoController::class, 'index'])->name('videos.index');
Route::get('/videos/{video}', [VideoController::class, 'show'])->name('videos.show');

Route::get('/profile', [UserController::class, 'profile'])->middleware('can:borrow')->name('users.profile');
