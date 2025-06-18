<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredStudentController;
use App\Http\Controllers\Auth\RegisteredTeacherController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\Auth\StudentAuthController;
use App\Http\Controllers\Auth\TeacherAuthController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Student\StudentGradeController;
use App\Http\Controllers\Student\StudentAssignmentController;
use App\Http\Controllers\Admin\GradeController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/register/student', [RegisteredStudentController::class, 'create'])->name('register.student');
Route::post('/register/student', [RegisteredStudentController::class, 'store']);
Route::get('/register/teacher', [RegisteredTeacherController::class, 'create'])->name('register.teacher');
Route::post('/register/teacher', [RegisteredTeacherController::class, 'store']);


// Student Auth
Route::get('register/student', [StudentAuthController::class, 'showRegisterForm'])->name('student.register');
Route::post('register/student', [StudentAuthController::class, 'register']);
Route::get('login/student', [StudentAuthController::class, 'showLoginForm'])->name('student.login');
Route::post('login/student', [StudentAuthController::class, 'login']);

// Student Dashboard
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/assignments/{id}/submit', [App\Http\Controllers\AssignmentSubmissionController::class, 'create'])->name('submission.create');
    Route::post('/assignments/{id}/submit', [App\Http\Controllers\AssignmentSubmissionController::class, 'store'])->name('submission.store');
    Route::get('/student/dashboard', [StudentController::class, 'index'])->name('student.dashboard');
     Route::get('student/grades', [StudentGradeController::class, 'index'])->name('student.grades.index');
    Route::get('/student/assignments', [StudentAssignmentController::class, 'assignments'])->name('student.assignments');

});



// Teacher Auth
Route::get('teacher/register', [TeacherAuthController::class, 'showRegisterForm'])->name('teacher.register');
Route::post('teacher/register', [TeacherAuthController::class, 'register']);
Route::get('teacher/login', [TeacherAuthController::class, 'showLoginForm'])->name('teacher.login');
Route::post('teacher/login', [TeacherAuthController::class, 'login']);

// Teacher Dashboard
Route::middleware(['auth', 'role:teacher'])->name('teacher.')->group(function () {
    Route::get('/teacher/dashboard', [TeacherController::class, 'index'])->name('dashboard');

    Route::resource('/teacher/assignments', App\Http\Controllers\Teacher\AssignmentController::class);
    Route::resource('/teacher/grades', App\Http\Controllers\Teacher\GradeController::class);
    Route::resource('/teacher/students', App\Http\Controllers\Teacher\StudentController::class);
    Route::resource('/teacher/subjects', App\Http\Controllers\Teacher\SubjectController::class);
    Route::resource('/teacher/courses', App\Http\Controllers\Teacher\CourseController::class);

    
});



// Admin Dashboard
Route::middleware(['auth', 'role:admin'])->name('admin.')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('/admin/students', App\Http\Controllers\Admin\StudentController::class);
    Route::resource('/admin/teachers', App\Http\Controllers\Admin\TeacherController::class);
    Route::resource('/admin/courses', App\Http\Controllers\Admin\CourseController::class);
    Route::resource('/admin/subjects', App\Http\Controllers\Admin\SubjectController::class);
    Route::resource('/admin/assignments',  App\Http\Controllers\Admin\AssignmentController::class);
    Route::resource('/admin/grades', App\Http\Controllers\Admin\GradeController::class);
    // Route::post('logout', [AdminController::class, 'destroy'])->name('logout');
});


    //Route::get('/teacher/grades', [GradeController::class, 'index'])->name('grades.index');
    // Route::get('/teacher/grades/create', [GradeController::class, 'create'])->name('grades.create');
    // Route::post('/teacher/grades', [GradeController::class, 'store'])->name('grades.store');
    // Route::get('/teacher/grades/create', [GradeController::class, 'create'])->name('grades.create');
    // Route::get('/assignments/create', [App\Http\Controllers\TeacherAssignmentController::class, 'create'])->name('assignments.create');
    // Route::post('/assignments', [App\Http\Controllers\TeacherAssignmentController::class, 'store'])->name('assignments.store');