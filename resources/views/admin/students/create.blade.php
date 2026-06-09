<!-- resources/views/admin/students/create.blade.php -->

@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="card shadow border-0">

        <!-- HEADER -->
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

            <h5 class="mb-0">

                <i class="bi bi-person-plus"></i>
                Add Student

            </h5>

            <a href="{{ route('students.index') }}"
                class="btn btn-light btn-sm">

                Back

            </a>

        </div>


        <!-- BODY -->
        <div class="card-body">

            <form id="studentForm"
                action="{{ route('students.store') }}"
                method="POST">

                @csrf

                <div class="row">

                    <!-- Admission No -->
                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Admission No <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                            name="admission_no"
                            class="form-control">

                        <div class="invalid-feedback"></div>

                    </div>


                    <!-- Roll No -->
                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Roll No <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                            name="roll_no"
                            class="form-control">

                        <div class="invalid-feedback"></div>

                    </div>



                    <!-- <div class="col-md-4 mb-3">

                        <label>Academic Year<span class="text-danger">*</span></label>

                        <select name="academic_year_id" class="form-control">

                            <option value="">Select Year</option>

                            <option value="2025-2026">
                                2025-2026
                            </option>

                            <option value="2026-2027">
                                2026-2027
                            </option>

                        </select>

                    </div> -->


                    <div class="col-md-4 mb-3">

                        <label>Academic Year *</label>

                        <select
                            name="academic_year_id"
                            class="form-select"
                            required>

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

                    <div class="col-md-4 mb-3">

                        <label>Course *</label>

                        <select name="course_id" id="course_id" class="form-select">

                            <option value=""> Select Course </option>

                            @foreach($courses as $course)
                            <option value="{{ $course->id }}">
                                {{ $course->name }}
                            </option>
                            @endforeach
                        </select>

                    </div>

                    <div class="col-md-4 mb-3">

                        <label>Section *</label>

                       <select name="section_id" id="section_id"  class="form-select">
                            <option value="">     Select Section </option>
                        </select>

                    </div>

                    <div class="col-md-4">

    <label class="form-label">
        Semester
    </label>

    <select
        name="semester_id"
        class="form-select"
        required>

        <option value="">
            Select Semester
        </option>

        @foreach($semesters as $semester)

            <option value="{{ $semester->id }}">
                {{ $semester->name }}
            </option>

        @endforeach

    </select>

</div>

                    <!-- First Name -->
                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            First Name <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                            name="first_name"
                            class="form-control">

                        <div class="invalid-feedback"></div>

                    </div>


                    <!-- Last Name -->
                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Last Name
                        </label>

                        <input type="text"
                            name="last_name"
                            class="form-control">

                        <div class="invalid-feedback"></div>

                    </div>

                    <!-- Section
                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Section <span class="text-danger">*</span>
                        </label>

                        <select name="section_id"
                                class="form-select">

                            <option value="">
                                Select Section
                            </option>

                            @foreach($sections as $section)

                                <option value="{{ $section->id }}">

                                    {{ $section->class->name }}
                                    -
                                    {{ $section->name }}

                                </option>

                            @endforeach

                        </select>

                        <div class="invalid-feedback"></div>

                    </div> -->

                    <!-- Gender -->
                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Gender <span class="text-danger">*</span>
                        </label>

                        <select name="gender"
                            class="form-select">

                            <option value="">
                                Select Gender
                            </option>

                            <option value="male">
                                Male
                            </option>

                            <option value="female">
                                Female
                            </option>

                            <option value="other">
                                Other
                            </option>

                        </select>

                        <div class="invalid-feedback"></div>

                    </div>


                    <!-- Phone -->
                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Phone <span class="text-danger">*</span>
                        </label>

                        <input type="number"
                            name="phone"
                            class="form-control">

                        <div class="invalid-feedback"></div>

                    </div>


                    <!-- Email -->
                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Email
                        </label>

                        <input type="email"
                            name="email"
                            class="form-control">

                        <div class="invalid-feedback"></div>

                    </div>


                    <!-- DOB -->
                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            DOB
                        </label>

                        <input type="date"
                            name="dob"
                            class="form-control">

                        <div class="invalid-feedback"></div>

                    </div>


                    <!-- Father -->
                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Father Name <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                            name="father_name"
                            class="form-control">

                        <div class="invalid-feedback"></div>

                    </div>


                    <!-- Mother -->
                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Mother Name <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                            name="mother_name"
                            class="form-control">

                        <div class="invalid-feedback"></div>

                    </div>


                    <!-- Address -->
                    <div class="col-md-12 mb-3">

                        <label class="form-label">
                            Address <span class="text-danger">*</span>
                        </label>

                        <textarea name="address"
                            rows="3"
                            class="form-control"></textarea>

                        <div class="invalid-feedback"></div>

                    </div>

                </div>


                <!-- BUTTON -->
                <div class="text-end">

                    <button type="submit"
                        class="btn btn-success">

                        <i class="bi bi-check-circle"></i>
                        Save Student

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection



