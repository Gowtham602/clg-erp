@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h4 class="mb-0">
                Academic Years
            </h4>

            <button
                class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#academicYearModal">

                <i class="bi bi-plus-circle"></i>
                Add Academic Year

            </button>

        </div>

        <div class="card-body">

            <table
                id="academicYearTable"
                class="table table-bordered table-striped">

                <thead>

                    <tr>

                        <th>S.No</th>

                        <th>Academic Year</th>

                        <th>Start Date</th>

                        <th>End Date</th>

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
<div
    class="modal fade"
    id="academicYearModal"
    tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <form id="academicYearForm">

                @csrf
            <input type="hidden" id="academic_year_id" name="academic_year_id">
                <div class="modal-header">

                    <h5 class="modal-title">

                        Add Academic Year

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

                            Academic Year

                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            placeholder="2026-2027">

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            Start Date

                        </label>

                        <input
                            type="date"
                            name="start_date"
                            class="form-control">

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            End Date

                        </label>

                        <input
                            type="date"
                            name="end_date"
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
<!-- @include('admin.academic-years.modal') -->

@endsection

@push('scripts')

<script>

$(document).ready(function () {

    let table = $('#academicYearTable').DataTable({

        processing: true,

        serverSide: true,

        ajax: "{{ route('academic-years.data') }}",

        columns: [

            {
                data: null,
                orderable: false,
                searchable: false,

                render: function(data,type,row,meta){

                    return meta.row
                        + meta.settings._iDisplayStart
                        + 1;
                }
            },

            {
                data: 'name',
                name: 'name'
            },

            {
                data: 'start_date',
                name: 'start_date'
            },

            {
                data: 'end_date',
                name: 'end_date'
            },

            {
                data: 'status',
                name: 'status'
            },

            {
                data: 'action',
                orderable: false,
                searchable: false
            }

        ]

    });



    // STORE

    $('#academicYearForm').submit(function(e){

    e.preventDefault();

    let id = $('#academic_year_id').val();

    let url;
    let formData = $(this).serialize();

    if(id){

        url = "{{ route('academic-years.update', ':id') }}";
        url = url.replace(':id', id);

        formData += '&_method=PUT';

    }else{

        url = "{{ route('academic-years.store') }}";
    }

    $.ajax({

        url: url,

        type: 'POST',

        data: formData,

        success:function(response){

            $('#academicYearModal').modal('hide');

            $('#academicYearForm')[0].reset();

            $('#academic_year_id').val('');

            table.ajax.reload();

            Swal.fire({
                icon:'success',
                title:'Success',
                text:'Saved Successfully',
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

    //edit
   $(document).on('click','.editBtn',function(){

    let id = $(this).data('id');

    let url = "{{ route('academic-years.edit', ':id') }}";
    url = url.replace(':id', id);

    $.get(url,function(data){

        $('#academic_year_id').val(data.id);

        $('[name="name"]').val(data.name);

        $('[name="start_date"]').val(data.start_date);

        $('[name="end_date"]').val(data.end_date);

        $('[name="status"]').val(data.status);

        $('#academicYearModal').modal('show');

    });

});
$('#academicYearModal').on('hidden.bs.modal', function () {

    $('#academicYearForm')[0].reset();

    $('#academic_year_id').val('');

});
    // DELETE

    $(document).on('click','.deleteBtn',function(){

        let id = $(this).data('id');

        Swal.fire({

            title: 'Are you sure?',

            text: "You won't be able to revert this!",

            icon: 'warning',

            showCancelButton: true,

            confirmButtonColor: '#3085d6',

            cancelButtonColor: '#d33',

            confirmButtonText: 'Yes, delete it!'

        }).then((result) => {

            if(result.isConfirmed){

                $.ajax({

                    url: '/admin/academic-years/' + id,

                    type: 'DELETE',

                    data: {

                        _token: $('meta[name="csrf-token"]').attr('content')

                    },

                    success:function(){

                        table.ajax.reload();

                        Swal.fire({

                            icon:'success',

                            title:'Deleted',

                            text:'Academic Year Deleted Successfully'

                        });

                    }

                });

            }

        });

    });

});

</script>

@endpush