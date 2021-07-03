<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

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
    return view('welcome');
});

Route::post('/admin_save', [AdminController::class, 'admin_save'])->name('auth.admin_save');
Route::post('/admin_check', [AdminController::class, 'admin_check'])->name('auth.admin_check');
Route::get('/admin_logout', [AdminController::class, 'admin_logout'])->name('auth.admin_logout');



Route::group(['middleware'=>['AuthCheck']], function(){
    Route::get('/admin_login', [AdminController::class, 'admin_login'])->name('auth.admin_login');
    Route::get('/admin_register', [AdminController::class, 'admin_register'])->name('auth.admin_register');

    Route::get('/admin/dashboard', [AdminController::class, 'admin_dashboard']);
    Route::get('/admin/settings',[AdminController::class,'admin_settings']);
    Route::get('/admin/profile',[AdminController::class,'admin_profile']);
    Route::get('/admin/staff',[AdminController::class,'admin_staff']);
});