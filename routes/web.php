<?php

use App\Models\Conversation;
use App\Models\Notification;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\MeetupController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReviewController;

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
    return redirect()->to('/home');
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
    Route::get('/create', [PostController::class, 'create'])->name('create');
    Route::get('/{post}', [PostController::class, 'show'])->name('show');
    Route::get('/edit/{post_id}', [PostController::class, 'edit'])->name('edit');
    Route::post('/delete', [PostController::class, 'destroy'])->name('destroy');
});

//like
Route::name('like.')->middleware(['auth'])->prefix('/like')->group(function () {
    Route::post('/', [LikeController::class, 'store'])->name('store');
});

//prorile
Route::name('profile.')->middleware(['auth'])->prefix('/profile')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    Route::get('/show/{user_id}', [ProfileController::class, 'show'])->name('show');
    Route::patch('/{user_id}', [ProfileController::class, 'update'])->name('update');
});
//notification
Route::name('notification.')->middleware(['auth'])->prefix('/notification')->group(function () {
    Route::get('/', [NotificationController::class, 'index'])->name('index');
    Route::get('/{notification}', [NotificationController::class, 'markAsRead'])->name('show');
});

//follow
Route::name('follow.')->middleware(['auth'])->prefix('/follows')->group(function () {
    Route::post('/', [FollowController::class, 'store'])->name('store');
});

Route::name('block.')->middleware(['auth'])->prefix('/blocks')->group(function () {
    Route::post('/', [BlockController::class, 'block'])->name('block');
    Route::get('/users', [BlockController::class, 'index'])->name('blockuserlist');
    Route::get('/users/{user_id}/update', [BlockController::class, 'edit'])->name('unblockuserform');
    Route::post('/users/destroy', [BlockController::class, 'destroy'])->name('destroy');
});
//meetup
Route::name('meetup.')->middleware(['auth'])->prefix('/meetup')->group(function () {
    Route::get('/create/{id_post}', [MeetupController::class, 'create'])->name('create');
    Route::get('/request-meetup', [MeetupController::class, 'showrequestmeetuplist'])->name('showrequestmeetuplist');
    Route::get('/requested-meetup', [MeetupController::class, 'showrequestedmeetuplist'])->name('showrequestedmeetuplist');
    Route::get('/request-meetup/{meetup_id}/process', [MeetupController::class, 'processmeetupview'])->name('processmeetupview');
    Route::post('/', [MeetupController::class, 'store'])->name('store');
    Route::post('/request-meetup', [MeetupController::class, 'processmeetup'])->name('processmeetup');
});


//messages / convo

Route::name('message.')->middleware(['auth'])->prefix('/convo')->group(function () {
    Route::get('/message/{read_by}', [ConversationController::class, 'index'])->name('index');
    Route::get('/', [ConversationController::class, 'conversations'])->name('conversations');
});

//report
Route::name('report.')->middleware(['auth'])->prefix('/report')->group(function () {
    Route::get('/{report_type}/{report_id}', [ReportController::class, 'index'])->name('index');
});

//search general
Route::name('src.')->middleware(['auth'])->prefix('/result')->group(function () {
    Route::get('/', [SearchController::class, 'index'])->name('index');
});

Route::prefix('review')->name('review.')->group(function () {
    Route::post('/', [ReviewController::class, 'store'])->name('store');
});

Route::get('register-success', function () {
    toast('Registered succesfully!');
    return view('register_success');
});
