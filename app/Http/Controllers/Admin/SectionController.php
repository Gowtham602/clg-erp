<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class SectionController extends Controller
{

    // INDEX

    public function index(Request $request)
    {

        // DATATABLE AJAX

        if ($request->ajax()) {

            $sections = Section::with('classModel')
                ->latest();



            return DataTables::of($sections)

                ->addIndexColumn()



                // CLASS NAME

                ->addColumn('class_name', function ($row) {

                    return $row->classModel->name ?? '-';

                })



                // SECTION DESIGN

                ->editColumn('name', function ($row) {

                    return '

                        <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill fw-semibold">

                            '.$row->name.'

                        </span>

                    ';
                })



                // SEARCH CLASS

                ->filterColumn('class_name', function($query, $keyword) {

                    $query->whereHas('classModel', function($q) use ($keyword){

                        $q->where(
                            'name',
                            'like',
                            "%{$keyword}%"
                        );

                    });

                })



                // ACTION BUTTONS

                ->addColumn('action', function ($row) {

                    return '

                        <div class="d-flex gap-2 justify-content-center">

                            <button
                                class="btn btn-light border shadow-sm rounded-circle editBtn"
                                data-id="'.$row->id.'"
                                title="Edit"
                                style="width:42px;height:42px;">

                                <i class="bi bi-pencil-square text-primary"></i>

                            </button>



                            <button
                                class="btn btn-light border shadow-sm rounded-circle deleteBtn"
                                data-id="'.$row->id.'"
                                title="Delete"
                                style="width:42px;height:42px;">

                                <i class="bi bi-trash text-danger"></i>

                            </button>

                        </div>

                    ';
                })



                ->rawColumns([
                    'name',
                    'action'
                ])

                ->make(true);
        }



        // PAGE COUNTS

        $totalSections = Section::count();
                                            
        $totalClasses = ClassModel::count();



        // DROPDOWN CLASSES

        $classes = ClassModel::latest()->get();



        return view(
            'admin.sections.index',
            compact(
                'classes',
                'totalSections',
                'totalClasses'
            )
        );
    }






    // STORE

    public function store(Request $request)
    {

        $request->validate([

            'class_id' => 'required|exists:classes,id',

            'name' => [

                'required',

                Rule::unique('sections')
                    ->where(function ($query) use ($request) {

                        return $query->where(
                            'class_id',
                            $request->class_id
                        );

                    })

            ]

        ], [

            'class_id.required' => 'Class is required.',

            'class_id.exists' => 'Selected class invalid.',

            'name.required' => 'Section name is required.',

            'name.unique' =>
                'This section already exists for selected class.'

        ]);



        Section::create([

            'class_id' => $request->class_id,

            'name' => trim($request->name)

        ]);



        return response()->json([

            'status' => true,

            'message' => 'Section Added Successfully'

        ]);
    }






    // EDIT

    public function edit($id)
    {

        $section = Section::findOrFail($id);

        return response()->json($section);
    }






    // UPDATE

    public function update(Request $request, $id)
    {

        $request->validate([

            'class_id' => 'required|exists:classes,id',

            'name' => [

                'required',

                Rule::unique('sections')
                    ->ignore($id)
                    ->where(function ($query) use ($request) {

                        return $query->where(
                            'class_id',
                            $request->class_id
                        );

                    })

            ]

        ], [

            'class_id.required' => 'Class is required.',

            'class_id.exists' => 'Selected class invalid.',

            'name.required' => 'Section name is required.',

            'name.unique' =>
                'This section already exists for selected class.'

        ]);



        $section = Section::findOrFail($id);



        $section->update([

            'class_id' => $request->class_id,

            'name' => trim($request->name)

        ]);



        return response()->json([

            'status' => true,

            'message' => 'Section Updated Successfully'

        ]);
    }






    // DELETE

    public function destroy($id)
    {

        $section = Section::findOrFail($id);

        $section->delete();



        return response()->json([

            'status' => true,

            'message' => 'Section Deleted Successfully'

        ]);
    }
}