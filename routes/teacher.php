<?php

use App\Http\Controllers\Teacher\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Teacher\StudentController;

Route::middleware(['auth', 'role:teacher'])
    ->prefix('teacher')
    ->group(function () {



Route::get('/dashboard', function () {
    return view('teacher.dashboard');
})->name('teacher.dashboard')->middleware('auth');

    // Students (ONLY own class)
    Route::get('students', [StudentController::class, 'index'])->name('teacher.students.index');
    Route::get('students-data', [StudentController::class, 'data'])->name('teacher.students.data');

    Route::post('students/store', [StudentController::class, 'store'])->name('teacher.students.store');
    Route::get('students/{id}/edit', [StudentController::class, 'edit'])->name('teacher.students.edit');
    Route::put('students/{id}', [StudentController::class, 'update'])->name('teacher.students.update');
    Route::delete('students/{id}', [StudentController::class, 'destroy'])->name('teacher.students.delete');




    //teacher mapping  subject list  in dashboard
    Route::get('/teacher-subject',[DashboardController::class,'teacherSubjects'])->name('teacher-subject');
});
