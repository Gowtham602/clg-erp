@extends('layouts.app')

@section('content')

<div class="container-fluid py-4">

    <!-- HEADER -->

    <div class="row mb-4">

        <div class="col-12">

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                <div class="card-body bg-primary text-white p-4">

                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                        <div>

                            <h2 class="fw mb-1">

                                <i class="bi bi-person-workspace me-2"></i>

                                Class Teacher Management

                            </h2>

                            <p class="mb-0 opacity-75">

                                Manage class teacher mappings professionally

                            </p>

                        </div>



                        <button
                            class="btn btn-light btn-lg rounded-pill px-4 shadow-sm"
                            id="addBtn">

                            <i class="bi bi-plus-circle-fill me-2"></i>

                            Add Mapping

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>





    <!-- STATS -->

    <div class="row mb-4">

        <!-- TOTAL MAPPINGS -->

        <div class="col-md-4 mb-3">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body d-flex align-items-center justify-content-between">

                    <div>

                        <small class="text-muted text-uppercase fw-semibold">

                            Total Mappings

                        </small>

                        <h2 class="fw-bold mb-0 mt-2">

                            {{ $classTeacherConut }}

                        </h2>

                    </div>



                    <div class="bg-primary bg-opacity-10 text-primary rounded-4 p-3">

                        <i class="bi bi-diagram-3-fill fs-2"></i>

                    </div>

                </div>

            </div>

        </div>



        <!-- TOTAL TEACHERS -->

        <div class="col-md-4 mb-3">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body d-flex align-items-center justify-content-between">

                    <div>

                        <small class="text-muted text-uppercase fw-semibold">

                            Total Teachers

                        </small>

                        <h2 class="fw-bold mb-0 mt-2">

                            {{$totalTeacherCount}}

                        </h2>

                    </div>



                    <div class="bg-success bg-opacity-10 text-success rounded-4 p-3">

                        <i class="bi bi-person-video3 fs-2"></i>

                    </div>

                </div>

            </div>

        </div>



        <!-- TOTAL SECTIONS -->

        <div class="col-md-4 mb-3">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body d-flex align-items-center justify-content-between">

                    <div>

                        <small class="text-muted text-uppercase fw-semibold">

                            Total Sections

                        </small>

                        <h2 class="fw-bold mb-0 mt-2">

                            {{ $totalSectionCount }}

                        </h2>

                    </div>



                    <div class="bg-dark bg-opacity-10 text-dark rounded-4 p-3">

                        <i class="bi bi-grid-fill fs-2"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>





    <!-- TABLE -->

    <div class="card border-0 shadow-lg rounded-4">

        <div class="card-body p-4">

            <div class="table-responsive">

                <table
                    class="table table-hover align-middle mb-0"
                    id="classTeacherTable">

                    <thead class="table-dark">

                        <tr>

                            <th width="70">

                                #

                            </th>

                            <th>

                                Class

                            </th>

                            <th>

                                Section

                            </th>

                            <th>

                                Teacher

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

