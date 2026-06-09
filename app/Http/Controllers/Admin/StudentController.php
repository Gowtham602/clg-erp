<?php

namespace App\Http\Controllers\Admin;

use App\Models\Student;
use App\Models\Section;
use App\Models\AcademicYear;
use App\Models\Semester;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use App\Models\StudentAcademic;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function index()
    {
        return view('admin.students.index');
    }
    public function getSections($courseId)
{
    $sections = Section::where(
        'class_id',
        $courseId
    )->get();

    return response()->json($sections);
}


    // public function data()
    // {
    //     $students = Student::with([
    //         'currentAcademic.section.class',
    //         'currentAcademic.section.teacher'
    //     ]);
    //     // dd($students);

    //     return DataTables::of($students)

    //         ->addColumn('student_name', function ($row) {

    //             return $row->first_name;
    //         })

    //         ->addColumn('class', function ($row) {

    //             return $row->currentAcademic->section->class->name ?? '-';
    //         })

    //         ->addColumn('section', function ($row) {

    //             return $row->currentAcademic->section->name ?? '-';
    //         })

    //         ->addColumn('teacher', function ($row) {

    //             return $row->currentAcademic->section->classTeacher->teacher->name ?? '-';
    //         })

    //         ->addColumn('roll_no', function ($row) {

    //             return $row->currentAcademic->roll_no ?? '-';
    //         })

    //         ->addColumn('academic_year', function ($row) {

    //             return $row->currentAcademic->academic_year ?? '-';
    //         })

    //         ->addColumn('action', function ($row) {

    //             return '

    //                 <a href="'.route('students.show',$row->id).'"
    //                     class="btn btn-info btn-sm">

    //                     <i class="bi bi-eye"></i>
    //                 </a>

    //                 <a href="'.route('students.edit',$row->id).'"
    //                     class="btn btn-primary btn-sm">

    //                     <i class="bi bi-pencil"></i>
    //                 </a>

    //                 <button class="btn btn-danger btn-sm deleteBtn"
    //                     data-id="'.$row->id.'">

    //                     <i class="bi bi-trash"></i>
    //                 </button>
    //             ';
    //         })

    //         ->rawColumns(['action'])

    //         ->make(true);
    // }





    public function data()
{
    $students = Student::with([
        'currentAcademic.section.class',
        'currentAcademic.section.teacher'
    ])

    ->join('student_academics', 'students.id', '=', 'student_academics.student_id')

    ->join('sections', 'student_academics.section_id', '=', 'sections.id')

    ->join('classes', 'sections.class_id', '=', 'classes.id')

    ->select('students.*')

    ->orderByRaw("
        CASE
            WHEN classes.name = 'LKG' THEN -1
            WHEN classes.name = 'UKG' THEN 0
            ELSE CAST(classes.name AS UNSIGNED)
        END ASC
    ");

 return DataTables::of($students)

    ->addIndexColumn()

    ->addColumn('student_name', function ($row) {
        return $row->first_name.' '.$row->last_name;
    })

    ->addColumn('roll_no', function ($row) {
        return optional($row->currentAcademic)->roll_no ?? '-';
    })

    ->addColumn('course', function ($row) {
        return optional(optional($row->currentAcademic)->course)->name ?? '-';
    })

    ->addColumn('semester', function ($row) {
        return optional(optional($row->currentAcademic)->semester)->name ?? '-';
    })

    ->addColumn('section', function ($row) {
        return optional(optional($row->currentAcademic)->section)->name ?? '-';
    })

    ->addColumn('academic_year', function ($row) {
        return optional(optional($row->currentAcademic)->academicYear)->name ?? '-';
    })

    ->addColumn('status', function ($row) {
        return '<span class="badge bg-success">Active</span>';
    })

    ->addColumn('action', function ($row) {
        return '
        <a href="'.route('students.show',$row->id).'"
                    class="btn btn-info btn-sm">

                    <i class="bi bi-eye"></i>
                </a>
            <a href="'.route('students.edit',$row->id).'"
               class="btn btn-primary btn-sm">
               <i class="bi bi-pencil"></i>
            </a>

            <button class="btn btn-danger btn-sm deleteBtn"
                    data-id="'.$row->id.'">
                <i class="bi bi-trash"></i>
            </button>
        ';
    })

    ->rawColumns(['status','action'])

    ->make(true);
}
  public function create()
{
    $academicYears = AcademicYear::all();

    $courses = ClassModel::where('status',1)->get();

    $semesters = Semester::where('status',1)->get();

    $sections = Section::where('status',1)->get();

    return view(
        'admin.students.create',
        compact(
            'academicYears',
            'courses',
            'semesters',
            'sections'
        )
    );
}


    public function store(Request $request)
    {

    // dd($request);
        $request->validate([


    'course_id' => 'required',



            'admission_no' => 'required|unique:students',

            'section_id' => 'required|exists:sections,id',

            'academic_year_id' => 'required',

            'roll_no' => 'required',

            'first_name' => 'required|string|max:100',

            'phone' => 'required|digits:10',

            'father_name' => 'required',

            'mother_name' => 'required',

            'gender' => 'required',

            'address' => 'required'
        ]);


        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | STUDENT TABLE
            |--------------------------------------------------------------------------
            */

            $student = Student::create([
                

                'admission_no' => $request->admission_no,

                'admission_date' => $request->admission_date,

                'first_name' => $request->first_name,

                'last_name' => $request->last_name,

                'dob' => $request->dob,

                'gender' => $request->gender,

                'blood_group' => $request->blood_group,

                'father_name' => $request->father_name,

                'mother_name' => $request->mother_name,

                'guardian_phone' => $request->guardian_phone,

                'phone' => $request->phone,

                'email' => $request->email,

                'address' => $request->address,

                'religion' => $request->religion,

                'nationality' => $request->nationality,

                'aadhaar_no' => $request->aadhaar_no,

                'transport_route' => $request->transport_route,

                'created_by' => auth()->id()
            ]);


            /*
            |--------------------------------------------------------------------------
            | STUDENT ACADEMICS TABLE
            |--------------------------------------------------------------------------
            */

            // StudentAcademic::create([

            //     'student_id' => $student->id,

            //     'section_id' => $request->section_id,

            //     'academic_year_id' => $request->academic_year_id,

            //     'roll_no' => $request->roll_no,

            //     'status' => 'studying'
                
            // ]);
       
            StudentAcademic::create([

    'student_id'       => $student->id,

    'academic_year_id' => $request->academic_year_id,

    'course_id'        => $request->course_id,

    'semester_id'      => $request->semester_id,

    'section_id'       => $request->section_id,

    'roll_no'          => $request->roll_no,

    'status'           => 'studying'
]);


            DB::commit();

            return response()->json([

                'success' => true,

                'message' => 'Student Added Successfully'
            ]);

        } catch (\Exception $e) {

            DB::rollBack();
// dd($e->getMessage());
            return response()->json([

                'success' => false,

                'message' => $e->getMessage()
            ]);
        }
    }
    

    public function show($id)
    {
        $student = Student::with([

            'academics.section.class',
            'academics.section.teacher'

        ])->findOrFail($id);

        return view('admin.students.show', compact('student'));
    }
