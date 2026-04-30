@extends('layouts.app')

@section('content')

<div class="card p-4 shadow-sm">
    <h5>Add Subject</h5>

    <form method="POST" action="{{ route('subjects.store') }}">
        @csrf

        <!-- Subject Name -->
        <input type="text" name="name" class="form-control mb-3" placeholder="Subject Name" required>

        <!-- Class -->
        <select name="class_id" class="form-control mb-3" required>
            <option value="">Select Class</option>
            @foreach($classes as $class)
                <option value="{{ $class->id }}">
                    {{ $class->name }} - {{ $class->section }}
                </option>
            @endforeach
        </select>

        <!-- Teachers -->
        <label>Select Teachers</label>
        <select name="teacher_ids[]" class="form-control mb-3 select2" multiple required>
            @foreach($teachers as $teacher)
                <option value="{{ $teacher->id }}">
                    {{ $teacher->name }}
                </option>
            @endforeach
        </select>

        <button class="btn btn-primary">Save</button>
    </form>
</div>
@push('scripts')
<script>
$(document).ready(function () {

    console.log("Select2 Init"); // debug

    if ($.fn.select2) {
        $('.select2').select2({
            placeholder: "Select Teachers",
            width: '100%'
        });
    } else {
        console.error("Select2 not loaded");
    }

});
</script>
@endpush
@endsection