
@extends('layouts.app')

@section('content')


<form action="{{ route('departments.store') }}"
      method="POST">

    @csrf

    <div class="mb-3">
        <label>Name</label>

        <input type="text"
               name="name"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Code</label>

        <input type="text"
               name="code"
               class="form-control">
    </div>

    <div class="form-check">
        <input type="checkbox"
               name="status"
               value="1"
               checked>

        <label>Active</label>
    </div>

    <button class="btn btn-primary">
        Save
    </button>

</form>

@endsection