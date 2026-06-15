{{-- resources/views/admin/teachers/edit.blade.php --}}

@extends('layouts.app')

@section('content')

<div class="card shadow border-0">

    <div class="card-header bg-primary text-white">

        <h5 class="mb-0">

            Edit Teacher

        </h5>

    </div>

    <div class="card-body">

        <form id="teacherEditForm">

    @csrf
    @method('PUT')

    <!-- BASIC INFORMATION -->

    <div class="section-title mb-3">
        <h5 class="text-primary">
            <i class="bi bi-person-circle"></i>
            Basic Information
        </h5>
    </div>

    <div class="row">

        <div class="col-md-4 mb-3">

            <label>Name</label>

            <input type="text"
                name="name"
                value="{{ optional($teacher->user)->name }}"
                class="form-control">

            <div class="invalid-feedback"></div>

        </div>

        <div class="col-md-4 mb-3">

            <label>Email</label>

            <input type="email"
                name="email"
                value="{{ optional($teacher->user)->email }}"
                class="form-control">

            <div class="invalid-feedback"></div>

        </div>

        <div class="col-md-4 mb-3">

            <label>Employee ID</label>

            <input type="text"
                value="{{ $teacher->employee_id }}"
                class="form-control"
                name="employee_id"
                readonly>

        </div>

        <div class="col-md-4 mb-3">

            <label>Phone</label>

            <input type="text"
                name="phone"
                value="{{ $teacher->phone }}"
                class="form-control">

            <div class="invalid-feedback"></div>

        </div>

        <div class="col-md-4 mb-3">

            <label>Alternate Phone</label>

            <input type="text"
                name="alternate_phone"
                value="{{ $teacher->alternate_phone }}"
                class="form-control">

        </div>

        <div class="col-md-4 mb-3">

            <label>Gender</label>

            <select name="gender"
                class="form-select">

                <option value="">Select Gender</option>

                <option value="Male"
                    {{ $teacher->gender == 'male' ? 'selected' : '' }}>
                    Male
                </option>

                <option value="Female"
                    {{ $teacher->gender == 'female' ? 'selected' : '' }}>
                    Female
                </option>

            </select>

            <div class="invalid-feedback"></div>

        </div>

    </div>

    <hr>

    <!-- PROFESSIONAL INFORMATION -->

    <div class="section-title mb-3">

        <h5 class="text-success">
            <i class="bi bi-briefcase-fill"></i>
            Professional Information
        </h5>

    </div>

    <div class="row">

        <div class="col-md-4 mb-3">

            <label>Department</label>

            <select name="department_id"
                class="form-select">

                <option value="">Select Department</option>

                @foreach($departments as $department)

                <option value="{{ $department->id }}"
                    {{ $teacher->department_id == $department->id ? 'selected' : '' }}>

                    {{ $department->name }}

                </option>

                @endforeach

            </select>

            <div class="invalid-feedback"></div>

        </div>

        <div class="col-md-4 mb-3">

            <label>Designation</label>

            <select name="designation_id"
                class="form-select">

                <option value="">Select Designation</option>

                @foreach($designations as $designation)

                <option value="{{ $designation->id }}"
                    {{ $teacher->designation_id == $designation->id ? 'selected' : '' }}>

                    {{ $designation->name }}

                </option>

                @endforeach

            </select>

            <div class="invalid-feedback"></div>

        </div>

        <div class="col-md-4 mb-3">

            <label>Employment Type</label>

            <select name="employment_type"
                class="form-select">

                <option value="Full Time"
                    {{ $teacher->employment_type == 'Full Time' ? 'selected' : '' }}>
                    Full Time
                </option>

                <option value="Part Time"
                    {{ $teacher->employment_type == 'Part Time' ? 'selected' : '' }}>
                    Part Time
                </option>

                <option value="Contract"
                    {{ $teacher->employment_type == 'Contract' ? 'selected' : '' }}>
                    Contract
                </option>

            </select>

        </div>

        <div class="col-md-4 mb-3">

            <label>Qualification</label>

            <input type="text"
                name="qualification"
                value="{{ $teacher->qualification }}"
                class="form-control">

        </div>

        <div class="col-md-4 mb-3">

            <label>Experience</label>

            <input type="text"
                name="experience"
                value="{{ $teacher->experience }}"
                class="form-control">

        </div>

        <div class="col-md-4 mb-3">

            <label>Joining Date</label>

            <input type="date"
                name="joining_date"
                value="{{ $teacher->joining_date }}"
                class="form-control">

        </div>

    </div>

    <hr>

    <!-- ADDRESS & DOCUMENTS -->

    <div class="section-title mb-3">

        <h5 class="text-warning">
            <i class="bi bi-geo-alt-fill"></i>
            Address & Documents
        </h5>

    </div>

    <div class="row">

        <div class="col-md-4 mb-3">

            <label>Aadhaar No</label>

            <input type="text"
                name="aadhaar_no"
                value="{{ $teacher->aadhaar_no }}"
                class="form-control">

        </div>

        <div class="col-md-4 mb-3">

            <label>City</label>

            <input type="text"
                name="city"
                value="{{ $teacher->city }}"
                class="form-control">

        </div>

        <div class="col-md-4 mb-3">

            <label>State</label>

            <input type="text"
                name="state"
                value="{{ $teacher->state }}"
                class="form-control">

        </div>

        <div class="col-md-4 mb-3">

            <label>Pincode</label>

            <input type="text"
                name="pincode"
                value="{{ $teacher->pincode }}"
                class="form-control">

        </div>

        <div class="col-md-8 mb-3">

            <label>Address</label>

            <textarea
                name="address"
                rows="3"
                class="form-control">{{ $teacher->address }}</textarea>

            <div class="invalid-feedback"></div>

        </div>

    </div>

    <hr>

    <div class="text-end">

        <button type="submit"
            class="btn btn-primary">

            <i class="bi bi-check-circle"></i>

            Update Teacher

        </button>

    </div>

