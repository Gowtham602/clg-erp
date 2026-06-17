@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="fw-bold mb-1">
                Exam Management
            </h3>

            <small class="text-muted">
                Manage all examination records
            </small>
        </div>

        <a href="{{ route('exams.create') }}"
           class="btn btn-primary">

            <i class="bi bi-plus-circle me-1"></i>

            Create Exam

        </a>

    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">

        <div class="col-md-4">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <h6 class="text-muted">
                        Total Exams
                    </h6>

                    <h3 class="fw-bold text-primary">
                        {{ $exams->count() }}
                    </h3>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <h6 class="text-muted">
                        Active Exams
                    </h6>

                    <h3 class="fw-bold text-success">

                        {{ $exams->where('end_date','>=',now())->count() }}

                    </h3>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <h6 class="text-muted">
                        Completed Exams
                    </h6>

                    <h3 class="fw-bold text-danger">

                        {{ $exams->where('end_date','<',now())->count() }}

                    </h3>

                </div>

            </div>

        </div>

    </div>

    <!-- Main Table Card -->
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white">

            <h5 class="mb-0">
                Exam List
            </h5>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">

                        <tr>

                            <th>#</th>

                            <th>Exam Name</th>

                            <th>Type</th>

                            <th>Start Date</th>

                            <th>End Date</th>

                            <th>Status</th>

                            <th class="text-center">
                                Actions
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($exams as $key => $exam)

                        <tr>

                            <td>
                                {{ $key + 1 }}
                            </td>

                            <td>

                                <div class="fw-semibold">

                                    {{ $exam->name }}

                                </div>

                            </td>

                            <td>

                                <span class="badge bg-info">

                                    {{ $exam->exam_type }}

                                </span>

                            </td>

                            <td>

                                {{ date('d-m-Y', strtotime($exam->start_date)) }}

                            </td>

                            <td>

                                {{ date('d-m-Y', strtotime($exam->end_date)) }}

                            </td>

                            <td>

                                @if(now()->between($exam->start_date, $exam->end_date))

                                    <span class="badge bg-success">
                                        Active
                                    </span>

                                @elseif(now()->lt($exam->start_date))

                                    <span class="badge bg-primary">
                                        Upcoming
                                    </span>

                                @else

                                    <span class="badge bg-secondary">
                                        Completed
                                    </span>

                                @endif

                            </td>

                            <td class="text-center">

                                <a href="{{ route('exams.edit',$exam->id) }}"
                                   class="btn btn-sm btn-outline-primary">

                                    <i class="bi bi-pencil-square"></i>

                                </a>

                                <!-- <button
                                    class="btn btn-sm btn-outline-danger">

                                    <i class="bi bi-trash"></i>

                                </button> -->

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="7"
                                class="text-center text-muted py-4">

                                No Exams Found

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection