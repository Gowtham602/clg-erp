@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="card shadow border-0">

        {{-- HEADER --}}

        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

            <h5 class="mb-0">
                Subject Teacher Mapping
            </h5>

            <a href="{{ route('subject-teacher.create') }}"
               class="btn btn-light btn-sm">

                + Add Mapping

            </a>

        </div>


        {{-- BODY --}}

        <div class="card-body">

            <table
                class="table table-bordered table-hover align-middle"
                id="subjectTeacherTable">

                <thead class="table-dark">

                    <tr>

                        <th width="70">#</th>

                        <th>Class</th>

                        <th>Section</th>

                        <th>Subject</th>

                        <th>Teacher</th>

                        <th width="170">Action</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($subjectTeachers as $key => $row)

                    <tr id="row{{ $row->id }}">

                        {{-- SERIAL NUMBER --}}

                        <td>
                            {{ $loop->iteration }}
                        </td>


                        {{-- CLASS --}}

                        <td>
                            {{ $row->subject->classModel->name ?? '-' }}
                        </td>


                        {{-- SECTION --}}

                        <td>
                            {{ $row->section->name ?? '-' }}
                        </td>


                        {{-- SUBJECT --}}

                        <td>
                            {{ $row->subject->name ?? '-' }}
                        </td>


                        {{-- TEACHER --}}

                        <td>
                            {{ $row->teacher->name ?? '-' }}
                        </td>


                        {{-- ACTION --}}

                        <td>

                            {{-- EDIT --}}

                            <a href="{{ route('subject-teacher.edit', $row->id) }}"
                               class="btn btn-warning btn-sm">

                                Edit

                            </a>


                            {{-- DELETE --}}

                            <button
                                type="button"
                                class="btn btn-danger btn-sm deleteBtn"
                                data-id="{{ $row->id }}"
                                data-url="{{ route('subject-teacher.destroy', $row->id) }}">

                                Delete

                            </button>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="6"
                            class="text-center text-muted">

                            No Subject Teacher Mapping Found

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection



@push('scripts')

<script>

$(document).ready(function () {

    // DATATABLE

    $('#subjectTeacherTable').DataTable({

        responsive: true

    });


    // DELETE

    $(document).on('click', '.deleteBtn', function () {

        let id = $(this).data('id');

        let url = $(this).data('url');

        Swal.fire({

            title: 'Are you sure?',

            text: 'Deleted data cannot be recovered',

            icon: 'warning',

            showCancelButton: true,

            confirmButtonColor: '#d33',

            cancelButtonColor: '#3085d6',

            confirmButtonText: 'Delete'

        }).then((result) => {

            if (result.isConfirmed) {

                $.ajax({

                    url: url,

                    type: 'POST',

                    data: {

                        _token: '{{ csrf_token() }}',

                        _method: 'DELETE'

                    },

                    success: function (response) {

                        $('#row' + id).remove();

                        Swal.fire({

                            icon: 'success',

                            title: 'Deleted Successfully',

                            timer: 1500,

                            showConfirmButton: false

                        });

                    },

                    error: function () {

                        Swal.fire({

                            icon: 'error',

                            title: 'Something went wrong'

                        });

                    }

                });

            }

        });

    });

});

</script>

@endpush