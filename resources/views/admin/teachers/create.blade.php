@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="card shadow border-0">

        <!-- HEADER -->
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

            <h5 class="mb-0">

                <i class="bi bi-person-plus"></i>
                Add Teacher

            </h5>

            <a href="{{ route('teachers.index') }}"
                class="btn btn-light btn-sm">

                Back

            </a>

        </div>


        <!-- BODY -->
        <div class="container-fluid">

            <form id="teacherForm">

                @csrf

                <!-- BASIC DETAILS -->
                <div class="card shadow-sm mb-4 mt-3">

                    <div class="card-header bg-primary text-white m-2">

                        <h5 class="mb-0">
                            <i class="bi bi-person-circle"></i>
                            Basic Information
                        </h5>

                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-4 mb-3">
                                <label>Name</label>
                                <input type="text"
                                    name="name"
                                    class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Email</label>
                                <input type="email"
                                    name="email"
                                    class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Employee ID</label>
                                <input type="text"
                                    name="employee_id"
                                    class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Phone</label>
                                <input type="number"
                                    name="phone"
                                    class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Alternate Phone</label>
                                <input type="text"
                                    name="alternate_phone"
                                    class="form-control">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Gender</label>

                                <select class="form-select"
                                    name="gender">

                                    <option value="">
                                        Select Gender
                                    </option>

                                    <option value="Male">
                                        Male
                                    </option>

                                    <option value="Female">
                                        Female
                                    </option>

                                </select>
                                <div class="invalid-feedback"></div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- PROFESSIONAL DETAILS -->
                <div class="card shadow-sm mb-4">

                    <div class="card-header bg-success text-white">

                        <h5 class="mb-0">
                            <i class="bi bi-briefcase"></i>
                            Professional Information
                        </h5>

                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-4 mb-3">

                                <label>Department</label>

                                <select class="form-select"
                                    name="department_id">

                                    <option value="">
                                        Select Department
                                    </option>

                                    @foreach($departments as $department)

                                    <option value="{{ $department->id }}">
                                        {{ $department->name }}
                                    </option>

                                    @endforeach

                                </select>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="col-md-4 mb-3">

                                <label>Designation</label>

                                <select class="form-select"
                                    name="designation_id">

                                    <option value="">
                                        Select Designation
                                    </option>

                                    @foreach($designations as $designation)

                                    <option value="{{ $designation->id }}">
                                        {{ $designation->name }}
                                    </option>

                                    @endforeach

                                </select>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="col-md-4 mb-3">
    <label>Employment Type</label>

    <select class="form-select" name="employment_type" required>
        <option value="">Select Type</option>

        <option value="Full Time">
            Full Time
        </option>

        <option value="Part Time">
            Part Time
        </option>

        <option value="Guest">
            Guest
        </option>
    </select>

    <div class="invalid-feedback"></div>
</div>

                            <div class="col-md-4 mb-3">

                                <label>Qualification</label>

                                <input type="text"
                                    name="qualification"
                                    class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="col-md-4 mb-3">

                                <label>Experience</label>

                                <input type="text"
                                    name="experience"
                                    class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="col-md-4 mb-3">

                                <label>Joining Date</label>

                                <input type="date"
                                    name="joining_date"
                                    class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>

                        </div>

                    </div>

                </div>

                <!-- ADDRESS DETAILS -->
                <div class="card shadow-sm mb-4">

                    <div class="card-header bg-warning">

                        <h5 class="mb-0">
                            <i class="bi bi-geo-alt"></i>
                            Address & Documents
                        </h5>

                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-4 mb-3">
                                <label>Aadhaar No</label>
                                <input type="text"
                                    name="aadhaar_no"
                                    class="form-control">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>City</label>
                                <input type="text"
                                    name="city"
                                    class="form-control">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>State</label>
                                <input type="text"
                                    name="state"
                                    class="form-control">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Pincode</label>
                                <input type="text"
                                    name="pincode"
                                    class="form-control">
                            </div>

                            <div class="col-md-8 mb-3">
                                <label>Address</label>

                                <textarea
                                    name="address"
                                    rows="3"
                                    class="form-control"></textarea>
                                <div class="invalid-feedback"></div>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="text-end">

                    <button class="btn btn-primary btn-lg">

                        <i class="bi bi-check-circle"></i>

                        Save Teacher

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
        | REMOVE ERROR WHILE TYPING
        |--------------------------------------------------------------------------
        */

        $(document).on(
            'keyup change',
            'input,select,textarea',
            function() {

                $(this)
                    .removeClass('is-invalid');

                $(this)
                    .closest('.mb-3')
                    .find('.invalid-feedback')
                    .html('');
            }
        );



        /*
        |--------------------------------------------------------------------------
        | SAVE TEACHER
        |--------------------------------------------------------------------------
        */

        $('#teacherForm').submit(function(e) {

            e.preventDefault();

            let form = $(this);

            $('.is-invalid')
                .removeClass('is-invalid');

            $('.invalid-feedback')
                .html('');

            $.ajax({

                url: "{{ route('teachers.store') }}",

                type: 'POST',

                data: form.serialize(),

                success: function(response) {

                    Swal.fire({

                        icon: 'success',

                        title: 'Success',

                        text: response.message,

                        timer: 1500,

                        showConfirmButton: false
                    });

                    form[0].reset();

                    setTimeout(function() {

                        window.location.href =
                            "{{ route('teachers.index') }}";

                    }, 1500);
                },

                error: function(xhr) {

                    if (xhr.status == 422) {
                        let errors =
                            xhr.responseJSON.errors;

                        $.each(errors, function(field, messages) {

                            let input =
                                $('[name="' + field + '"]');

                            input.addClass(
                                'is-invalid'
                            );

                            input
                                .closest('.mb-3')
                                .find('.invalid-feedback')
                                .html(messages[0]);
                        });
                    }
                }
            });

        });

    });
</script>

@endpush