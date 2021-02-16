<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProjectController;

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

Route::redirect('/', '/home');

Route::get('/home', function() {
    return view('home');
})->name('home');

Route::get('/posts', [
    PostController::class, 'index'
])->name('posts');

Route::get('/posts/category/{category}', [
    PostController::class, 'category'
])->name('category');

Route::get('/posts/{id}', [
    PostController::class, 'show'
])->name('post');

Route::get('/about', function() {
    return view('about');
})->name('about');

Route::get('/resume', function() {
    return view('resume');
})->name('resume');

Route::get('/portfolio', function() {
    return view('portfolio');
})->name('portfolio');