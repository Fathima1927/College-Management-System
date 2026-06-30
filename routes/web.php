<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SubjectController;


use App\Http\Controllers\FeeMasterController;
use App\Http\Controllers\FeePaymentController;
use App\Http\Controllers\FeeReceiptController;

use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EnrollmentController;

Route::get('/', function () {
    return view('welcome');
});
<<<<<<< HEAD
// Courses
Route::resource('courses', CourseController::class);

// Departments
Route::resource('departments', DepartmentController::class);

// Students (resource without destroy)
Route::resource('students', StudentController::class)->except(['destroy']);

// Custom student routes
=======

/*
|--------------------------------------------------------------------------
| Fee Management
|--------------------------------------------------------------------------
*/

Route::resource('fee-masters', FeeMasterController::class);

Route::get('/fee-payments/summary', [FeePaymentController::class, 'summary'])
    ->name('fee-payments.summary');

Route::resource('fee-payments', FeePaymentController::class);

Route::resource('fee-receipts', FeeReceiptController::class);

Route::get('/fee-receipts/{id}/download', [FeeReceiptController::class, 'download'])
    ->name('fee-receipts.download');

Route::post('/fee-payments/{feePayment}/generate-receipt', [FeeReceiptController::class, 'generateFromPayment'])
    ->name('fee-payments.generate-receipt');

Route::get('/fees/pending', [FeePaymentController::class, 'pending'])
    ->name('fees.pending');

Route::get('/fees/paid', [FeePaymentController::class, 'paid'])
    ->name('fees.paid');



/*
|--------------------------------------------------------------------------
| Course Management
|--------------------------------------------------------------------------
*/

Route::resource('courses', CourseController::class);

/*
|--------------------------------------------------------------------------
| Department Management
|--------------------------------------------------------------------------
*/

Route::resource('departments', DepartmentController::class);

/*
|--------------------------------------------------------------------------
| Student Management
|--------------------------------------------------------------------------
*/

Route::resource('students', StudentController::class)->except(['destroy']);

>>>>>>> origin/integration-student-course
Route::delete('students/{student}', [StudentController::class, 'destroy'])
    ->name('students.destroy');

Route::get('students/{student}/print', [StudentController::class, 'print'])
    ->name('students.print');

<<<<<<< HEAD
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
=======
/*
|--------------------------------------------------------------------------
| Enrollment Management
|--------------------------------------------------------------------------
*/

Route::get('/enrollments', [EnrollmentController::class, 'index'])
    ->name('enrollments.index');

Route::get('/enrollments/create', [EnrollmentController::class, 'create'])
    ->name('enrollments.create');

Route::post('/enrollments', [EnrollmentController::class, 'store'])
    ->name('enrollments.store');

Route::delete('/enrollments/{id}', [EnrollmentController::class, 'destroy'])
    ->name('enrollments.destroy');

use App\Http\Controllers\ReportController;

Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
Route::get('/reports/export-pdf', [ReportController::class, 'exportPdf'])->name('reports.export-pdf');
Route::get('/reports/export-excel', [ReportController::class, 'exportExcel'])->name('reports.export-excel');
>>>>>>> origin/integration-student-course
