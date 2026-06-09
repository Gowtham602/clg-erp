<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\Semester;
use Yajra\DataTables\Facades\DataTables;
class SemesterController extends Controller
{
    public function index()
{
    $courses = ClassModel::all();

    return view('admin.semesters.index', compact('courses'));
}
public function data()
{
    $semesters = Semester::with('course');

    return DataTables::of($semesters)

        ->addIndexColumn()

        ->addColumn('course', function ($row) {

            return $row->course->name ?? '-';
        })

        ->addColumn('status', function ($row) {

            return $row->status

                ? '<span class="badge bg-success">Active</span>'

                : '<span class="badge bg-danger">Inactive</span>';
        })

        ->addColumn('action', function ($row) {

            return '

                <button
                    class="btn btn-primary btn-sm editBtn"
                    data-id="'.$row->id.'">

                    <i class="bi bi-pencil"></i>

                </button>

                <button
                    class="btn btn-danger btn-sm deleteBtn"
                    data-id="'.$row->id.'">

                    <i class="bi bi-trash"></i>

                </button>
            ';
        })

        ->rawColumns([
            'status',
            'action'
        ])

        ->make(true);
}


public function store(Request $request)
{
    $request->validate([
        'course_id' => 'required',
        'name' => ['required',Rule::unique('semesters')
                ->where(function ($query) use ($request) {
                    return $query->where(
                        'course_id',
                        $request->course_id
                    );
                })
        ],
        'semester_no' => ['required',Rule::unique('semesters')
                ->where(function ($query) use ($request) {
                    return $query->where(
                        'course_id',
                        $request->course_id
                    );
                })
        ]
    ],[

      'name.required' => 'Semester name is required',

        'semester_no.required' => 'Semester number is required',

        'name.unique' => 'This semester already exists for the selected course',

        'semester_no.unique' => 'Semester number already exists for this course'

    ]);
    $course = ClassModel::find($request->course_id);

if($request->semester_no > $course->total_semesters){

    return response()->json([
        'message' => 'Semester exceeds course limit'
    ],422);
}

    Semester::create([

        'course_id' => $request->course_id,

        'name' => $request->name,

        'semester_no' => $request->semester_no,

        'status' => $request->status
    ]);

    return response()->json([

        'status' => true,

        'message' => 'Semester Added Successfully'
    ]);
}
public function edit($id)
{
    return Semester::findOrFail($id);
}
public function update(Request $request, $id)
{
    $semester = Semester::findOrFail($id);

    $request->validate([

        'course_id' => 'required',

        'name' => [

            'required',

            Rule::unique('semesters')
                ->ignore($id)
                ->where(function ($query) use ($request) {

                    return $query->where(
                        'course_id',
                        $request->course_id
                    );

                })
        ],

        'semester_no' => [

            'required',

            Rule::unique('semesters')
                ->ignore($id)
                ->where(function ($query) use ($request) {

                    return $query->where(
                        'course_id',
                        $request->course_id
                    );

                })
        ]

    ],[

        'name.unique' => 'Semester already exists for this course',

        'semester_no.unique' => 'Semester number already exists for this course'

    ]);
    $course = ClassModel::find($request->course_id);

if($request->semester_no > $course->total_semesters){

    return response()->json([
        'message' => 'Semester exceeds course limit'
    ],422);
}
    $semester->update([

        'course_id' => $request->course_id,

        'name' => $request->name,

        'semester_no' => $request->semester_no,

        'status' => $request->status
    ]);

    return response()->json([

        'status' => true,

        'message' => 'Semester Updated Successfully'
    ]);
}
public function destroy($id)
{
    Semester::findOrFail($id)
        ->delete();

    return response()->json([

        'status' => true,

        'message' => 'Semester Deleted Successfully'
    ]);
}
}
