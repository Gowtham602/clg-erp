<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\ClassTeacherController;
use App\Http\Controllers\Admin\SubjectTeacherController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\StudentPromotionController;
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\AcademicYearController;
use App\Http\Controllers\Admin\DepartmentController;

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });
});


    

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {

    //  Dashboard
    Route::get('/dashboard', [DashBoardController::class, 'index'])
        ->name('admin.dashboard');

    //  Students
    Route::resource('students', StudentController::class);
    Route::get('students-data', [StudentController::class, 'data'])
        ->name('students.data'); 

    // Route::get('students/{id}/show',[StudentController::class, 'show'])->name('students.show');


    //Students History 
    Route::get('/admin/student/{id}/history', [StudentController::class, 'history']);    

    //  Teachers
    
    // Route::resource('teachers', TeacherController::class)->except(['show']);
     Route::resource('teachers', TeacherController::class );

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

    //section 
    Route::resource('sections', SectionController::class);
    Route::get('sections-data', [SectionController::class,'data'])
    ->name('sections.data');    


    //classes teacher mapping 
    Route::resource('class-teachers', ClassTeacherController::class);
    Route::get('get-sections/{class}',[ClassTeacherController::class, 'getSections'])->name('get.sections');


    //subject 
    Route::resource('subjects', SubjectController::class);
    Route::get('subjects-data',[SubjectController::class, 'data'])->name('subjects-data');

    //academic year



    Route::get(
        'academic-years',
        [AcademicYearController::class, 'index']
    )->name('academic-years.index');

    Route::get(
        'academic-years/data',
        [AcademicYearController::class, 'data']
    )->name('academic-years.data');

    Route::post(
        'academic-years/store',
        [AcademicYearController::class, 'store']
    )->name('academic-years.store');

    Route::get(
        'academic-years/{id}/edit',
        [AcademicYearController::class, 'edit']
    )->name('academic-years.edit');

    Route::put(
        'academic-years/{id}',
        [AcademicYearController::class, 'update']
    )->name('academic-years.update');

    Route::delete(
        'academic-years/{id}',
        [AcademicYearController::class, 'destroy']
    )->name('academic-years.destroy');


    Route::get(
    'departments',
    [DepartmentController::class,'index']
)->name('departments.index');

Route::get(
    'departments/data',
    [DepartmentController::class,'data']
)->name('departments.data');

Route::post(
    'departments/store',
    [DepartmentController::class,'store']
)->name('departments.store');

Route::get(
    'departments/{id}/edit',
    [DepartmentController::class,'edit']
)->name('departments.edit');

Route::put(
    'departments/{id}',
    [DepartmentController::class,'update']
)->name('departments.update');

Route::delete(
    'departments/{id}',
    [DepartmentController::class,'destroy']
)->name('departments.destroy');

    // subject teacher

    Route::resource('subject-teacher', SubjectTeacherController::class);
    Route::get('admin/get-subjects/{class_id}', [SubjectTeacherController::class, 'getSubjects'])->name('get-subjects');
    Route::get('get-subjects/{class_id}',[SubjectTeacherController::class, 'getSubjects'])->name('get.subjects');

    Route::get('get-sections/{class_id}', [SubjectTeacherController::class, 'getSections'] )->name('get.sections');

    Route::get('admin/get-sections/{class_id}',[SubjectTeacherController::class, 'getSections'])->name('get-sections');


    //students promotion to next class 
    Route::get('/admin/promotion', [PromotionController::class, 'index'])->name('promotion.index');
    Route::post('/admin/promotion', [PromotionController::class, 'promote'])->name('promotion.store');


    Route::get('student-promotions',
    [StudentPromotionController::class, 'index'])
    ->name('student.promotions.index');

Route::post('student-promotions/get-students',
    [StudentPromotionController::class, 'getStudents'])
    ->name('student.promotions.getStudents');

Route::post('student-promotions/promote',
    [StudentPromotionController::class, 'promote'])
    ->name('student.promotions.promote');

});

// Route::controller(PromotionController::class)
//     ->prefix('promotions')
//     ->name('promotions.')
//     ->group(function () {

//         Route::get('/', 'index')
//             ->name('index');

//         Route::post('/get-students', 'getStudents')
//             ->name('getStudents');

//         Route::post('/promote', 'promote')
//             ->name('promote');
//     });

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