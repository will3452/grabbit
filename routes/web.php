<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MeetupController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Models\Notification;
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
    Route::post('/', [CommentController::class, 'addComment'])->name('new');
    Route::delete('/{comment}', [CommentController::class, 'removeComment'])->name('remove');
});


Route::name('post.')->middleware(['auth'])->prefix('/posts')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::post('/', [PostController::class, 'store'])->name('store');
});

//like
Route::name('like.')->middleware(['auth'])->prefix('/like')->group(function () {
    Route::post('/', [LikeController::class, 'store'])->name('store');
});

//prorile
Route::name('profile.')->middleware(['auth'])->prefix('/profile')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    Route::patch('/{user_id}', [ProfileController::class, 'update'])->name('index');
});
//notification
Route::name('notification.')->middleware(['auth'])->prefix('/notification')->group(function () {
    Route::get('/', [NotificationController::class, 'index'])->name('index');
    Route::get('/{data}', [NotificationController::class, 'show'])->name('show');
});

//follow
Route::name('follow.')->middleware(['auth'])->prefix('/follows')->group(function () {
    Route::post('/', [FollowController::class, 'store'])->name('store');
});

//meetup
Route::name('meetup.')->middleware(['auth'])->prefix('/meetup')->group(function () {
    Route::get('/create/{id_post}', [MeetupController::class, 'create'])->name('create');
    Route::post('/', [MeetupController::class, 'store'])->name('store');
    Route::patch('/list/{meetup_id}', [MeetupController::class, 'process'])->name('process');
    Route::get('/request-meetup', [MeetupController::class, 'showrequestmeetuplist'])->name('showrequestmeetuplist');
    Route::get('/request-meetup/{meetup_id}/process', [MeetupController::class, 'processmeetupview'])->name('processmeetupview');
    Route::post('/request-meetup', [MeetupController::class, 'processmeetup'])->name('processmeetup');

});
