<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\mainhomecontroller;
use App\Http\Controllers\admincarcontroller;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [mainhomecontroller::class,'dashboard'])->name('user.dashboard');
    Route::get('/profile', [mainhomecontroller::class,'singleuser_dashboard'])->name('profile');
    Route::Post('/profile/{id}', [mainhomecontroller::class,'singleuser_dashboard_update'])->name('profile_update');
});

Route::middleware(['auth','auth.admin'])->group(function () {
    Route::get('/Admin-panel',[AdminController::class,'blog_show'])->name('admin.blogdashboard');
    Route::get('/Add-blog',[AdminController::class,'add_blog_show'])->name('add_blog_admin');
    Route::Post('/Add',[AdminController::class,'blog_add'])->name('admin.addblog');
    Route::get('deleted/{id}',[AdminController::class,'blog_delete'])->name('admin.delete');
    Route::get('update/{id}',[AdminController::class,'blog_update'])->name('admin.update');
    Route::POST('update',[AdminController::class,'blog_update_post'])->name('blog.update');
    //car dashboard
    Route::get('/Admin-panel-car',[admincarcontroller::class,'blog_show'])->name('admin.cardashboard');
    Route::get('/Add-car',[admincarcontroller::class,'add_blog_show'])->name('add_blog_admin');
    Route::Post('/Addcar',[admincarcontroller::class,'blog_add'])->name('admin.addblog');
    Route::get('deletecar/{id}',[admincarcontroller::class,'blog_delete'])->name('admin.delete');
    Route::get('updatecar/{id}',[admincarcontroller::class,'blog_update'])->name('admin.update');
    Route::POST('updatecar',[admincarcontroller::class,'blog_update_post'])->name('blog.update');
});




Route::get('/', [mainhomecontroller::class,'car_show_home'])->name('home');
Route::fallback(function () {
    return view('404');
});
Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/car', [mainhomecontroller::class,'car_show'])->name('car');
Route::get('/blog', [mainhomecontroller::class,'blog_show'])->name('blog');
Route::get('/blog/{slug}', [mainhomecontroller::class,'blog_single'])->name('blog-single');

Route::get('/booking', function () {
    return view('booking');
})->name('booking');
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::get('/register', function () {
    return view('auth.register');
})->name('register');


