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




    <style>

    </style>
@endpush

@section('content')
    <div class="container-fluid">



        <div class="row">
            <div class="col-sm-4" style="color: white">
                <div class="contentHeader">
                    <div class="title-header">
                        {{-- <i class="fas fa-history pr-2"></i> --}}
                        Tambah Loket
                    </div>
                    {{-- <button class="title-button"><i class="fas fa-plus pr-2"></i>Tambah</button> --}}
                </div>
                <form id="form_loket">
                    @csrf
                    <div class="form-group row" style="margin: 5px 2px 0px 2px;">
                        <label for="nomor_loket" class="col-sm-4 col-form-label ">Nomor</label>
                        <div class="col-sm-8">
                            <Select class="form-control form-control-sm" id="nomor_loket" name="nomor_loket" required
                                style="background-color: transparent; color: white">
                                @php
                                    // create array ok nomor for each $loket->nomor
                                    
                                    $nomor = [];
                                    foreach ($loket as $key => $value) {
                                        $nomor[] = $value->nomor;
                                    }
                                    
                                    // create option in select 1 to 10 except nomor in array
                                    for ($i = 1; $i <= 10; $i++) {
                                        if (!in_array($i, $nomor)) {
                                            echo '<option value="' . $i . '" style="background-color: #222F3E; ">' . $i . '</option>';
                                        }
                                    }
                                    echo '<option value="' . 99 . '" style="background-color: #222F3E; ">' . 99 . '</option>';
                                    
                                @endphp




                            </select>
                        </div>
                    </div>

                    <div class="form-group row" style="margin: 5px 2px 0px 2px;">
                        <label for="nama_loket" class="col-sm-4 col-form-label ">Nama</label>
                        <div class="col-sm-8">
                            <input name="nama_loket" id="nama_loket" class="form-control form-control-sm" type="text"
                                required maxlength="30"
                                style="background-color: transparent; color: white; text-transform:uppercase">
                        </div>
                    </div>

                    <div class="form-group row" style="margin: 5px 2px 0px 2px;">
                        <label for="status_loket" class="col-sm-4 col-form-label ">Status</label>
                        <div class="col-sm-8">
                            <Select class="form-control form-control-sm" id="status_loket" name="status_loket" required
                                style="background-color: transparent; color: white">
                                <option value="1" style="background-color: #222F3E; ">Enable</option>
                                <option value="1" style="background-color: #222F3E; ">Disable</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group  text-right col-sm mt-2">
                        <button class="btn btn-primary btn-xs" id="simpan">Tambahkan</button>
                    </div>
                </form>




            </div>
            <div class="col-sm-8" style="color: white">
                <div class="contentHeader">
                    <div class="title-header">
                        {{-- <i class="fas fa-history pr-2"></i> --}}
                        List Loket
                    </div>
                </div>

                {{-- echo $loket --}}
                <table class="table table-sm  table-striped  mt-1" id="table_loket">
                    <thead>
                        <tr>
                            {{-- invisible id --}}

                            <th scope="col" width="10%" class="text-left">Nomor</th>
                            <th scope="col" width="40%" class="text-left">Nama Loket</th>
                            <th scope="col" width="10%" class="text-left">Status</th>
                            <th scope="col" width="40%" class="text-right"></th>
                            <th scope="col" style="display: none">id</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($loket as $item)
                            <tr>
                                {{-- invisible id --}}

                                {{-- visible nomor --}}
                                <td class="text-left">{{ $item->nomor }}</td>
                                <td class="text-left">{{ $item->nama }}</td>
                                {{-- status if 1=enabled 0=disabled --}}
                                <td class="text-left">{{ $item->status == 1 ? 'Enabled' : 'Disabled' }}</td>
                                {{-- action button alight right --}}
                                <td class="text-right
                                    ">
                                    <button class="btn btn-primary btn-xs" id="edit">Edit</button>
                                    <button class="btn btn-danger btn-xs" id="hapus">Hapus</button>
                                </td>
                                <td style="display: none">{{ $item->id }}</td>
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
    {{-- Script to create New Loket without reload page --}}

    {{-- script datatable --}}
    <script src="{{ asset('') }}assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('') }}assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('') }}assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('') }}assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('') }}assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('') }}assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>


    <script>
        // datatable


        const myForm = document.getElementById('form_loket');
        const nomor_loket = document.getElementById('nomor_loket');
        const nama_loket = document.getElementById('nama_loket');
        const status_loket = document.getElementById('status_loket');
        const simpan = document.getElementById('simpan');

        // add new loket
        myForm.addEventListener('submit', function(e) {
            e.preventDefault();
            // nama_loket.value = nama_loket.value.toUpperCase();
            var myJson = {
                nomor: nomor_loket.value,
                nama: nama_loket.value.toUpperCase(),
                status: status_loket.value,
                // get session requestorEmail
                requestorUsername: '{{ session()->get('username') }}',

            };
            myForm.method = 'POST';
            myForm.action = '/api/loket';
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

        // if id="edit" button clicked change table to input field edit
        $(document).on('click', '#edit', function() {
            // GET LOGIN DATA FROM SESSION
            var session = {
                username: '{{ session()->get('username') }}',
                token: '{{ session()->get('tokenJwt') }}'
            };
            console.log(session);

            // get row data
            var currentRow = $(this).closest("tr");
            var nomor = currentRow.find("td:eq(0)").text();
            var nama = currentRow.find("td:eq(1)").text();
            var status = currentRow.find("td:eq(2)").text();
            // change table to input field
            currentRow.find("td:eq(0)").html("<input type='text' id='nomor' value='" + nomor + "' />");
            currentRow.find("td:eq(1)").html("<input type='text' id='nama' value='" + nama + "' />");
            //    status as select option Enable=1 or Disable=0, set selected option
            if (status == 'Enabled') {
                currentRow.find("td:eq(2)").html(
                    "<select id='status'><option value='1' selected>Enabled</option><option value='0'>Disabled</option></select>"
                );
            } else {
                currentRow.find("td:eq(2)").html(
                    "<select id='status'><option value='1'>Enabled</option><option value='0' selected>Disabled</option></select>"
                );
            }

            // change button to save button
            currentRow.find("td:eq(3)").html("<button class='btn btn-primary btn-xs' id='save'>Save</button>");
        });

        // if id="save" button clicked change input field to table
        $(document).on('click', '#save', function() {
            // get row data
            var currentRow = $(this).closest("tr");
            var nomor = currentRow.find("td:eq(0)").find("input[type=text]").val();
            var nama = currentRow.find("td:eq(1)").find("input[type=text]").val();
            var status = currentRow.find("td:eq(2)").find("select").val();



            // change input field to table
            currentRow.find("td:eq(0)").html(nomor);
            currentRow.find("td:eq(1)").html(nama);
            //    status as select option Enable=1 or Disable=0, set selected option
            if (status == '1') {
                currentRow.find("td:eq(2)").html('Enabled');
            } else {
                currentRow.find("td:eq(2)").html('Disabled');
            }
            // change button to edit button
            currentRow.find("td:eq(3)").html("<button class='btn btn-primary btn-xs' id='edit'>Edit</button>");
            // get id
            var id = currentRow.find("td:eq(4)").text();

            // update data to database
            var myJson = {
                nomor: nomor,
                nama: nama.toUpperCase(),
                // status as select option Enable=1 or Disable=0
                status: status,
                // get session requestorEmail
                requestorUsername: '{{ session()->get('username') }}',
            };
            var myJsonString = JSON.stringify(myJson);
            console.log(myJsonString);
            const xhr = new XMLHttpRequest();
            // update based on id
            xhr.open('PUT', '/api/loket/' + id);
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


        });

        // if id="delete" button clicked delete data show confirmation dialog
        $(document).on('click', '#hapus', function() {

            var currentRow = $(this).closest("tr");
            var nomor = currentRow.find("td:eq(0)").text();
            var nama = currentRow.find("td:eq(1)").text();
            var status = currentRow.find("td:eq(2)").text();
            // get id
            var id = currentRow.find("td:eq(4)").text();
            // show confirmation dialog
            var r = confirm("Are you sure want to delete " + nomor + " - " + nama + " - " + status + "?");
            if (r == true) {
                // delete data to database
                var myJson = {
                    requestorUsername: '{{ session()->get('username') }}',
                };
                var myJsonString = JSON.stringify(myJson);
                console.log(myJsonString);
                const xhr = new XMLHttpRequest();
                // delete based on id
                xhr.open('DELETE', '/api/loket/' + id);

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
    </script>
@endpush
