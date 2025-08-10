<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


// يظهر للجميع
Route::get('/', [UserController::class, 'showsignin'])->name('showsignin');
Route::post('signin', [UserController::class, 'signin'])->name('signin');
Route::get('signup', [UserController::class, 'signup'])->name('signup');
Route::post('signup', [UserController::class, 'store'])->name('store');

// للمستخدم العادي فقط
Route::middleware(['auth', 'checkrole:user'])->group(function () {
    Route::get('user_dash', [UserController::class, 'userdash'])->name('user.dash');
    Route::get('edit/{id}', [UserController::class, 'useredit'])->name('user.edit');
    Route::put('update/{id}', [UserController::class, 'userupdate'])->name('user.update');
    Route::post('userlogout', [UserController::class, 'userlogout'])->name('user.logout');
});

// للأدمن فقط
Route::middleware(['auth', 'checkrole:admin'])->group(function () {
    Route::get('admin', [UserController::class, 'admindash'])->name('admin.dash');
    Route::post('adminlogout', [UserController::class, 'adminlogout'])->name('admin.logout');
    Route::get('adminedit/{id}', [UserController::class, 'adminedit'])->name('admin.edit');
    Route::put('adminupdate/{id}', [UserController::class, 'adminupdate'])->name('admin.update');
});
