
@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="card shadow border-0">

        <div class="card-header bg-primary text-white">

            <h4 class="mb-0">

                <i class="bi bi-arrow-up-circle"></i>

                Student Promotion

            </h4>

        </div>

        <div class="card-body">

            {{-- CURRENT ACADEMIC DETAILS --}}

            <div class="card shadow-sm mb-4">

                <div class="card-header bg-info text-white">

                    Current Academic Details

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-3 mb-3">

                            <label>

                                Academic Year

                            </label>

                            <select
                                class="form-control"
                                id="academic_year_id">

                                <option value="">

                                    Select Academic Year

                                </option>

                                @foreach($academicYears as $year)

                                    <option value="{{ $year->id }}">

                                        {{ $year->name }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-3 mb-3">

                            <label>

                                Course

                            </label>

                            <select
                                class="form-control"
                                id="course_id">

                                <option value="">

                                    Select Course

                                </option>

                                @foreach($courses as $course)

                                    <option value="{{ $course->id }}">

                                        {{ $course->name }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-3 mb-3">

                            <label>

                                Semester

                            </label>

                            <select
                                class="form-control"
                                id="semester_id">

                                <option value="">

                                    Select Semester

                                </option>

                                @foreach($semesters as $semester)

                                    <option value="{{ $semester->id }}">

                                        {{ $semester->name }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-3 mb-3">

                            <label>

                                Section

                            </label>

                            <select
                                class="form-control"
                                id="section_id">

                                <option value="">

                                    Select Section

                                </option>

                                @foreach($sections as $section)

                                    <option value="{{ $section->id }}">

                                        {{ $section->name }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                    </div>

                    <button
                        type="button"
                        id="fetch_students"
                        class="btn btn-primary">

                        <i class="bi bi-search"></i>

                        Fetch Students

                    </button>

                </div>

            </div>


            {{-- STUDENT LIST --}}

            <div class="card shadow-sm mb-4">

                <div class="card-header bg-dark text-white">

                    Student List

                </div>

                <div class="card-body p-0">

                    <table
                        class="table table-bordered mb-0">

                        <thead>

                            <tr>

                                <th width="50">

                                    <input
                                        type="checkbox"
                                        id="check_all">

                                </th>

                                <th>

                                    Admission No

                                </th>

                                <th>

                                    Student Name

                                </th>

                                <th>

                                    Roll No

                                </th>

                                <th>

                                    Status

                                </th>

                            </tr>

                        </thead>

                        <tbody id="student_table">

                            <tr>

                                <td
                                    colspan="5"
                                    class="text-center">

                                    Fetch students to continue

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>


            {{-- PROMOTION DETAILS --}}

            <div class="card shadow-sm">

                <div class="card-header bg-success text-white">

                    Promotion Details

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-4">

                            <label>

                                New Academic Year

                            </label>

                            <select
                                class="form-control"
                                id="new_academic_year_id">

                                <option value="">

                                    Select Academic Year

                                </option>

                                @foreach($academicYears as $year)

                                    <option value="{{ $year->id }}">

                                        {{ $year->name }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-4">

                            <label>

                                New Semester

                            </label>

                            <select
                                class="form-control"
                                id="new_semester_id">

                                <option value="">

                                    Select Semester

                                </option>

                                @foreach($semesters as $semester)

                                    <option value="{{ $semester->id }}">

                                        {{ $semester->name }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-4">

                            <label>

                                New Section

                            </label>

                            <select
                                class="form-control"
                                id="new_section_id">

                                <option value="">

                                    Select Section

                                </option>

                                @foreach($sections as $section)

                                    <option value="{{ $section->id }}">

                                        {{ $section->name }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                    </div>

                    <div class="text-end mt-4">

                        <button
                            class="btn btn-success"
                            id="promoteBtn">

                            <i class="bi bi-arrow-up-circle"></i>

                            Promote Students

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection


@push('scripts')

<script>

$('#check_all').on('click',function(){

    $('.student_checkbox')
        .prop(
            'checked',
            $(this).prop('checked')
        );
});

$('#fetch_students').click(function () {

    let academicYear = $('#academic_year_id').val();
    let course = $('#course_id').val();
    let semester = $('#semester_id').val();
    let section = $('#section_id').val();

    if (!academicYear) {
        toastr.error('Please select Academic Year');
        return;
    }

    if (!course) {
        toastr.error('Please select Course');
        return;
    }

    if (!semester) {
        toastr.error('Please select Semester');
        return;
    }

    if (!section) {
        toastr.error('Please select Section');
        return;
    }

    let btn = $(this);

    btn.prop('disabled', true);
    btn.html('<i class="spinner-border spinner-border-sm"></i> Loading...');

    $.ajax({
        url: "{{ route('student.promotions.getStudents') }}",
        type: 'POST',
        data: {
            _token: "{{ csrf_token() }}",
            academic_year_id: academicYear,
            course_id: course,
            semester_id: semester,
            section_id: section
        },

        success: function (response) {

            let rows = '';

            if (response.students.length === 0) {

                rows = `
                    <tr>
                        <td colspan="5" class="text-center text-danger">
                            No Students Found
                        </td>
                    </tr>
                `;

            } else {

                $.each(response.students, function (index, student) {

                    rows += `
                    <tr>
                        <td>
                            <input type="checkbox"
                                   class="student_checkbox"
                                   value="${student.id}">
                        </td>

                        <td>${student.student.admission_no}</td>

                        <td>
                            ${student.student.first_name}
                            ${student.student.last_name}
                        </td>

                        <td>${student.roll_no}</td>

                        <td>
                            <span class="badge bg-success">
                                ${student.status}
                            </span>
                        </td>
                    </tr>
                    `;
                });
            }

            $('#student_table').html(rows);

        },

        error: function () {

            toastr.error('Something went wrong');

        },

        complete: function () {

            btn.prop('disabled', false);

            btn.html(`
                <i class="bi bi-search"></i>
                Fetch Students
            `);
        }
    });

});
$('#promoteBtn').click(function () {

    let ids = [];

    $('.student_checkbox:checked').each(function () {
        ids.push($(this).val());
    });

    if (ids.length === 0) {
        toastr.error('Please select at least one student');
        return;
    }

    let academicYear = $('#new_academic_year_id').val();
    let semester = $('#new_semester_id').val();
    let section = $('#new_section_id').val();

    if (!academicYear) {
        toastr.error('Please select Promotion Academic Year');
        return;
    }

    if (!semester) {
        toastr.error('Please select Promotion Semester');
        return;
    }

    if (!section) {
        toastr.error('Please select Promotion Section');
        return;
    }

    let btn = $(this);

    btn.prop('disabled', true);

    btn.html(`
        <i class="spinner-border spinner-border-sm"></i>
        Promoting...
    `);

    $.ajax({

        url: "{{ route('student.promotions.promote') }}",

        type: 'POST',

        data: {

            _token: "{{ csrf_token() }}",

            academic_ids: ids,

            new_academic_year_id: academicYear,

            new_semester_id: semester,

            new_section_id: section

        },

        success: function (response) {

            toastr.success(response.message);

            setTimeout(function () {

                location.reload();

            }, 1000);

        },

        error: function (xhr) {

            if (xhr.responseJSON?.message) {

                toastr.error(xhr.responseJSON.message);

            } else {

                toastr.error('Promotion failed');

            }

        },

        complete: function () {

            btn.prop('disabled', false);

            btn.html(`
                <i class="bi bi-arrow-up-circle"></i>
                Promote Students
            `);
        }
    });
});

</script>

@endpush

