<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SubjectController;

Route::get('/', function () {
    return view('welcome');
});
// Courses
Route::resource('courses', CourseController::class);

// Departments
Route::resource('departments', DepartmentController::class);

// Students (resource without destroy)
Route::resource('students', StudentController::class)->except(['destroy']);

// Custom student routes
Route::delete('students/{student}', [StudentController::class, 'destroy'])
    ->name('students.destroy');

Route::get('students/{student}/print', [StudentController::class, 'print'])
    ->name('students.print');

Route::get('/enrollments', [EnrollmentController::class, 'index'])->name('enrollments.index');
Route::get('/enrollments/create', [EnrollmentController::class, 'create'])->name('enrollments.create');
Route::post('/enrollments', [EnrollmentController::class, 'store'])->name('enrollments.store');
Route::delete('/enrollments/{id}', [EnrollmentController::class, 'destroy'])
    ->name('enrollments.destroy');
   

Route::get('/enrollments/print', [EnrollmentController::class, 'printReport'])->name('enrollments.print');
Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');


Route::resource('employees', EmployeeController::class);
Route::get('/employees/{employee}/print', [EmployeeController::class, 'printEmployee'])->name('employees.print');


Route::resource('subjects', SubjectController::class);