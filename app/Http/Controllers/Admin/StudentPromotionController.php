<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\Student;
use App\Models\StudentHistory;
use App\Models\StudentAcademic;

class StudentPromotionController extends Controller
{

    // INDEX PAGE

    public function index()
    {
        $classes = ClassModel::with('sections')->get();

        return view(
            'admin.student_promotions.index',
            compact('classes')
        );
    }



    // FETCH STUDENTS

    // public function getStudents(Request $request)
    // {

    //     $request->validate([

    //         'from_section_id' => 'required',

    //         'academic_year' => 'required'
    //     ]);


    //     // CURRENT YEAR STUDENTS ONLY

    //     $students = StudentAcademic::with([

    //             'student',

    //             'section.classModel'

    //         ])
    //         ->where('section_id', $request->from_section_id)

    //         ->where('academic_year', $request->academic_year)

    //         ->get();


    //     return response()->json($students);
    // }

//         public function getStudents(Request $request)
// {

//     $students = Student::with([

//             'section.classModel'

//         ])
//         ->where(
//             'section_id',
//             $request->from_section_id
//         )
//         ->get();

//     return response()->json($students);
// }

        public function getStudents(Request $request)
{
    $students = StudentAcademic::with([

            'student',

            'section.classModel'

        ])
        ->where(

            'section_id',

            $request->from_section_id
        )
        ->where(

            'academic_year',

            $request->academic_year
        )
        ->where(

            'status',

            'studying'
        )
        ->get();

    return response()->json($students);
}

    // PROMOTE STUDENTS

 public function promote(Request $request)
{
    $request->validate([

        'academic_ids' => 'required',

        'from_section_id' => 'required',

        'to_section_id' => 'required',

        'new_academic_year' => 'required'
    ]);


    $academics = StudentAcademic::whereIn(

        'id',

        $request->academic_ids

    )->get();



    foreach ($academics as $academic) {


        /*
        |--------------------------------------------------------------------------
        | OLD STATUS UPDATE
        |--------------------------------------------------------------------------
        */

        $academic->update([

            'status' => 'promoted'
        ]);


        /*
        |--------------------------------------------------------------------------
        | NEW ACADEMIC ENTRY
        |--------------------------------------------------------------------------
        */

        StudentAcademic::create([

            'student_id' => $academic->student_id,

            'section_id' => $request->to_section_id,

            'academic_year' => $request->new_academic_year,

            'roll_no' => $academic->roll_no,

            'status' => 'studying'
        ]);


        /*
        |--------------------------------------------------------------------------
        | HISTORY
        |--------------------------------------------------------------------------
        */

        StudentHistory::create([

            'student_id' => $academic->student_id,

            'from_section_id' => $request->from_section_id,

            'to_section_id' => $request->to_section_id,

            'academic_year' => $request->new_academic_year
        ]);
    }


    return response()->json([

        'status' => true,

        'message' => 'Students Promoted Successfully'
    ]);
}
}