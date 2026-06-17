@extends('layouts.app')

@section('content')

<div class="container">

    <div class="card shadow mx-auto"
         style="max-width:900px;">
 <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

        <h4 class="mb-0">
            <i class="bi bi-file-earmark-text me-2"></i>
            Hall Ticket Preview
        </h4>

        <a href="{{ route('hall-tickets.download',[$student->id,$exam->id]) }}"
           class="btn btn-light">

            <i class="bi bi-download me-1"></i>

            Download PDF

        </a>

    </div>
        <div class="card-body p-4">

            <!-- Header -->

            <div class="border rounded p-3 mb-4">

                <div class="row align-items-center">

                    <div class="col-2 text-center">

                        <img src="{{ asset('logo.png') }}"
                             width="80">

                    </div>

                    <div class="col-10 text-center">

                        <h5 class="fw-bold mb-1">
                            AGRICULTURAL COLLEGE
                        </h5>

                        <h6 class="mb-1">
                            EXAMINATION HALL TICKET
                        </h6>

                        <strong>
                            {{ $exam->name }}
                        </strong>

                    </div>

                </div>

            </div>

            <!-- Student Information -->

            <div class="row mb-4">

                <div class="col-md-9">

                    <table class="table table-bordered">

                        <tr>
                            <th width="30%">Admission No</th>
                            <td>{{ $student->admission_no }}</td>
                        </tr>

                        <tr>
                            <th>Name</th>
                            <td>
                                {{ $student->first_name }}
                                {{ $student->last_name }}
                            </td>
                        </tr>

                        <tr>
                            <th>Father Name</th>
                            <td>{{ $student->father_name }}</td>
                        </tr>

                        <tr>
                            <th>Roll No</th>
                            <td>
                                {{ optional($student->academic)->roll_no }}
                            </td>
                        </tr>

                        <tr>
                            <th>Course</th>
                            <td>
                                {{ optional(optional($student->academic)->course)->name }}
                            </td>
                        </tr>

                        <tr>
                            <th>Semester</th>
                            <td>
                                {{ optional(optional($student->academic)->semester)->name }}
                            </td>
                        </tr>

                    </table>

                </div>

                <div class="col-md-3 text-center">

                    @if($student->photo)

                        <img src="{{ asset('storage/'.$student->photo) }}"
                             class="img-thumbnail"
                             style="width:150px;height:180px;object-fit:cover;">

                    @else

                        <img src="{{ asset('images/no-image.png') }}"
                             class="img-thumbnail"
                             style="width:150px;height:180px;">

                    @endif

                </div>

            </div>

            <!-- Schedule -->

            <h5 class="fw-bold mb-3">
                Examination Schedule
            </h5>

            <table class="table table-bordered">

                <thead class="table-dark">

                    <tr>

                        <th>Date</th>
                        <th>Time</th>
                        <th>Subject Code</th>
                        <th>Subject Name</th>
                        <th>Hall No</th>

                    </tr>

                </thead>

                <tbody>

                @foreach($schedules as $schedule)

                    <tr>

                        <td>
                            {{ date('d-m-Y',strtotime($schedule->exam_date)) }}
                        </td>

                        <td>
                            {{ date('h:i A',strtotime($schedule->start_time)) }}
                            -
                            {{ date('h:i A',strtotime($schedule->end_time)) }}
                        </td>

                        <td>
                            {{ $schedule->subject->subject_code ?? '-' }}
                        </td>

                        <td>
                            {{ $schedule->subject->subject_name ?? '-' }}
                        </td>

                        <td>
                            {{ $schedule->hall_no }}
                        </td>

                    </tr>

                @endforeach

                </tbody>

            </table>

            <!-- Instructions -->

            <div class="mt-4">

                <h5 class="fw-bold">
                    Instructions To Candidate
                </h5>

                <ol>

                    <li>
                        Hall Ticket is mandatory for every examination.
                    </li>

                    <li>
                        Student ID card must be carried.
                    </li>

                    <li>
                        Reach examination hall 30 minutes before exam.
                    </li>

                    <li>
                        Mobile phones and smart devices are prohibited.
                    </li>

                    <li>
                        Follow all invigilator instructions.
                    </li>

                </ol>

            </div>

            <!-- Signatures -->

            <div class="row mt-5 text-center">

                <div class="col-6">

                    <br><br>

                    ____________________

                    <br>

                    Student Signature

                </div>

                <div class="col-6">

                    <br><br>

                    ____________________

                    <br>

                    Controller Of Examination

                </div>

            </div>

        </div>

    </div>

</div>

@endsection