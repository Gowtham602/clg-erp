<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\StudentHistory;
use App\Models\StudentAcademic;
use Illuminate\Support\Facades\DB;

class PromotionController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $classes = ClassModel::with('sections')->get();

        $histories = StudentHistory::with([

            'student',
            'fromSection.classModel',
            'toSection.classModel'

        ])
        ->latest()
        ->limit(10)
        ->get();

        return view(
            'admin.promotion.index',
            compact('classes', 'histories')
        );
    }



    /*
    |--------------------------------------------------------------------------
    | PROMOTE STUDENTS
    |--------------------------------------------------------------------------
    */

    public function promote(Request $request)
    {
        $request->validate([

            'from_section' => 'required|exists:sections,id',

            'to_section' =>
                'required|exists:sections,id|different:from_section',

            'academic_year' => 'required',

            'new_academic_year' => 'required',
        ]);


        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | GET CURRENT YEAR STUDENTS
            |--------------------------------------------------------------------------
            */

            $students = StudentAcademic::where(

                    'section_id',
                    $request->from_section

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



            /*
            |--------------------------------------------------------------------------
            | LOOP STUDENTS
            |--------------------------------------------------------------------------
            */

            foreach ($students as $academic) {

                /*
                |--------------------------------------------------------------------------
                | OLD RECORD UPDATE
                |--------------------------------------------------------------------------
                */

                $academic->update([

                    'status' => 'promoted'
                ]);


                /*
                |--------------------------------------------------------------------------
                | NEW YEAR ENTRY
                |--------------------------------------------------------------------------
                */

                StudentAcademic::create([

                    'student_id' => $academic->student_id,

                    'section_id' => $request->to_section,

                    'academic_year' =>
                        $request->new_academic_year,

                    'roll_no' => $academic->roll_no,

                    'status' => 'studying'
                ]);


                /*
                |--------------------------------------------------------------------------
                | HISTORY SAVE
                |--------------------------------------------------------------------------
                */

                StudentHistory::create([

                    'student_id' => $academic->student_id,

                    'from_section_id' =>
                        $request->from_section,

                    'to_section_id' =>
                        $request->to_section,

                    'academic_year' =>
                        $request->new_academic_year,
                ]);
            }


            DB::commit();

            return back()->with(

                'success',
                'Students promoted successfully'
            );

        } catch (\Exception $e) {

            DB::rollBack();

            dd($e->getMessage());
        }
    }
}