<div class="modal fade" id="classTeacherModal" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 rounded-4 shadow-lg overflow-hidden">

            <form id="classTeacherForm">

                @csrf

                <input type="hidden" id="mapping_id">



                <!-- HEADER -->

                <div class="modal-header bg-primary text-white border-0 p-4">

                    <h4 class="modal-title fw-bold">

                        <i class="bi bi-person-plus-fill me-2"></i>

                        Class Teacher Form

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
                            class="form-select form-select-lg rounded-3">

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

                    <div class="mb-4">

                        <label class="form-label fw-semibold">

                            Section

                        </label>

                        <select
                            id="section_id"
                            class="form-select form-select-lg rounded-3">

                            <option value="">
                                Select Section
                            </option>

                        </select>

                        <small class="text-danger error_section_id"></small>

                    </div>



                    <!-- TEACHER -->

                    <div class="mb-3">

                        <label class="form-label fw-semibold">

                            Teacher

                        </label>

                        <select
                            id="teacher_id"
                            class="form-select form-select-lg rounded-3">

                            <option value="">
                                Select Teacher
                            </option>

                            @foreach($teachers as $teacher)

                            <option value="{{ $teacher->id }}">

                                {{ $teacher->name }}

                            </option>

                            @endforeach

                        </select>

                        <small class="text-danger error_teacher_id"></small>

                    </div>

                </div>



                <!-- FOOTER -->

                <div class="modal-footer border-0 px-4 pb-4">

                    <button
                        type="button"
                        class="btn btn-light rounded-pill px-4"
                        data-bs-dismiss="modal">

                        Close

                    </button>

                    <button
                        type="submit"
                        class="btn btn-primary rounded-pill px-4"
                        id="saveBtn">

                        <i class="bi bi-check-circle-fill me-2"></i>

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
    $(document).ready(function() {

        // SELECT2

        $('#teacher_id').select2({
            theme: 'bootstrap-5',
            width: '100%',
            dropdownParent: $('#classTeacherModal')
        });


        // MODAL

        let modal = new bootstrap.Modal(
            document.getElementById('classTeacherModal')
        );


        // DATATABLE

        let table = $('#classTeacherTable').DataTable({

            processing: true,

            serverSide: true,

            ajax: "{{ route('class-teachers.index') }}",

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
                    data: 'section_name',
                    name: 'section_name'
                },

                {
                    data: 'teacher_name',
                    name: 'teacher_name'
                },

                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }

            ]

        });


        // ADD BUTTON

        $(document).on('click', '#addBtn', function() {

            $('#classTeacherForm')[0].reset();

            $('#mapping_id').val('');

            $('#section_id').html(
                '<option value="">Select Section</option>'
            );

            $('#teacher_id').val('').trigger('change');

            $('.text-danger').text('');

            $('#saveBtn').text('Save');

            modal.show();

        });


        // CLASS CHANGE

        $('#class_id').change(function() {

            let classId = $(this).val();

            if (classId == '') {

                $('#section_id').html(
                    '<option value="">Select Section</option>'
                );

                return;
            }

            $.ajax({

                url: "{{ route('get.sections', ':id') }}"
                    .replace(':id', classId),

                type: 'GET',

                success: function(sections) {

                    let option =
                        '<option value="">Select Section</option>';

                    sections.forEach(function(section) {

                        option += `
                        <option value="${section.id}">
                            ${section.name}
                        </option>
                    `;
                    });

                    $('#section_id').html(option);

                }

            });

        });


        // STORE + UPDATE

        $('#classTeacherForm').submit(function(e) {

            e.preventDefault();

            $('.text-danger').text('');

            let id = $('#mapping_id').val();

            let url = id ?
                "{{ route('class-teachers.update', ':id') }}"
                .replace(':id', id) :
                "{{ route('class-teachers.store') }}";

            let type = id ? 'PUT' : 'POST';

            $('#saveBtn').html('Saving...');

            $.ajax({

                url: url,

                type: type,

                data: {
                    _token: "{{ csrf_token() }}",
                    class_id: $('#class_id').val(),
                    section_id: $('#section_id').val(),
                    teacher_id: $('#teacher_id').val()
                },

                success: function(response) {

                    $('#saveBtn').html('Save');

                    modal.hide();

                    table.ajax.reload();

                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        timer: 1500,
                        showConfirmButton: false
                    });

                },

                error: function(xhr) {

                    $('#saveBtn').html('Save');

                    let errors = xhr.responseJSON.errors;

                    if (errors.class_id) {
                        $('.error_class_id').text(errors.class_id[0]);
                    }

                    if (errors.section_id) {
                        $('.error_section_id').text(errors.section_id[0]);
                    }

                    if (errors.teacher_id) {
                        $('.error_teacher_id').text(errors.teacher_id[0]);
                    }

                }

            });

        });


        // EDIT

        $(document).on('click', '.editBtn', function() {

            let id = $(this).data('id');

            $('.text-danger').text('');

            $.ajax({

                url: "{{ route('class-teachers.edit', ':id') }}"
                    .replace(':id', id),

                type: 'GET',

                success: function(response) {

                    let data = response.classTeacher;

                    let sections = response.sections;

                    $('#mapping_id').val(data.id);

                    $('#class_id').val(data.class_id);

                    let option =
                        '<option value="">Select Section</option>';

                    sections.forEach(function(section) {

                        option += `
                        <option value="${section.id}">
                            ${section.name}
                        </option>
                    `;
                    });

                    $('#section_id').html(option);

                    $('#section_id').val(data.section_id);

                    $('#teacher_id')
                        .val(data.teacher_id)
                        .trigger('change');

                    $('#saveBtn').text('Update');

                    modal.show();

                }

            });

        });


        // DELETE

        $(document).on('click', '.deleteBtn', function() {

            let id = $(this).data('id');

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

                        url: "{{ route('class-teachers.destroy', ':id') }}"
                            .replace(':id', id),

                        type: 'DELETE',

                        data: {
                            _token: "{{ csrf_token() }}"
                        },

                        success: function(response) {

                            table.ajax.reload();

                            Swal.fire({
                                icon: 'success',
                                title: response.message,
                                timer: 1500,
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