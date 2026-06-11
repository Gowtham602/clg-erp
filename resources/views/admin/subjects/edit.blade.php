@extends('layouts.app')

@section('content')

<div class="container-fluid py-4">

<div class="card shadow border-0">

    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">
            <i class="bi bi-pencil-square me-2"></i>
            Edit Subject
        </h4>
    </div>

    <div class="card-body">

        <form action="{{ route('subjects.update',$subject->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="row">

                <!-- COURSE -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Course
                    </label>

                    <select
                        name="class_id"
                        id="class_id"
                        class="form-select @error('class_id') is-invalid @enderror">

                        <option value="">
                            Select Course
                        </option>

                        @foreach($classes as $class)

                            <option
                                value="{{ $class->id }}"
                                {{ old('class_id',$subject->class_id) == $class->id ? 'selected' : '' }}>

                                {{ $class->name }}

                            </option>

                        @endforeach

                    </select>

                    @error('class_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror

                </div>

                <!-- SEMESTER -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Semester
                    </label>

                    <select
                        name="semester_id"
                        id="semester_id"
                        class="form-select @error('semester_id') is-invalid @enderror">

                        @foreach($semesters as $semester)

                            <option
                                value="{{ $semester->id }}"
                                {{ old('semester_id',$subject->semester_id) == $semester->id ? 'selected' : '' }}>

                                {{ $semester->name }}

                            </option>

                        @endforeach

                    </select>

                    @error('semester_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror

                </div>

                <!-- SUBJECT CODE -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Subject Code
                    </label>

                    <input
                        type="text"
                        name="subject_code"
                        value="{{ old('subject_code',$subject->subject_code) }}"
                        class="form-control @error('subject_code') is-invalid @enderror">

                    @error('subject_code')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror

                </div>

                <!-- SUBJECT NAME -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Subject Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name',$subject->name) }}"
                        class="form-control @error('name') is-invalid @enderror">

                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror

                </div>

                <!-- SUBJECT TYPE -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Subject Type
                    </label>

                    <select
                        name="subject_type"
                        class="form-select">

                        <option value="Theory"
                            {{ $subject->subject_type == 'Theory' ? 'selected' : '' }}>
                            Theory
                        </option>

                        <option value="Lab"
                            {{ $subject->subject_type == 'Lab' ? 'selected' : '' }}>
                            Lab
                        </option>

                    </select>

                </div>

                <!-- CREDITS -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Credits
                    </label>

                    <input
                        type="number"
                        name="credits"
                        value="{{ old('credits',$subject->credits) }}"
                        class="form-control">

                </div>

                <!-- MAX MARKS -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Maximum Marks
                    </label>

                    <input
                        type="number"
                        name="max_marks"
                        value="{{ old('max_marks',$subject->max_marks) }}"
                        class="form-control">

                </div>

                <!-- PASS MARKS -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Pass Marks
                    </label>

                    <input
                        type="number"
                        name="pass_marks"
                        value="{{ old('pass_marks',$subject->pass_marks) }}"
                        class="form-control">

                </div>

                <!-- STATUS -->

                <div class="col-md-12 mb-3">

                    <label class="form-label">
                        Status
                    </label>

                    <select
                        name="status"
                        class="form-select">

                        <option value="1"
                            {{ $subject->status == 1 ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="0"
                            {{ $subject->status == 0 ? 'selected' : '' }}>
                            Inactive
                        </option>

                    </select>

                </div>

            </div>

            <button
                type="submit"
                class="btn btn-success">

                <i class="bi bi-check-circle me-2"></i>
                Update Subject

            </button>

        </form>

    </div>

</div>

</div>

@endsection

@push('scripts')

<script>

$('#class_id').change(function(){

    let courseId = $(this).val();

    $.get(
        '/admin/get-course-semesters/' + courseId,
        function(response){

            let options = '';

            $.each(response,function(i,row){

                options += `
                    <option value="${row.id}">
                        ${row.name}
                    </option>
                `;

            });

            $('#semester_id').html(options);

        }
    );

});

</script>

@endpush
