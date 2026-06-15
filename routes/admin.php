<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\SemesterController;
use App\Http\Controllers\Admin\ClassTeacherController;
use App\Http\Controllers\Admin\SubjectTeacherController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\StudentPromotionController;
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\AcademicYearController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\ExamController;

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
    Route::get('/get-course-semesters/{course}',[SubjectController::class, 'getSemestersSubject'])->name('subjects.semesters');
    Route::resource('subjects', SubjectController::class);
    Route::get('subjects-data',[SubjectController::class, 'data'])->name('subjects-data');



    //semester 
    Route::get('semesters',[SemesterController::class, 'index'])->name('semesters.index');

    Route::get('semesters/data',[SemesterController::class, 'data'])->name('semesters.data');

    Route::post('semesters/store',[SemesterController::class, 'store'])->name('semesters.store');

    Route::get('semesters/{id}/edit',[SemesterController::class, 'edit'])->name('semesters.edit');

    Route::put('semesters/{id}',[SemesterController::class, 'update'])->name('semesters.update');

    Route::delete('semesters/{id}',[SemesterController::class, 'destroy'])->name('semesters.destroy');


    //academic year 
    Route::get(
    'get-sections/{course}',
    [StudentController::class, 'getSections']
)->name('students.get-sections');
    Route::get('academic-years',[AcademicYearController::class, 'index'])->name('academic-years.index');

    Route::get('academic-years/data', [AcademicYearController::class, 'data'])->name('academic-years.data');

    Route::post('academic-years/store',[AcademicYearController::class, 'store'])->name('academic-years.store');

    Route::get('academic-years/{id}/edit',[AcademicYearController::class, 'edit'])->name('academic-years.edit');

    Route::put('academic-years/{id}',[AcademicYearController::class, 'update'])->name('academic-years.update');

    Route::delete('academic-years/{id}',[AcademicYearController::class, 'destroy'])->name('academic-years.destroy');


    Route::get('departments',[DepartmentController::class,'index'])->name('departments.index');

    Route::get('departments/data',[DepartmentController::class,'data'])->name('departments.data');

    Route::post('departments/store',[DepartmentController::class,'store'])->name('departments.store');

    Route::get('departments/{id}/edit',[DepartmentController::class,'edit'])->name('departments.edit');

    Route::put('departments/{id}',[DepartmentController::class,'update'])->name('departments.update');

    Route::delete('departments/{id}',[DepartmentController::class,'destroy'])->name('departments.destroy');

    // subject teacher

    Route::resource('subject-teacher', SubjectTeacherController::class); 
    Route::get('get-semesters/{course}',[SubjectTeacherController::class,'getSemesters'])->name('get-semesters');
    Route::get('admin/get-subjects/{class_id}', [SubjectTeacherController::class, 'getSubjects'])->name('get-subjects');
    Route::get('get-subjects/{class_id}',[SubjectTeacherController::class, 'getSubjects'])->name('get.subjects');

    Route::get('get-sections/{class_id}', [SubjectTeacherController::class, 'getSections'] )->name('get.sections');

    Route::get('admin/get-sections/{class_id}',[SubjectTeacherController::class, 'getSections'])->name('get-sections');


    //students promotion to next class 
    Route::get('/admin/promotion', [PromotionController::class, 'index'])->name('promotion.index');
    Route::post('/admin/promotion', [PromotionController::class, 'promote'])->name('promotion.store');

    //for exams controller
    Route::resource('exams', ExamController::class);
    Route::get('/get-semesters/{class}',[ExamController::class,'getSemestersExam'])->name('get.semesters');

 Route::get(
        'student-promotions',
        [StudentPromotionController::class, 'index']
    )->name('student.promotions.index');

    Route::post(
        'student-promotions/get-students',
        [StudentPromotionController::class, 'getStudents']
    )->name('student.promotions.getStudents');

    Route::post(
        'student-promotions/promote',
        [StudentPromotionController::class, 'promote']
    )->name('student.promotions.promote');

    Route::get(
    'get-sections/{course}',
    [StudentPromotionController::class,'getSections']
);
});
