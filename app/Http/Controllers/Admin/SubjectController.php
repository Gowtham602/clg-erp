<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\ClassModel;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;


class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::with('class','teachers')->get();
        return view('admin.subjects.index', compact('subjects'));
    }

    public function create()
    {
        $classes = ClassModel::all();
        $teachers = User::where('role','teacher')->get();

        return view('admin.subjects.create', compact('classes','teachers'));
    }

    public function store(Request $request)
    {
        // dd('hi');
        $subject = Subject::create([
            'name' => $request->name,
            'class_id' => $request->class_id,
        ]);

        $subject->teachers()->sync($request->teacher_ids);

        return redirect()->route('subjects.index');
    }

    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        $classes = ClassModel::all();
        $teachers = User::where('role','teacher')->get();

        return view('admin.subjects.edit', compact('subject','classes','teachers'));
    }

    public function update(Request $request, $id)
    {
        $subject = Subject::findOrFail($id);

        $subject->update([
            'name' => $request->name,
            'class_id' => $request->class_id,
        ]);

        $subject->teachers()->sync($request->teacher_ids);

        return redirect()->route('subjects.index');
    }

    public function destroy($id)
    {
        Subject::findOrFail($id)->delete();
        return back();
    }

    public function data()
{
    $subjects = Subject::with(['class', 'teachers']);

    return DataTables::of($subjects)

        ->addIndexColumn()

        // CLASS
        ->addColumn('class', function ($row) {
            return $row->class->name ?? '-';
        })

        // TEACHERS
        ->addColumn('teachers', function ($row) {
            return $row->teachers->map(function ($t) {
                return '<span class="badge bg-primary me-1">'.$t->name.'</span>';
            })->implode(' ');
        })

        //  SEARCH FIX FOR RELATION
        ->filterColumn('class', function ($query, $keyword) {
            $query->whereHas('class', function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%");
            });
        })

        ->filterColumn('teachers', function ($query, $keyword) {
            $query->whereHas('teachers', function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%");
            });
        })

        // ACTION BUTTONS
        ->addColumn('action', function ($row) {

            $edit = route('subjects.edit', $row->id);
            $delete = route('subjects.destroy', $row->id);

            return "
                <a href='{$edit}' class='btn btn-sm btn-primary'>
                    <i class='bi bi-pencil'></i>
                </a>

                <button data-url='{$delete}' class='btn btn-sm btn-danger deleteBtn'>
                    <i class='bi bi-trash'></i>
                </button>
            ";
        })

        ->rawColumns(['teachers', 'action'])
        ->make(true);
}

}