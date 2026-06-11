<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\Section;
use App\Models\Subject;
use App\Models\SubjectTeacher;
use App\Models\AcademicYear;
use App\Models\Semester;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubjectTeacherController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $subjectTeachers = SubjectTeacher::with([
            'subject.classModel',
            'section',
            'teacher'
        ])
            ->latest()
            ->get();

        return view(
            'admin.subject_teacher.index',
            compact('subjectTeachers')
        );
    }
    
    //get semaster

public function getSemesters($classId)
{
    $semesters = Semester::where(
        'course_id',
        $classId
    )
    ->orderBy('semester_no')
    ->get();

    return response()->json($semesters);
}
    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
{
    $academicYears = AcademicYear::latest()->get();

    $classes = ClassModel::latest()->get();

    $teachers = User::where(
        'role',
        'teacher'
    )->latest()->get();

    return view(
        'admin.subject_teacher.create',
        compact(
            'academicYears',
            'classes',
            'teachers'
        )
    );
}


    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([

            'academic_year_id' => 'required|exists:academic_years,id',

            'class_id'         => 'required|exists:classes,id',

            'semester_id'      => 'required|exists:semesters,id',

            'subject_id'       => [

                'required',

                Rule::unique('subject_teachers')
                    ->where(function ($query) use ($request) {

                        return $query
                            ->where('academic_year_id', $request->academic_year_id)
                            ->where('class_id', $request->class_id)
                            ->where('semester_id', $request->semester_id)
                            ->where('section_id', $request->section_id)
                            ->where('subject_id', $request->subject_id);
                    })

            ],

            'section_id'       => 'required|exists:sections,id',

            'teacher_id'       => 'required|exists:users,id',

            'status'           => 'required|boolean'

        ]);


        SubjectTeacher::create([

            'academic_year_id' => $request->academic_year_id,

            'class_id'         => $request->class_id,

            'semester_id'      => $request->semester_id,

            'subject_id'       => $request->subject_id,

            'section_id'       => $request->section_id,

            'teacher_id'       => $request->teacher_id,

            'status'           => $request->status

        ]);


        return redirect()
            ->route('subject-teacher.index')
            ->with(
                'success',
                'Subject Teacher Assigned Successfully'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit($id)
{
    $subjectTeacher = SubjectTeacher::findOrFail($id);

    $academicYears = AcademicYear::where(
        'status',
        1
    )->get();

    $classes = ClassModel::orderBy('name')->get();

    $semesters = Semester::where(
        'course_id',
        $subjectTeacher->class_id
    )->get();

    $subjects = Subject::where(
        'class_id',
        $subjectTeacher->class_id
    )->get();

    $sections = Section::where(
        'class_id',
        $subjectTeacher->class_id
    )->get();

    $teachers = User::where(
        'role',
        'teacher'
    )->get();

    return view(
        'admin.subject_teacher.edit',
        compact(
            'subjectTeacher',
            'academicYears',
            'classes',
            'semesters',
            'subjects',
            'sections',
            'teachers'
        )
    );
}


    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $request->validate([

            'subject_id' => [

                'required',

                Rule::unique('subject_teachers')
                    ->ignore($id)
                    ->where(function ($query) use ($request) {

                        return $query
                            ->where('subject_id', $request->subject_id)
                            ->where('section_id', $request->section_id);
                    })
            ],

            'section_id' => 'required',

            'teacher_id' => 'required',
            'academic_year_id' => 'required|exists:academic_years,id',

            'class_id'         => 'required|exists:classes,id',

            'semester_id'      => 'required|exists:semesters,id',

        ], [

            'subject_id.unique' =>
            'This subject already assigned for this section.'

        ]);


        $subjectTeacher = SubjectTeacher::findOrFail($id);

        $subjectTeacher->update([

            'subject_id' => $request->subject_id,

            'section_id' => $request->section_id,

            'teacher_id' => $request->teacher_id,
            'academic_year_id' => $request->academic_year_id,

            'class_id'         => $request->class_id,

            'semester_id'      => $request->semester_id,

            'status'           => $request->status

        ]);


        return redirect()
            ->route('subject-teacher.index')
            ->with(
                'success',
                'Updated Successfully'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $subjectTeacher = SubjectTeacher::findOrFail($id);

        $subjectTeacher->delete();

        return response()->json([

            'status' => true,

            'message' => 'Deleted Successfully'

        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | GET SUBJECTS
    |--------------------------------------------------------------------------
    */

    public function getSubjects($class_id)
    {
        $subjects = Subject::where(
            'class_id',
            $class_id
        )
            ->latest()
            ->get();

        return response()->json($subjects);
    }


    /*
    |--------------------------------------------------------------------------
    | GET SECTIONS
    |--------------------------------------------------------------------------
    */

    public function getSections($class_id)
    {
        $sections = Section::where(
            'class_id',
            $class_id
        )
            ->latest()
            ->get();

        return response()->json($sections);
    }
}
