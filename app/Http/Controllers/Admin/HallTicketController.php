<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exams;
use App\Models\Student;
use App\Models\ExamSchedule;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\StudentAcademic;
class HallTicketController extends Controller
{
public function index(Request $request)
{
    $exams = Exams::latest()->get();

    $student = null;
    // dd($student);
    $selectedExam = null;

    if(
        $request->filled('exam_id') &&
        $request->filled('admission_no')
    )
    {
        $student = Student::with([
    'academic.course',
    'academic.semester',
    'academic.academicYear'
])
->where(
    'admission_no',
    $request->admission_no
)
->first();

        $selectedExam =
            Exams::find($request->exam_id);
            // dd($student);
    }

    return view(
        'admin.hall-tickets.index',
        compact(
            'exams',
            'student',
            'selectedExam'
        )
    );
}

    // public function show(Student $student, Exams $exam)
    // {
    //     $schedules = $exam->schedules()
    //         ->with('subject')
    //         ->orderBy('exam_date')
    //         ->get();

    //     return view('admin.hall-tickets.preview',compact('student','exam','schedules'));
    // }

//     public function show(Student $student, Exams $exam)
// {
//     $student->load([
//         'academic.course',
//         'academic.semester'
//     ]);

//     if (
//         !$student->academic ||
//         $student->academic->course_id != $exam->class_id ||
//         $student->academic->semester_id != $exam->semester_id
//     ) {
//         return redirect()
//             ->route('hall-tickets.index')
//             ->with(
//                 'error',
//                 'Student Course/Semester does not match selected Exam'
//             );
//     }

//     $schedules = ExamSchedule::with('subject')
//         ->where('exam_id', $exam->id)
//         ->orderBy('exam_date')
//         ->get();

//     return view(
//         'admin.hall-tickets.preview',
//         compact(
//             'student',
//             'exam',
//             'schedules'
//         )
//     );
// }

public function show(Student $student, Exams $exam)
{
    $student->load([
        'academic.course',
        'academic.semester'
    ]);
// dd([
//     'student_course'   => $student->academic->course_id,
//     'student_semester' => $student->academic->semester_id,

//     'exam_course'      => $exam->class_id,
//     'exam_semester'    => $exam->semester_id,
// ]);
    if (
        !$student->academic ||
        $student->academic->course_id != $exam->class_id ||
        $student->academic->semester_id != $exam->semester_id
    ) {

        return redirect()
            ->route('hall-tickets.index')
            ->with(
                'error',
                'Student does not belong to this Exam Course/Semester'
            );
    }

    $schedules = ExamSchedule::with('subject')
        ->where('exam_id', $exam->id)
        ->orderBy('exam_date')
        ->get();

    return view(
        'admin.hall-tickets.preview',
        compact(
            'student',
            'exam',
            'schedules'
        )
    );
}

//     public function download(Student $student, Exams $exam)
// {
//     $student->load([
//         'academic.course',
//         'academic.semester'
//     ]);

//     $schedules = ExamSchedule::with('subject')
//         ->where('exam_id',$exam->id)
//         ->orderBy('exam_date')
//         ->get();

//     $pdf = Pdf::loadView(
//         'admin.pdf.hall-ticket',
//         compact(
//             'student',
//             'exam',
//             'schedules'
//         )
//     );

//     return $pdf->download(
//         'Hall-Ticket-'.$student->admission_no.'.pdf'
//     );
// }

public function download(Student $student, Exams $exam)
{
    $student->load([
        'academic.course',
        'academic.semester'
    ]);

    if (
        !$student->academic ||
        $student->academic->course_id != $exam->class_id ||
        $student->academic->semester_id != $exam->semester_id
    ) {
        return redirect()
            ->route('hall-tickets.index')
            ->with(
                'error',
                'Student Course/Semester does not match selected Exam'
            );
    }

    $schedules = ExamSchedule::with('subject')
        ->where('exam_id', $exam->id)
        ->orderBy('exam_date')
        ->get();

    $pdf = Pdf::loadView(
        'admin.pdf.hall-ticket',
        compact(
            'student',
            'exam',
            'schedules'
        )
    );

    return $pdf->download(
        'Hall-Ticket-'.$student->admission_no.'.pdf'
    );
}
}
