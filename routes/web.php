<?php

use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
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
    'middleware' => 'auth:web'
], function () {
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

// ------------- MAIN PAGE -------------
Route::group([
    'middleware'=>'auth:web'
], function () {
    Route::get('/', [PostController::class, 'index'])->name('posts.index');
    Route::get('/allPosts', [PostController::class, 'getAllPosts']);
    Route::get('/adminPanel', [AdminPanelController::class, 'index'])->name('adminPanel');
    Route::get('/adminPanel/tableWidget', [AdminPanelController::class, 'tableWidget'])->name('tableWidget');
});


// -------------- GROUP FOR CRUD POSTS -----------------
Route::group([
    'middleware'=>'auth:web'
], function (){
    Route::post('/adminPanel/tableWidget/createPost', [PostController::class, 'createPost'])->name('post.create');
    Route::patch('/adminPanel/tableWidget/updatePost', [PostController::class, 'updatePost'])->name('post.update');
    Route::delete('/adminPanel/tableWidget/deletePost', [PostController::class, 'deletePost'])->name('post.delete');

    Route::get('/adminPanel/tableWidget/getPost/{postId}', [PostController::class, 'getPostById'])->name('getPostById');
    Route::get('/getPostsByParams', [PostController::class, 'getPostsByParams'])->name('get.posts.by.params');
    Route::get('/getPostsBySearch', [PostController::class, 'getPostsBySearch'])->name("get.posts.by.search");
});

// -------------- GROUP FOR CRUD CATEGORIES -----------------
Route::group([
    'middleware'=>'auth:web'
], function () {
    Route::post('/adminPanel/tableWidget/createCategory', [CategoryController::class, 'create'])->name('category.create');
    Route::patch('/adminPanel/tableWidget/updateCategory', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/adminPanel/tableWidget/deleteCategory', [CategoryController::class, 'delete'])->name('category.delete');
    Route::get('/adminPanel/tableWidget/getCategory/{categoryId}', [CategoryController::class, 'getCategoryById'])->name('category.by.id');
});

// -------------- GROUP FOR CRUD TAGS -----------------
Route::group([
    'middleware'=>'auth:web'
], function () {
    Route::post('/adminPanel/tableWidget/createTag', [TagController::class, 'create'])->name('tag.create');
    Route::patch('/adminPanel/tableWidget/updateTag', [TagController::class, 'update'])->name('tag.update');
    Route::delete('/adminPanel/tableWidget/deleteTag', [TagController::class, 'delete'])->name('tag.delete');
    Route::get('/adminPanel/tableWidget/getTag/{tagId}', [TagController::class, 'getTagById'])->name('tag.by.id');
});
// -------------- GROUP FOR CRUD USERS -----------------
Route::group([
    'middleware'=>'auth:web'
], function () {
    Route::post('/adminPanel/tableWidget/createUser', [UserController::class, 'create'])->name('user.create');
    Route::patch('/adminPanel/tableWidget/updateUser', [UserController::class, 'update'])->name('user.update');
    Route::delete('/adminPanel/tableWidget/deleteUser', [UserController::class, 'delete'])->name('user.delete');
    Route::get('/adminPanel/tableWidget/getUser/{userId}', [UserController::class, 'getUserById'])->name('user.by.id');
});


// ---------------- VIEW THE FORMS -------------------
Route::get('/login-index', [LoginController::class, 'index'])->name('login.index');
Route::get('/register', [RegisterController::class, 'index'])->name('registration.index');

// -------------- MIDDLEWARE VALIDATION --------------
Route::post('/register',
    [RegisterController::class, 'register'])
    ->name("register")
    ->middleware('registration');





