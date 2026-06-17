@extends('layouts.app')

@section('content')

<div class="container-fluid">

<div class="card shadow border-0">

    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

        <h5 class="mb-0">

            <i class="bi bi-calendar-event"></i>

            Exam Schedule List

        </h5>

        <a href="{{ route('exam-schedules.create') }}"
           class="btn btn-light">

            <i class="bi bi-plus-circle"></i>

            Add Schedule

        </a>

    </div>

    <div class="card-body">

        @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

        @endif

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-primary">

                    <tr>

                        <th>#</th>

                        <th>Exam</th>

                        <th>Subject</th>

                        <th>Date</th>

                        <th>Start Time</th>

                        <th>End Time</th>

                        <th>Room</th>

                        <th>Hall</th>

                        <th>Max Marks</th>

                        <th>Pass Marks</th>

                        <th width="150">Action</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($schedules as $schedule)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $schedule->exam->name ?? '-' }}</td>

                        <td>{{ $schedule->subject->name ?? '-' }}</td>

                        <td>{{ date('d-m-Y', strtotime($schedule->exam_date)) }}</td>

                        <td>{{ $schedule->start_time }}</td>

                        <td>{{ $schedule->end_time }}</td>

                        <td>{{ $schedule->room_no }}</td>

                        <td>{{ $schedule->hall_no }}</td>

                        <td>{{ $schedule->max_marks }}</td>

                        <td>{{ $schedule->pass_marks }}</td>

                        <td>

                            <a href="{{ route('exam-schedules.edit',$schedule->id) }}"
                               class="btn btn-warning btn-sm">

                                <i class="bi bi-pencil-square"></i>

                            </a>

                            <form action="{{ route('exam-schedules.destroy',$schedule->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button
                                    onclick="return confirm('Delete this schedule?')"
                                    class="btn btn-danger btn-sm">

                                    <i class="bi bi-trash"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="11" class="text-center">

                            No Exam Schedule Found

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>


</div>

@endsection
