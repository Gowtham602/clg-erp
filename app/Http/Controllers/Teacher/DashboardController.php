<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;

class DashboardController extends Controller
{
    // teacher subject mapping list 
    // public function teacherSubjects()
// {
//     $teacherId = auth()->id();

//     $subjects = Subject::whereHas('class', function ($q) use ($teacherId) {
//         $q->where('teacher_id', $teacherId);
//     })->with('class')->get();

//     return view('teacher.subjects.index', compact('subjects'));
// }
public function teacherSubjects()
{
    $subjects = auth()->user()
        ->subjects() //  pivot relation
        ->with('class')
        ->get();

    return view('teacher.subjects.index', compact('subjects'));
}

}
