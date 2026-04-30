@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between mb-3">
        <h5 class="fw-bold">Subjects</h5>

        <a href="{{ route('subjects.create') }}" class="btn btn-success btn-sm">
            <i class="bi bi-plus"></i> Add Subject
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body table-responsive">

            <table class="table table-bordered align-middle" id="subjectTable">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Subject</th>
                        <th>Class</th>
                        <th>Teachers</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>

        </div>
    </div>

</div>

@endsection


@push('scripts')
<script>



$('#subjectTable').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('subjects-data') }}",

    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },

        { data: 'name', name: 'name' },

        { data: 'class', name: 'class.name' },

        { data: 'teachers', name: 'teachers.name', orderable: false },

        { data: 'action', orderable: false, searchable: false }
    ]
});


/*  SweetAlert Delete */
$(document).on('click', '.deleteBtn', function () {

    let url = $(this).data('url');

    Swal.fire({
        title: 'Are you sure?',
        text: "This subject will be deleted!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33'
    }).then((result) => {

        if (result.isConfirmed) {

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    _method: 'DELETE',
                    _token: '{{ csrf_token() }}'
                },
                success: function () {
                    $('#subjectTable').DataTable().ajax.reload();
                    Swal.fire('Deleted!', 'Subject removed.', 'success');
                }
            });

        }
    });

});
</script>
@endpush