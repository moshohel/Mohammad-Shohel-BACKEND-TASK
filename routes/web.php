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

// Blog Routes
Route::prefix('blog')->group(function(){
    Route::get('/', [App\Http\Controllers\BlogController::class, 'index']);
    Route::get('/create', [App\Http\Controllers\BlogController::class, 'create']);
    Route::post('/store', [App\Http\Controllers\BlogController::class, 'store'])->name('blog.store');
    Route::post('/update/(id)', [App\Http\Controllers\BlogController::class, 'update']);
    Route::get('/getToken', [App\Http\Controllers\BlogController::class, 'getToken']);
});

// Tag Routes
Route::prefix('tag')->group(function () {
    Route::get('/', [App\Http\Controllers\TagController::class, 'index']);
    Route::post('/store', [App\Http\Controllers\TagController::class, 'store'])->name('tag.store');

    Route::get('/getToken', [App\Http\Controllers\TagController::class, 'getToken']);
});

Auth::routes();
Route::get('/getToken', [App\Http\Controllers\Auth\LoginController::class, 'getToken']);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
