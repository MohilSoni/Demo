<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

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

Route::prefix('admin')->group(function () {
    Route::get('/login',[AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login/check',[AdminAuthController::class, 'AdminLoginCheck'])->name('admin.login.check');
    Route::get('/logout',[AdminAuthController::class, 'AdminLogout'])->name('admin.logout');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    Route::get('/dashboard',[AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/users',[AdminController::class, 'AdminUsers'])->name('admin.users');
    Route::get('/departments',[AdminController::class, 'AdminDepartments'])->name('admin.departments');
    Route::get('/user/add',[AdminController::class, 'AdminUserAddForm'])->name('admin.user.add');
    Route::post('/user/store',[AdminController::class, 'AdminUserStore'])->name('admin.user.store');
});
