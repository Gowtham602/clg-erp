<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DepartmentController extends Controller
{
    public function index()
    {
        return view('admin.departments.index');
    }

    public function data()
    {
        return DataTables::of(
            Department::latest()
        )

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

        'name' => 'required|unique:departments,name',

        'code' => 'required|unique:departments,code'

    ],[

        'name.required' => 'Department name is required.',

        'name.unique' => 'Department already exists.',

        'code.required' => 'Department code is required.',

        'code.unique' => 'Department code already exists.'
    ]);

    Department::create([

        'name' => $request->name,

        'code' => strtoupper($request->code),

        'status' => $request->status
    ]);

    return response()->json([

        'status' => true,

        'message' => 'Department Created Successfully'
    ]);
}
    public function edit($id)
    {
        return Department::findOrFail($id);
    }

    public function update(Request $request,$id)
{
    $department = Department::findOrFail($id);

    $request->validate([

        'name' => 'required|unique:departments,name,'.$id,

        'code' => 'required|unique:departments,code,'.$id

    ],[

        'name.required' => 'Department name is required.',

        'name.unique' => 'Department already exists.',

        'code.required' => 'Department code is required.',

        'code.unique' => 'Department code already exists.'
    ]);

    $department->update([

        'name' => $request->name,

        'code' => strtoupper($request->code),

        'status' => $request->status
    ]);

    return response()->json([

        'status' => true,

        'message' => 'Department Updated Successfully'
    ]);
}

    public function destroy($id)
    {
        Department::findOrFail($id)
            ->delete();

        return response()->json([
            'status' => true
        ]);
    }
}