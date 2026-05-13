<?php

namespace App\Http\Controllers\Admin;

use App\Models\Student;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Models\StudentAcademic;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class StudentController extends Controller
{
    public function index()
    {
        return view('admin.students.index');
    }


    public function data()
    {
        $students = Student::with([
            'currentAcademic.section.class',
            'currentAcademic.section.teacher'
        ]);

        return DataTables::of($students)

            ->addColumn('student_name', function ($row) {

                return $row->first_name;
            })

            ->addColumn('class', function ($row) {

                return $row->currentAcademic->section->class->name ?? '-';
            })

            ->addColumn('section', function ($row) {

                return $row->currentAcademic->section->name ?? '-';
            })

            ->addColumn('teacher', function ($row) {

                return $row->currentAcademic->section->teacher->name ?? '-';
            })

            ->addColumn('roll_no', function ($row) {

                return $row->currentAcademic->roll_no ?? '-';
            })

            ->addColumn('academic_year', function ($row) {

                return $row->currentAcademic->academic_year ?? '-';
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

            ->rawColumns(['action'])

            ->make(true);
    }


    public function create()
    {
        $sections = Section::with('class')->get();

        return view(
            'admin.students.create',
            compact('sections')
        );
    }


    public function store(Request $request)
    {

    // dd($request);
        $request->validate([

            'admission_no' => 'required|unique:students',

            'section_id' => 'required|exists:sections,id',

            'academic_year' => 'required',

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

            StudentAcademic::create([

                'student_id' => $student->id,

                'section_id' => $request->section_id,

                'academic_year' => $request->academic_year,

                'roll_no' => $request->roll_no,

                'status' => 'studying'
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


    public function destroy($id)
    {
        Student::findOrFail($id)->delete();

        return response()->json([

            'success' => true
        ]);
    }
}