<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\SubjectController;

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });
});




Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {

    //  Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    //  Students
    Route::resource('students', StudentController::class);
    Route::get('students-data', [StudentController::class, 'data'])
        ->name('students.data');

    //  Teachers
    
    Route::resource('teachers', TeacherController::class)->except(['show']);

    Route::get('teachers-data', [TeacherController::class, 'data'])
        ->name('teachers.data');

    Route::delete('teachers/{id}', [TeacherController::class, 'destroy'])
        ->name('teachers.delete');

    Route::post('teachers/restore/{id}', [TeacherController::class, 'restore'])
        ->name('teachers.restore');

    //  Classes
    Route::resource('classes', ClassController::class);
    Route::get('classes-data', [ClassController::class, 'data'])
        ->name('classes.data');


    //subject 
    Route::resource('subjects', SubjectController::class);
    Route::get('subjects-data',[SubjectController::class, 'data'])->name('subjects-data');

});

// // use App\Http\Controllers\Admin\TeacherController;
// Route::prefix('admin')->middleware(['auth'])->group(function () {

//     // Student CRUD
//     Route::get('/students', [StudentController::class, 'index'])->name('students.index');

//     Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');

//     Route::post('/students/store', [StudentController::class, 'store'])->name('students.store');

//     Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');

//     Route::put('/students/{id}', [StudentController::class, 'update'])->name('students.update');

//     Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('students.destroy');

//     // DataTable
//     Route::get('/students-data', [StudentController::class, 'data'])->name('students.data');



//     // dashboard
//     Route::get('/dashboard', [DashboardController::class, 'index'])
//     ->name('admin.dashboard');
// });
   
// Route::prefix('admin')->middleware(['auth'])->group(function () {
//     Route::get('/teachers', [TeacherController::class, 'index']);
//     Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
    
//     Route::get('/teachers/create', [TeacherController::class, 'create'])->name('teachers.create');

//     Route::post('/teachers/store', [TeacherController::class, 'store'])->name('teachers.store');

//     Route::delete('/teachers/{id}', [TeacherController::class, 'destroy'])->name('teachers.delete');

//     Route::get('/teachers/data', [TeacherController::class, 'data'])->name('teachers.data');


//     // class 
//     Route::resource('classes', ClassController::class);
//     Route::get('classes-data', [ClassController::class, 'data'])->name('classes.data');
// });