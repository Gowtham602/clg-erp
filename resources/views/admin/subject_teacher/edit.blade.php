@extends('layouts.app')

@section('content')

<div class="container-fluid mt-4">

    <div class="card shadow border-0">

        {{-- HEADER --}}

        <div class="card-header bg-primary text-white">

            <h5 class="mb-0">
                Edit Subject Teacher Mapping
            </h5>

        </div> 


        {{-- BODY --}}

        <div class="card-body">

            <form id="editForm">

                @csrf
                @method('PUT')


                {{-- CLASS --}}

                <div class="mb-3">

                    <label class="form-label">
                        Class
                    </label>

                    <select
                        id="class_id"
                        class="form-select">

                        <option value="">
                            Select Class
                        </option>

                        @foreach($classes as $class)

                        <option
                            value="{{ $class->id }}"
                            {{ $classId == $class->id ? 'selected' : '' }}>

                            {{ $class->name }}

                        </option>

                        @endforeach

                    </select>

                </div>



                {{-- SUBJECT --}}

                <div class="mb-3">

                    <label class="form-label">
                        Subject
                    </label>

                    <select
                        name="subject_id"
                        id="subject_id"
                        class="form-select">

                        <option value="">
                            Select Subject
                        </option>

                        @foreach($subjects as $subject)

                        <option
                            value="{{ $subject->id }}"
                            {{ $subjectTeacher->subject_id == $subject->id ? 'selected' : '' }}>

                            {{ $subject->name }}

                        </option>

                        @endforeach

                    </select>

                    <small class="text-danger error_subject_id"></small>

                </div>



                {{-- SECTION --}}

                <div class="mb-3">

                    <label class="form-label">
                        Section
                    </label>

                    <select
                        name="section_id"
                        id="section_id"
                        class="form-select">

                        <option value="">
                            Select Section
                        </option>

                        @foreach($sections as $section)

                        <option
                            value="{{ $section->id }}"
                            {{ $subjectTeacher->section_id == $section->id ? 'selected' : '' }}>

                            {{ $section->name }}

                        </option>

                        @endforeach

                    </select>

                    <small class="text-danger error_section_id"></small>

                </div>



                {{-- TEACHER --}}

                <div class="mb-3">

                    <label class="form-label">
                        Teacher
                    </label>

                    <select
                        name="teacher_id"
                        id="teacher_id"
                        class="form-select">

                        <option value="">
                            Select Teacher
                        </option>

                        @foreach($teachers as $teacher)

                        <option
                            value="{{ $teacher->id }}"
                            {{ $subjectTeacher->teacher_id == $teacher->id ? 'selected' : '' }}>

                            {{ $teacher->name }}

                        </option>

                        @endforeach

                    </select>

                    <small class="text-danger error_teacher_id"></small>

                </div>



                {{-- BUTTON --}}

                <button
                    type="submit"
                    class="btn btn-success"
                    id="updateBtn">

                    Update

                </button>

                <a href="{{ route('subject-teacher.index') }}"
                   class="btn btn-secondary">

                    Back

                </a>

            </form>

        </div>

    </div>

</div>

@endsection




@push('scripts')

<script>

$(document).ready(function () {

    // SELECT2

    $('#teacher_id').select2({
        theme: 'bootstrap-5',
        width: '100%'
    });


    // CLASS CHANGE

    $('#class_id').change(function () {

        let classId = $(this).val();

        if(classId == '') {

            $('#subject_id').html(
                '<option value="">Select Subject</option>'
            );

            $('#section_id').html(
                '<option value="">Select Section</option>'
            );

            return;
        }


        // LOAD SUBJECTS

        $.ajax({

            url: "{{ route('get.subjects', ':id') }}"
                    .replace(':id', classId),

            type: 'GET',

            success: function (subjects) {

                let option =
                    '<option value="">Select Subject</option>';

                subjects.forEach(function (subject) {

                    option += `
                        <option value="${subject.id}">
                            ${subject.name}
                        </option>
                    `;
                });

                $('#subject_id').html(option);

            }

        });


        // LOAD SECTIONS

        $.ajax({

            url: "{{ route('get.sections', ':id') }}"
                    .replace(':id', classId),

            type: 'GET',

            success: function (sections) {

                let option =
                    '<option value="">Select Section</option>';

                sections.forEach(function (section) {

                    option += `
                        <option value="${section.id}">
                            ${section.name}
                        </option>
                    `;
                });

                $('#section_id').html(option);

            }

        });

    });



    // UPDATE

    $('#editForm').submit(function (e) {

        e.preventDefault();

        $('.text-danger').text('');

        $('#updateBtn').html('Updating...');

        $.ajax({

            url: "{{ route('subject-teacher.update', $subjectTeacher->id) }}",

            type: "POST",

            data: $(this).serialize(),

            success: function (response) {

                $('#updateBtn').html('Update');

                Swal.fire({

                    icon: 'success',

                    title: 'Updated Successfully',

                    timer: 1500,

                    showConfirmButton: false

                });

                setTimeout(function () {

                    window.location.href =
                        "{{ route('subject-teacher.index') }}";

                }, 1500);

            },

            error: function (xhr) {

                $('#updateBtn').html('Update');

                let errors = xhr.responseJSON.errors;

                if(errors.subject_id){
                    $('.error_subject_id')
                        .text(errors.subject_id[0]);
                }

                if(errors.section_id){
                    $('.error_section_id')
                        .text(errors.section_id[0]);
                }

                if(errors.teacher_id){
                    $('.error_teacher_id')
                        .text(errors.teacher_id[0]);
                }

            }

        });

    });

});

</script>

@endpush