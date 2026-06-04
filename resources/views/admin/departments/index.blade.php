@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h4 class="mb-0">
                Departments
            </h4>

            <button
                class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#departmentModal">

                <i class="bi bi-plus-circle"></i>
                Add Department

            </button>

        </div>

        <div class="card-body">

            <table
                id="departmentTable"
                class="table table-bordered table-striped">

                <thead>

                    <tr>

                        <th>S.No</th>

                        <th>Department Name</th>

                        <th>Code</th>

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

<!-- Modal -->

<div
    class="modal fade"
    id="departmentModal"
    tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <form id="departmentForm">

                @csrf

                <input
                    type="hidden"
                    id="department_id">

                <div class="modal-header">

                    <h5 class="modal-title">

                        Department

                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <div class="mb-3">

                        <label class="form-label">

                            Department Name

                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control">

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            Department Code

                        </label>

                        <input
                            type="text"
                            name="code"
                            class="form-control">

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            Status

                        </label>

                        <select
                            name="status"
                            class="form-select">

                            <option value="1">
                                Active
                            </option>

                            <option value="0">
                                Inactive
                            </option>

                        </select>

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                        Close

                    </button>

                    <button
                        type="submit"
                        class="btn btn-primary">

                        Save

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection

@push('scripts')

<script>

$(document).ready(function(){

    let table = $('#departmentTable').DataTable({

        processing:true,

        serverSide:true,

        ajax:"{{ route('departments.data') }}",

        columns:[

            {
                data:null,
                orderable:false,
                searchable:false,

                render:function(data,type,row,meta){

                    return meta.row
                        + meta.settings._iDisplayStart
                        + 1;
                }
            },

            {
                data:'name',
                name:'name'
            },

            {
                data:'code',
                name:'code'
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




    // STORE & UPDATE

    $('#departmentForm').submit(function(e){

        e.preventDefault();

        let id = $('#department_id').val();
        console.log(id,"id");

        let url;
        let formData = $(this).serialize();

        if(id){

            url = "{{ route('departments.update', ':id') }}";
            url = url.replace(':id', id);

            formData += '&_method=PUT';

        }else{

            url = "{{ route('departments.store') }}";
        }

        $.ajax({

            url:url,

            type:'POST',

            data:formData,

            success:function(response){

                $('#departmentModal').modal('hide');

                $('#departmentForm')[0].reset();

                $('#department_id').val('');

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

        let url = "{{ route('departments.edit', ':id') }}";

        url = url.replace(':id', id);

        $.get(url,function(data){

            $('#department_id').val(data.id);

            $('[name="name"]').val(data.name);

            $('[name="code"]').val(data.code);

            $('[name="status"]').val(data.status);

            $('#departmentModal').modal('show');

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

                let url = "{{ route('departments.destroy', ':id') }}";

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




    // RESET MODAL

    $('#departmentModal').on('hidden.bs.modal', function () {

        $('#departmentForm')[0].reset();

        $('#department_id').val('');

    });

});

</script>

@endpush