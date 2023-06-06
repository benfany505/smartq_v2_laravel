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
            <div class="col-sm-8" style="color: white">
                <div class="contentHeader">
                    <div class="title-header">
                        {{-- <i class="fas fa-history pr-2"></i> --}}
                        Konfigurasi Umum
                    </div>
                    {{-- <button class="title-button"><i class="fas fa-plus pr-2"></i>Tambah</button> --}}
                </div>
                <form id="form_umum">
                    @csrf
                    {{-- logo using filepond --}}
                    <div class="form-group row" style="margin: 5px 5px 5px 5px;">
                        <label for="logo" class="col-sm-4 col-form-label text-left ">Logo</label>
                        <div class="col-sm-8">
                            <div>
                                <img src="{{ asset('') }}{{ $umum->logoUrl }}" alt="logo" id="preview"
                                    style="width: 100px; height: 100px; border-radius:10%; border: 1px solid white;">
                                <input class="form-control-sm" id="image" type="file"
                                    style="background-color: transparent; color: white;" accept="image/png, image/jpeg">
                            </div>




                            {{-- <input type="file" name="image" id="image" accept="image/png, image/jpeg, image/gif"> --}}

                        </div>
                    </div>

                    {{-- Nama Perusahaan --}}
                    <div class="form-group row" style="margin: 5px 2px 0px 2px;">
                        <label for="perusahaan" class="col-sm-4 col-form-label ">Nama Perusahaan</label>
                        <div class="col-sm-8">
                            <input name="perusahaan" id="perusahaan" class="form-control form-control-sm" type="text"
                                required maxlength="30" style="background-color: transparent; color: white;"
                                value="{{ $umum->perusahaan }}">


                        </div>
                    </div>

                    {{-- Alamat1 --}}
                    <div class="form-group row" style="margin: 5px 2px 0px 2px;">
                        <label for="alamat1" class="col-sm-4 col-form-label ">Alamat 1</label>
                        <div class="col-sm-8">
                            <input name="alamat1" id="alamat1" class="form-control form-control-sm" type="text"
                                required maxlength="50" style="background-color: transparent; color: white;"
                                value="{{ $umum->alamat1 }}">

                        </div>
                    </div>

                    {{-- Alamat2 --}}
                    <div class="form-group row" style="margin: 5px 2px 0px 2px;">
                        <label for="alamat2" class="col-sm-4 col-form-label ">Alamat 2</label>
                        <div class="col-sm-8">
                            <input name="alamat2" id="alamat2" class="form-control form-control-sm" type="text"
                                required maxlength="50" style="background-color: transparent; color: white; "
                                value="{{ $umum->alamat2 }}">

                        </div>
                    </div>

                    {{-- telp --}}
                    <div class="form-group row" style="margin: 5px 2px 0px 2px;">
                        <label for="telp" class="col-sm-4 col-form-label ">Nomor Telepon</label>
                        <div class="col-sm-8">
                            <input name="telp" id="telp" class="form-control form-control-sm" type="text"
                                required maxlength="30" style="background-color: transparent; color: white; "
                                value="{{ $umum->telp }}">

                        </div>
                    </div>
                    {{-- Mute Enable disable option box --}}
                    <div class="form-group row" style="margin: 5px 2px 0px 2px;">
                        <label for="mute" class="col-sm-4 col-form-label ">Auto Mute</label>
                        <div class="col-sm-8">
                            <select name="mute" id="mute" class="form-control form-control-sm"
                                style="background-color: transparent; color: white; ">
                                {{-- set selected based on $umum --}}
                                @if ($umum->mute == 1)
                                    <option value="1" style="background-color: #222F3E; " selected>Enable</option>
                                    <option value="0" style="background-color: #222F3E; ">Disable</option>
                                @else
                                    <option value="1" style="background-color: #222F3E; ">Enable</option>
                                    <option value="0" style="background-color: #222F3E; " selected>Disable</option>
                                @endif


                            </select>
                        </div>
                    </div>
                    {{-- mode printer option dengan printer, antrian 50, antrian 100 --}}
                    <div class="form-group row" style="margin: 5px 2px 0px 2px;">
                        <label for="mode_printer" class="col-sm-4 col-form-label ">Mode Cetak</label>
                        <div class="col-sm-8">
                            <select name="mode_printer" id="mode_printer" class="form-control form-control-sm"
                                style="background-color: transparent; color: white; ">
                                {{-- set selected based on $umum --}}
                                @if ($umum->mode_printer == 0)
                                    <option value="0" style="background-color: #222F3E; " selected>Dengan
                                        Printer
                                    </option>
                                    <option value="1" style="background-color: #222F3E; ">Tanpa Printer 50</option>
                                    <option value="2" style="background-color: #222F3E; ">Tanpa Printer 100</option>
                                @elseif ($umum->mode_printer == 1)
                                    <option value="0" style="background-color: #222F3E; ">Cetak Printer</option>
                                    <option value="1" style="background-color: #222F3E; " selected>Tanpa Printer 50
                                    </option>
                                    <option value="2" style="background-color: #222F3E; ">Tanpa Printer 100</option>
                                @elseif ($umum->mode_printer == 2)
                                    <option value="0" style="background-color: #222F3E; ">Cetak Printer</option>
                                    <option value="1" style="background-color: #222F3E; ">Tanpa Printer 50</option>
                                    <option value="2" style="background-color: #222F3E; " selected>Tanpa Printer 100
                                    </option>
                                @endif


                            </select>
                        </div>
                    </div>
                    {{-- running Text --}}

                    <div class="form-group row" style="margin: 5px 2px 0px 2px;">
                        <label for="text" class="col-sm-4 col-form-label ">Running Text</label>
                        <div class="col-sm-8">
                            {{-- multi line input text --}}
                            <textarea name="text" id="text" class="form-control form-control-sm" type="text" rows="4"
                                style="resize: none; background-color: transparent; color: white; ">{{ $umum->text }}</textarea>

                        </div>
                    </div>


                    <div class="form-group  text-right col-sm mt-2">
                        <button class="btn btn-primary btn-xs" id="simpan">Simpan</button>
                    </div>
                </form>




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
        // fi file image choosen update image box preview
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#image").change(function() {
            readURL(this);
        });
    </script>
    <script>
        const myForm = document.getElementById('form_umum');
        const simpan = document.getElementById('simpan');
        const perusahaan = document.getElementById('perusahaan');
        const alamat1 = document.getElementById('alamat1');
        const alamat2 = document.getElementById('alamat2');
        const telp = document.getElementById('telp');
        const mute = document.getElementById('mute');
        const text = document.getElementById('text');
        const mode_printer = document.getElementById('mode_printer');
        // get image file
        const imageFIle = document.getElementById('image');
        // get preview image


        simpan.addEventListener('click', function(e) {
            e.preventDefault();
            // console.log(imageFIle.files[0]);
            var formData = new FormData()
            // append image file
            formData.append('logo', $('input[type=file]')[0].files[0]);
            formData.append('perusahaan', perusahaan.value);
            formData.append('alamat1', alamat1.value);
            formData.append('alamat2', alamat2.value);
            formData.append('telp', telp.value);
            formData.append('mute', mute.value);
            formData.append('text', text.value);
            formData.append('mode_printer', mode_printer.value);
            formData.append('requestorUsername', '{{ session()->get('username') }}')
            // set authorization bearer token
            formData.append('Authorization', 'Bearer ' + '{{ session()->get('tokenJwt') }}');
            // formData.append('_token', '{{ csrf_token() }}');

            // send data
            $.ajax({
                url: '/api/umum/1',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                // set auth bearer token
                headers: {
                    "Authorization": "Bearer " + '{{ session()->get('tokenJwt') }}'
                },
                // on process loading show
                beforeSend: function() {
                    Swal.fire({
                        title: 'Loading...',
                        html: 'Sedang memproses data',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading()
                        },
                    });
                },


                success: function(data) {
                    // swallfire
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data berhasil diubah',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // reload page

                        }
                    });

                },
                error: function(data) {
                    // swallfire
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Data gagal diubah',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // reload page

                        }
                    });
                }
            });









        });
    </script>
@endpush

{{-- // formData.append('_token', '{{ csrf_token() }}');
            // sendata using xhr 
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/api/umum/1');
            xhr.setRequestHeader("Authorization", "Bearer " +
                '{{ session()->get('tokenJwt') }}');
            // content type for form data
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            for (var pair of formData.entries()) {
                console.log(pair[0] + ', ' + pair[1]);
            }
            xhr.send(formData);
            xhr.onload = function() {
                if (xhr.status != 200) {
                    alert(`Error ${xhr.status}: ${xhr.statusText}`);
                } else {

                    // update table without reload page
                    const response = JSON.parse(xhr.response);
                    // console.log(response);
                    // reload
                    location.reload();

                }
            }; --}}