//     public function edit($id)
// {
//     $student = Student::findOrFail($id);

//     $sections = Section::with('class')->get();

//     return view(
//         'admin.students.edit',
//         compact('student', 'sections')
//     );
// }

public function edit($id)
{
    $student = Student::with('currentAcademic')
        ->findOrFail($id);

    $sections = Section::with('class')->get();

    return view(
        'admin.students.edit',
        compact('student', 'sections')
    );
}

public function update(Request $request, $id)
{
    // dd($request);
    $student = Student::with('currentAcademic')
        ->findOrFail($id);

         $request->validate([
        'admission_no' => [
                'required',
                Rule::unique('students')
                    ->ignore($student->id),
            ],
        'section_id' => 'required|exists:sections,id',

        'roll_no' => 'required',

        'first_name' => 'required|string|max:100',

        'phone' => 'required|digits:10',

        'father_name' => 'required',

        'mother_name' => 'required',

        'gender' => 'required',

        'address' => 'required'
    ]);

    DB::beginTransaction();

    try {

        /*
        |--------------------------------------------------------------------------
        | UPDATE STUDENT
        |--------------------------------------------------------------------------
        */

        $student->update([
            'admission_no' =>$request->admission_no,
            'first_name' => $request->first_name,

            'last_name' => $request->last_name,

            'gender' => $request->gender,

            'father_name' => $request->father_name,

            'mother_name' => $request->mother_name,

            'phone' => $request->phone,

            'email' => $request->email,

            'dob' => $request->dob,

            'address' => $request->address,
        ]);


        /*
        |--------------------------------------------------------------------------
        | UPDATE STUDENT ACADEMIC
        |--------------------------------------------------------------------------
        */

        if ($student->currentAcademic) {

            $student->currentAcademic->update([

                'section_id' => $request->section_id,

                'roll_no' => $request->roll_no,
            ]);
        }

        DB::commit();

        return response()->json([

            'success' => true,

            'message' => 'Student Updated Successfully'
        ]);

    } catch (\Exception $e) {

        DB::rollBack();

        return response()->json([

            'success' => false,

            'message' => $e->getMessage()
        ]);
    }
}

    public function destroy($id)
    {
        Student::findOrFail($id)->delete();

        return response()->json([

            'success' => true
        ]);
    }
}