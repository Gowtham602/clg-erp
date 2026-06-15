@extends('layouts.app')

@section('content')


<div class="container-fluid">


<div class="card border-0 shadow-lg">

    <!-- HEADER -->
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">

        <h5 class="mb-0">
            <i class="bi bi-journal-text me-2"></i>
            Create Exam
        </h5>

        <a href="{{ route('exams.index') }}"
           class="btn btn-light btn-sm">

            <i class="bi bi-arrow-left"></i>
            Back

        </a>

    </div>

    <!-- BODY -->
    <div class="card-body p-4">

        <form action="{{ route('exams.store') }}"
              method="POST"
              id="examForm">

            @csrf

            <div class="row g-4">

                <!-- EXAM NAME -->
                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        Exam Name
                    </label>

                    <input type="text"
                           name="name"
                           id="name"
                           class="form-control"
                           value="{{ old('name') }}">

                    <div class="invalid-feedback"></div>

                </div>

                <!-- ACADEMIC YEAR -->
                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        Academic Year
                    </label>

                    <select name="academic_year_id"
                            id="academic_year_id"
                            class="form-select">

                        <option value="">
                            Select Academic Year
                        </option>

                        @foreach($academicYears as $year)

                        <option value="{{ $year->id }}">
                            {{ $year->name }}
                        </option>

                        @endforeach

                    </select>

                    <div class="invalid-feedback"></div>

                </div>

                <!-- COURSE -->
                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        Course
                    </label>

                    <select name="class_id"
                            id="class_id"
                            class="form-select">

                        <option value="">
                            Select Course
                        </option>

                        @foreach($classes as $class)

                        <option value="{{ $class->id }}">
                            {{ $class->name }}
                        </option>

                        @endforeach

                    </select>

                    <div class="invalid-feedback"></div>

                </div>

                <!-- SEMESTER -->
                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        Semester
                    </label>

                    <select name="semester_id"
                            id="semester_id"
                            class="form-select">

                        <option value="">
                            Select Semester
                        </option>

                    </select>

                    <div class="invalid-feedback"></div>

                </div>

                <!-- EXAM TYPE -->
                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        Exam Type
                    </label>

                    <select name="exam_type"
                            class="form-select">

                        <option value="">
                            Select Type
                        </option>

                        <option value="Internal">
                            Internal
                        </option>

                        <option value="Semester">
                            Semester
                        </option>

                        <option value="Supplementary">
                            Supplementary
                        </option>

                    </select>

                    <div class="invalid-feedback"></div>

                </div>

                <!-- START DATE -->
                <div class="col-md-3">

                    <label class="form-label fw-semibold">
                        Start Date
                    </label>

                    <input type="date"
                           name="start_date"
                           class="form-control">

                    <div class="invalid-feedback"></div>

                </div>

                <!-- END DATE -->
                <div class="col-md-3">

                    <label class="form-label fw-semibold">
                        End Date
                    </label>

                    <input type="date"
                           name="end_date"
                           class="form-control">

                    <div class="invalid-feedback"></div>

                </div>

            </div>

            <hr class="my-4">

            <div class="text-end">

                <button type="reset"
                        class="btn btn-secondary me-2">

                    <i class="bi bi-arrow-counterclockwise"></i>
                    Reset

                </button>

                <button type="submit"
                        class="btn btn-primary px-4">

                    <i class="bi bi-check-circle"></i>
                    Save Exam

                </button>

            </div>

        </form>

    </div>

</div>

</div>
</div>


<style>

.card{
    border-radius:15px;
}

.card-header{
    border-radius:15px 15px 0 0 !important;
}

.form-control,
.form-select{
    height:48px;
}

.form-label{
    margin-bottom:8px;
}

.btn{
    border-radius:8px;
}

</style>

@push('scripts')

<script>
    $('input,select').on('keyup change', function(){

    if($(this).val() != '')
    {
        $(this).removeClass('is-invalid');

        $(this)
            .closest('.col-md-6,.col-md-3')
            .find('.invalid-feedback')
            .text('');
    }

});
    $(document).ready(function() {

        /*
        |--------------------------------------------------------------------------
        | LOAD SEMESTERS
        |--------------------------------------------------------------------------
        */

        $('#class_id').change(function() {

            let classId = $(this).val();

            if (classId == '') {
                $('#semester_id').html(
                    '<option value="">Select Semester</option>'
                );
                return;
            }

            let url =
                "{{ route('get.semesters', ':id') }}";

            url = url.replace(':id', classId);

            $.ajax({

                url: url,

                type: 'GET',

                success: function(response) {

                    let options =
                        '<option value="">Select Semester</option>';

                    $.each(response, function(index, row) {

                        options +=
                            `<option value="${row.id}">
                        ${row.name}
                    </option>`;

                    });

                    $('#semester_id').html(options);

                }

            });

        });



        /*
        |--------------------------------------------------------------------------
        | JQUERY VALIDATION
        |--------------------------------------------------------------------------
        */

        $('#examForm').validate({

            rules: {

                name: {
                    required: true,
                    minlength: 3
                },

                academic_year_id: {
                    required: true
                },

                class_id: {
                    required: true
                },

                semester_id: {
                    required: true
                },

                exam_type: {
                    required: true
                },

                start_date: {
                    required: true
                },

                end_date: {
                    required: true
                }

            },

            messages: {

                name: {
                    required: "Please enter exam name",
                    minlength: "Minimum 3 characters required"
                },

                academic_year_id: {
                    required: "Please select academic year"
                },

                class_id: {
                    required: "Please select course"
                },

                semester_id: {
                    required: "Please select semester"
                },

                exam_type: {
                    required: "Please select exam type"
                },

                start_date: {
                    required: "Please select start date"
                },

                end_date: {
                    required: "Please select end date"
                }

            },

            errorElement: 'div',

            errorPlacement: function(error, element) {

                error.addClass(
                    'invalid-feedback d-block'
                );

                element.closest('.mb-3')
                    .append(error);
            },

            highlight: function(element) {

                $(element)
                    .addClass('is-invalid');
            },

            unhighlight: function(element) {

                $(element)
                    .removeClass('is-invalid');
            },
    
            submitHandler: function(form) {

                let startDate =
                    $('input[name="start_date"]').val();

                let endDate =
                    $('input[name="end_date"]').val();

                if (endDate < startDate) {
                    Swal.fire({

                        icon: 'error',

                        title: 'Validation Error',

                        text: 'End Date must be greater than Start Date'

                    });

                    return false;
                }

                form.submit();
            }

        });

    });
</script>

@endpush

@endsection