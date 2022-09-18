<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
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

// logout
Route::get('/logout', function () {
    Auth::logout();
    return redirect(route('login'));
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



// comments
Route::name('comment.')->middleware(['auth'])->prefix('/comments')->group(function () {
    Route::post('/', [CommentController::class])->name('new');
    Route::delete('/{comment}', [CommentController::class])->name('remove');
});


Route::name('post.')->middleware(['auth'])->prefix('/posts')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::post('/', [PostController::class, 'store'])->name('store');
});
