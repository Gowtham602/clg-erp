@extends('layouts.app')

@section('content')

<div class="container-fluid py-4">

    <!-- HEADER -->

    <div class="card border-0 shadow-lg rounded-4 overflow-hidden mb-4">

        <div class="card-body bg-primary text-white p-4">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                <div>

                    <h2 class="fw-bold mb-1">

                        <i class="bi bi-diagram-3-fill me-2"></i>

                        Section Management

                    </h2>

                    <p class="mb-0 opacity-75">

                        Manage class sections professionally

                    </p>

                </div>



                <button
                    class="btn btn-light btn-lg rounded-pill px-4 shadow-sm"
                    id="addBtn">

                    <i class="bi bi-plus-circle-fill me-2"></i>

                    Add Section

                </button>

            </div>

        </div>

    </div>





    <!-- STATS -->

    <div class="row mb-4">

        <!-- TOTAL SECTIONS -->

        <div class="col-md-6 mb-3">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted text-uppercase fw-semibold">

                            Total Sections

                        </small>

                        <h2 class="fw-bold mt-2 mb-0">

                            {{ $totalSections }}

                        </h2>

                    </div>



                    <div class="bg-primary bg-opacity-10 text-primary rounded-4 p-3">

                        <i class="bi bi-diagram-3-fill fs-2"></i>

                    </div>

                </div>

            </div>

        </div>



        <!-- TOTAL CLASSES -->

        <div class="col-md-6 mb-3">

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



                    <div class="bg-success bg-opacity-10 text-success rounded-4 p-3">

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

                <table
                    class="table table-hover align-middle mb-0"
                    id="sectionTable">

                    <thead class="table-dark">

                        <tr>

                            <th width="80">

                                #

                            </th>

                            <th>

                                Class

                            </th>

                            <th>

                                Section

                            </th>

                            <th width="180">

                                Action

                            </th>

                        </tr>

                    </thead>

                </table>

            </div>

        </div>

    </div>

</div>





<!-- MODAL -->

<div class="modal fade" id="sectionModal" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 rounded-4 shadow-lg overflow-hidden">

            <form id="sectionForm">

                @csrf

                <input type="hidden" id="section_id">



                <!-- HEADER -->

                <div class="modal-header bg-primary text-white border-0 p-4">

                    <h4 class="modal-title fw-bold">

                        <i class="bi bi-diagram-3-fill me-2"></i>

                        Section Form

                    </h4>

                    <button
                        type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal">
                    </button>

                </div>



                <!-- BODY -->

                <div class="modal-body p-4">

                    <!-- CLASS -->

                    <div class="mb-4">

                        <label class="form-label fw-semibold">

                            Class

                        </label>

                        <select
                            id="class_id"
                            class="form-select form-select-lg rounded-4">

                            <option value="">

                                Select Class

                            </option>

                            @foreach($classes as $class)

                                <option value="{{ $class->id }}">

                                    {{ $class->name }}

                                </option>

                            @endforeach

                        </select>

                        <small class="text-danger error_class_id"></small>

                    </div>





                    <!-- SECTION -->

                    <div class="mb-3">

                        <label class="form-label fw-semibold">

                            Section Name

                        </label>

                        <div class="input-group input-group-lg">

                            <span class="input-group-text bg-primary text-white border-0 rounded-start-4">

                                <i class="bi bi-grid-fill"></i>

                            </span>

                            <input
                                type="text"
                                id="name"
                                class="form-control rounded-end-4"
                                placeholder="Enter Section Name">

                        </div>

                        <small class="text-danger error_name"></small>

                    </div>

                </div>



                <!-- FOOTER -->

                <div class="modal-footer border-0 px-4 pb-4">

                    <button
                        type="button"
                        class="btn btn-light border rounded-pill px-4"
                        data-bs-dismiss="modal">

                        Close

                    </button>



                    <button
                        type="submit"
                        class="btn btn-primary rounded-pill px-5 shadow-sm">

                        <i class="bi bi-check-circle-fill me-2"></i>

                        Save Section

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection






@push('scripts')

<script>

$(document).ready(function () {

    // CSRF

    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN':
                $('meta[name="csrf-token"]').attr('content')

        }

    });





    // DATATABLE

    let table = $('#sectionTable').DataTable({

        processing: true,

        serverSide: true,

        responsive: true,

        ajax: "{{ route('sections.index') }}",

        columns: [

            {
                data: 'DT_RowIndex',

                name: 'DT_RowIndex',

                orderable: false,

                searchable: false
            },



            {
                data: 'class_name',

                name: 'class_name'
            },



            {
                data: 'name',

                name: 'name'
            },



            {
                data: 'action',

                name: 'action',

                orderable: false,

                searchable: false
            }

        ]

    });






    // ADD

    $('#addBtn').click(function () {

        $('#sectionForm')[0].reset();

        $('#section_id').val('');

        $('.text-danger').html('');

        $('#sectionModal').modal('show');

    });






    // SAVE / UPDATE

 // SAVE / UPDATE

$('#sectionForm').submit(function (e) {

    e.preventDefault();

    $('.text-danger').html('');

    let id = $('#section_id').val();

    let url = id
        ? "{{ route('sections.update', ':id') }}"
            .replace(':id', id)
        : "{{ route('sections.store') }}";

    let method = id
        ? 'PUT'
        : 'POST';



    $.ajax({

        url: url,

        type: method,

        data: {

            _token: $('meta[name="csrf-token"]').attr('content'),

            class_id: $('#class_id').val(),

            name: $('#name').val()

        },



        success: function (response) {

            $('#sectionModal').modal('hide');

            $('#sectionForm')[0].reset();

            table.ajax.reload();



            Swal.fire({

                icon: 'success',

                title: 'Success',

                text: response.message,

                timer: 2000,

                showConfirmButton: false

            });

        },



        error: function (xhr) {

            if(xhr.status === 422){

                let errors = xhr.responseJSON.errors;

                $.each(errors, function(key, value){

                    $('.error_' + key).html(value[0]);

                });

            }

        }

    });

});



    // EDIT

    $(document).on('click', '.editBtn', function () {

        let id = $(this).data('id');

        let url = "{{ route('sections.edit', ':id') }}"
            .replace(':id', id);



        $.ajax({

            url: url,

            type: 'GET',



            success: function (response) {

                $('#section_id').val(response.id);

                $('#class_id').val(response.class_id);

                $('#name').val(response.name);

                $('#sectionModal').modal('show');

            }

        });

    });






    // DELETE

    $(document).on('click', '.deleteBtn', function () {

        let id = $(this).data('id');

        let url = "{{ route('sections.destroy', ':id') }}"
            .replace(':id', id);



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

                $.ajax({

                    url: url,

                    type: 'DELETE',



                    success: function (response) {

                        table.ajax.reload();



                        Swal.fire({

                            icon: 'success',

                            title: 'Deleted',

                            text: response.message,

                            timer: 2000,

                            showConfirmButton: false

                        });

                    }

                });

            }

        });

    });

});

</script>

@endpush