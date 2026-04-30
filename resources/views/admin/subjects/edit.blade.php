@extends('layouts.app')

@section('content')

<div class="card p-4 shadow-sm">
    <h5>Edit Subject</h5>

    <form method="POST" action="{{ route('subjects.update', $subject->id) }}">
        @csrf
        @method('PUT')

        <!-- Subject Name -->
        <input type="text" name="name" value="{{ $subject->name }}" 
               class="form-control mb-3" required>

        <!-- Class -->
        <select name="class_id" class="form-control mb-3" required>
            @foreach($classes as $class)
                <option value="{{ $class->id }}"
                    {{ $subject->class_id == $class->id ? 'selected' : '' }}>
                    {{ $class->name }} - {{ $class->section }}
                </option>
            @endforeach
        </select>

        <!-- Teachers -->
        <label>Teachers</label>
        <select name="teacher_ids[]" class="form-control mb-3" multiple>

            @foreach($teachers as $teacher)
                <option value="{{ $teacher->id }}"
                    {{ $subject->teachers->contains($teacher->id) ? 'selected' : '' }}>
                    {{ $teacher->name }}
                </option>
            @endforeach

        </select>

        <button class="btn btn-primary">Update</button>
    </form>
</div>

@endsection