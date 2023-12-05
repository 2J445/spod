<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController; //投稿機能
use App\Models\Post;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $posts = Post::orderBy('id', 'desc')->get();
    $user = Auth::user();
    return view('home', compact('posts', 'user'));
    //return view('welcome');
});

//Sass(デザイン)
URL::forceScheme('https');

//ユーザー
Auth::routes();
Route::get('/user/{id}/regulation', [App\Http\Controllers\UserController::class, 'regulation'])->name('user.regulation');
Route::post('/user/{id}/regulation', [App\Http\Controllers\UserController::class, 'regulation'])->name('user.regulation');
Route::get('/user/{id}/cancell_regulation', [App\Http\Controllers\UserController::class, 'cancell_regulation'])->name('user.cancell_regulation');
Route::post('/user/{id}/cancell_regulation', [App\Http\Controllers\UserController::class, 'cancell_regulation'])->name('user.cancell_regulation');
Route::resource('user', App\Http\Controllers\UserController::class);
Route::get('/users/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('user.show');
Route::get('/user/edit/{id}', [App\Http\Controllers\UserController::class, 'edit']); //ユーザー編集
Route::get('/user/destroy_confirm/{id}', [App\Http\Controllers\UserController::class, 'destroy_confirm']); //ユーザー退会
Route::post('/user/update/{id}', [App\Http\Controllers\UserController::class, 'update']); //ユーザーUPDATE

//サインアップ・ログイン後の遷移
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//お問い合わせフォーム
//入力ページ
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact.index');

//確認ページ
Route::post('/contact/confirm', [App\Http\Controllers\ContactController::class, 'confirm'])->name('contact.confirm');

//送信完了ページ
Route::post('/contact/thanks', [App\Http\Controllers\ContactController::class, 'send'])->name('contact.send');

//投稿
Route::resource('post', App\Http\Controllers\PostController::class);
//Route::get('/create', [App\Http\Controllers\PostController::class, 'create'])->name('post.create');
Route::post('/posts', [App\Http\Controllers\PostController::class, 'store'])->name('post.store');
Route::get('/posts/{id}', [App\Http\Controllers\PostController::class, 'show'])->name('post.show');
Route::get('/post/edit/{id}', [App\Http\Controllers\PostController::class, 'edit']); //配信編集
Route::post('/post/update/{id}', [App\Http\Controllers\PostController::class, 'update']); //配信UPDATE

//投稿を押した時
Route::post('/post', [App\Http\Controllers\PostController::class, 'store'])->name('post.store');

//チェッカー機能
Route::resource('check', App\Http\Controllers\CheckController::class);
Route::post('/checks', [App\Http\Controllers\CheckController::class, 'store'])->name('check.store');
Route::get('/checks/{id}', [App\Http\Controllers\CheckController::class, 'show'])->name('check.show');

// googleへのリダイレクト
Route::get('/auth/google', 'App\Http\Controllers\GoogleLoginController@redirectToGoogle');
// 認証後の処理
Route::get('/auth/google/callback', 'App\Http\Controllers\GoogleLoginController@handleGoogleCallback');
