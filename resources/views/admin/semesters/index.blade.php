@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="card">

        <div class="card-header d-flex justify-content-between">

            <h4>
                Semester Management
            </h4>

            <button
                class="btn btn-primary"
                id="addSemesterBtn">

                <i class="bi bi-plus-circle"></i>
                Add Semester

            </button>

        </div>

        <div class="card-body">

            <table
                id="semesterTable"
                class="table table-bordered table-striped">

                <thead>

                    <tr>

                        <th>#</th>

                        <th>Course</th>

                        <th>Semester</th>

                        <th>Semester No</th>

                        <th>Status</th>

                        <th width="150">
                            Action
                        </th>

                    </tr>

                </thead>

            </table>

        </div>

    </div>

</div>

@include('admin.semesters.modal')

@endsection
@push('scripts')

<script>

$(document).ready(function(){

    // DATATABLE

    let table = $('#semesterTable').DataTable({

        processing:true,

        serverSide:true,

        ajax:"{{ route('semesters.data') }}",

        columns:[

            {
                data:'DT_RowIndex',
                orderable:false,
                searchable:false
            },

            {
                data:'course',
                name:'course'
            },

            {
                data:'name',
                name:'name'
            },

            {
                data:'semester_no',
                name:'semester_no'
            },

            {
                data:'status',
                name:'status'
            },

            {
                data:'action',
                orderable:false,
                searchable:false
            }

        ]

    });



    // MODAL

    let modal = new bootstrap.Modal(

        document.getElementById('semesterModal')

    );



    // ADD

    $('#addSemesterBtn').click(function(){

        $('#semesterForm')[0].reset();

        $('#semester_id').val('');

        $('#modalTitle').text('Add Semester');

        $('.text-danger').text('');

        modal.show();

    });



    // STORE & UPDATE

    $('#semesterForm').submit(function(e){

        e.preventDefault();

        let id = $('#semester_id').val();

        let url;

        let formData = $(this).serialize();

        if(id){

            url = "{{ route('semesters.update', ':id') }}";

            url = url.replace(':id', id);

            formData += '&_method=PUT';

        }
        else{

            url = "{{ route('semesters.store') }}";

        }

        $.ajax({

            url:url,

            type:'POST',

            data:formData,

            success:function(response){

                modal.hide();

                $('#semesterForm')[0].reset();

                $('#semester_id').val('');

                table.ajax.reload();

                Swal.fire({

                    icon:'success',

                    title:'Success',

                    text:response.message,

                    timer:2000,

                    showConfirmButton:false

                });

            },

            error:function(xhr){

                let errors = xhr.responseJSON.errors;

                let errorText = '';

                $.each(errors,function(key,value){

                    errorText += value[0] + '<br>';

                });

                Swal.fire({

                    icon:'error',

                    title:'Validation Error',

                    html:errorText

                });

            }

        });

    });



    // EDIT

    $(document).on('click','.editBtn',function(){

        let id = $(this).data('id');

        let url = "{{ route('semesters.edit', ':id') }}";

        url = url.replace(':id', id);

        $.get(url,function(data){

            $('#semester_id').val(data.id);

            $('[name="course_id"]').val(data.course_id);

            $('[name="name"]').val(data.name);

            $('[name="semester_no"]').val(data.semester_no);

            $('[name="status"]').val(data.status);

            $('#modalTitle').text('Edit Semester');

            modal.show();

        });

    });



    // DELETE

    $(document).on('click','.deleteBtn',function(){

        let id = $(this).data('id');

        Swal.fire({

            title:'Are you sure?',

            text:"You won't be able to revert this!",

            icon:'warning',

            showCancelButton:true,

            confirmButtonColor:'#3085d6',

            cancelButtonColor:'#d33',

            confirmButtonText:'Yes, Delete'

        }).then((result)=>{

            if(result.isConfirmed){

                let url = "{{ route('semesters.destroy', ':id') }}";

                url = url.replace(':id', id);

                $.ajax({

                    url:url,

                    type:'POST',

                    data:{

                        _method:'DELETE',

                        _token:$('meta[name="csrf-token"]').attr('content')

                    },

                    success:function(response){

                        table.ajax.reload();

                        Swal.fire({

                            icon:'success',

                            title:'Deleted',

                            text:response.message

                        });

                    }

                });

            }

        });

    });

});

</script>

@endpush