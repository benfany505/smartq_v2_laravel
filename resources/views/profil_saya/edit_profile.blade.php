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
                        Profile Saya
                    </div>
                    {{-- banner --}}
                    <div class="text-center text-sm-right">
                        <span class="badge badge-secondary">{{ $profile->role }}</span>
                        <div class="text-muted"><small style="color: salmon">Joined
                                {{ date('d M Y', strtotime($profile->created_at)) }}</small>
                        </div>
                    </div>
                </div>
                <form id="form_profile">
                    @csrf
                    {{-- image_url using filepond --}}
                    <div class="form-group row" style="margin: 5px 5px 5px 5px;">
                        <label for="image_url" class="col-sm-4 col-form-label ">Photo</label>
                        <div class="col-sm-8">
                            <div>
                                {{-- check if $profile->image_url has valid image --}}
                                @if ($profile->image_url != '')
                                    <img src="{{ asset('') }}{{ $profile->image_url }}" alt="image" id="preview"
                                        style="width: 100px; height: 100px; border-radius:10%; border: 1px solid white;">
                                @else
                                    <img src="{{ asset('') }}assets/dist/img/no_photo.png" alt="image"
                                        id="preview"
                                        style="width: 100px; height: 100px; border-radius:10%; border: 1px solid white;">
                                @endif
                                <input class="form-control-sm" id="image" type="file"
                                    style="background-color: transparent; color: white;" accept="image/png, image/jpeg">
                            </div>

                            {{-- <img src="{{ asset('') }}{{ $profile->image_url }}" alt="image" id="preview"
                                    style="width: 100px; height: 100px; border-radius:10%; border: 1px solid white;">
                                <input class="form-control-sm" id="image" type="file"
                                    style="background-color: transparent; color: white;" accept="image/png, image/jpeg"> --}}
                        </div>
                    </div>




                    {{-- <input type="file" name="image" id="image" accept="image/png, image/jpeg, image/gif"> --}}




                    {{-- Nama Perusahaan --}}
                    <div class="form-group row" style="margin: 5px 2px 0px 2px;">
                        <label for="full_name" class="col-sm-4 col-form-label ">Nama Lengkap</label>
                        <div class="col-sm-8">
                            <input name="full_name" id="full_name" class="form-control form-control-sm" type="text"
                                required maxlength="50" style="background-color: transparent; color: white;"
                                value="{{ $profile->full_name }} ">

                        </div>
                    </div>
                    {{-- username --}}
                    <div class="form-group row" style="margin: 5px 2px 0px 2px;">
                        <label for="username" class="col-sm-4 col-form-label ">Nama Pengguna</label>
                        <div class="col-sm-8">
                            <input name="username" id="username" class="form-control form-control-sm" type="text"
                                required maxlength="50" style="background-color: transparent; color: white;"
                                value="{{ $profile->username }}">

                        </div>
                    </div>


                    {{-- current password with lock unlock --}}




                    <div class="form-group  text-right col-sm mt-2">
                        {{-- button change password --}}
                        <button type="button" class="btn btn-danger btn-xs" id="change_password">Ganti Kata Sandi</button>
                        {{-- button save --}}
                        <button class="btn btn-primary btn-xs" id="simpan">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- modal change password --}}
    <div class="modal fade" id="modal_change_password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content pr-3 pl-3"style="background-color: #222F3E; color:white;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ganti Kata Sandi</h5>

                </div>
                <form id="form_change_password">
                    @csrf
                    <div class="modal-body 
                    ">
                        <div class="form-group
                        ">
                            <label for="current_password">Kata Sandi Saat Ini</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="current_password" name="current_password"
                                    placeholder="Kata Sandi Saat Ini" style="background-color:transparent;color:white;"
                                    required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary"
                                        style="background-color:transparent;color:white;" type="button"
                                        id="btn_show_password_current"><i class="fas fa-eye"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group
                        ">
                            <label for="new_password">Kata Sandi Baru</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="new_password" name="new_password"
                                    placeholder="Kata Sandi Baru" style="background-color:transparent;color:white;"
                                    {{-- minimum 4 --}} pattern=".{4,}" title="Minimum 4 karakter" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary"
                                        style="background-color:transparent;color:white;" type="button"
                                        id="btn_show_password_new"><i class="fas fa-eye"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group
                        ">
                            <label for="confirm_password">Konfirmasi Kata Sandi Baru</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="confirm_password"
                                    name="confirm_password" placeholder="Konfirmasi Kata Sandi Baru"
                                    style="background-color:transparent;color:white;" pattern=".{4,}"
                                    title="Minimum 4 karakter" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary"
                                        style="background-color:transparent;color:white;" type="button"
                                        id="btn_show_password_confirm"><i class="fas fa-eye"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="button" id="submit_password" class="btn btn-primary">Simpan</button>
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
        $(document).ready(function() {
            $('#change_password').click(function() {
                // clear form
                $('#form_change_password')[0].reset();
                // show modal


                $('#modal_change_password').modal('show');
            });
        });

        // on click btn_show_password_current
        $('#btn_show_password_current').click(function() {
            if ($('#current_password').attr('type') == 'password') {
                $('#current_password').attr('type', 'text');
                $('#btn_show_password_current').html('<i class="fas fa-eye-slash"></i>');
            } else {
                $('#current_password').attr('type', 'password');
                $('#btn_show_password_current').html('<i class="fas fa-eye"></i>');
            }
        });

        // on click btn_show_password_new
        $('#btn_show_password_new').click(function() {
            if ($('#new_password').attr('type') == 'password') {
                $('#new_password').attr('type', 'text');
                $('#btn_show_password_new').html('<i class="fas fa-eye-slash"></i>');
            } else {
                $('#new_password').attr('type', 'password');
                $('#btn_show_password_new').html('<i class="fas fa-eye"></i>');
            }
        });

        // on click btn_show_password_confirm
        $('#btn_show_password_confirm').click(function() {
            if ($('#confirm_password').attr('type') == 'password') {
                $('#confirm_password').attr('type', 'text');
                $('#btn_show_password_confirm').html('<i class="fas fa-eye-slash"></i>');
            } else {
                $('#confirm_password').attr('type', 'password');
                $('#btn_show_password_confirm').html('<i class="fas fa-eye"></i>');
            }
        });

        //on modal #submit_password click, submit form
        $('#submit_password').click(function() {
            console.log('submit');
            // check if new password and confirm password is same
            if ($('#new_password').val() == $('#confirm_password').val()) {
                // submit form
                const form = document.getElementById('form_change_password');
                const current_password = document.getElementById('current_password');
                const new_password = document.getElementById('new_password');
                const confirm_password = document.getElementById('confirm_password');
                var myJson = {
                    current_password: current_password.value,
                    new_password: new_password.value,
                    confirm_password: confirm_password.value,
                    requestorUsername: '{{ session()->get('username') }}'
                };

                var myJsonString = JSON.stringify(myJson);
                console.log(myJsonString);
                const xhr = new XMLHttpRequest();
                xhr.open('PUT', '/api/edit_profile/password');
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.setRequestHeader("Authorization", "Bearer " +
                    '{{ session()->get('tokenJwt') }}');
                xhr.send(myJsonString);

                xhr.onload = function() {
                    if (xhr.status != 200) {
                        // get response "message"
                        var response = JSON.parse(xhr.responseText);
                        // show alert
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message,
                        });
                    } else {
                        console.log(response);
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Password berhasil diubah!',
                        }).then((result) => {
                            var response = JSON.parse(xhr.responseText);

                            // clear form
                            $('#form_change_password')[0].reset();
                            // hide modal
                            $('#modal_change_password').modal('hide');
                        });
                        // hide modal

                    }


                };

            } else {
                // show alert
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Password baru dan konfirmasi password tidak sama!',
                });
            }

        });
    </script>

    {{-- update user --}}
    <script>
        const myForm = document.getElementById('form_profile');
        const simpan = document.getElementById('simpan');
        const full_name = document.getElementById('full_name');
        const username = document.getElementById('username');
        const role = document.getElementById('role');

        const imageFIle = document.getElementById('image');
        // get preview image


        simpan.addEventListener('click', function(e) {
            e.preventDefault();
            // console.log(imageFIle.files[0]);
            var formData = new FormData()
            // append image file
            formData.append('photo', $('input[type=file]')[0].files[0]);
            formData.append('full_name', full_name.value);
            formData.append('username', username.value);
            formData.append('requestorUsername', '{{ session()->get('username') }}')
            // set authorization bearer token
            formData.append('Authorization', 'Bearer ' + '{{ session()->get('tokenJwt') }}');
            // formData.append('_token', '{{ csrf_token() }}');
            for (var pair of formData.entries()) {
                console.log(pair[0] + ', ' + pair[1]);
            }
            // send data
            $.ajax({
                url: '/api/edit_profile',
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
                            // destroy jwt token
                            sessionStorage.removeItem('tokenJwt');
                            // reload page
                            location.reload();

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
