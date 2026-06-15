<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeacherDetail;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Subject;
use Yajra\DataTables\Facades\DataTables;

class TeacherController extends Controller
{
    public function index()
{
    // dd("hi");

    $teachers = TeacherDetail::with([
        'user',
        'department',
        'designation'
    ])
    ->latest()
    ->get();

    return view(
        'admin.teachers.index',
        compact('teachers')
    );
}


public function create()
{
    //    dd("hi");
    $departments = Department::where('status',1)
                    ->orderBy('name')
                    ->get();

    $designations = Designation::where('status',1)
                    ->orderBy('name')
                    ->get();

    return view('admin.teachers.create', compact(
        'departments',
        'designations'
    ));
}

    public function store(Request $request)
    {
        // dd($request);
        $request->validate([

            'name' => 'required|max:100',

            'email' => 'required|email|unique:users,email',

            'employee_id' =>
            'required|unique:teacher_details,employee_id',

            'department_id' => 'required|exists:departments,id',

            'designation_id' => 'required|exists:designations,id',      
            'phone' =>
            'required|digits:10',

            'gender' =>
            'required',

            'qualification' =>
            'required',

            'joining_date' =>
            'required',

            'address' =>
            'required'
        ]);


        $user = User::create([

            'name' => $request->name,

            'email' => $request->email,

            'password' => bcrypt('Teacher@123'),

            'role' => 'teacher'
        ]);


        TeacherDetail::create([

            'user_id' => $user->id,

            'employee_id' => $request->employee_id,

            'phone' => $request->phone,
            'department_id' => $request->department_id,

            'designation_id' => $request->designation_id,

            'employment_type' => $request->employment_type,

            'alternate_phone' =>
            $request->alternate_phone,

            'gender' => $request->gender,

            'dob' => $request->dob,

            'qualification' =>
            $request->qualification,

            'experience' =>
            $request->experience,

            'joining_date' =>
            $request->joining_date,

            'salary' =>
            $request->salary,

            'blood_group' =>
            $request->blood_group,

            'aadhaar_no' =>
            $request->aadhaar_no,

            'address' =>
            $request->address,

            'city' =>
            $request->city,

            'state' =>
            $request->state,

            'pincode' =>
            $request->pincode,
        ]);


        return response()->json([

            'success' => true,

            'message' =>
            'Teacher Created Successfully'
        ]);
    }

    // TeacherController.php

  public function edit($id)
{
    $teacher = TeacherDetail::with([
        'user',
        'department',
        'designation'
    ])->findOrFail($id);

    $departments = Department::where('status',1)->get();

    $designations = Designation::where('status',1)->get();

    return view(
        'admin.teachers.edit',
        compact(
            'teacher',
            'departments',
            'designations'
        )
    );
}



    public function update(Request $request, $id)
{
    $teacher = TeacherDetail::with('user')
        ->findOrFail($id);

   $request->validate([

    'name' => 'required|string|max:100',

    'email' => 'required|email|unique:users,email,' . $teacher->user_id,

    'phone' => 'required|digits:10',

    'department_id' => 'required|exists:departments,id',

    'designation_id' => 'required|exists:designations,id',

    'employment_type' => 'required',

    'gender' => 'required',

    'qualification' => 'required|max:100',

    'joining_date' => 'required|date',

    'aadhaar_no' => 'nullable|digits:12',

    'pincode' => 'nullable|digits:6',

    'address' => 'required|max:500',
]);

    $teacher->user->update([

        'name' => $request->name,

        'email' => $request->email,
    ]);

   $teacher->update([

    'department_id' => $request->department_id,

    'designation_id' => $request->designation_id,

    'employment_type' => $request->employment_type,

    'phone' => $request->phone,

    'alternate_phone' => $request->alternate_phone,

    'gender' => $request->gender,

    'qualification' => $request->qualification,

    'experience' => $request->experience,

    'joining_date' => $request->joining_date,

    'aadhaar_no' => $request->aadhaar_no,

    'city' => $request->city,

    'state' => $request->state,

    'pincode' => $request->pincode,

    'address' => $request->address,
]);

    return response()->json([

        'success' => true,

        'message' => 'Teacher Updated Successfully'
    ]);
}




