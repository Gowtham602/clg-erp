<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">

    <title>Hall Ticket</title>

    <style>

        body{
            font-family: DejaVu Sans, sans-serif;
            font-size:12px;
            color:#000;
        }

        .container{
            width:100%;
        }

        .header{
            border:1px solid #000;
            border-radius:8px;
            padding:10px;
            margin-bottom:20px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        table th,
        table td{
            border:1px solid #000;
            padding:6px;
        }

        .no-border td{
            border:none;
        }

        .title{
            text-align:center;
        }

        .photo{
            border:1px solid #000;
            width:120px;
            height:150px;
        }

        .mt-20{
            margin-top:20px;
        }

        .mt-40{
            margin-top:40px;
        }

    </style>

</head>

<body>

<div class="container">

    <!-- Header -->

    <div class="header">

        <table class="no-border">

            <tr>

                <td width="15%" align="center">

                    <img
                        src="{{ public_path('logo.png') }}"
                        width="70">

                </td>

                <td class="title">

                    <h2 style="margin:0;">
                        AGRICULTURAL COLLEGE
                    </h2>

                    <h3 style="margin:5px 0;">
                        HALL TICKET
                    </h3>

                    <strong>
                        {{ $exam->name }}
                    </strong>

                </td>

            </tr>

        </table>

    </div>

    <!-- Student Information -->

    <table class="no-border">

        <tr>

            <td width="75%" valign="top">

                <table>

                    <tr>
                        <th width="30%">
                            Admission No
                        </th>

                        <td>
                            {{ $student->admission_no }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            Student Name
                        </th>

                        <td>
                            {{ $student->first_name }}
                            {{ $student->last_name }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            Father Name
                        </th>

                        <td>
                            {{ $student->father_name }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            Roll No
                        </th>

                        <td>
                            {{ optional($student->academic)->roll_no ?? '-' }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            Course
                        </th>

                        <td>
                            {{ optional(optional($student->academic)->course)->name ?? '-' }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            Semester
                        </th>

                        <td>
                            {{ optional(optional($student->academic)->semester)->name ?? '-' }}
                        </td>
                    </tr>

                </table>

            </td>

            <td width="25%" align="center">

                @if($student->photo)

                    <img
                        src="{{ public_path('storage/'.$student->photo) }}"
                        class="photo">

                @else

                    <div class="photo"></div>

                @endif

            </td>

        </tr>

    </table>

    <!-- Schedule -->

    <h3 class="mt-20">
        Examination Schedule
    </h3>

    <table>

        <thead>

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
                    {{ $schedule->hall_no ?? '-' }}
                </td>

            </tr>

        @endforeach

        </tbody>

    </table>

    <!-- Instructions -->

    <div class="mt-20">

        <h3>
            Instructions To Candidate
        </h3>

        <ol>

            <li>
                Hall Ticket is mandatory for every examination.
            </li>

            <li>
                Student ID Card must be carried.
            </li>

            <li>
                Reach examination hall 30 minutes before examination.
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

    <table class="no-border mt-40">

        <tr>

            <td align="center">

                ____________________

                <br><br>

                Student Signature

            </td>

            <td align="center">

                ____________________

                <br><br>

                Controller Of Examination

            </td>

        </tr>

    </table>

</div>

</body>

</html>