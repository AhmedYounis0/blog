<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CommentController;

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

// Theme Routes
Route::controller(ThemeController::class)->name('theme.')->group(function () {
   Route::get('/', 'index')->name('home');
   Route::get('/home', 'index')->name('home');
   Route::get('/category/{id}','category')->name('category');
   Route::get('/contact','contact')->name('contact');
   Route::get('/singleBlog','singleBlog')->name('singleBlog');
});

// Subscriber Route

Route::post('subscribe/register',[SubscriberController::class,'store'])->name('subscribe.register');

// Contact us Route
Route::post('contact/store',[ContactController::class,'store'])->name('contact.store');

// Blogs Creations Routes
Route::get('my-blogs',[\App\Http\Controllers\BlogController::class,'index'])->name('blogs.my-blogs');
Route::resource('blogs',\App\Http\Controllers\BlogController::class);

// Contact us Route
Route::post('comment/store',[CommentController::class,'store'])->name('comment.store');

require __DIR__.'/auth.php';
