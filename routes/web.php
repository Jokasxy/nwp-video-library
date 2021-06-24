<?php

use Illuminate\Support\Facades\Route;

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



Route::get('/directors', [App\Http\Controllers\DirectorController::class, 'index'])->name('directors');
Route::get('/directors/show/{id}', [App\Http\Controllers\DirectorController::class, 'index'])->name('directors');

Route::group(['prefix' => 'directors', 'middleware' => '[can:modify]', 'as' => 'directors.'], function () {
    Route::get('/create', [\App\Http\Controllers\DirectorController::class, 'create']);
    Route::post('/store', [\App\Http\Controllers\DirectorController::class, 'store']);
    Route::get('/edit/{id}', [\App\Http\Controllers\DirectorController::class, 'update']);
    Route::put('/update/{id}', [\App\Http\Controllers\DirectorController::class, 'edit']);
    Route::delete('/destroy/{id}', [\App\Http\Controllers\DirectorController::class, 'destroy']);
});
