<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subject;
use App\Models\TeacherDetail;
use Yajra\DataTables\Facades\DataTables;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = User::with('teacherDetail')
            ->where('role', 'teacher')
            ->get();

        return view('admin.teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('admin.teachers.create');
    }

    public function store(Request $request)
    {
        // BACKEND VALIDATION
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|digits:10',
            'qualification' => 'required',
            'experience_type' => 'required',
            'address' => 'required'
        ]);

        // CREATE USER
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('Teacher@123'),
            'role' => 'teacher'
        ]);

        // CREATE DETAILS
        TeacherDetail::create([
            'user_id' => $user->id,
            'phone' => $request->phone,
            'qualification' => $request->qualification,
            'experience_type' => $request->experience_type,
            'address' => $request->address
        ]);

        return back()->with('success', 'Teacher Created');
    }
   public function destroy($id)
{
    $teacher = User::findOrFail($id);
    $teacher->delete(); 

    return response()->json([
        'message' => 'Teacher deleted successfully'
    ]);
}
  

// public function data()
// {
//     $teachers = User::with('teacherDetail')
//         ->where('role', 'teacher');

//     return DataTables::of($teachers)
//         ->addColumn('phone', function ($row) {
//             return $row->teacherDetail->phone ?? '';
//         })
//         ->addColumn('qualification', function ($row) {
//             return $row->teacherDetail->qualification ?? '';
//         })
//         ->addColumn('action', function ($row) {
//             return '
//                 <form method="POST" action="'.route('teachers.delete',$row->id).'">
//                     '.csrf_field().method_field("DELETE").'
//                     <button class="btn btn-danger btn-sm"> <i class="bi bi-trash"></i></button>
//                 </form>
//             ';
//         })
//         ->rawColumns(['action'])
//         ->make(true);
// }
 

// public function data()
// {

//  $type = $request->type ?? 'active';
//     $teachers = User::with('teacherDetail')
//         ->where('role', 'teacher');
//  if ($type == 'deleted') {
//         $query = $query->onlyTrashed(); // key line
//     }
//     return DataTables::of($teachers)
//         ->addColumn('phone', function ($row) {
//             return $row->teacherDetail->phone ?? '';
//         })
//         ->addColumn('qualification', function ($row) {
//             return $row->teacherDetail->qualification ?? '';
//         })
//         ->addColumn('action', function ($row) {
//             return $row->id; 
//         })
//         ->rawColumns(['action'])
//         ->make(true);
// }
public function data(Request $request)
{
    $type = $request->type ?? 'active';

    $query = User::with('teacherDetail')
        ->where('role', 'teacher');

    if ($type == 'deleted') {
        $query = $query->onlyTrashed(); // deleted
    }

    return DataTables::of($query)
        ->addColumn('phone', fn($row) => optional($row->teacherDetail)->phone)
        ->addColumn('qualification', fn($row) => optional($row->teacherDetail)->qualification)
        ->addColumn('action', fn($row) => $row->id)
        ->make(true);
}
public function restore($id)
{
    $teacher = User::onlyTrashed()->findOrFail($id);
    $teacher->restore();

    return response()->json([
        'message' => 'Teacher restored successfully'
    ]);
}

public function mySubjects()
{
    $teacherId = auth()->id();

    $subjects = Subject::with('class')
        ->whereHas('teachers', function ($q) use ($teacherId) {
            $q->where('users.id', $teacherId);
        })
        ->get();

    return view('teacher.subjects', compact('subjects'));
}

}