@push('scripts')

<script>
    $(document).ready(function() {

        /*
        |--------------------------------------------------------------------------
        | ON CHANGE VALIDATION
        |--------------------------------------------------------------------------
        */

        $(document).on(
            'keyup change',
            'input, select, textarea',
            function() {

                validateField($(this));
            }
        );
        


        $('#course_id').change(function(){

    let courseId = $(this).val();

    let url = "{{ route('students.get-sections', ':id') }}";
    url = url.replace(':id', courseId);

    $('#section_id').html(
        '<option value="">Loading...</option>'
    );

    $.ajax({

        url: url,

        type: 'GET',

        success: function(response){

            let options =
                '<option value="">Select Section</option>';

            $.each(response, function(index, section){

                options += `
                    <option value="${section.id}">
                        ${section.name}
                    </option>
                `;
            });

            $('#section_id').html(options);
        }

    });

});


        /*
        |--------------------------------------------------------------------------
        | FORM SUBMIT
        |--------------------------------------------------------------------------
        */
        $('#studentForm').submit(function(e) {

            e.preventDefault();

            let form = this;

            $('.is-invalid').removeClass('is-invalid');

            $('.invalid-feedback').html('');

            $.ajax({

                url: $(form).attr('action'),

                type: 'POST',

                data: new FormData(form),

                processData: false,

                contentType: false,

                success: function(response) {

                    Swal.fire({

                        icon: 'success',

                        title: 'Success',

                        text: response.message,

                        timer: 1500,

                        showConfirmButton: false
                    });

                    setTimeout(function() {

                        window.location.href =
                            "{{ route('students.index') }}";

                    }, 1500);
                },

                error: function(xhr) {

                    console.log(xhr.responseText);

                    if (xhr.status === 422) {

                        let errors =
                            xhr.responseJSON.errors;

                        $.each(errors, function(field, messages) {

                            let input =
                                $('[name="' + field + '"]');

                            input.addClass('is-invalid');

                            input
                                .closest('.mb-3')
                                .find('.invalid-feedback')
                                .html(messages[0]);
                        });
                    }
                }
            });
        });




        function validateField(input) {
            let name = input.attr('name');

            let value = input.val();

            input.removeClass('is-invalid');

            input.closest('.mb-3')
                .find('.invalid-feedback')
                .html('');



            // FIRST NAME
            if (name == 'first_name') {
                if (value.trim() == '') {
                    showError(input,
                        'First name is required');
                }
            }


            // ADMISSION NO
            if (name == 'admission_no') {
                if (value.trim() == '') {
                    showError(input,
                        'Admission no is required');
                }
            }


            // PHONE
            if (name == 'phone') {
                let phonePattern =
                    /^[0-9]{10}$/;

                if (value.trim() == '') {
                    showError(input,
                        'Phone is required');
                } else if (!phonePattern.test(value)) {
                    showError(input,
                        'Enter valid 10 digit phone');
                }
            }


            // EMAIL
            if (name == 'email') {
                let emailPattern =
                    /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                if (value != '' &&
                    !emailPattern.test(value)) {
                    showError(input,
                        'Enter valid email');
                }
            }


            // FATHER
            if (name == 'father_name') {
                if (value.trim() == '') {
                    showError(input,
                        'Father name is required');
                }
            }


            // MOTHER
            if (name == 'mother_name') {
                if (value.trim() == '') {
                    showError(input,
                        'Mother name is required');
                }
            }


            // ADDRESS
            if (name == 'address') {
                if (value.trim() == '') {
                    showError(input,
                        'Address is required');
                }
            }


            // GENDER
            if (name == 'gender') {
                if (value == '') {
                    showError(input,
                        'Select gender');
                }
            }


            // SECTION
            if (name == 'section_id') {
                if (value == '') {
                    showError(input,
                        'Select section');
                }
            }
        }


        function showError(input, message) {
            input.addClass('is-invalid');

            input.closest('.mb-3')
                .find('.invalid-feedback')
                .html(message);
        }

    });
</script>

@endpush