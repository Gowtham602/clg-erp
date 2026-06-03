@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- PAGE HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="fw-bold mb-0">
                Dashboard
            </h3>

            <small class="text-muted">
                Welcome to School ERP System
            </small>
        </div>

        <div>
            <span class="badge bg-primary fs-6 p-2">
                {{ now()->format('d M Y') }}
            </span>
        </div>

    </div>



    <!-- STATISTICS -->
    <div class="row g-4">

        <!-- STUDENTS -->
        <div class="col-xl-3 col-md-6">

            <a href="{{ route('students.index') }}"
               class="text-decoration-none">

                <div class="card dashboard-card border-0 shadow-sm">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <small class="text-muted">
                                    Total Students
                                </small>

                                <h2 class="fw-bold mt-2 text-primary">
                                    {{ $students }}
                                </h2>

                            </div>

                            <div class="icon-box bg-primary-subtle text-primary">

                                <i class="bi bi-people-fill"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </a>

        </div>



        <!-- TEACHERS -->
        <div class="col-xl-3 col-md-6">

            <a href="{{ route('teachers.index') }}"
               class="text-decoration-none">

                <div class="card dashboard-card border-0 shadow-sm">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <small class="text-muted">
                                    Total Teachers
                                </small>

                                <h2 class="fw-bold mt-2 text-success">
                                    {{ $teachers }}
                                </h2>

                            </div>

                            <div class="icon-box bg-success-subtle text-success">

                                <i class="bi bi-person-badge-fill"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </a>

        </div>



        <!-- CLASSES -->
        <div class="col-xl-3 col-md-6">

            <a href="{{ route('classes.index') }}"
               class="text-decoration-none">

                <div class="card dashboard-card border-0 shadow-sm">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <small class="text-muted">
                                    Total Departments
                                </small>

                                <h2 class="fw-bold mt-2 text-warning">
                                    {{ $classes }}
                                </h2>

                            </div>

                            <div class="icon-box bg-warning-subtle text-warning">

                                <i class="bi bi-building"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </a>

        </div>



        <!-- SECTIONS -->
        <div class="col-xl-3 col-md-6">

            <div class="card dashboard-card border-0 shadow-sm">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <small class="text-muted">
                                Total Sections
                            </small>

                            <h2 class="fw-bold mt-2 text-danger">
                                {{ $sections }}
                            </h2>

                        </div>

                        <div class="icon-box bg-danger-subtle text-danger">

                            <i class="bi bi-diagram-3-fill"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <!-- QUICK ACTIONS -->
    <div class="row mt-4">

        <div class="col-lg-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-header bg-white border-0">

                    <h5 class="mb-0 fw-bold">
                        Quick Actions
                    </h5>

                </div>

                <div class="card-body">

                    <div class="d-grid gap-3">

                        <a href="{{ route('students.create') }}"
                           class="btn btn-primary">

                            <i class="bi bi-person-plus-fill"></i>
                            Add Student

                        </a>

                        <a href="{{ route('teachers.create') }}"
                           class="btn btn-success">

                            <i class="bi bi-person-workspace"></i>
                            Add Teacher

                        </a>

                        <!-- <a href="{{ route('classes.index') }}"
                           class="btn btn-warning text-white">

                            <i class="bi bi-building-add"></i>
                            Add Class

                        </a> -->

                    </div>

                </div>

            </div>

        </div>



        <!-- RECENT STUDENTS -->
        <div class="col-lg-8">

            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">

                    <h5 class="mb-0 fw-bold">
                        Recent Students
                    </h5>

                    <a href="{{ route('students.index') }}"
                       class="btn btn-sm btn-primary">

                        View All

                    </a>

                </div>

                <div class="card-body p-0">

                    <div class="table-responsive">

                        <table class="table align-middle mb-0">

                            <thead class="table-light">

                                <tr>

                                    <th>#</th>

                                    <th>Name</th>

                                    <th>Phone</th>

                                    <th>Gender</th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse($recentStudents as $student)

                                    <tr>

                                        <td>
                                            {{ $loop->iteration }}
                                        </td>

                                        <td class="fw-semibold">
                                            {{ $student->first_name }}
                                            {{ $student->last_name }}
                                        </td>

                                        <td>
                                            {{ $student->phone }}
                                        </td>

                                        <td>

                                            <span class="badge bg-light text-dark">

                                                {{ ucfirst($student->gender) }}

                                            </span>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="4"
                                            class="text-center text-muted py-4">

                                            No Students Found

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>



@endsection