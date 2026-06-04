@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <!-- TOP STATS -->

    <div class="row mb-4">

        <!-- TOTAL CLASSES -->

        <div class="col-md-4 mb-3">

            <div class="card border-0 shadow-sm dashboard-card bg-primary text-white">

                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>

                        <h6 class="mb-1 text-uppercase">
                            Total Departments
                        </h6>

                        <h2 class="fw-bold mb-0">

                            {{ $totalClasses }}

                        </h2>

                    </div>

                    <div class="icon-box">

                        <i class="bi bi-mortarboard-fill"></i>

                    </div>

                </div>

            </div>

        </div>



        <!-- TOTAL SECTIONS -->

        <div class="col-md-4 mb-3">

            <div class="card border-0 shadow-sm dashboard-card bg-success text-white">

                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>

                        <h6 class="mb-1 text-uppercase">
                            Total Sections
                        </h6>

                        <h2 class="fw-bold mb-0">

                            {{ $totalSections }}

                        </h2>

                    </div>

                    <div class="icon-box">

                        <i class="bi bi-diagram-3-fill"></i>

                    </div>

                </div>

            </div>

        </div>



        <!-- ACTIVE CLASSES -->

        <!-- <div class="col-md-4 mb-3">

            <div class="card border-0 shadow-sm dashboard-card bg-dark text-white">

                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>

                        <h6 class="mb-1 text-uppercase">
                            Active Classes
                        </h6>

                        <h2 class="fw-bold mb-0">

                            {{ $activeClasses }}

                        </h2>

                    </div>

                    <div class="icon-box">

                        <i class="bi bi-collection-fill"></i>

                    </div>

                </div>

            </div>

        </div> -->

    </div>

    <div class="card shadow border-0">

        <!-- HEADER -->
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

            <div>

                <h4 class="mb-0 fw-bold">

                    <i class="bi bi-mortarboard-fill"></i>
                    Department Management

                </h4>

                <small>Manage Departments and sections</small>

            </div>

            <!-- ADD BUTTON -->
            <button class="btn btn-light fw-semibold"
                id="addClassBtn">

                <i class="bi bi-plus-circle"></i>
                Add departments

            </button>

        </div>

        <!-- BODY -->
        <div class="card-body">

            <table class="table table-bordered align-middle"
                id="classesTable">

                <thead class="table-light">

                    <tr>

                        <th>#</th>
                        <th>Departments Names</th>
                        <th>Sections</th>
                        <th width="150">Actions</th>

                    </tr>

                </thead>

            </table>

        </div>

    </div>

</div>





<!-- MODAL -->
<div class="modal fade"
    id="classModal"
    tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 shadow-lg">

            <!-- HEADER -->
            <div class="modal-header bg-primary text-white">

                <h5 class="modal-title fw-bold"
                    id="modalTitle">

                    Add Departments

                </h5>

                <button type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"></button>

            </div>

            <!-- FORM -->
            <form id="classForm">

                @csrf

                <input type="hidden"
                    id="class_id">

                <div class="modal-body">

                    <!-- CLASS NAME -->
                    <div class="mb-3">

                        <label class="form-label fw-semibold">

                            Departments Name

                        </label>

                        <input type="text"
                            name="name"
                            id="name"
                            class="form-control"
                            placeholder="Enter Departments Name">

                        <small class="text-danger"
                            id="name_error"></small>

                    </div>

                </div>

                <!-- FOOTER -->
                <div class="modal-footer">

                    <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                        Close

                    </button>

                    <button type="submit"
                        class="btn btn-success">

                        <i class="bi bi-check-circle"></i>
                        Save

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection




@push('scripts')

<!-- TOASTR -->
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $(document).ready(function() {

        // DATATABLE
        let table = $('#classesTable').DataTable({

            processing: true,

            serverSide: true,

            ajax: "{{ route('classes.data') }}",

            columns: [

                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },

                {
                    data: 'name',
                    name: 'name'
                },

                {
                    data: 'sections',
                    name: 'sections',
                    orderable: false,
                    searchable: false
                },

                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }

            ]

        });





        // MODAL
        let modal = new bootstrap.Modal(
            document.getElementById('classModal')
        );





        // ADD
        $('#addClassBtn').click(function() {

            $('#classForm')[0].reset();

            $('#class_id').val('');

            $('#modalTitle').text('Add Class');

            $('.text-danger').text('');

            modal.show();

        });

        //deleted 

        $(document).on('click', '.deleteBtn', function () {

    let id = $(this).data('id');

    Swal.fire({

        title: 'Are you sure?',

        text: "You won't be able to revert this!",

        icon: 'warning',

        showCancelButton: true,

        confirmButtonColor: '#d33',

        cancelButtonColor: '#3085d6',

        confirmButtonText: 'Yes, delete it!'

    }).then((result) => {

        if (result.isConfirmed) {

            $.ajax({

                url: "{{ route('classes.destroy', ':id') }}"
                    .replace(':id', id),

                type: "POST",

                data: {

                    _token: "{{ csrf_token() }}",

                    _method: "DELETE"

                },

                success: function (response) {

                    toastr.success('Class Deleted Successfully');

                    $('#classesTable')
                        .DataTable()
                        .ajax.reload();

                }

            });

        }

    });

});



        // EDIT
        $(document).on('click', '.editBtn', function() {

            let id = $(this).data('id');

            let name = $(this).data('name');

            $('#class_id').val(id);

            $('#name').val(name);

            $('#modalTitle').text('Edit Department Name');

            $('.text-danger').text('');

            modal.show();

        });





        // SAVE
        $('#classForm').submit(function(e) {

            e.preventDefault();

            $('.text-danger').text('');

            let id = $('#class_id').val();

            let formData = new FormData(this);

            let url = '';
            let method = '';



            if (id == '') {

                url = "{{ route('classes.store') }}";

                method = "POST";

            } else {

                url = "{{ route('classes.update', ':id') }}";

                url = url.replace(':id', id);

                formData.append('_method', 'PUT');

                method = "POST";

            }



            $.ajax({

                url: url,

                type: method,

                data: formData,

                processData: false,

                contentType: false,



                success: function(response) {

                    modal.hide();

                    toastr.success(response.message);

                    table.ajax.reload();

                },



                error: function(xhr) {

                    if (xhr.status === 422) {

                        let errors = xhr.responseJSON.errors;

                        if (errors.name) {

                            $('#name_error').text(errors.name[0]);

                        }

                    }

                }

            });

        });

    });
</script>

@endpush