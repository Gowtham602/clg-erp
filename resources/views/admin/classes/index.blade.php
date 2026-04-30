@extends('layouts.app')

@section('content')

<div class="card shadow d-flex flex-column flex-grow-1">
    
    <!-- HEADER -->
    <div class="p-3 border-bottom d-flex justify-content-between">
        <h5>Classes</h5>
        <a href="{{ route('classes.create') }}" class="btn btn-success">
           <i class="bi bi-plus-circle me-1"></i> Add Class
        </a>
    </div>

    <!-- TABLE -->
    <div class="flex-grow-1 overflow-auto p-3">
        <table id="classTable" class="table table-striped table-hover w-100">
            <thead class="table-dark">
                <tr>
                    <th>SNo</th>
                    <th>Name</th>
                    <th>Section</th>
                    <th>Teacher</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>

</div>

@endsection

@push('scripts')
<script>
$(document).ready(function () {

    $('#classTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('classes.data') }}",

        columns: [
         {
            data: null,
            orderable: false,
            searchable: false,
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
            { data: 'name' },
            { data: 'section' },
            { data: 'teacher' },
            { data: 'action', orderable: false, searchable: false }
        ]
    });

    // DELETE
    $(document).on('click', '.deleteBtn', function () {
        let id = $(this).data('id');

        if(confirm('Delete this class?')) {
            $.ajax({
                url: '/classes/' + id,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function () {
                    $('#classTable').DataTable().ajax.reload();
                }
            });
        }
    });

});
</script>
@endpush