   public function destroy($id)
{
    $teacher = TeacherDetail::with('user')
        ->findOrFail($id);

    // soft delete user
    if ($teacher->user) {

        $teacher->user->delete();
    }

    // soft delete teacher detail
    $teacher->delete();

    return response()->json([

        'success' => true,

        'message' => 'Teacher Deleted Successfully'
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
 // TeacherController.php

// public function data(Request $request)
// {
//     $type = $request->type ?? 'active';

//     $query = TeacherDetail::with('user');

//     if ($type == 'deleted') {

//         $query = $query->onlyTrashed();

//     } else {

//         $query = $query->whereNull('deleted_at');
//     }

//     return DataTables::of($query)

//         ->addColumn('name', function ($row) {

//             return optional($row->user)->name;
//         })

//         ->addColumn('email', function ($row) {

//             return optional($row->user)->email;
//         })

//         ->addColumn('phone', function ($row) {

//             return $row->phone;
//         })

//         ->addColumn('qualification', function ($row) {

//             return $row->qualification;
//         })

//         ->addColumn('status', function ($row) {

//             return $row->status;
//         })

//         ->addColumn('id', function ($row) {

//             // IMPORTANT
//             return $row->id;
//         })

//         ->make(true);
// }
// public function data(Request $request)
// {
//     $type = $request->type ?? 'active';

//     $query = TeacherDetail::with([

//         'user' => function($q){

//             $q->withTrashed();
//         }
//     ]);



//     if ($type == 'deleted') {

//         $query = $query->onlyTrashed();

//     } else {

//         $query = $query->whereNull('deleted_at');
//     }



//     return DataTables::of($query)

//         ->addColumn('name', function ($row) {

//             return optional($row->user)->name;
//         })

//         ->addColumn('email', function ($row) {

//             return optional($row->user)->email;
//         })

//         ->addColumn('phone', function ($row) {

//             return $row->phone;
//         })

//         ->addColumn('qualification', function ($row) {

//             return $row->qualification;
//         })

//         ->addColumn('status', function ($row) {

//             return $row->status;
//         })

//         ->addColumn('id', function ($row) {

//             return $row->id;
//         })

//         ->make(true);
// }
public function data(Request $request)
{
    $type = $request->type ?? 'active';

    $query = TeacherDetail::with([
        'user' => fn($q) => $q->withTrashed(),
        'department',
        'designation'
    ]);

    if ($type === 'deleted') {
        $query->onlyTrashed();
    } else {
        $query->whereNull('deleted_at');
    }

    return DataTables::of($query)

        ->addColumn('name', fn($row) =>
            optional($row->user)->name
        )

        ->addColumn('email', fn($row) =>
            optional($row->user)->email
        )

        ->addColumn('department', fn($row) =>
            optional($row->department)->name ?? '-'
        )

        ->addColumn('designation', fn($row) =>
            optional($row->designation)->name ?? '-'
        )

        ->addColumn('phone', fn($row) =>
            $row->phone
        )

        ->addColumn('joining_date', fn($row) =>
            $row->joining_date
                ? \Carbon\Carbon::parse($row->joining_date)
                    ->format('d-m-Y')
                : '-'
        )

        ->addColumn('status', function ($row) use ($type) {

            if ($type == 'deleted') {
                return '<span class="badge bg-danger">Deleted</span>';
            }

            return '<span class="badge bg-success">Active</span>';
        })

        ->addColumn('action', function ($row) use ($type) {

            if ($type == 'deleted') {

                return '
                    <button
                        onclick="restoreTeacher('.$row->id.')"
                        class="btn btn-success btn-sm">
                        <i class="bi bi-arrow-clockwise"></i>
                    </button>
                ';
            }

            $editUrl = route('teachers.edit', $row->id);

            return '
                <a href="'.$editUrl.'"
                    class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil-fill"></i>
                </a>

                <button
                    onclick="deleteTeacher('.$row->id.')"
                    class="btn btn-danger btn-sm">
                    <i class="bi bi-trash-fill"></i>
                </button>
            ';
        })

        ->rawColumns(['status', 'action'])
        ->make(true);
}
   public function restore($id)
{
    $teacher = TeacherDetail::withTrashed()
        ->with('user')
        ->findOrFail($id);

    // restore teacher
    $teacher->restore();

    // restore user
    if ($teacher->user()->withTrashed()->first()) {

        $teacher->user()->withTrashed()->restore();
    }

    return response()->json([

        'success' => true,

        'message' => 'Teacher Restored Successfully'
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
