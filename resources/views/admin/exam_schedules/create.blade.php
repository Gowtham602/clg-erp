@extends('layouts.app')

@section('content')

<div class="container-fluid">

<div class="card shadow border-0">

<div class="card-header bg-primary text-white">

    <h5 class="mb-0">

        Create Exam Schedule

    </h5>

</div>

<div class="card-body">
       @if ($errors->any())

<div class="alert alert-danger">

    <ul class="mb-0">

        @foreach ($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif
<form
    action="{{ route('exam-schedules.store') }}"
    method="POST"
    id="scheduleForm"
    novalidate>

    @csrf

    <div class="row">

        <!-- Exam -->

        <div class="col-md-6 mb-3">

            <label class="form-label">
                Exam
            </label>

            <select
                name="exam_id"
                id="exam_id"
                class="form-select"
                required>

                <option value="">
                    Select Exam
                </option>

                @foreach($exams as $exam)

                    <option value="{{ $exam->id }}">
                        {{ $exam->name }}
                    </option>

                @endforeach

            </select>

            <div class="invalid-feedback">
                Please select Exam.
            </div>

        </div>

        <!-- Subject -->

        <div class="col-md-6 mb-3">

            <label class="form-label">
                Subject
            </label>

           <select name="subject_id" id="subject_id"  class="form-select" required>

    <option value="">
        Select Subject
    </option>

</select>

            <div class="invalid-feedback">
                Please select Subject.
            </div>

        </div>

        <!-- Exam Date -->

        <div class="col-md-4 mb-3">

            <label class="form-label">
                Exam Date
            </label>

            <input
                type="date"
                name="exam_date"
                class="form-control"
                required>

            <div class="invalid-feedback">
                Please select Exam Date.
            </div>

        </div>

        <!-- Start Time -->

        <div class="col-md-4 mb-3">

            <label class="form-label">
                Start Time
            </label>

            <input
                type="time"
                name="start_time"
                class="form-control"
                required>

            <div class="invalid-feedback">
                Please select Start Time.
            </div>

        </div>

        <!-- End Time --> 

        <div class="col-md-4 mb-3">

            <label class="form-label">
                End Time
            </label>

            <input
                type="time"
                name="end_time"
                class="form-control"
                required>

            <div class="invalid-feedback">
                Please select End Time.
            </div>

        </div>

        <!-- Room No -->

        <div class="col-md-6 mb-3">

            <label class="form-label">
                Room No
            </label>

            <input
                type="text"
                name="room_no"
                maxlength="50"
                class="form-control">

        </div>

    </div>

    <button
        type="submit"
        class="btn btn-primary">

        Save Schedule

    </button>

</form>

</div>

</div>

</div>

@push('scripts')


<script>

(() => {

    'use strict';

    const forms =
        document.querySelectorAll('form');

    Array.from(forms).forEach(form => {

        form.addEventListener('submit', event => {

            if (!form.checkValidity()) {

                event.preventDefault();

                event.stopPropagation();

            }

            form.classList.add('was-validated');

        });

    });

})();



//get particular subject_id
$('#exam_id').change(function(){

    let examId = $(this).val();

    $('#subject_id').html(
        '<option>Loading...</option>'
    );

    let url =
        "{{ route('get.subjects.exam',':id') }}";

    url = url.replace(':id',examId);

    $.ajax({

        url:url,

        type:'GET',

        success:function(response){

            let options =
                '<option value="">Select Subject</option>';

            $.each(response,function(index,row){

                options += `
                <option value="${row.id}">
                    ${row.subject_code} - ${row.name}
                </option>
                `;
            });

            $('#subject_id').html(options);

        }

    });

});
</script>
@endpush

@endsection