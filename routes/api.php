<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Course\CourseController;
use App\Http\Controllers\Payment\PaystackController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('admin')->group(function () {
    Route::get('view-admins', [AdminController::class, 'veiwAdmins']);
    Route::get('view-users', [AdminController::class, 'viewUsers']);
    Route::put('update-user', [AdminController::class, 'updateUserDet']);
    Route::put('update-admin', [AdminController::class, 'updateAdminDet']);
    Route::post('change-status', [AdminController::class, 'changeUserStatus']);
});

Route::prefix('user')->group(function () {
    Route::post('create', [UserController::class, 'store']);
    Route::get('data', [UserController::class, 'userData']); 
    Route::put('{id}', [UserController::class, 'update']); 
    Route::delete('{id}', [UserController::class, 'destroy']); 
});


Route::prefix('course')->group(function () {
    Route::get('/', [CourseController::class, 'viewCourses']);
    Route::get('level/{level}', [CourseController::class, 'viewCoursesByLevel']);
    Route::get('duration/{duration}', [CourseController::class, 'viewCoursesByDuration']);
    Route::get('{id}', [CourseController::class, 'getCourseById']);
    Route::post('update', [CourseController::class, 'updateDiscount']);
});


Route::prefix('auth')->group(function () {
    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'login']);
    Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
});


Route::prefix('payment')->group(function () {
    Route::post('make_payment', [PaystackController::class, 'make_payment']);
    Route::get('payment_callback', [PaystackController::class, 'payment_callback'])->name('callback');
    Route::get('verify_payment/{reference}', [PaystackController::class, 'verify_payment']);
});

