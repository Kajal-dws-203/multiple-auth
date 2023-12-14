<?php

use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\UserLoginController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\User;

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

// Route::get('/', function () {
//     return view('admin.dashboard');
// })->name('index.dashboard1');

// Route::get('/dashboard2', function () {
//     return view('admin.dashboard2');
// })->name('index.dashboard2');

// Route::get('/dashboard3', function () {
//     return view('admin.dashboard3');
// })->name('index.dashboard3');

// Route::get('/widgets', function () {
//     return view('admin.widgets');
// })->name('index.widgets');

// Route::get('/top-nav', function () {
//     return view('admin.top-nav');
// })->name('index.top-nav');

// Route::get('/top-nav-sidebaar', function () {
//     return view('admin.top-nav-sidebaar');
// })->name('index.top-nav-sidebaar');



// Routes for auth system


Route::prefix('admin')->group(function (){
    Route::get('/register',[RegisterController::class,'showRegisterPage'])->name('index.showRegisterPage');
    Route::get('/login',[LoginController::class,'showLoginPage'])->name('index.showLoginPage');
    Route::post('/admin-login',[LoginController::class,'adminLogin'])->name('index.adminLogin');
    Route::post('/user-login',[LoginController::class,'userLogin'])->name('index.userLogin');
    Route::post('/admin-register',[RegisterController::class,'adminRegister'])->name('index.adminRegister');   
    Route::get('/show-user-dashboard',[LoginController::class,'showUserDashboard'])->name('show.user.dashboard');
    Route::get('/show-admin-dashboard',[LoginController::class,'showAdminDashboard'])->name('show.admin.dashboard');
    Route::get('/logout',[LoginController::class,'logout'])->name('logout');
});

// routes for seperate login page for user and admin

Route::prefix('user')->group(function (){
    Route::get('/show-user-login',[UserLoginController::class,'showUserLoginPage'])->name('index.showUserLoginPage');
    Route::post('/submit-user-login',[UserLoginController::class,'submitUserLogin'])->name('index.submitUserLogin');
});

Route::prefix('admin')->group(function (){
    Route::get('/show-admin-login', [AdminLoginController::class,'showAdminLoginPage'])->name('index.showAdminLoginPage');
    Route::post('/submit-admin-login',[AdminLoginController::class,'submitAdminLogin'])->name('index.submitAdminLogin');
});


//Routes for add admin and user

Route::get('/create-user',[UserController::class,'createUser'])->name('user.create');
Route::post('/store-user',[UserController::class,'storeUser'])->name('user.store');
Route::post('/post-login',[UserController::class,'postLogin'])->name('user.postLogin');


Route::group(['middleware' => ['IsAdmin']], function () {
    Route::get('/display-admin-dashboard',[UserController::class,'displayAdminDashboard'])->name('user.displayAdminDashboard');
});

Route::group(['middleware' => ['IsUser']], function () {
    Route::get('/display-user-dashboard',[UserController::class,'displayUserDashboard'])->name('user.displayUserDashboard');
});

