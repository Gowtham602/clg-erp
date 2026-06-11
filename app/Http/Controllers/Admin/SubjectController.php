<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Semester;
class SubjectController extends Controller
{

    // INDEX

    // public function index()
    // {
    //     $classes = ClassModel::with([

    //         'subjects' => function ($query) {

    //             $query->latest();

    //         }

    //     ])->latest()->get();


    //     $totalSubjects = Subject::count();

    //     $totalClasses = ClassModel::count();


    //     return view(
    //         'admin.subjects.index',
    //         compact(
    //             'classes',
    //             'totalSubjects',
    //             'totalClasses'
    //         )
    //     );
    // }

  public function index()
{
    $classes = ClassModel::with('subjects')->latest()->get();

    $totalSubjects = Subject::count();

    $totalClasses = ClassModel::count();

    return view(
        'admin.subjects.index',
        compact(
            'classes',
            'totalSubjects',
            'totalClasses'
        )
    );
}


    // CREATE

    public function create()
{
    $classes = ClassModel::orderBy('name')->get();



    return view(
        'admin.subjects.create',
        compact(
            'classes'
            
        )
    );
}

public function getSemestersSubject($course)
{
    $semesters = Semester::where(
        'course_id',
        $course
    )
    ->orderBy('semester_no')
    ->get();

    return response()->json($semesters);
}



    // STORE

    // public function store(Request $request)
    // {
    //     $request->validate([

    //         'class_id' => 'required|exists:classes,id',

    //         'name' => [

    //             'required',

    //             Rule::unique('subjects')
    //                 ->where(function ($query) use ($request) {

    //                     return $query->where(
    //                         'class_id',
    //                         $request->class_id
    //                     );

    //                 })

    //         ]

    //     ], [

    //         'class_id.required' => 'Class is required.',

    //         'class_id.exists' => 'Selected class invalid.',

    //         'name.required' => 'Subject name is required.',

    //         'name.unique' =>
    //             'This subject already exists for selected class.'

    //     ]);


    //     Subject::create([

    //         'class_id' => $request->class_id,

    //         'name' => trim($request->name)

    //     ]);


    //     return redirect()
    //         ->route('subjects.index')
    //         ->with(
    //             'success',
    //             'Subject Added Successfully'
    //         );
    // }

        public function store(Request $request)
{
   $request->validate([

    'class_id'     => 'required|exists:classes,id',

    'semester_id'  => 'required|exists:semesters,id',

    'subject_code' => [
        'required',
        'max:50',
        'unique:subjects,subject_code'
    ],

    'name' => [

        'required',
        'max:255',

        Rule::unique('subjects')
            ->where(function ($query) use ($request) {

                return $query
                    ->where('class_id', $request->class_id)
                    ->where('semester_id', $request->semester_id);

            })

    ],

], [

    'class_id.required'     => 'Please select course.',

    'semester_id.required'  => 'Please select semester.',

    'subject_code.required' => 'Subject code is required.',

    'subject_code.unique'   => 'Subject code already exists.',

    'name.required'         => 'Subject name is required.',

    'name.unique'           => 'This subject already exists in the selected course and semester.',

]);

    Subject::create([

        'class_id'      => $request->class_id,
        'semester_id'   => $request->semester_id,
        'subject_code'  => strtoupper(trim($request->subject_code)),
        'name'          => trim($request->name),
        'subject_type'  => $request->subject_type,
        'credits'       => $request->credits,
        'max_marks'     => $request->max_marks,
        'pass_marks'    => $request->pass_marks,
        'status'        => $request->status,

    ]);

    return redirect()
        ->route('subjects.index')
        ->with(
            'success',
            'Subject Added Successfully'
        );
}



    // EDIT

   public function edit($id)
{
    $subject = Subject::findOrFail($id);

    $classes = ClassModel::orderBy('name')->get();

    $semesters = Semester::where(
        'course_id',
        $subject->class_id
    )
    ->orderBy('semester_no')
    ->get();

    return view(
        'admin.subjects.edit',
        compact(
            'subject',
            'classes',
            'semesters'
        )
    );
}




    // UPDATE

   public function update(Request $request, $id)
{
    $request->validate([

        'class_id'     => 'required|exists:classes,id',

        'semester_id'  => 'required|exists:semesters,id',

        'subject_code' => [

            'required',

            Rule::unique('subjects','subject_code')
                ->ignore($id)

        ],

        'name' => [

            'required',

            Rule::unique('subjects')
                ->ignore($id)
                ->where(function ($query) use ($request) {

                    return $query
                        ->where('class_id', $request->class_id)
                        ->where('semester_id', $request->semester_id);

                })

        ],

        'subject_type' => 'required|in:Theory,Lab',

        'credits'      => 'required|integer|min:0',

        'max_marks'    => 'required|integer|min:1',

        'pass_marks'   => 'required|integer|min:1',

        'status'       => 'required|boolean'

    ]);

    $subject = Subject::findOrFail($id);

    $subject->update([

        'class_id'      => $request->class_id,

        'semester_id'   => $request->semester_id,

        'subject_code'  => strtoupper(
            trim($request->subject_code)
        ),

        'name'          => trim($request->name),

        'subject_type'  => $request->subject_type,

        'credits'       => $request->credits,

        'max_marks'     => $request->max_marks,

        'pass_marks'    => $request->pass_marks,

        'status'        => $request->status

    ]);

    return redirect()
        ->route('subjects.index')
        ->with(
            'success',
            'Subject Updated Successfully'
        );
}




    // DELETE

    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);

        $subject->delete();


        return redirect()
            ->route('subjects.index')
            ->with(
                'success',
                'Subject Deleted Successfully'
            );
    }
}