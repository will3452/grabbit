<?php

use App\Http\Controllers\CommentController;
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

// logout
Route::get('/logout', function () {
    Auth::logout();
    return back();
});

// comments
Route::name('comment.')->middleware(['auth'])->prefix('/comments')->group(function () {
    Route::post('/', [CommentController::class])->name('new');
    Route::delete('/{comment}', [CommentController::class])->name('remove');
});
