@extends('layouts.app')

@section('content')

<table class="table">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Subject</th>
            <th>Class</th>
            <th>Section</th>
        </tr>
    </thead>

    <tbody>
        @foreach($subjects as $key => $subject)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $subject->name }}</td>
            <td>{{ $subject->class->name }}</td>
            <td>{{ $subject->class->section }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection