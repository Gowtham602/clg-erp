@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="card shadow border-0">

        <div class="card-header bg-primary text-white">

            <h5 class="mb-0">
                <i class="bi bi-file-earmark-pdf"></i>
                Hall Ticket Generation
            </h5>

        </div>

        <div class="card-body">

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">

            {{ session('error') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>
    @endif
            <form method="GET"
                action="{{ route('hall-tickets.index') }}">

                <div class="row">

                    <div class="col-md-4">

                        <label class="form-label">
                            Exam
                        </label>

                        <select
                            name="exam_id"
                            class="form-select">

                            <option value="">
                                Select Exam
                            </option>

                            @foreach($exams as $exam)

                            <option
                                value="{{ $exam->id }}"
                                {{ request('exam_id') == $exam->id ? 'selected' : '' }}>

                                {{ $exam->name }}

                            </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-4">

                        <label class="form-label">
                            Admission No
                        </label>

                        <input
                            type="text"
                            name="admission_no"
                            class="form-control"
                            value="{{ request('admission_no') }}">

                    </div>

                    <div class="col-md-2 d-flex align-items-end">

                        <button
                            class="btn btn-primary w-100">

                            Search

                        </button>

                    </div>

                </div>

            </form>

       @if($student)

<table class="table table-bordered">

    <tr>
        <th>Student Name</th>
        <td>
            {{ $student->first_name }}
            {{ $student->last_name }}
        </td>
    </tr>

    <tr>
        <th>Admission No</th>
        <td>{{ $student->admission_no }}</td>
    </tr>

    <tr>
        <th>Course</th>
        <td>
            {{ optional(optional($student->academic)->course)->name }}
        </td>
    </tr>

    <tr>
        <th>Semester</th>
        <td>
            {{ optional(optional($student->academic)->semester)->name }}
        </td>
    </tr>

</table>

<div class="mt-3">

    <a href="{{ route('hall-tickets.preview',[$student->id,$selectedExam->id]) }}"
       class="btn btn-success">

        Preview Hall Ticket

    </a>

    <a href="{{ route('hall-tickets.download',[$student->id,$selectedExam->id]) }}"
       class="btn btn-danger">

        Download PDF

    </a>

</div>

@endif

        </div>

    </div>

</div>

@endsection