<div class="bg-primary text-white h-100">

    <div class="p-3">

        <!-- LOGO -->
        <h4 class="text-center mb-1 fw-bold text-nowrap">
             College
        </h4>



        <!-- ================= ADMIN ================= -->
        @if(auth()->user()->role == 'admin')

        <!-- DASHBOARD -->
        <a href="{{ route('admin.dashboard') }}"
            class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">

            <i class="bi bi-speedometer2 me-2"></i>
            Dashboard
        </a>

        <!-- ACADEMIC YEARS -->
        <a href="{{ route('academic-years.index') }}"
            class="sidebar-link {{ request()->routeIs('academic-years.*') ? 'active' : '' }}">

            <i class="bi bi-calendar-range me-2"></i>
            Academic Years
        </a>

        <!-- DEPARTMENTS -->
    <a href="{{ route('departments.index') }}"
        class="sidebar-link {{ request()->routeIs('departments.*') ? 'active' : '' }}">

        <i class="bi bi-building me-2"></i>
        Departments

    </a>

        <!-- CLASSES -->
        <a href="{{ route('classes.index') }}"
            class="sidebar-link {{ request()->routeIs('classes.*') ? 'active' : '' }}">

            <i class="bi bi-mortarboard me-2"></i>
            Course
        </a>

        
            <a href="{{ route('semesters.index') }}"
            class="sidebar-link {{ request()->routeIs('semesters.*') ? 'active' : '' }}">

                <i class="bi bi-calendar3 me-2"></i>

                Semesters

            </a>

        <!-- SECTIONS -->
        <a href="{{ route('sections.index') }}"
            class="sidebar-link {{ request()->routeIs('sections.*') ? 'active' : '' }}">

            <i class="bi bi-diagram-3 me-2"></i>
            Sections
        </a>

        <!-- CLASS TEACHER -->

        <a href="{{ route('class-teachers.index') }}"
            class="sidebar-link {{ request()->routeIs('class-teachers.*') ? 'active' : '' }}">

            <i class="bi bi-person-video3 me-2"></i>
            Class Teacher

        </a>


        <!-- SUBJECTS -->
        <a href="{{ route('subjects.index') }}"
            class="sidebar-link {{ request()->routeIs('subjects.*') ? 'active' : '' }}">

            <i class="bi bi-book me-2"></i>
            Subjects
        </a>


        <!-- SUBJECT TEACHER -->
        <a href="{{ route('subject-teacher.index') }}"
            class="sidebar-link {{ request()->routeIs('subject-teacher.*') ? 'active' : '' }}">

            <i class="bi bi-person-workspace me-2"></i>
            Subject Teacher
        </a>


        <!-- STUDENTS -->
        <a href="{{ route('students.index') }}"
            class="sidebar-link {{ request()->routeIs('students.*') ? 'active' : '' }}">

            <i class="bi bi-people me-2"></i>
            Students
        </a>



        <!-- TEACHERS -->
        <a href="{{ route('teachers.index') }}"
            class="sidebar-link {{ request()->routeIs('teachers.*') ? 'active' : '' }}">

            <i class="bi bi-person-badge me-2"></i>
            Teachers
        </a>

            <!-- //Exams  -->
         <!-- Exams -->
        <a href="{{ route('exams.index') }}"
        class="sidebar-link {{ request()->routeIs('exams.*') ? 'active' : '' }}">

            <i class="bi bi-file-earmark-text me-2"></i>
            Exams
        </a>

        <!-- PROMOTION -->
        <!-- <a href="{{ route('promotion.index') }}"
           class="sidebar-link {{ request()->routeIs('promotion.*') ? 'active' : '' }}">

            <i class="bi bi-arrow-up-circle me-2"></i>
            Promotion
        </a> -->
        <!-- <a href="{{ route('student.promotions.index') }}"
            class="sidebar-link {{ request()->routeIs('promotion.*') ? 'active' : '' }}">

            <i class="bi bi-arrow-up-circle me-2"></i>
            Promotion
        </a> -->

        @endif





        <!-- ================= TEACHER ================= -->

        @if(auth()->user()->role == 'teacher')

        <!-- DASHBOARD -->

        <a href="{{ route('teacher.dashboard') }}"
            class="sidebar-link {{ request()->routeIs('teacher.dashboard') ? 'active' : '' }}">

            <i class="bi bi-speedometer2 me-2"></i>

            Dashboard

        </a>



        <!-- MY STUDENTS -->

        <a href="{{ route('teacher.students.index') }}"
            class="sidebar-link {{ request()->routeIs('teacher.students.*') ? 'active' : '' }}">

            <i class="bi bi-people-fill me-2"></i>

            My Students

        </a>



        <!-- MY SUBJECTS -->

        <a href="{{ route('teacher.subjects') }}"
            class="sidebar-link {{ request()->routeIs('teacher.subjects') ? 'active' : '' }}">

            <i class="bi bi-book-half me-2"></i>

            My Subjects

        </a>



        <!-- ATTENDANCE -->
        <!-- 
        <a href="#"
            class="sidebar-link">

            <i class="bi bi-calendar-check me-2"></i>

            Attendance

        </a> -->



        <!-- HOMEWORK -->

        <!-- <a href="#"
            class="sidebar-link">

            <i class="bi bi-journal-text me-2"></i>

            Homework

        </a> -->



        <!-- TIMETABLE -->

        <!-- <a href="#"
            class="sidebar-link">

            <i class="bi bi-clock-history me-2"></i>

            Timetable

        </a> -->



        <!-- EXAMS -->

        <!-- <a href="#"
            class="sidebar-link">

            <i class="bi bi-file-earmark-text me-2"></i>

            Exams

        </a> -->



        <!-- PROFILE -->

        <!-- <a href="#"
            class="sidebar-link">

            <i class="bi bi-person-circle me-2"></i>

            Profile

        </a> -->

        @endif



        <!-- ================= STUDENT ================= -->
        @if(auth()->user()->role == 'student')

        <!-- DASHBOARD -->
        <a href="{{ route('student.dashboard') }}"
            class="sidebar-link {{ request()->routeIs('student.dashboard') ? 'active' : '' }}">

            <i class="bi bi-speedometer2 me-2"></i>
            Dashboard
        </a>


        <!-- PROFILE -->
        <a href="#"
            class="sidebar-link">

            <i class="bi bi-person-circle me-2"></i>
            Profile
        </a>

        @endif

    </div>

</div>