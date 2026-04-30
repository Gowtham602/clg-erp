@extends('layouts.app')

@section('content')
<div class="p-3 border-bottom d-flex justify-content-between">
        <h5>Teachers</h5>
        <a href="{{ route('students.create') }}" class="btn btn-success">
            Add Student
        </a>
    </div>
<table class="table" id="studentTable">
    <thead>
        <tr>
            <th>S No</th>
            <th>Name</th>
            <th>Father</th>
            <th>Phone</th>
            <th>Class</th>
            <th>Section</th>
            <th>Class Teacher</th>
            <th>Action</th>
        </tr>
    </thead>
</table>



@push('scripts')  

<script>

$('#studentTable').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('students.data') }}",
    columns: [
        {
            data: null,
            orderable: false,
            searchable: false,
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        {data: 'name'},
        {data: 'father_name'},
        {data: 'phone'},
        {data: 'class'},
        {data: 'section'},
        {data:'teacher'},
        {data: 'action', orderable: false, searchable: false},
    ]
});

$(document).on('click', '.deleteBtn', function () {

    let id = $(this).data('id');

    if(confirm('Are you sure?')) {
        $.ajax({
        url: "{{ url('admin/students') }}/" + id,
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function () {
                $('#studentTable').DataTable().ajax.reload();
            }
        });
    }
});

$('#classSelect').change(function () {
    let section = $(this).find(':selected').data('section');
    $('#section').val(section);
});
</script>



@endpush
@endsection