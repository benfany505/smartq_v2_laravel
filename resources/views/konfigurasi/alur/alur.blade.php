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
    <!-- Include the default stylesheet -->


    {{-- filepond plugins --}}
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.js"></script>
    <!-- add the Image Crop plugin script -->
    <script src="https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>

    {{-- <!-- Include plugin -->
     --}}
    <!-- Include the default stylesheet -->




    <style>

    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4" style="color: white">
                <div class="contentHeader">
                    <div class="title-header" id="title_header">
                        {{-- <i class="fas fa-history pr-2"></i> --}}
                        Tambah Alur
                    </div>
                    {{-- <button class="title-button"><i class="fas fa-plus pr-2"></i>Tambah</button> --}}
                </div>
                <form id="form_alur">
                    @csrf


                    <div class="form-group row" style="margin: 5px 2px 0px 2px;">
                        <label for="pilihan_alur" class="col-sm-4 col-form-label ">Alur</label>
                        <div class="col-sm-8">
                            <Select class="form-control form-control-sm" id="pilihan_alur" name="pilihan_alur" required
                                style="background-color: transparent; color: white">
                                <option style="background-color: #222F3E; " value="">Pilih Alur</option>
                                <option style="background-color: #222F3E; " value="1">AWAL</option>
                                <option style="background-color: #222F3E; " value="2">TENGAH</option>
                                <option style="background-color: #222F3E; " value="3">AKHIR</option>
                            </Select>
                        </div>
                    </div>



                    <div id="div_pilihan_loket" class="form-group row" style="margin: 5px 2px 0px 2px; display: none">
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
                    <div id="div_pilihan_layanan" class="form-group row" style="margin: 5px 2px 0px 2px; display: none">
                        <label for="pilihan_layanan" class="col-sm-4 col-form-label ">Layanan</label>
                        <div class="col-sm-8">
                            <Select multiple="multiple" class="form-control form-control-sm" id="pilihan_layanan"
                                name="pilihan_layanan" required style="background-color: transparent; color: white">
                                @foreach ($layanan as $item)
                                    <option style="background-color: #222F3E; " value="{{ $item->kode }}">
                                        {{ $item->kode }}. {{ $item->nama }}</option>
                                @endforeach
                            </Select>
                        </div>
                    </div>

                    {{-- check box transfer based on $loket and select all check box --}}
                    <div id="div_pilihan_transfer" class="form-group row" style="margin: 5px 2px 0px 2px; display: none">
                        <label for="pilihan_transfer" class="col-sm-4 col-form-label ">Transfer Ke</label>
                        <div class="col-sm-8">
                            {{-- multiple checkbox inline --}}
                            <Select multiple="multiple" class="form-control form-control-sm" id="pilihan_transfer"
                                name="pilihan_transfer" required style="background-color: transparent; color: white">
                                @foreach ($loket as $item)
                                    <option style="background-color: #222F3E; " value="{{ $item->nomor }}">
                                        {{ $item->nomor }}. {{ $item->nama }}</option>
                                @endforeach

                            </Select>
                        </div>
                    </div>

                    {{-- check box transfer based on $loket and select all check box --}}




                    <div class="form-group  text-right col-sm mt-2">
                        <button class="btn btn-primary btn-xs" id="simpan">Tambahkan</button>
                        <button class="btn btn-info btn-xs" id="cancel" style="display: none">Cancel</button>
                        <button class="btn btn-warning btn-xs" id="update" style="display: none">Update</button>

                    </div>
                </form>



            </div>
            <div class="col-sm-8" style="color: white">
                <div class="contentHeader">
                    <div class="title-header">
                        {{-- <i class="fas fa-history pr-2"></i> --}}
                        List Alur
                    </div>
                </div>

                {{-- echo $alur --}}

                <table class="table table-sm table-stripped mt-1" id="table_alur">

                    <thead>
                        <tr>

                            <th>Alur</th>
                            <th>Loket</th>
                            <th>Layanan</th>
                            <th>Transfer Ke</th>
                            <th>Status</th>
                            <th></th>
                            <th scope="col" style="display: none">id</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alur as $item)
                            <tr>
                                {{-- invisible id --}}

                                {{-- visible nomor --}}
                                <td class="text-left">{{ $item->nama }}. {{ $item->keterangan }}</td>
                                <td class="text-left">{{ $item->list_loket }}.
                                    @foreach ($loket as $item2)
                                        @if ($item2->nomor == $item->list_loket)
                                            {{ $item2->nama }}
                                        @endif
                                    @endforeach
                                </td>
                                <td class="text-left">
                                    {{-- clickable icon to sneak name of list layanan --}}
                                    <i class="fas fa-info-circle mr-1" data-html="true" data-toggle="tooltip"
                                        data-placement="top"
                                        title="
                            @foreach ($layanan as $item2)
                                @if (in_array($item2->kode, explode(',', $item->list_layanan)))
                                    {{ $item2->kode }}. {{ $item2->nama }} <br>
                                    {{-- break line html --}}
                                @endif @endforeach
                        "></i>
                                    {{ $item->list_layanan }}

                                </td>
                                <td class="text-left">
                                    {{-- clickable icon to sneak name of list transfer --}}
                                    <i class="fas fa-info-circle mr-1" data-html="true" data-toggle="tooltip"
                                        data-placement="top"
                                        title="
                                    @foreach ($loket as $item2)
                                        @if (in_array($item2->nomor, explode(',', $item->list_transfer)))
                                            {{ $item2->nomor }}. {{ $item2->nama }} <br>
                                            {{-- break line html --}}
                                        @endif @endforeach
                                "></i>
                                    {{ $item->list_transfer }}
                                </td>

                                {{-- status if 1=enabled 0=disabled --}}
                                <td class="text-left">{{ $item->status == 1 ? 'Enabled' : 'Disabled' }}</td>
                                {{-- action button alight right --}}
                                <td class="text-right
                                ">
                                    <button class="btn btn-primary btn-xs" id="edit">Edit</button>
                                    <button class="btn btn-danger btn-xs" id="hapus">Hapus</button>
                                </td>
                                <td style="display: none;" id="data-id">{{ $item->id }}</td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>

    </div>

