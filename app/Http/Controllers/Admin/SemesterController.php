<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

        'semester_no' => 'required',

        'name' => 'required'
    ]);

    Semester::create($request->all());

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

    $semester->update($request->all());

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
