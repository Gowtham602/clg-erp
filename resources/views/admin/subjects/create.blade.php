@extends('layouts.app')

@section('content')

<div class="container-fluid py-4">

    <!-- HEADER -->

    <div class="card border-0 shadow-lg rounded-4 overflow-hidden mb-4">

        <div class="card-body bg-primary text-white p-4">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                <div>

                    <h2 class="fw-bold mb-1">

                        <i class="bi bi-book-half me-2"></i>

                        Add Subject

                    </h2>

                    <p class="mb-0 opacity-75">

                        Create new subject for academic class

                    </p>

                </div>



                <a href="{{ route('subjects.index') }}"
                    class="btn btn-light btn-lg rounded-pill px-4 shadow-sm">

                    <i class="bi bi-arrow-left-circle me-2"></i>

                    Back

                </a>

            </div>

        </div>

    </div>





    <!-- FORM CARD -->

    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

        <div class="card-body p-4">

            <form
                action="{{ route('subjects.store') }}"
                method="POST">

                @csrf



                <div class="row">

                    <!-- CLASS -->
                    <!-- COURSE -->

                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-semibold">
                            Course
                        </label>

                        <select name="class_id" id="class_id" class="form-select">
                            <option value=""> Select Course</option>

                            @foreach($classes as $class)
                            <option value="{{ $class->id }}">
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

                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-semibold">
                            Semester
                        </label>

                        <select
    name="semester_id"
    id="semester_id"
    class="form-select @error('semester_id') is-invalid @enderror">

    <option value="">Select Semester</option>

</select>

@error('semester_id')
    <div class="invalid-feedback d-block">
        {{ $message }}
    </div>
@enderror
                    </div>

                    <!-- SUBJECT CODE -->
<div class="col-md-6 mb-4">

    <label class="form-label fw-semibold">
        Subject Code
    </label>

    <input
        type="text"
        name="subject_code"
        value="{{ old('subject_code') }}"
        class="form-control form-control-lg rounded-4 @error('subject_code') is-invalid @enderror"
        placeholder="Example: BCA101">

    @error('subject_code')
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
    @enderror

</div>

                    <!-- SUBJECT NAME -->

                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-semibold">
                            Subject Name
                        </label>

                        <input type="text"  name="name" value="{{ old('name') }}" class="form-control form-control-lg rounded-4 @error('name') is-invalid @enderror">

                            @error('name')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                    </div>

                    <!-- SUBJECT TYPE -->

                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-semibold">
                            Subject Type
                        </label>

                        <select
                            name="subject_type"
                            class="form-select form-select-lg rounded-4">

                            <option value="Theory">Theory</option>
                            <option value="Lab">Lab</option>

                        </select>
                    </div>

                    <!-- CREDITS -->

                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-semibold">
                            Credits
                        </label>

                       <input  type="number"  name="credits"  value="{{ old('credits') }}"  class="form-control form-control-lg rounded-4 @error('credits') is-invalid @enderror">

@error('credits')
    <div class="invalid-feedback d-block">
        {{ $message }}
    </div>
@enderror
                    </div>

                    <!-- MAX MARKS -->

                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-semibold">
                            Maximum Marks
                        </label>

                        <input
                            type="number"
                            name="max_marks"
                            value="{{ old('max_marks',100) }}"
                            class="form-control form-control-lg rounded-4">
                    </div>

                    <!-- PASS MARKS -->

                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-semibold">
                            Pass Marks
                        </label>

                        <input
                            type="number"
                            name="pass_marks"
                            value="{{ old('pass_marks',40) }}"
                            class="form-control form-control-lg rounded-4">
                    </div>

                    <!-- STATUS -->

                    <div class="col-md-12 mb-4">
                        <label class="form-label fw-semibold">
                            Status
                        </label>

                        <select
                            name="status"
                            class="form-select form-select-lg rounded-4">

                            <option value="1">Active</option>
                            <option value="0">Inactive</option>

                        </select>
                    </div>

                </div>





                <!-- BUTTONS -->

                <div class="d-flex justify-content-end gap-2 mt-3">

                    <a href="{{ route('subjects.index') }}"
                        class="btn btn-light border rounded-pill px-4">

                        Cancel

                    </a>



                    <button
                        type="submit"
                        class="btn btn-primary rounded-pill px-5 shadow-sm">

                        <i class="bi bi-check-circle-fill me-2"></i>

                        Save Subject

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
@push('scripts')

<script>
    // for  course and semester
    $(document).ready(function() {

        $('#class_id').on('change', function() {

            let courseId = $(this).val();

            $('#semester_id').empty()
                .append('<option value="">Select Semester</option>');

            if (courseId === '') {
                return;
            }

            $.ajax({

                url: "{{ route('subjects.semesters', ['course' => '__ID__']) }}"
                    .replace('__ID__', courseId),

                type: 'GET',

                dataType: 'json',

                success: function(response) {

                    $.each(response, function(index, semester) {

                        $('#semester_id').append(
                            `<option value="${semester.id}">
                            ${semester.name}
                        </option>`
                        );

                    });

                },

                error: function(xhr) {

                    console.error(xhr);

                    $('#semester_id').html(
                        '<option value="">No Semester Found</option>'
                    );

                }

            });

        });

    });
</script>
@endpush