</form>

    </div>

</div>


@push('scripts')

<script>

$(document).ready(function(){

 

    $(document).on(
        'keyup change',
        'input,select,textarea',
        function(){

            $(this)
                .removeClass('is-invalid');

            $(this)
                .next('.invalid-feedback')
                .html('');
        }
    );


    /*
    |--------------------------------------------------------------------------
    | PHONE VALIDATION
    |--------------------------------------------------------------------------
    */

    $('input[name="phone"]').on('input', function(){

        let value = $(this).val();

        value = value.replace(/\D/g,'');

        $(this).val(value);

        if(value.length != 10)
        {
            $(this)
                .addClass('is-invalid');

            $(this)
                .next('.invalid-feedback')
                .html('Phone must be 10 digits');
        }
    });


    /*
    |--------------------------------------------------------------------------
    | EMAIL VALIDATION
    |--------------------------------------------------------------------------
    */

    $('input[name="email"]').on('input', function(){

        let email = $(this).val();

        let pattern =
            /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if(!pattern.test(email))
        {
            $(this)
                .addClass('is-invalid');

            $(this)
                .next('.invalid-feedback')
                .html('Invalid Email');
        }
    });


    /*
    |--------------------------------------------------------------------------
    | UPDATE AJAX
    |--------------------------------------------------------------------------
    */

    $('#teacherEditForm').submit(function(e){

        e.preventDefault();

        let form = $(this);

        $.ajax({

            url:"{{ route('teachers.update',$teacher->id) }}",

            type:'POST',

            data:form.serialize(),

            success:function(response){

                Swal.fire({

                    icon:'success',

                    title:'Success',

                    text:response.message,

                    timer:1500,

                    showConfirmButton:false
                });

                setTimeout(function(){

                    window.location.href =
                        "{{ route('teachers.index') }}";

                },1500);
            },

            error:function(xhr){

                if(xhr.status == 422)
                {
                    let errors =
                        xhr.responseJSON.errors;

                    $.each(errors,function(field,msg){

                        $('[name="'+field+'"]')
                            .addClass('is-invalid');

                        $('[name="'+field+'"]')
                            .next('.invalid-feedback')
                            .html(msg[0]);
                    });
                }
            }
        });
    });

});

</script>

@endpush

@endsection