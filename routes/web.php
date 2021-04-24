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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [App\Http\Controllers\BlogController::class, 'index']);

// Tag Routes
Route::prefix('tag')->group(function () {
    Route::get('/', [App\Http\Controllers\TagController::class, 'index']);
    Route::post('/store', [App\Http\Controllers\TagController::class, 'store'])->name('tag.store');
    Route::get('/getToken', [App\Http\Controllers\TagController::class, 'getToken']);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
