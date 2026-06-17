@extends('layouts.app')

@section('content')

<div class="card">

    <div class="card-header">
        <h5>Edit Exam Schedule</h5>
    </div>

    <div class="card-body">

        <form action="{{ route('exam-schedules.update', $examSchedule->id) }}"
              method="POST"
              class="needs-validation"
              novalidate>

            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Exam
                    </label>

                    <select
                        name="exam_id"
                        class="form-select @error('exam_id') is-invalid @enderror"
                        required>

                        <option value="">
                            Select Exam
                        </option>

                        @foreach($exams as $exam)

                            <option
                                value="{{ $exam->id }}"
                                {{ old('exam_id', $examSchedule->exam_id) == $exam->id ? 'selected' : '' }}>

                                {{ $exam->name }}

                            </option>

                        @endforeach

                    </select>

                    @error('exam_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Subject
                    </label>

                    <select
                        name="subject_id"
                        class="form-select @error('subject_id') is-invalid @enderror"
                        required>

                        <option value="">
                            Select Subject
                        </option>

                        @foreach($subjects as $subject)

                            <option
                                value="{{ $subject->id }}"
                                {{ old('subject_id', $examSchedule->subject_id) == $subject->id ? 'selected' : '' }}>

                                {{ $subject->subject_code }}
                                -
                                {{ $subject->name }}

                            </option>

                        @endforeach

                    </select>

                    @error('subject_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Exam Date
                    </label>

                    <input
                        type="date"
                        name="exam_date"
                        value="{{ old('exam_date', $examSchedule->exam_date) }}"
                        class="form-control @error('exam_date') is-invalid @enderror"
                        required>

                    @error('exam_date')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Start Time
                    </label>

                    <input
                        type="time"
                        name="start_time"
                        value="{{ old('start_time', $examSchedule->start_time) }}"
                        class="form-control @error('start_time') is-invalid @enderror"
                        required>

                    @error('start_time')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        End Time
                    </label>

                    <input
                        type="time"
                        name="end_time"
                        value="{{ old('end_time', $examSchedule->end_time) }}"
                        class="form-control @error('end_time') is-invalid @enderror"
                        required>

                    @error('end_time')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Room No
                    </label>

                    <input
                        type="text"
                        name="room_no"
                        value="{{ old('room_no', $examSchedule->room_no) }}"
                        class="form-control @error('room_no') is-invalid @enderror">

                    @error('room_no')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

            </div>

            <button
                type="submit"
                class="btn btn-primary">

                Update Schedule

            </button>

        </form>

    </div>

</div>

@endsection
@push('scripts')

<script>
(() => {
    'use strict';

    const forms =
        document.querySelectorAll('.needs-validation');

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
</script>

@endpush