<div class="bg-primary text-white h-100">

    <div class="p-3">

        <h5 class="text-center mb-4 fw-bold">Menu</h5>

        <!-- ================= ADMIN ================= -->
        @if(auth()->user()->role == 'admin')

        <a href="{{ route('admin.dashboard') }}"
           class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>

        <a href="{{ route('teachers.index') }}"
           class="sidebar-link {{ request()->routeIs('teachers.*') ? 'active' : '' }}">
            <i class="bi bi-person-badge me-2"></i> Teachers
        </a>

        <a href="{{ route('classes.index') }}"
           class="sidebar-link {{ request()->routeIs('classes.*') ? 'active' : '' }}">
            <i class="bi bi-mortarboard me-2"></i> Classes
        </a>

        <a href="{{ route('students.index') }}"
           class="sidebar-link {{ request()->routeIs('students.*') ? 'active' : '' }}">
            <i class="bi bi-people me-2"></i> Students
        </a>

        <!--  SUBJECTS -->
        <a href="{{ route('subjects.index') }}"
           class="sidebar-link {{ request()->routeIs('subjects.*') ? 'active' : '' }}">
            <i class="bi bi-book me-2"></i> Subjects
        </a>

        <!--  SUBJECT - TEACHER (OPTIONAL PAGE) -->
        <a href="{{ route('subjects.create') }}"
           class="sidebar-link">
            <i class="bi bi-diagram-3 me-2"></i> Assign Subject
        </a>

        @endif


        <!-- ================= TEACHER ================= -->
        @if(auth()->user()->role == 'teacher')

        <a href="{{ route('teacher.dashboard') }}"
           class="sidebar-link {{ request()->routeIs('teacher.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>

        <a href="{{ route('teacher.students.index') }}"
           class="sidebar-link {{ request()->routeIs('teacher.students.*') ? 'active' : '' }}">
            <i class="bi bi-people me-2"></i> My Students
        </a>

        <!--  TEACHER SUBJECTS -->
        <a href="{{ route('teacher-subject') }}"
            class="sidebar-link {{ request()->routeIs('teacher.subject') ? 'active' : '' }}">
            <i class="bi bi-book me-2"></i> My Subjects
        </a>

        <a href="#"
           class="sidebar-link">
            <i class="bi bi-calendar-check me-2"></i> Attendance
        </a>

        @endif


        <!-- ================= STUDENT ================= -->
        @if(auth()->user()->role == 'student')

        <a href="{{ route('student.dashboard') }}"
           class="sidebar-link {{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>

        <a href="#"
           class="sidebar-link">
            <i class="bi bi-person-circle me-2"></i> Profile
        </a>

        @endif

    </div>

</div>