@endsection

@push('custom-js')
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

    {{-- script datatable --}}
    <script src="{{ asset('') }}assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('') }}assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('') }}assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('') }}assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('') }}assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('') }}assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>


    <link rel="stylesheet" type="text/css" href="{{ asset('css/multiple-select.css') }}">
    <script src="{{ asset('js/multiple-select.js') }}"></script>
    <!-- Include the default stylesheet -->
    {{-- <link rel="stylesheet" type="text/css"
        href="https://cdn.rawgit.com/wenzhixin/multiple-select/e14b36de/multiple-select.css">
    <!-- Include plugin -->
    <script src="https://cdn.rawgit.com/wenzhixin/multiple-select/e14b36de/multiple-select.js"></script> --}}
    <script>
        $("#pilihan_loket").multipleSelect({
            filter: false,
            keepOpen: false,
            placeholder: "Pilih Loket",
        });
        $("#pilihan_layanan").multipleSelect({
            filter: false,
            keepOpen: false,
            placeholder: "Pilih Layanan",
        });
        $("#pilihan_transfer").multipleSelect({
            filter: false,
            keepOpen: false,
            placeholder: "Pilih Loket Tujuan",
        });
    </script>
    <script>
        // on pilihan_alur change
        $('#pilihan_alur').change(function() {
            // get value
            var value = $(this).val();
            // check if value is 1
            if (value != 0) {
                //    show div_pilihan_loket with animation ease in
                $('#div_pilihan_loket').show('easeIn');
                //   show div_pilihan_layanan with animation ease in
                $('#div_pilihan_layanan').show('easeIn');
                //   show div_pilihan_transfer with animation ease in
                $('#div_pilihan_transfer').show('easeIn');
            } else {
                // hide div with id id="pilihan_loket"
                $('#div_pilihan_loket').hide('easeOut');
                // hide div with id id="pilihan_layanan"
                $('#div_pilihan_layanan').hide('easeOut');
                // hide div with id id="pilihan_transfer"
                $('#div_pilihan_transfer').hide('easeOut');
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#example1').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>

    <script>
        const myForm = document.getElementById('form_alur');
        const pilihan_alur = document.getElementById('pilihan_alur');
        const pilihan_loket = document.getElementById('pilihan_loket');
        const pilihan_layanan = document.getElementById('pilihan_layanan');
        const pilihan_transfer = document.getElementById('pilihan_transfer');
        const simpan = document.getElementById('simpan');
        const update = document.getElementById('update');
        const cancel = document.getElementById('cancel');

        // on simpan click
        simpan.addEventListener('click', function(e) {
            // prevent default
            e.preventDefault();
            // get multiple select value on pilihan_loket
            var pilihan_loket_value = $('#pilihan_loket').multipleSelect('getSelects');
            // get multiple select value on pilihan_layanan
            var pilihan_layanan_value = $('#pilihan_layanan').multipleSelect('getSelects');
            // get multiple select value on pilihan_transfer
            var pilihan_transfer_value = $('#pilihan_transfer').multipleSelect('getSelects');
            // get value on pilihan_alur
            var pilihan_alur_value = pilihan_alur.value;
            // check if pilihan_alur_value is 1
            // convert ["5","6","7","8","9","10"] to 5,6,7,8,9,10
            pilihan_loket_value = pilihan_loket_value.join(',');
            pilihan_layanan_value = pilihan_layanan_value.join(',');
            pilihan_transfer_value = pilihan_transfer_value.join(',');
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
            // check if pilihan_transfer_value is empty
            if (pilihan_transfer_value == '') {
                // show alert
                alert('Pilih Loket Tujuan');
                // focus on pilihan_transfer
                pilihan_transfer.focus();
                // return false
                return false;
            }

            var myJson = {
                nama: pilihan_alur_value,
                list_loket: pilihan_loket_value,
                list_layanan: pilihan_layanan_value,
                list_transfer: pilihan_transfer_value,
                keterangan: pilihan_alur.options[pilihan_alur.selectedIndex].text,
                requestorUsername: '{{ session()->get('username') }}',
            };

            myForm.method = 'post';
            myForm.action = '/api/alur';
            var myJsonString = JSON.stringify(myJson);
            console.log(myJsonString);
            const formData = new FormData(myForm);
            const xhr = new XMLHttpRequest();
            var token = "Bearer " + '{{ session()->get('tokenJwt') }}';
            xhr.open(myForm.method, myForm.action);
            xhr.setRequestHeader("Authorization", "Bearer " +
                '{{ session()->get('tokenJwt') }}');
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.send(myJsonString);
            xhr.onload = function() {
                if (xhr.status != 200) {
                    alert(`Error ${xhr.status}: ${xhr.statusText}`);
                } else {

                    // update table without reload page
                    const response = JSON.parse(xhr.response);
                    console.log(response);
                    // reload
                    location.reload();

                }
            };

        });

        update.addEventListener('click', function(e) {
            // prevent default
            e.preventDefault();
            // get multiple select value on pilihan_loket
            var pilihan_loket_value = $('#pilihan_loket').multipleSelect('getSelects');
            // get multiple select value on pilihan_layanan
            var pilihan_layanan_value = $('#pilihan_layanan').multipleSelect('getSelects');
            // get multiple select value on pilihan_transfer
            var pilihan_transfer_value = $('#pilihan_transfer').multipleSelect('getSelects');
            // get value on pilihan_alur
            var pilihan_alur_value = pilihan_alur.value;
            // check if pilihan_alur_value is 1
            // convert ["5","6","7","8","9","10"] to 5,6,7,8,9,10
            pilihan_loket_value = pilihan_loket_value.join(',');
            pilihan_layanan_value = pilihan_layanan_value.join(',');
            pilihan_transfer_value = pilihan_transfer_value.join(',');
            // get id from elemet title_header "Edit Alur 1"
            var id = document.getElementById('title_header').innerHTML.split(' ')[2];
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
            // check if pilihan_transfer_value is empty
            if (pilihan_transfer_value == '') {
                // show alert
                alert('Pilih Loket Tujuan');
                // focus on pilihan_transfer
                pilihan_transfer.focus();
                // return false
                return false;
            }

            var myJson = {
                nama: pilihan_alur_value,
                list_loket: pilihan_loket_value,
                list_layanan: pilihan_layanan_value,
                list_transfer: pilihan_transfer_value,
                keterangan: pilihan_alur.options[pilihan_alur.selectedIndex].text,
                requestorUsername: '{{ session()->get('username') }}',
            };

            myForm.method = 'POST';
            myForm.action = '/api/alur/' + id;
            var myJsonString = JSON.stringify(myJson);
            console.log(myJsonString);
            const formData = new FormData(myForm);
            const xhr = new XMLHttpRequest();

            xhr.open(myForm.method, myForm.action);
            xhr.setRequestHeader("Authorization", "Bearer " +
                '{{ session()->get('tokenJwt') }}');
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.send(myJsonString);
            xhr.onload = function() {
                if (xhr.status != 200) {
                    alert(`Error ${xhr.status}: ${xhr.statusText}`);
                } else {

                    // update table without reload page
                    const response = JSON.parse(xhr.response);
                    console.log(response);
                    // reload
                    location.reload();

                }
            };



        });

        // cancel 
        cancel.addEventListener('click', function(e) {
            // prevent default
            e.preventDefault();
            // reload
            $('#table_alur tr').css('background-color', ''); // get row data 
            var title = document.getElementById('title_header');
            title.innerHTML = 'Tambah Alur';
            // reset form

            $('#simpan').show();
            $('#update').hide();
            $('#cancel').hide();
            // #pilihan_alur option[value="1"]
            $('#pilihan_alur').val('').change();
            $('#pilihan_loket').multipleSelect('uncheckAll');
            $('#pilihan_layanan').multipleSelect('uncheckAll');
            $('#pilihan_transfer').multipleSelect('uncheckAll');




            // location.reload();
        });

        // on delete click delete data

        $(document).on('click', '#hapus', function() {

            var currentRow = $(this).closest("tr");

            var id = currentRow.find("td:eq(6)").text();

            var alur = currentRow.find("td:eq(0)").text();
            var loket = currentRow.find("td:eq(1)").text();
            var layanan = currentRow.find("td:eq(2)").text();

            loket = loket.replace(/\s/g, '');
            alur = alur.replace(/\s/g, '');
            layanan = layanan.replace(/\s/g, '');






            // show confirmation dialog
            var r = confirm("Alur : " + alur + "\nLoket : " + loket + "\nLayanan : " +
                layanan + "\nAre you sure want to delete this data ?");

            if (r == true) {
                // delete data to database
                var myJson = {
                    requestorUsername: '{{ session()->get('username') }}',
                };
                var myJsonString = JSON.stringify(myJson);
                console.log(myJsonString);
                const xhr = new XMLHttpRequest();
                // delete based on id
                xhr.open('DELETE', '/api/alur/' + id);

                xhr.setRequestHeader("Authorization", "Bearer " +
                    '{{ session()->get('tokenJwt') }}');
                xhr.setRequestHeader("Content-Type", "application/json");
                xhr.send(myJsonString);
                xhr.onload = function() {
                    if (xhr.status != 200) {
                        alert(`Error ${xhr.status}: ${xhr.statusText}`);
                    } else {

                        const response = JSON.parse(xhr.response);
                        // reload page 
                        location.reload();
                    }
                };
            }

        });

        // on edit click put data to form
        $(document).on('click', '#edit', function() {
            // clear all bacground color css on every row 
            $('#table_alur tr').css('background-color', ''); // get row data 
            var currentRow = $(this).closest("tr");
            currentRow.css("background-color", "#47535F");
            var title = document.getElementById('title_header');
            var id = currentRow.find("td:eq(6)").text();
            // change title header with last row data
            title.innerHTML = 'Edit Alur' + ' ' + id;
            var alur = currentRow.find("td:eq(0)").text();
            // loket after icon and space 
            var loket = currentRow.find("td:eq(1)").text();
            var layanan = currentRow.find("td:eq(2)").text();
            var transfer = currentRow.find("td:eq(3)").text();
            layanan = layanan.substring(layanan.indexOf(" ") + 1);
            // loket first string
            loket = loket.charAt(0);

            transfer = transfer.replace(/\s/g, '');
            layanan = layanan.replace(/\s/g, '');

            switch (alur.charAt(0)) {
                case '1':
                    //    change value of pilihan_alur to 1
                    $('#pilihan_alur').val('1').change();
                    break;
                case '2':
                    $('#pilihan_alur').val('2').change();
                    break;
                case '3':
                    $('#pilihan_alur').val('3').change();
                    break;
                default:
                    break;
            }

            $('#pilihan_loket').multipleSelect('setSelects', loket.split(','));
            $('#pilihan_layanan').multipleSelect('setSelects', layanan.split(','));
            $('#pilihan_transfer').multipleSelect('setSelects', transfer.split(','));




            $('#simpan').hide();
            $('#update').show();
            $('#cancel').show();

        });
    </script>
@endpush
