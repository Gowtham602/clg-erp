<nav class="bg-white shadow-sm px-4 py-3" style="min-height:70px;">

    <div class="d-flex justify-content-between align-items-center">

        <!-- LEFT -->
        <div class="d-flex align-items-center">

            <!-- MOBILE MENU -->
            <button class="btn btn-light d-md-none me-3"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#mobileSidebar">
                <i class="bi bi-list fs-4"></i>
            </button>

            <!-- LOGO -->
            <span class="fw-bold text-success fs-5 d-none d-md-inline success">
                <i class="bi bi-mortarboard-fill text-success me-2"></i>
                Agricultural College
            </span>

            <!-- MOBILE TITLE -->
            <span class="fw-bold fs-5 d-md-none">Home</span>

        </div>

        <!-- RIGHT -->
        <div class="d-flex align-items-center">

            <i class="bi bi-bell fs-5 me-4"></i>

            <div class="dropdown">
                <a class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle"
                   data-bs-toggle="dropdown">

                    <i class="bi bi-person-circle fs-5 me-2"></i>

                    <span class="d-none d-md-inline fw-semibold">
                        {{ auth()->user()->name }}
                    </span>

                </a>

                <ul class="dropdown-menu dropdown-menu-end shadow">
                    <li class="px-3 py-2 small text-muted">
                        {{ auth()->user()->role }}
                    </li>
                    <li><hr></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>

        </div>

    </div>

    <!-- MOBILE GREETING -->
    <div class="mt-2 d-md-none">
        <small class="text-muted">Good Morning!</small>
        <h6 class="mb-0 fw-semibold">{{ auth()->user()->name }}</h6>
    </div>

</nav>