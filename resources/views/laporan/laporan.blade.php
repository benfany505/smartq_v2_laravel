@extends('layouts.master')
@section('title', 'ETN | SmartQ V2')
@push('custom-css')
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('') }}assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('') }}assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('') }}assets/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('') }}assets/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('') }}assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('') }}assets/plugins/daterangepicker/daterangepicker.css">

    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('') }}assets/plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="{{ asset('css/filepond.css') }}">

    {{-- filepond plugins --}}
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.js"></script>
    <!-- add the Image Crop plugin script -->
    <script src="https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-5" style="color: white">
                <div class="contentHeader">
                    <div class="title-header">
                        {{-- <i class="fas fa-history pr-2"></i> --}}
                        Filter Laporan
                    </div>
                    {{-- <button class="title-button"><i class="fas fa-plus pr-2"></i>Tambah</button> --}}
                </div>
                <form id="form_tambah_user">
                    @csrf
                    {{-- <div class="form-group row" style="margin: 5px 2px 0px 2px;">
                        <label for="pilihan_jenis_laporan" class="col-sm-4 col-form-label ">Jenis Laporan</label>
                        <div class="col-sm-8">
                            <Select class="form-control form-control-sm" id="pilihan_jenis_laporan"
                                name="pilihan_jenis_laporan" required style="background-color: transparent; color: white">
                                <option style="background-color: #222F3E; " value="">Pilih Alur</option>
                                <option style="background-color: #222F3E; " value="1">Rekap</option>
                                <option style="background-color: #222F3E; " value="2">Detail</option>
                            </Select>
                        </div>
                    </div> --}}

                    <div id="div_pilihan_loket" class="form-group row" style="margin: 5px 2px 0px 2px;">
                        <label for="pilihan_loket" class="col-sm-4 col-form-label ">Loket</label>
                        <div class="col-sm-8">
                            <Select multiple="multiple" class="form-control form-control-sm" id="pilihan_loket"
                                name="pilihan_loket" required style="background-color: transparent; color: white">
                                @foreach ($loket as $item)
                                    <option style="background-color: #222F3E; " value="{{ $item->nomor }}">
                                        {{ $item->nomor }}. {{ $item->nama }}</option>
                                @endforeach
                            </Select>
                        </div>
                    </div>

                    {{-- layanan --}}
                    <div id="div_pilihan_layanan" class="form-group row" style="margin: 5px 2px 0px 2px;">
                        <label for="pilihan_layanan" class="col-sm-4 col-form-label ">Layanan</label>
                        <div class="col-sm-8">
                            <Select multiple="multiple" class="form-control form-control-sm" id="pilihan_layanan"
                                name="pilihan_layanan" required style="background-color: transparent; color: white;">
                                @foreach ($layanan as $item)
                                    <option style="background-color: #222F3E; " value="{{ $item->kode }}">
                                        {{ $item->kode }}. {{ $item->nama }}</option>
                                @endforeach
                            </Select>
                        </div>
                    </div>
                    {{-- date range picker --}}
                    <div class="form-group row" style="margin: 5px 2px 0px 2px;">
                        <label for="role" class="col-sm-4 col-form-label ">Jangka Waktu</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-clock"></i></span>
                                </div>
                                <input type="text" class="form-control float-right" id="reservationtime"
                                    style="background-color: transparent; color: white;">

                            </div>
                        </div>
                    </div>


                    <div class="form-group  text-right col-sm mt-2">
                        {{-- button save --}}
                        <button class="btn btn-primary btn-xs" id="show">Tampilkan Data</button>
                    </div>


                </form>




            </div>
        </div>

        <div class="col-sm-12" style="color: white">
            <div class="contentHeader">
                <div class="title-header">
                    {{-- <i class="fas fa-history pr-2"></i> --}}
                    Data Laporan
                </div>
            </div>
            {{-- Data Tabel Antrian --}}
            <table class="table table-sm table-stripped mt-1" id="table_alur">
                <thead style="background-color: darkslategray">
                    <tr>
                        {{-- <th rowspan="2"
                            style="align-content: center; text-align: center; vertical-align: middle; border : 1px solid; "
                            width="5%">
                            No
                        </th> --}}
                        <th rowspan="2"
                            style="align-content: center; text-align: center; vertical-align: middle; border : 1px solid;"
                            width=10%>
                            Tanggal</th>
                        <th rowspan="2"
                            style="align-content: center; text-align: center; vertical-align: middle; border : 1px solid;"
                            width="25%">
                            Loket
                        </th>
                        <th rowspan="2"
                            style="align-content: center; text-align: center; vertical-align: middle; border : 1px solid;"
                            width="25%">
                            Layanan</th>
                        <th rowspan="2"
                            style="align-content: center; text-align: center; vertical-align: middle; border : 1px solid;"
                            width="10%">
                            Jumlah</th>
                        <th colspan="3" {{-- middle --}}
                            style="align-content: center; text-align: center; vertical-align: middle; border : 1px solid;"
                            width="25%">
                            Waktu Pelayanan (Menit)
                        </th>
                        {{-- <th>Waktu Tunggu Maksimal</th>
                        <th>Waktu Layanan Maksimal</th>
                        <th>Waktu Selesai Maksimal</th>
                        <th>Waktu Pelayanan Maksimal</th> --}}
                        <th scope="col" style="display: none">id</th>
                    </tr>
                    <tr>
                        <th style="align-content: center; text-align: center; vertical-align: middle; border : 1px solid;">
                            Rata-Rata</th>
                        <th style="align-content: center; text-align: center; vertical-align: middle; border : 1px solid;">
                            Minimal</th>
                        <th style="align-content: center; text-align: center; vertical-align: middle; border : 1px solid;">
                            Maksimal</th>

                    </tr>
                </thead>
                <tbody>
                    {{-- check if $laporan not empty --}}
                    @if ($laporan != null)
                        {{-- for each --}}
                        @foreach ($laporan as $item)
                            @if ($item->kode_loket != 0)
                                <tr>
                                    {{-- <td
                                        style="align-content: center; text-align: center; vertical-align: middle; border : 1px solid;">
                                        {{ $loop->iteration }}</td> --}}
                                    <td
                                        style="align-content: center; text-align: center; vertical-align: middle; border : 1px solid;">
                                        {{ $item->tanggal }}</td>
                                    <td
                                        style="align-content: center; text-align: center; vertical-align: middle; border : 1px solid;">
                                        {{-- kode loket based on $loket --}}
                                        {{ $item->kode_loket }} -
                                        {{-- nama loket based on $loket --}}
                                        @foreach ($loket as $item2)
                                            @if ($item2->nomor == $item->kode_loket)
                                                {{ $item2->nama }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td
                                        style="align-content: center; text-align: center; vertical-align: middle; border : 1px solid;">
                                        {{ $item->kode_layanan }} -
                                        {{-- nama layanan based on $layanan --}}
                                        @foreach ($layanan as $item2)
                                            @if ($item2->kode == $item->kode_layanan)
                                                {{ $item2->nama }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td
                                        style="align-content: center; text-align: center; vertical-align: middle; border : 1px solid;">
                                        {{ $item->jumlah_antrean }}</td>
                                    <td
                                        style="align-content: center; text-align: center; vertical-align: middle; border : 1px solid;">
                                        {{ $item->pelayanan_avg }}</td>
                                    <td
                                        style="align-content: center; text-align: center; vertical-align: middle; border : 1px solid;">
                                        {{ $item->pelayanan_min }}</td>
                                    <td
                                        style="align-content: center; text-align: center; vertical-align: middle; border : 1px solid;">
                                        {{ $item->pelayanan_max }}</td>
                                    <td style="display: none">{{ $item->id }}</td>
                                </tr>
                            @endif
                        @endforeach
                    @else
                        <td>Tidak Ada Data</td>
                    @endif


                </tbody>

            </table>





        </div>

    </div>







@endsection

@push('custom-js')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/multiple-select.css') }}">
    <script src="{{ asset('js/multiple-select.js') }}"></script>
    {{-- script for id= show button --}}
    <script>
        $(document).ready(function() {
            $('#show').click(function(e) {
                e.preventDefault();

                var reservationtime = $('#reservationtime').val();
                // start and end based on database time format
                var start = reservationtime.split(' - ')[0];
                var end = reservationtime.split(' - ')[1];

                // get multiple select value on pilihan_loket
                var pilihan_loket_value = $('#pilihan_loket').multipleSelect('getSelects');
                // get multiple select value on pilihan_layanan
                var pilihan_layanan_value = $('#pilihan_layanan').multipleSelect('getSelects');

                pilihan_loket_value = pilihan_loket_value.join(',');
                pilihan_layanan_value = pilihan_layanan_value.join(',');

                // check if pilihan_alur_value is empty

                // check if pilihan_loket_value is empty
                if (pilihan_loket_value == '') {
                    // show alert
                    alert('Pilih Loket');
                    return false;
                }
                // check if pilihan_layanan_value is empty
                if (pilihan_layanan_value == '') {
                    // show alert
                    alert('Pilih Layanan');
                    // focus on pilihan_layanan
                    pilihan_layanan.focus();
                    // return false
                    return false;
                }

            });
        });
    </script>


    <script>
        $("#pilihan_loket").multipleSelect({
            filter: false,
            keepOpen: false,
            placeholder: "Pilih Loket",
            width: '100%'
        });
        $("#pilihan_layanan").multipleSelect({
            filter: false,
            keepOpen: false,
            placeholder: "Pilih Layanan",
            width: '100%'
        });
    </script>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>

        <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>

        <script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script> --}}
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('') }}assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('') }}assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="{{ asset('') }}assets/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="{{ asset('') }}assets/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="{{ asset('') }}assets/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="{{ asset('') }}assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('') }}assets/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('') }}assets/plugins/moment/moment.min.js"></script>
    <script src="{{ asset('') }}assets/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('') }}assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="{{ asset('') }}assets/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('') }}assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    {{-- Script to create New Layanan without reload page --}}

    <script>
        $(function() {

            //Date picker
            $('#reservationdate').datetimepicker({
                format: 'L'
            });

            //Date and time picker
            $('#reservationdatetime').datetimepicker({
                icons: {
                    time: 'far fa-clock'
                }
            });

            //Date range picker
            $('#reservation').daterangepicker()
            //Date range picker with time picker
            $('#reservationtime').daterangepicker({
                timePicker: true,
                timePickerIncrement: 30,
                locale: {
                    format: 'DD/MM/YY hh:mm A'
                },
                startDate: moment().startOf('hour'),
                endDate: moment().startOf('hour').add(32, 'hour'),
                ranges: {
                    'Today': [moment().startOf('day'), moment().endOf('day')],
                    'Yesterday': [moment().startOf('day').subtract(1, 'days'), moment().endOf(
                        'day').subtract(1, 'days')],
                    'Last 7 Days': [moment().startOf('day').subtract(6, 'days'), moment().endOf(
                        'day')],
                    'Last 30 Days': [moment().startOf('day').subtract(29, 'days'), moment().endOf(
                        'day')],
                    'This Month': [moment().startOf('day').startOf('month'), moment().endOf(
                        'day').endOf('month')],
                    'Last Month': [moment().startOf('day').subtract(1, 'month').startOf('month'),
                        moment().startOf('day').subtract(1, 'month').endOf('month')
                    ]
                }
            })
            //Date range as a button
            $('#daterange-btn').daterangepicker({
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                            'month').endOf('month')]
                    },
                    startDate: moment().subtract(29, 'days'),
                    endDate: moment()
                },
                function(start, end) {
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format(
                        'MMMM D, YYYY'))
                }
            )



        })
    </script>


    {{-- script datatable --}}
    <script src="{{ asset('') }}assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('') }}assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('') }}assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('') }}assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('') }}assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('') }}assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
@endpush
