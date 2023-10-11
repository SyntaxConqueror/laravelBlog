<?php

use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\SectionsController;
use \App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Storage;

// -------------------------- AUTHENTICATION -----------------------------
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ------------- LOGIN LOGOUT -------------
Route::group([
    'middleware' => ['web'],
    'prefix' => 'auth'
], function () {
    Route::post('login', [AuthController::class, 'login'])
        ->name('login');

    Route::post('logout', [AuthController::class, 'logout'])
        ->name('logout');

});

// ------------- MAIN PAGE -------------
Route::group([
    'middleware'=>'auth:web'
], function () {
    Route::get('/', [PostController::class, 'index'])->name('posts.index');
    Route::get('/allPosts', [PostController::class, 'getAllPosts']);
    Route::get('/adminPanel', [AdminPanelController::class, 'index'])->name('adminPanel');
    Route::get('/adminPanel/tableWidget', [AdminPanelController::class, 'tableWidget'])->name('tableWidget');
    Route::get('/adminPanel/tableWidget/getPost/{postId}', [AdminPanelController::class, 'getPost'])->name('getPostById');
});


// -------------- GROUP FOR CRUD POSTS -----------------
Route::group([
    'middleware'=>'auth:web'
], function (){
    Route::post('/adminPanel/tableWidget/createPost', [PostController::class, 'createPost'])->name('post.create');
    Route::patch('/adminPanel/tableWidget/updatePost', [PostController::class, 'updatePost'])->name('post.update');
    Route::delete('/adminPanel/tableWidget/deletePost', [PostController::class, 'deletePost'])->name('post.delete');
});


// --------------- SEARCH THE POSTS -----------------
Route::get('/getPostsByParams',
    [PostController::class, 'getPostsByParams'])
    ->name('get.posts.by.params');

Route::get('/getPostsBySearch',
    [PostController::class, 'getPostsBySearch'])
    ->name("get.posts.by.search");

// ---------------- VIEW THE FORMS -------------------
Route::get('/login-index',
    [LoginController::class, 'index'])
    ->name('login.index');

Route::get('/register',
    [RegisterController::class, 'index'])
    ->name('registration.index');

// -------------- MIDDLEWARE VALIDATION --------------
Route::post('/register',
    [RegisterController::class, 'register'])
    ->name("register")
    ->middleware('registration');





