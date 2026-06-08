<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Department;

class ClassController extends Controller
{

    // INDEX
    //     public function index()
    // {
    //     $totalClasses = ClassModel::count();

    //     $totalSections = Section::count();

    //     $activeClasses = ClassModel::count();



    //     // CLASS ORDER
    //     $classes = ClassModel::orderByRaw("

    //         CASE

    //             WHEN name = 'LKG' THEN -1

    //             WHEN name = 'UKG' THEN 0

    //             ELSE CAST(name AS UNSIGNED)

    //         END ASC

    //     ")->get();



    //     return view(
    //         'admin.classes.index',

    //         compact(

    //             'classes',

    //             'totalClasses',

    //             'totalSections',

    //             'activeClasses'
    //         )
    //     );
    // }

    public function index()
    {
        $departments = Department::where(
            'status',
            1
        )->get();
       $totalClasses = ClassModel::count();
        $totalSections = Section::count();

        $activeClasses = ClassModel::count();
        return view(
            'admin.classes.index',
            compact('departments','totalClasses','totalSections','activeClasses')
        );
    }



    // DATATABLE
    public function data()
    {

        $classes = ClassModel::with('sections')

            ->orderByRaw("

        CASE

            WHEN name = 'LKG' THEN -1

            WHEN name = 'UKG' THEN 0

            ELSE CAST(name AS UNSIGNED)

        END ASC

    ");

        return DataTables::of($classes)

            ->addIndexColumn()



            ->addColumn('sections', function ($class) {

                if ($class->sections->count() > 0) {

                    return $class->sections->pluck('name')->implode(' , ');
                }

                return 'No Sections';
            })


                ->addColumn('department', function ($row) {

                return $row->department->name ?? '-';

                })
            ->addColumn('action', function ($class) {

                return '

                    <button class="btn btn-primary btn-sm editBtn"
                            data-id="' . $class->id . '"
                            data-name="' . $class->name . '">

                        <i class="bi bi-pencil"></i>

                    </button>

                    <button class="btn btn-danger btn-sm deleteBtn"
                            data-id="' . $class->id . '">

                        <i class="bi bi-trash"></i>

                    </button>

                ';
            })



            ->rawColumns(['action'])

            ->make(true);
    }





    // STORE
    public function store(Request $request)
    {
        $request->validate([

            'department_id' => 'required',

            'name' => 'required|unique:classes,name',

            'duration_years' => 'required|integer|min:1',

            'total_semesters' => 'required|integer|min:1'

        ], [

            'department_id.required' => 'Department is required',

            'name.required' => 'Course name is required',

            'name.unique' => 'Course already exists'
        ]);

        ClassModel::create([

            'department_id' => $request->department_id,

            'name' => $request->name,

            'duration_years' => $request->duration_years,

            'total_semesters' => $request->total_semesters,

            'status' => $request->status
        ]);

        return response()->json([

            'status' => true,

            'message' => 'Course Added Successfully'
        ]);
    }





    // UPDATE
    public function update(Request $request, ClassModel $class)
    {
        $request->validate([

            'department_id' => 'required',

            'name' => [
                'required',
                Rule::unique('classes', 'name')->ignore($class->id)
            ],

            'duration_years' => 'required',

            'total_semesters' => 'required'

        ]);

        $class->update([

            'department_id' => $request->department_id,

            'name' => $request->name,

            'duration_years' => $request->duration_years,

            'total_semesters' => $request->total_semesters,

            'status' => $request->status
        ]);

        return response()->json([

            'status' => true,

            'message' => 'Course Updated Successfully'
        ]);
    }





    // DELETE
    public function destroy(ClassModel $class)
    {

        $class->delete();

        return response()->json([

            'status' => true,

            'message' => 'Deleted Successfully'

        ]);
    }
}
