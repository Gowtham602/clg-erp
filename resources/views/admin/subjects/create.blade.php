@extends('layouts.app')

@section('content')

<div class="container-fluid py-4">

    <!-- HEADER -->

    <div class="card border-0 shadow-lg rounded-4 overflow-hidden mb-4">

        <div class="card-body bg-primary text-white p-4">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                <div>

                    <h2 class="fw-bold mb-1">

                        <i class="bi bi-book-half me-2"></i>

                        Add Subject

                    </h2>

                    <p class="mb-0 opacity-75">

                        Create new subject for academic class

                    </p>

                </div>



                <a href="{{ route('subjects.index') }}"
                   class="btn btn-light btn-lg rounded-pill px-4 shadow-sm">

                    <i class="bi bi-arrow-left-circle me-2"></i>

                    Back

                </a>

            </div>

        </div>

    </div>





    <!-- FORM CARD -->

    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

        <div class="card-body p-4">

            <form
                action="{{ route('subjects.store') }}"
                method="POST">

                @csrf



                <div class="row">

                    <!-- CLASS -->

                    <div class="col-md-6 mb-4">

                        <label class="form-label fw-semibold">

                            Class

                        </label>

                        <select
                            name="class_id"
                            class="form-select form-select-lg rounded-4 @error('class_id') is-invalid @enderror">

                            <option value="">

                                Select Class

                            </option>

                            @foreach($classes as $class)

                                <option
                                    value="{{ $class->id }}"
                                    {{ old('class_id') == $class->id ? 'selected' : '' }}>

                                    {{ $class->name }}

                                </option>

                            @endforeach

                        </select>



                        @error('class_id')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>





                    <!-- SUBJECT -->

                    <div class="col-md-6 mb-4">

                        <label class="form-label fw-semibold">

                            Subject Name

                        </label>

                        <div class="input-group input-group-lg">

                            <span class="input-group-text bg-primary text-white border-0 rounded-start-4">

                                <i class="bi bi-journal-bookmark-fill"></i>

                            </span>

                            <input
                                type="text"
                                name="name"
                                class="form-control rounded-end-4 @error('name') is-invalid @enderror"
                                placeholder="Enter Subject Name"
                                value="{{ old('name') }}">

                        </div>



                        @error('name')

                            <div class="invalid-feedback d-block">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>

                </div>





                <!-- BUTTONS -->

                <div class="d-flex justify-content-end gap-2 mt-3">

                    <a href="{{ route('subjects.index') }}"
                       class="btn btn-light border rounded-pill px-4">

                        Cancel

                    </a>



                    <button
                        type="submit"
                        class="btn btn-primary rounded-pill px-5 shadow-sm">

                        <i class="bi bi-check-circle-fill me-2"></i>

                        Save Subject

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection