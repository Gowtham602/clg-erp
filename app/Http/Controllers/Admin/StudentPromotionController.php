<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\ClassModel;
use App\Models\Semester;
use App\Models\Section;
use App\Models\StudentAcademic;
use App\Models\StudentHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentPromotionController extends Controller
{
    public function index()
    {
        $sections = Section::all();
        $academicYears = AcademicYear::where('status',1)->get();

        $courses = ClassModel::all();

        $semesters = Semester::where('status',1)->get();

        return view(
            'admin.student_promotions.index',
            compact(
                'academicYears',
                'courses',
                'semesters',
                'sections'
            )
        );
    }

    public function getStudents(Request $request)
    {
        $request->validate([

            'academic_year_id' => 'required',

            'course_id' => 'required',

            'semester_id' => 'required',

            'section_id' => 'required'
        ]);

        $students = StudentAcademic::with([
            'student',
            'course',
            'semester',
            'section'
        ])
        ->where('academic_year_id',$request->academic_year_id)
        ->where('course_id',$request->course_id)
        ->where('semester_id',$request->semester_id)
        ->where('section_id',$request->section_id)
        ->where('status','studying')
        ->get();

        return response()->json([
            'status' => true,
            'students' => $students
        ]);
    }

    public function promote(Request $request)
    {
        $request->validate([

            'academic_ids' => 'required|array',

            'new_academic_year_id' =>
                'required|exists:academic_years,id',

            'new_semester_id' =>
                'required|exists:semesters,id',

            'new_section_id' =>
                'required|exists:sections,id'
        ]);

        DB::beginTransaction();

        try {

            $academics = StudentAcademic::whereIn(
                'id',
                $request->academic_ids
            )->get();

            foreach($academics as $academic){

                StudentHistory::create([

                    'student_id' =>
                        $academic->student_id,

                    'from_academic_year_id' =>
                        $academic->academic_year_id,

                    'to_academic_year_id' =>
                        $request->new_academic_year_id,

                    'from_course_id' =>
                        $academic->course_id,

                    'to_course_id' =>
                        $academic->course_id,

                    'from_semester_id' =>
                        $academic->semester_id,

                    'to_semester_id' =>
                        $request->new_semester_id,

                    'from_section_id' =>
                        $academic->section_id,

                    'to_section_id' =>
                        $request->new_section_id,

                    'promoted_date' =>
                        now()
                ]);

                $academic->update([

                    'academic_year_id' =>
                        $request->new_academic_year_id,

                    'semester_id' =>
                        $request->new_semester_id,

                    'section_id' =>
                        $request->new_section_id
                ]);
            }

            DB::commit();

            return response()->json([

                'status' => true,

                'message' =>
                    'Students promoted successfully'
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([

                'status' => false,

                'message' => $e->getMessage()

            ],500);
        }
    }

    public function getSections($courseId)
{
    $sections = Section::where(
        'class_id',
        $courseId
    )->get();

    return response()->json($sections);
}

}