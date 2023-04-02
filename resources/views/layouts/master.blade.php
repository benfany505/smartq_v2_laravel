<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'ETN | SmartQ V2')</title>
    {{-- icon --}}
    <link rel="icon" href="{{ asset('') }}assets/dist/img/smartq.png">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('') }}assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('') }}assets/plugins/toastr/toastr.min.css">
    {{-- Select2 --}}
    <script src="{{ asset('') }}assets/plugins/jquery/jquery.min.js"></script>

    <link href="{{ asset('') }}assets/dist/css/select2/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('') }}/css/style.css" rel="stylesheet" />
    {{-- <link rel="stylesheet" href="http://etn_invoice.test/assets/dist/css/adminlte.min.css"> --}}
    {{-- filepond --}}
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />

    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.css" rel="stylesheet" />

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/css/selectize.bootstrap4.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('css/ben.css') }}">
    @stack('custom-css')
</head>

<body class="hold-transition sidebar-mini layout-fixed text-sm" style="background-color: #566473">
    <div class="wrapper">

        {{-- <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('') }}assets/dist/img/logo_etn.png" alt="ETN Logo"
                height="100" width="100">
        </div> --}}




        @include('layouts.nav-header')
        @include('layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="m-1">
            <div class="content-wrapper" style="background-color: #222F3E;">


                <!-- Main content -->
                <section class="content pt-3">
                    @yield('content')
                </section>
                <!-- /.content -->
            </div>
        </div>

        <!-- /.content-wrapper -->
        <div class="mr-1 ml-1">
            <footer class="main-footer" style="background-color: #222F3E; border:none;">
                <strong>Copyright &copy; 2023 <a href="https://etn.co.id">etn.co.id</a>.</strong>
                All rights reserved.
                <div class="float-right d-none d-sm-inline-block">
                    <?php $version = env('APP_VERSION'); ?>
                    <b>Version</b> <?= $version ?>


                </div>
            </footer>

        </div>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('') }}assets/plugins/jquery/jquery.min.js"></script>
    @stack('custom-js')
    {{-- select2 --}}
    <script src="{{ asset('') }}assets/dist/js/select2/select2.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('') }}assets/dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('') }}assets/dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    {{-- <script src="{{ asset('') }}assets/dist/js/pages/dashboard.js"></script> --}}
    <!-- SweetAlert2 -->
    <script src="{{ asset('') }}assets/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="{{ asset('') }}assets/plugins/toastr/toastr.min.js"></script>

    <script>
        /*** add active class and stay opened when selected ***/
        var url = window.location;

        // for sidebar menu entirely but not cover treeview
        $('ul.nav-sidebar a').filter(function() {
            if (this.href) {
                return this.href == url || url.href.indexOf(this.href) == 0;
            }
        }).addClass('active');

        // for the treeview
        $('ul.nav-treeview a').filter(function() {
            if (this.href) {
                return this.href == url || url.href.indexOf(this.href) == 0;
            }
        }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
    </script>
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>

    <script>
        // document ready
        $(document).ready(function() {
            // remove all selected option
            $(".select").select2({
                placeholder: "Select . . .",
                allowClear: false,
                dropdownPosition: 'below',
                dropdownAutoWidth: true,

            });

            $(".select-inmodal").select2({
                placeholder: "Select . . .",
                allowClear: true,
                dropdownPosition: 'below',
                // auto width
                width: '100%',
                // width: '100%',

                dropdownAutoWidth: true,
                // width to fit parent

            });



            $(".select-readonly").select2({
                placeholder: "Pilih . . .",
                allowClear: true,
                disabled: "readonly",
            });
            $('.js-example-basic-single').select2();


        });
    </script>

    <script>
        // define function to calculate a+b
    </script>


</body>

</html>
