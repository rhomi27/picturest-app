<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\CommentController;

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
Route::get('/', [ViewController::class, 'index']);
Route::middleware(['isTamu'])->group(function () {
    Route::get('/search', [ViewController::class, 'search'])->name('view.tamu');
    Route::get('/detail-tamu/{id}', [ViewController::class, 'detail'])->name('detail.tamu');
    Route::get('/comen-read-tamu/{id}', [CommentController::class, 'read']);
    Route::get('/search-tamu', [ViewController::class, 'searchImage'])->name('search.tamu');

    Route::post('/daftar', [AuthController::class, 'daftar'])->name('auth.daftar');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

});

Route::middleware(['isLogin','IsUser'])->group(function () {
    Route::get('/home', [PostController::class, 'index'])->name('view.post');
    Route::get('/albums', [AlbumController::class, 'index'])->name('view.album');
    Route::get('/detail-album/{id}', [AlbumController::class, 'albumDetail'])->name('detail.album');
    Route::get('/read-detail-album', [AlbumController::class,'readDetail'])->name('read.detail.album');
    Route::get('/read-album', [AlbumController::class, 'read'])->name('read.album');
    Route::get('/read-album-user/{id}', [AlbumController::class, 'albumUser'])->name('read.album.user');
    Route::get('/view-create', [PostController::class, 'create']);
    Route::get('/view-update/{id}', [PostController::class,'show']);
    Route::get('/notifikasi', [ViewController::class, 'notif']);
    Route::get('/profil', [UserController::class, 'profil']);
    Route::get('/detail/{id}', [PostController::class, 'detail'])->name('detail.post');
    Route::get('/profil-user/{id}', [UserController::class, 'profilUser'])->name('profil.user');
    Route::get('/comen-read/{id}', [CommentController::class, 'read']);
    Route::get('/count-read/{id}', [UserController::class, 'read']);
    Route::get('/count-reading', [UserController::class, 'reading']);
    Route::get('/edit-user', [UserController::class, 'showEdit'])->name('show.edit');
    Route::get('/acount', [UserController::class,'setAcount'])->name('sett.acount');
    Route::get('/followers/{id}', [FollowController::class, 'followers'])->name('user.followers');
    Route::get('/following/{id}', [FollowController::class, 'following'])->name('user.following');
    Route::get('/count-notif', [ViewController::class, 'countNotif'])->name('count.notif');
    Route::get('/search-image', [PostController::class, 'searchImage'])->name('search.image');
    Route::get('/delete-post/{id}', [PostController::class,'destroy'])->name('delete.post');
    Route::get('/edit-album/{id}', [AlbumController::class,'show']);
    Route::get('/delete-album/{id}', [AlbumController::class,'delete'])->name('delete.album');
    Route::get('/delete-all-notif', [ViewController::class,'deleteAll'])->name('deleteall.notif');
    Route::get('/delete/{id}', [ViewController::class,'delete'])->name('delete.notif');


    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::post('/post-image', [PostController::class, 'store'])->name('post.image');
    Route::post('/update/{id}', [PostController::class,'update'])->name('update.post');
    Route::post('/post-album', [AlbumController::class, 'create'])->name('post.album');
    Route::post('/update-album/{id}', [AlbumController::class,'update'])->name('update.album');
    Route::post('/like-post/{postId}', [LikeController::class, 'like'])->name('like.post');
    Route::post('/comen-post/{postId}', [CommentController::class, 'commen'])->name('comen.post');
    Route::post('/follow-user/{userId}', [FollowController::class, 'follow'])->name('follow.user');
    Route::post('/profil-edit', [UserController::class, 'edit'])->name('profil.edit');
    Route::post('/update-acount', [UserController::class,'updateAcount'])->name('update.acount');
    Route::post('/read-notif', [ViewController::class, 'readNotif'])->name('read.notif');
    Route::post('/read-all-notif', [ViewController::class,'readAllNotif'])->name('readall.notif');
    Route::post('/report-post/{postId}', [ReportController::class, 'report'])->name('report.post');
});

Route::get('/login-admin', [AdminController::class, 'showLogin'])->name('login.show');
Route::post('/login-proses', [AdminController::class,'login'])->name('login.proses');

Route::middleware(['IsAdmin'])->group(function () {
    Route::get('/dashboard', [AdminController::class,'index'])->name('dashboard');
    Route::get('/getData', [AdminController::class,'getData'])->name('getdata.chart');
    Route::get('/report', [AdminController::class,'showReport'])->name('report');
    Route::get('/detail-report/{id}', [AdminController::class,'detailReport'])->name('detail.report');
    Route::get('/users', [AdminController::class,'showUser'])->name('users');
    Route::get('/users-info/{id}', [AdminController::class,'usersInfo'])->name('users.info');

    Route::post('/logout-admin', [AdminController::class,'logout'])->name('logout.admin');
    Route::post('/blokir/{id}', [AdminController::class,'blockPost'])->name('block');
});

