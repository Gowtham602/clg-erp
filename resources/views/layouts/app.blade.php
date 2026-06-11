<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>School System</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- BOOTSTRAP -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DATATABLE -->

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">

    <!-- SELECT2 -->

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <!-- SELECT2 BOOTSTRAP 5 THEME -->
    <link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
</head>
<style>

#toast-container > .toast-success{
    background:#198754 !important;
    color:#fff !important;
    border-radius:14px;
    box-shadow:0 10px 25px rgba(25,135,84,0.25);
}

#toast-container > .toast-error{
    background:#dc3545 !important;
    color:#fff !important;
    border-radius:14px;
    box-shadow:0 10px 25px rgba(220,53,69,0.25);
}

#toast-container > .toast-warning{
    background:#ffc107 !important;
    color:#000 !important;
    border-radius:14px;
    box-shadow:0 10px 25px rgba(255,193,7,0.25);
}

#toast-container > .toast-info{
    background:#0dcaf0 !important;
    color:#fff !important;
    border-radius:14px;
    box-shadow:0 10px 25px rgba(13,202,240,0.25);
}

.toast{
    opacity:1 !important;
    padding:15px 18px !important;
    font-size:14px;
}

.toast-title{
    font-weight:700;
}

</style>
<body class="bg-light">

    <div class="d-flex flex-column min-vh-100">

        {{-- HEADER --}}
        @include('layouts.header')

        {{-- MAIN --}}
        <div class="d-flex flex-grow-1">

            {{-- SIDEBAR --}}
            <div class="d-none d-md-block bg-primary text-white"
                 style="width:210px; min-height:100vh;">

                @include('layouts.sidebar')

            </div>

            {{-- CONTENT --}}
            <div class="flex-grow-1 p-3"
                 style="padding-bottom:80px; overflow-x:auto;">

                @yield('content')

            </div>

        </div>

    </div>


    {{-- MOBILE SIDEBAR --}}

    <div class="offcanvas offcanvas-start d-md-none"
         tabindex="-1"
         id="mobileSidebar">

        <div class="offcanvas-header">

            <h5 class="offcanvas-title">
                Menu
            </h5>

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="offcanvas">
            </button>

        </div>

        <div class="offcanvas-body">

            @include('layouts.sidebar')

        </div>

    </div>


    {{-- MOBILE NAV --}}

    @include('layouts.mobile-nav')


    <!-- JQUERY -->

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- BOOTSTRAP -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- VALIDATION -->

    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

    <!-- SWEETALERT -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- DATATABLE -->

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <!-- BUTTONS -->

    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

    <!-- EXPORT -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

    <!-- SELECT2 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    {{-- PAGE SCRIPTS --}}

    @stack('scripts')

</body>

</html>