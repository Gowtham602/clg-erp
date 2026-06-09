@extends('layouts.app')

@section('content')

<div class="container-fluid py-3">

    <!-- TOP ERP HEADER -->
    <div class="card border-0 shadow-lg mb-4">

        <div class="card-body bg-primary text-white rounded">

            <div class="d-flex justify-content-between align-items-center flex-wrap">

                <div>
                    <h2 class="fw-bold mb-1">
                        <i class="bi bi-mortarboard-fill"></i>
                        Agricultural College - Students
                    </h2>

                    <p class="mb-0">
                        Manage all student records easily
                    </p>
                </div>

                <div class="mt-2 mt-md-0">

                    <a href="{{ route('students.create') }}"
                       class="btn btn-light fw-bold shadow-sm">

                        <i class="bi bi-plus-circle-fill"></i>
                        Add Student
                    </a>

                </div>

            </div>

        </div>

    </div>


    <!-- MAIN CARD -->
    <div class="card border-0 shadow-lg">

        <!-- HEADER -->
        <div class="card-header bg-white border-0 py-3">

            <div class="d-flex justify-content-between align-items-center">

                <h4 class="mb-0 fw-bold text-primary">

                    <i class="bi bi-people-fill"></i>
                    Student List

                </h4>
<!-- 
                <span class="badge bg-primary fs-6 px-3 py-2">

                    ERP System

                </span> -->

            </div>

        </div>


        <!-- BODY -->
        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle"
                       id="studentTable"
                       width="100%">
<thead class="table-primary">

<tr>

    <th>#</th>

    <th>Student Name</th>

    <th>Admission No</th>

    <th>Roll No</th>

    <th>Phone</th>

    <th>Course</th>

    <th>Semester</th>

    <th>Section</th>

    <th>Academic Year</th>

    <th>Status</th>

    <th>Action</th>

</tr>

</thead>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection



@push('styles')

<style>

    .table th {
        font-size: 14px;
        font-weight: 700;
        white-space: nowrap;
    }

    .table td {
        vertical-align: middle;
        font-size: 14px;
    }

    .dataTables_wrapper .dataTables_filter input {
        border-radius: 8px;
        border: 1px solid #ccc;
        padding: 5px 10px;
    }

    .dataTables_wrapper .dataTables_length select {
        border-radius: 8px;
        border: 1px solid #ccc;
    }

    .btn-action {
        width: 35px;
        height: 35px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    table.dataTable tbody tr:hover {
        background-color: #f5f9ff;
        transition: 0.2s;
    }

</style>

@endpush



@push('scripts')

<script>

$(document).ready(function(){

    let table = $('#studentTable').DataTable({

        processing:true,

        serverSide:true,

        responsive:true,

        ajax:"{{ route('students.data') }}",

        columns:[

            {
                data:'DT_RowIndex',
                orderable:false,
                searchable:false
            },

            {
                data:'student_name',
                name:'student_name'
            },

            {
                data:'admission_no',
                name:'admission_no'
            },

            {
                data:'roll_no',
                name:'roll_no'
            },

            {
                data:'phone',
                name:'phone'
            },

            {
                data:'course',
                name:'course'
            },

            {
                data:'semester',
                name:'semester'
            },

            {
                data:'section',
                name:'section'
            },

            {
                data:'academic_year',
                name:'academic_year'
            },

            {
                data:'status',
                name:'status'
            },

            {
                data:'action',
                orderable:false,
                searchable:false,
                className:'text-center'
            }

        ]

    });



    // DELETE

    $(document).on('click','.deleteBtn',function(){

        let id = $(this).data('id');

        Swal.fire({

            title:'Are you sure?',

            text:'Delete this student?',

            icon:'warning',

            showCancelButton:true,

            confirmButtonText:'Yes Delete',

            cancelButtonText:'Cancel'

        }).then((result)=>{

            if(result.isConfirmed){

                let url = "{{ route('students.destroy', ':id') }}";

                url = url.replace(':id', id);

                $.ajax({

                    url:url,

                    type:'POST',

                    data:{

                        _token:'{{ csrf_token() }}',

                        _method:'DELETE'

                    },

                    success:function(response){

                        table.ajax.reload();

                        Swal.fire({

                            icon:'success',

                            title:'Success',

                            text:'Student Deleted Successfully',

                            timer:2000,

                            showConfirmButton:false

                        });

                    }

                });

            }

        });

    });

});

</script>

@endpush