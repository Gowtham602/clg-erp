@extends('layouts.app')

@section('content')

<div class="container-fluid py-4">

    <!-- HEADER -->

   <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">

    <div class="card-body bg-primary text-white py-3 px-4">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

            <div>

                <h4 class="fw-bold mb-1">

                    <i class="bi bi-book-half me-2"></i>

                    Subject Management

                </h4>

                <small class="opacity-75">

                    Manage class subjects professionally

                </small>

            </div>

            <a href="{{ route('subjects.create') }}"
               class="btn btn-light rounded-pill px-3 py-2 shadow-sm">

                <i class="bi bi-plus-circle-fill me-1"></i>

                Add Subject

            </a>

        </div>

    </div>

</div>





    <!-- STATS -->

    <div class="row mb-4">

        <!-- TOTAL SUBJECTS -->

        <div class="col-md-4 mb-3">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted text-uppercase fw-semibold">

                            Total Subjects

                        </small>    

                        <h2 class="fw-bold mt-2 mb-0">

                            {{ $totalSubjects }}

                        </h2>

                    </div>



                    <div class="bg-primary bg-opacity-10 text-primary rounded-4 p-1">

                        <i class="bi bi-journal-bookmark-fill fs-2"></i>

                    </div>

                </div>

            </div>

        </div>



        <!-- TOTAL CLASSES -->

        <div class="col-md-4 mb-3">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted text-uppercase fw-semibold">

                            Total Classes

                        </small>

                        <h2 class="fw-bold mt-2 mb-0">

                            {{ $totalClasses }}

                        </h2>

                    </div>



                    <div class="bg-success bg-opacity-10 text-success rounded-4 p-1">

                        <i class="bi bi-mortarboard-fill fs-2"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>





    <!-- TABLE -->

    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

        <div class="card-body p-4">

            <div class="table-responsive">

                <table class="table align-middle table-hover mb-0">

                    <thead class="table-dark">

                        <tr>

                            <th width="80">

                                #

                            </th>

                            <th>

                                Class

                            </th>

                            <th>

                                Subjects

                            </th>

                            <th width="180">

                                Action

                            </th>

                        </tr>

                    </thead>



                    <tbody>

                        @forelse($classes as $key => $class)

                        <tr>

                            <!-- SNO -->

                            <td>

                                <span class="fw-bold text-primary">

                                    {{ ++$key }}

                                </span>

                            </td>



                            <!-- CLASS -->

                            <td>

                                <div class="d-flex align-items-center gap-3">

                                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-2">

                                        <i class="bi bi-mortarboard-fill"></i>

                                    </div>

                                    <div>

                                        <div class="fw-semibold">

                                            {{ $class->name }}

                                        </div>

                                        <small class="text-muted">

                                            Academic Class

                                        </small>

                                    </div>

                                </div>

                            </td>



                            <!-- SUBJECTS -->

                            <td>

                                @forelse($class->subjects as $subject)

                                <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill fw-semibold me-1 mb-1">

                                    {{ $subject->name }}

                                </span>

                                @empty

                                <span class="text-muted">

                                    No Subjects

                                </span>

                                @endforelse

                            </td>



                            <!-- ACTION -->

                            <td>

                                <div class="dropdown">

                                    <button
                                        class="btn btn-light border shadow-sm rounded-circle"
                                        data-bs-toggle="dropdown"
                                        style="width:42px;height:42px;">

                                        <i class="bi bi-three-dots"></i>

                                    </button>



                                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow rounded-4 p-2">

                                        @forelse($class->subjects as $subject)

                                        <!-- SUBJECT TITLE -->

                                        <li>

                                            <div class="dropdown-item-text small fw-bold text-muted">

                                                {{ $subject->name }}

                                            </div>

                                        </li>

                                        <!-- EDIT -->
                                        <!-- <li> -->

                                         <li>
    <a href="{{ route('subjects.edit', $subject->id) }}"
       class="dropdown-item rounded-3">

        <i class="bi bi-pencil-square me-2"></i>
        Edit

    </a>
</li>

                                        <!-- </li> -->



                        

                                        <li>

                                            <form
                                                action="{{ route('subjects.destroy',$subject->id) }}"
                                                method="POST"
                                                class="deleteForm">

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="dropdown-item text-danger rounded-3">

                                                    <i class="bi bi-trash me-2"></i>

                                                    Delete

                                                </button>

                                            </form>

                                        </li>



                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>

                                        @empty

                                        <li>

                                            <span class="dropdown-item-text text-muted">

                                                No Subjects

                                            </span>

                                        </li>

                                        @endforelse

                                    </ul>

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="4"
                                class="text-center py-5">

                                <div class="text-muted">

                                    <i class="bi bi-inbox fs-1 d-block mb-3"></i>

                                    No Subjects Found

                                </div>

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






@push('scripts')

<!-- SUCCESS -->

@if(session('success'))

<script>
    Swal.fire({

        icon: 'success',

        title: 'Success',

        text: '{{ session('success')}}',

        timer: 2000,

        showConfirmButton: false

    });
</script>

@endif





<!-- DELETE -->

<script>
    $(document).ready(function() {

        $('.deleteForm').submit(function(e) {

            e.preventDefault();

            let form = this;

            Swal.fire({

                title: 'Are you sure?',

                text: "Deleted data cannot be recovered!",

                icon: 'warning',

                showCancelButton: true,

                confirmButtonColor: '#0d6efd',

                cancelButtonColor: '#dc3545',

                confirmButtonText: 'Yes Delete'

            }).then((result) => {

                if (result.isConfirmed) {

                    form.submit();

                }

            });

        });

    });
</script>

@endpush