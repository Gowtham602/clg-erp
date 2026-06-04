<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;

class AcademicYearController extends Controller
{
    public function index()
    {
        return view('admin.academic-years.index');
    }

    public function data()
    {
        return DataTables::of(
            AcademicYear::latest()
        )

        ->addColumn('status', function ($row) {

            return $row->status
                ? '<span class="badge bg-success">Active</span>'
                : '<span class="badge bg-danger">Inactive</span>';
        })

        ->addColumn('action', function ($row) {

            return '
                <button
                    class="btn btn-primary btn-sm editBtn"
                    data-id="'.$row->id.'">
                     <i class="bi bi-pencil"></i>
                </button>

                <button
                    class="btn btn-danger btn-sm deleteBtn"
                    data-id="'.$row->id.'">
                     <i class="bi bi-trash"></i>
                </button>
            ';
        })

        ->rawColumns(['status','action'])

        ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required|unique:academic_years',

            'start_date' => 'required',

            'end_date' => 'required'
        ]);

        AcademicYear::create([

            'name' => $request->name,

            'start_date' => $request->start_date,

            'end_date' => $request->end_date,

            'status' => $request->status
        ]);

        return response()->json([
            'success' => true
        ]);
    }

    public function edit($id)
    {

        return AcademicYear::findOrFail($id);
    }


public function update(Request $request, $id)
{
    $request->validate([
        'name' => [
            'required',
            Rule::unique('academic_years')->ignore($id)
        ],
        'start_date' => 'required',
        'end_date' => 'required'
    ]);

    $year = AcademicYear::findOrFail($id);

    $year->update([
        'name' => $request->name,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'status' => $request->status
    ]);

    return response()->json([
        'success' => true
    ]);
}

    public function destroy($id)
    {
        AcademicYear::findOrFail($id)
            ->delete();

        return response()->json([
            'success' => true
        ]);
    }
}