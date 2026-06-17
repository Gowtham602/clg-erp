<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcademicYear;
use App\Models\ClassModel;
use App\Models\Semester;
use App\Models\Exams;

class ExamController extends Controller
{
    public function index()
{
    $exams = Exams::latest()->get();

    return view(
        'admin.exams.index',
        compact('exams')
    );
}
   

public function create()
{
    $academicYears = AcademicYear::where('status',1)
        ->orderBy('id','desc')
        ->get();

    $classes = ClassModel::where('status',1)
        ->orderBy('name')
        ->get();

    $semesters = Semester::where('status',1)
        ->orderBy('id')
        ->get();

     $exams = Exams::latest()->get();
    return view(
        'admin.exams.create',
        compact(
            'academicYears',
            'classes',
            'semesters',
            'exams'
        )
    );
}

    public function store(Request $request)
    {
        $request->validate([

    'name' => 'required',

    'academic_year_id' =>
        'required|exists:academic_years,id',

    'class_id' =>
        'required|exists:classes,id',

    'semester_id' =>
        'required|exists:semesters,id',

    'exam_type' =>
        'required',

    'start_date' =>
        'required|date',

    'end_date' =>
        'required|date|after_or_equal:start_date'
]);

        Exams::create([
            'name'             => $request->name,
            'academic_year_id' => $request->academic_year_id,
            'class_id'         => $request->class_id,
            'semester_id'      => $request->semester_id,
            'exam_type'        => $request->exam_type,
            'start_date'       => $request->start_date,
            'end_date'         => $request->end_date,
            'status'           => 1,
        ]);

        return redirect()
            ->route('exams.index')
            ->with('success', 'Exam Created Successfully');
    }

    public function edit($id)
{
    $exam = Exams::findOrFail($id);

    $academicYears = AcademicYear::where('status',1)
        ->orderBy('id','desc')
        ->get();

    $classes = ClassModel::where('status',1)
        ->orderBy('name')
        ->get();

   $semesters = Semester::where('course_id',$exam->class_id)
        ->where('status',1)
        ->get();

    return view(
        'admin.exams.edit',
        compact(
            'exam',
            'academicYears',
            'classes',
            'semesters'
        )
    );
}

    public function update(Request $request, Exams $exam)
    {
        $request->validate([
            'name'             => 'required|max:255',
            'academic_year_id' => 'required',
            'class_id'         => 'required',
            'semester_id'      => 'required',
            'exam_type'        => 'required',
            'start_date'       => 'required|date',
            'end_date'         => 'required|date|after_or_equal:start_date',
        ]);

        $exam->update($request->all());

        return redirect()
            ->route('exams.index')
            ->with('success', 'Exam Updated Successfully');
    }


       public function getSemestersExam($courseId)
{
    $semesters = Semester::where(
        'course_id',
        $courseId
    )
    ->where('status',1)
    ->get();

    return response()->json($semesters);
}

    public function destroy(Exams $exam)
    {
        $exam->delete();

        return redirect()
            ->route('exams.index')
            ->with('success', 'Exam Deleted Successfully');
    }
}
