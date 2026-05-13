<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use App\Models\ClassModel;
use App\Models\Section;

class DashBoardController extends Controller
{
    public function index()
    {
        $students = Student::count();

        $teachers = User::where('role', 'teacher')->count();

        $classes = ClassModel::count();

        $sections = Section::count();

        $recentStudents = Student::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'students',
            'teachers',
            'classes',
            'sections',
            'recentStudents'
        ));
    }
}