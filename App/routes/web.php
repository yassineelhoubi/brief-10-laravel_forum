<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\DashboardController;

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

/* Route::get('/', function () {
    return view('welcome');
});
 */
Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');
Route::get('/dashboard' ,[DashboardController::class , 'index'] )->name('dashboard')->middleware('is_user');

/* POST */
Route::get('/posts' , [PostController::class , 'index'])->name('posts');
Route::post('/posts' , [PostController::class , 'store']);
Route::delete('/posts/{post}' , [PostController::class , 'destroy'])->name('posts.destroy');

Route::get('/posts/{post}' , [PostController::class , 'update'])->name('posts.update');
Route::post('/posts/edit' , [PostController::class , 'pushUpdate'])->name('posts.pushUpdate');

/* like unlike */
Route::post('/posts/{post}/likes' , [PostLikeController::class , 'store'])->name('posts.likes');
Route::delete('/posts/{post}/likes' , [PostLikeController::class , 'destroy'])->name('posts.likes');

/* comment */
Route::get('/posts/{post}/comment' , [CommentController::class , 'index'])->name('posts.comment');
Route::post('/posts/comment' , [CommentController::class , 'store'])->name('posts.makecomment');


/* Route::get('/posts', function(){
    return view('posts.index');
}); */