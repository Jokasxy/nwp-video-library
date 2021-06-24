<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\DirectorController;

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
