<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubjectController extends Controller
{

    // INDEX

    public function index()
    {
        $classes = ClassModel::with([

            'subjects' => function ($query) {

                $query->latest();

            }

        ])->latest()->get();


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
        $classes = ClassModel::latest()->get();

        return view(
            'admin.subjects.create',
            compact('classes')
        );
    }




    // STORE

    public function store(Request $request)
    {
        $request->validate([

            'class_id' => 'required|exists:classes,id',

            'name' => [

                'required',

                Rule::unique('subjects')
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

            'name.required' => 'Subject name is required.',

            'name.unique' =>
                'This subject already exists for selected class.'

        ]);


        Subject::create([

            'class_id' => $request->class_id,

            'name' => trim($request->name)

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

        $classes = ClassModel::latest()->get();

        return view(
            'admin.subjects.edit',
            compact(
                'subject',
                'classes'
            )
        );
    }




    // UPDATE

    public function update(Request $request, $id)
    {
        $request->validate([

            'class_id' => 'required|exists:classes,id',

            'name' => [

                'required',

                Rule::unique('subjects')
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

            'name.required' => 'Subject name is required.',

            'name.unique' =>
                'This subject already exists for selected class.'

        ]);


        $subject = Subject::findOrFail($id);

        $subject->update([

            'class_id' => $request->class_id,

            'name' => trim($request->name)

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