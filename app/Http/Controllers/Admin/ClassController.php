<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class ClassController extends Controller
{

    // INDEX
    public function index()
{
    $totalClasses = ClassModel::count();

    $totalSections = Section::count();

    $activeClasses = ClassModel::count();



    // CLASS ORDER
    $classes = ClassModel::orderByRaw("

        CASE

            WHEN name = 'LKG' THEN -1

            WHEN name = 'UKG' THEN 0

            ELSE CAST(name AS UNSIGNED)

        END ASC

    ")->get();



    return view(
        'admin.classes.index',

        compact(

            'classes',

            'totalClasses',

            'totalSections',

            'activeClasses'
        )
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



            ->addColumn('action', function ($class) {

                return '

                    <button class="btn btn-primary btn-sm editBtn"
                            data-id="'.$class->id.'"
                            data-name="'.$class->name.'">

                        <i class="bi bi-pencil"></i>

                    </button>

                    <button class="btn btn-danger btn-sm deleteBtn"
                            data-id="'.$class->id.'">

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

            'name' => [

                'required',

                'unique:classes,name'

            ]

        ], [

            'name.required' => 'Department name is required',

            'name.unique' => 'This Department already exists'

        ]);



        ClassModel::create([

            'name' => $request->name

        ]);



        return response()->json([

            'status' => true,

            'message' => 'Class Added Successfully'

        ]);

    }





    // UPDATE
    public function update(Request $request, ClassModel $class)
    {

        $request->validate([

            'name' => [

                'required',

                Rule::unique('classes', 'name')->ignore($class->id)

            ]

        ], [

            'name.required' => 'Class name is required',

            'name.unique' => 'Class already exists'

        ]);



        $class->update([

            'name' => $request->name

        ]);



        return response()->json([

            'status' => true,

            'message' => 'Class Updated Successfully'

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