<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exams;
use App\Models\Subject;
use App\Models\ExamSchedule;
class ExamScheduleController extends Controller
{
        public function index()
    {
        $schedules = ExamSchedule::with([
            'exam',
            'subject'
        ])->latest()->get();

        return view('admin.exam_schedules.index', compact('schedules'));
    }

    public function getSubjectsByExam($id)
    {
        $exam = Exams::findOrFail($id);

        $subjects = Subject::where(
                'class_id',
                $exam->class_id
            )
            ->where(
                'semester_id',
                $exam->semester_id
            )
            ->where(
                'status',
                1
            )
            ->get();

        return response()->json($subjects);
    }

    public function create()
    {
        $exams = Exams::where('status', 1 )->get();
        $subjects = Subject::where('status',1)->get();

        return view('admin.exam_schedules.create',compact('exams','subjects'));
    }

  public function store(Request $request)
{
    $request->validate([

        'exam_id' => [
            'required',
            'exists:exams,id'
        ],

        'subject_id' => [
            'required',
            'exists:subjects,id'
        ],

        'exam_date' => [
            'required',
            'date'
        ],

        'start_time' => [
            'required'
        ],

        'end_time' => [
            'required',
            'after:start_time'
        ],

        'room_no' => [
            'nullable',
            'max:50'
        ],

    ]);
$exam = Exams::findOrFail(
    $request->exam_id
);

$subject = Subject::findOrFail(
    $request->subject_id
);

if(
    $exam->class_id != $subject->class_id
    ||
    $exam->semester_id != $subject->semester_id
){
    return back()->withErrors([
        'subject_id' =>
        'Invalid Subject For Selected Exam'
    ]);
}
    ExamSchedule::create($request->all());

    return redirect()
        ->route('exam-schedules.index')
        ->with('success', 'Exam Schedule Created Successfully');
}
public function edit(ExamSchedule $examSchedule)
{
    $exams = Exams::where('status', 1)->get();

    $subjects = Subject::where('status', 1)->get();

    return view(
        'admin.exam_schedules.edit',
        compact(
            'examSchedule',
            'exams',
            'subjects'
        )
    );
}


public function update(Request $request, ExamSchedule $examSchedule)
{
    $request->validate([

        'exam_id' => 'required|exists:exams,id',

        'subject_id' => 'required|exists:subjects,id',

        'exam_date' => 'required|date',

        'start_time' => 'required',

        'end_time' => 'required|after:start_time',

        'room_no' => 'nullable|max:50',

    ]);

    $examSchedule->update($request->all());    

    return redirect() 
        ->route('exam-schedules.index')
        ->with('success', 'Exam Schedule Updated Successfully');
}
public function destroy(ExamSchedule $examSchedule)
{
    $examSchedule->delete();

    return redirect()
        ->route('exam-schedules.index')
        ->with('success', 'Exam Schedule Deleted Successfully');
}
}
