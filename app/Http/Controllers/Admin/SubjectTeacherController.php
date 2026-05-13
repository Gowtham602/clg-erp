<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\Section;
use App\Models\Subject;
use App\Models\SubjectTeacher;
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


    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $classes = ClassModel::latest()->get();

        $teachers = User::where(
            'role',
            'teacher'
        )->latest()->get();

        return view(
            'admin.subject_teacher.create',
            compact(
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

            'subject_id' => [

                'required',

                Rule::unique('subject_teachers')
                    ->where(function ($query) use ($request) {

                        return $query
                            ->where('subject_id', $request->subject_id)
                            ->where('section_id', $request->section_id);
                    })
            ],

            'section_id' => 'required',

            'teacher_id' => 'required'

        ], [

            'subject_id.unique' =>
                'This subject already assigned for this section.'

        ]);


        SubjectTeacher::create([

            'subject_id' => $request->subject_id,

            'section_id' => $request->section_id,

            'teacher_id' => $request->teacher_id

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
        $subjectTeacher = SubjectTeacher::with([
            'subject',
            'section'
        ])->findOrFail($id);

        // CLASS ID FROM SUBJECT

        $classId = $subjectTeacher
                        ->subject
                        ->class_id;

        $classes = ClassModel::latest()->get();

        $subjects = Subject::where(
            'class_id',
            $classId
        )->get();

        $sections = Section::where(
            'class_id',
            $classId
        )->get();

        $teachers = User::where(
            'role',
            'teacher'
        )->latest()->get();

        return view(
            'admin.subject_teacher.edit',
            compact(
                'subjectTeacher',
                'classes',
                'subjects',
                'sections',
                'teachers',
                'classId'
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

            'teacher_id' => 'required'

        ], [

            'subject_id.unique' =>
                'This subject already assigned for this section.'

        ]);


        $subjectTeacher = SubjectTeacher::findOrFail($id);

        $subjectTeacher->update([

            'subject_id' => $request->subject_id,

            'section_id' => $request->section_id,

            'teacher_id' => $request->teacher_id

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