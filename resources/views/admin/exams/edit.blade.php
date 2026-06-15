@extends('layouts.app')

@section('content')

<div class="container-fluid">

```
<div class="card shadow border-0">

    <div class="card-header bg-warning d-flex justify-content-between align-items-center">

        <h5 class="mb-0 text-dark">

            <i class="bi bi-pencil-square"></i>

            Edit Exam

        </h5>

        <a href="{{ route('exams.index') }}"
           class="btn btn-dark btn-sm">

            Back

        </a>

    </div>

    <div class="card-body">

        <form action="{{ route('exams.update',$exam->id) }}"
              method="POST"
              id="examForm">

            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Exam Name
                    </label>

                    <input type="text"
                           name="name"
                           value="{{ old('name',$exam->name) }}"
                           class="form-control">

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Academic Year
                    </label>

                    <select name="academic_year_id"
                            class="form-select">

                        @foreach($academicYears as $year)

                        <option value="{{ $year->id }}"
                            {{ $exam->academic_year_id == $year->id ? 'selected' : '' }}>

                            {{ $year->name }}

                        </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Course
                    </label>

                    <select name="class_id"
                            id="class_id"
                            class="form-select">

                        @foreach($classes as $class)

                        <option value="{{ $class->id }}"
                            {{ $exam->class_id == $class->id ? 'selected' : '' }}>

                            {{ $class->name }}

                        </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Semester
                    </label>

                    <select name="semester_id"
                            id="semester_id"
                            class="form-select">

                        @foreach($semesters as $semester)

                        <option value="{{ $semester->id }}"
                            {{ $exam->semester_id == $semester->id ? 'selected' : '' }}>

                            {{ $semester->name }}

                        </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Exam Type
                    </label>

                    <select name="exam_type"
                            class="form-select">

                        <option value="Internal"
                            {{ $exam->exam_type == 'Internal' ? 'selected' : '' }}>

                            Internal

                        </option>

                        <option value="Semester"
                            {{ $exam->exam_type == 'Semester' ? 'selected' : '' }}>

                            Semester

                        </option>

                        <option value="Supplementary"
                            {{ $exam->exam_type == 'Supplementary' ? 'selected' : '' }}>

                            Supplementary

                        </option>

                    </select>

                </div>

                <div class="col-md-3 mb-3">

                    <label class="form-label">
                        Start Date
                    </label>

                    <input type="date"
                           name="start_date"
                           value="{{ $exam->start_date }}"
                           class="form-control">

                </div>

                <div class="col-md-3 mb-3">

                    <label class="form-label">
                        End Date
                    </label>

                    <input type="date"
                           name="end_date"
                           value="{{ $exam->end_date }}"
                           class="form-control">

                </div>

            </div>

            <div class="text-end">

                <button type="submit"
                        class="btn btn-warning">

                    <i class="bi bi-save"></i>

                    Update Exam

                </button>

            </div>

        </form>

    </div>

</div>
```

</div>

@endsection
