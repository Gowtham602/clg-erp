<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>School System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- // for jquerry datatable  -->
    
 
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
</head>


<body class="bg-light">

    <div class="d-flex flex-column min-vh-100">

        {{-- HEADER --}}
        @include('layouts.header')

        {{-- MAIN --}}
        <div class="d-flex flex-grow-1">

            {{-- SIDEBAR --}}

            <!-- <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileSidebar"> -->

            <div class="d-none d-md-block bg-primary text-white" style="width:250px; min-height:100vh;">
                @include('layouts.sidebar')
            </div>

            {{-- CONTENT --}}
            <!-- <div class="flex-grow-1 p-3" style="padding-bottom:80px">
                 -->
            <div class="flex-grow-1 p-3 d-flex flex-column overflow-hidden" style="padding-bottom:80px;">
                @yield('content')
            </div>


        </div>


    </div>
    <div class="offcanvas offcanvas-start d-md-none" tabindex="-1" id="mobileSidebar">

        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>

        <div class="offcanvas-body">
            @include('layouts.sidebar')
        </div>

    </div>
    {{-- MOBILE --}}
    @include('layouts.mobile-nav')

    </div>
    <!-- 1. jQuery FIRST -->
<!-- jQuery  -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Validation -->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- Buttons -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

<!-- Export -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<!--  SELECT2 (MUST BE AFTER JQUERY) -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>

<!-- @stack('scripts') -->
 @vite(['resources/js/app.js'])
@stack('scripts')

</body>

</html>