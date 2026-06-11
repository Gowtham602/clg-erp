@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="card shadow border-0">

        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

            <h5 class="mb-0">
                Subject Teacher Mapping
            </h5>

            <a href="{{ route('subject-teacher.create') }}"
               class="btn btn-light btn-sm">

                + Add Mapping

            </a>

        </div>

        <div class="card-body">

            <table
                id="subjectTeacherTable"
                class="table table-bordered table-hover align-middle">

                <thead class="table-dark">

                    <tr>
                        <th>#</th>
                        <th>Class</th>
                        <th>Section</th>
                        <th>Subject</th>
                        <th>Teacher</th>
                        <th>Action</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($subjectTeachers as $row)

                        <tr id="row{{ $row->id }}">

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                {{ optional(optional($row->subject)->classModel)->name ?? '-' }}
                            </td>

                            <td>
                                {{ optional($row->section)->name ?? '-' }}
                            </td>

                            <td>
                                {{ optional($row->subject)->name ?? '-' }}
                            </td>

                            <td>
                                {{ optional($row->teacher)->name ?? '-' }}
                            </td>

                            <td>

                                <a href="{{ route('subject-teacher.edit',$row->id) }}"
                                   class="btn btn-warning btn-sm">

                                    Edit

                                </a>

                                <button
                                    type="button"
                                    class="btn btn-danger btn-sm deleteBtn"
                                    data-id="{{ $row->id }}"
                                    data-url="{{ route('subject-teacher.destroy',$row->id) }}">

                                    Delete

                                </button>

                            </td>

                        </tr>

                    @empty

                    @endforelse

                </tbody>

            </table>

            @if($subjectTeachers->count() == 0)

                <div class="text-center py-4 text-muted">

                    No Subject Teacher Mapping Found

                </div>

            @endif

        </div>

    </div>

</div>

@endsection

@push('scripts')

<script>

$(document).ready(function () {

    @if($subjectTeachers->count() > 0)

        $('#subjectTeacherTable').DataTable({

            responsive: true,
            pageLength: 10

        });

    @endif


    $(document).on('click','.deleteBtn',function(){

        let id  = $(this).data('id');
        let url = $(this).data('url');

        Swal.fire({

            title:'Are you sure?',
            text:'Deleted data cannot be recovered',
            icon:'warning',
            showCancelButton:true,
            confirmButtonText:'Delete'

        }).then((result)=>{

            if(result.isConfirmed){

                $.ajax({

                    url:url,

                    type:'POST',

                    data:{
                        _token:'{{ csrf_token() }}',
                        _method:'DELETE'
                    },

                    success:function(){

                        $('#row'+id).remove();

                        Swal.fire(
                            'Deleted!',
                            'Record deleted successfully.',
                            'success'
                        );

                    }

                });

            }

        });

    });

});

</script>

@endpush