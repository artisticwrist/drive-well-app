<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Course\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::get('about', function(){
    return view('about');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('web')->group(function () {
    Route::post('/send-feedback', [UserController::class, 'sendFeedback'])->name('send.feedback');
    Route::get('/admin/delete-feedback/{id}', [AdminController::class, 'deleteFeedback'])->name('delete.feedback');
    Route::post('/update-user', [UserController::class, 'updateUser'])->name('update.user');
    Route::get('/edit-user-profile/{id}', [ProfileController::class, 'editUser'])->name('profile.edit.user');
    Route::get('/view-message/{id}', [AdminController::class, 'feedbackFull'])->name('view.feedback.full');
    Route::get('/view-admin-users', [AdminController::class, 'viewUsersAdmin'])->name('view.users');
    Route::get('/view-admin-courses', [AdminController::class, 'viewCoursesAdmin'])->name('view.courses');
    Route::post('/admin/create-user', [AdminController::class, 'createUser'])->name('create.user');
    Route::get('/admin/delete-user/{id}', [UserController::class, 'deleteUser'])->name('delete.user');
    Route::get('/admin/delete-course/{id}', [CourseController::class, 'deleteCourse'])->name('delete.course');
    Route::post('/admin/create', [AdminController::class, 'createAdmin'])->name('submit');
    Route::post('/courses/create', [CourseController::class, 'createCourse'])->name('create.course');
    Route::get('/dashboard', [AdminController::class, 'adminDashboard'])->middleware(['auth', 'verified'])->name('dashboard');
});




require __DIR__.'/auth.php';
