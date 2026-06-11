@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <div class="card shadow border-0">
        <div class="card-header">
            <h4 class="mb-0"> Add Subject Teacher </h4>
        </div>
        <div class="card-body">
            <form action="{{ route('subject-teacher.store') }}"
                method="POST">
                @csrf

                <div class="mb-3">
    <label>Academic Year</label>

    <select name="academic_year_id"
            class="form-control">

        <option value="">
            Select Academic Year
        </option>

        @foreach($academicYears as $year)

            <option value="{{ $year->id }}">
                {{ $year->name }}
            </option>

        @endforeach

    </select>
</div>
                <!-- CLASS -->

                <div class="mb-3">
                    <label class="form-label">    Class   </label>
                    <select name="class_id"    id="class_id" class="form-control @error('class_id') is-invalid @enderror">
                        <option value="">  Select Class </option>
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
              
                <div class="mb-3">

    <label>Semester</label>

    <select name="semester_id"
            id="semester_id"
            class="form-control">

        <option value="">
            Select Semester
        </option>

    </select>

</div>
                <!-- SECTION -->
                <div class="mb-3">
                    <label class="form-label">
                        Section
                    </label>
                    <select name="section_id"
                        id="section_id"
                        class="form-control @error('section_id') is-invalid @enderror">

                        <option value="">
                            Select Section
                        </option>
                    </select>
                    @error('section_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                      <!-- SUBJECT -->
                <div class="mb-3">
                    <label class="form-label">    Subject </label>
                    <select name="subject_id"
                        id="subject_id"
                        class="form-control @error('subject_id') is-invalid @enderror">

                        <option value="">
                            Select Subject
                        </option>

                    </select>

                    @error('subject_id')

                    <div class="invalid-feedback">

                        {{ $message }}

                    </div>

                    @enderror

                </div>



                <!-- TEACHER -->

                <div class="mb-3">

                    <label class="form-label">
                        Teacher
                    </label>

                    <select name="teacher_id"
                        class="form-control @error('teacher_id') is-invalid @enderror">

                        <option value="">
                            Select Teacher
                        </option>

                        @foreach($teachers as $teacher)

                        <option value="{{ $teacher->id }}">

                            {{ $teacher->name }}

                        </option>

                        @endforeach

                    </select>

                    @error('teacher_id')

                    <div class="invalid-feedback">

                        {{ $message }}

                    </div>

                    @enderror

                </div>


<div class="mb-3">

    <label>Status</label>

    <select name="status"
            class="form-control">

        <option value="1">
            Active
        </option>

        <option value="0">
            Inactive
        </option>

    </select>

</div>

                <!-- BUTTON -->

                <button type="submit"
                    class="btn btn-primary">

                    Save

                </button>

            </form>

        </div>

    </div>

</div>

@endsection




@push('scripts')

<script>
$(document).ready(function () {

    $('#class_id').change(function () {

        let classId = $(this).val();

        // Semester
        $.get(
            "{{ route('get-semesters', ':id') }}"
            .replace(':id', classId),

            function(data){

                $('#semester_id').html(
                    '<option value="">Select Semester</option>'
                );

                $.each(data,function(i,row){

                    $('#semester_id').append(
                        `<option value="${row.id}">
                            ${row.name}
                        </option>`
                    );

                });

            }
        );

        // Subject
        $.get(
            "{{ route('get.subjects', ':id') }}"
            .replace(':id', classId),

            function(data){

                $('#subject_id').html(
                    '<option value="">Select Subject</option>'
                );

                $.each(data,function(i,row){

                    $('#subject_id').append(
                        `<option value="${row.id}">
                            ${row.name}
                        </option>`
                    );

                });

            }
        );

        // Section
        $.get(
            "{{ route('get.sections', ':id') }}"
            .replace(':id', classId),

            function(data){

                $('#section_id').html(
                    '<option value="">Select Section</option>'
                );

                $.each(data,function(i,row){

                    $('#section_id').append(
                        `<option value="${row.id}">
                            ${row.name}
                        </option>`
                    );

                });

            }
        );

    });

});
</script>

@endpush