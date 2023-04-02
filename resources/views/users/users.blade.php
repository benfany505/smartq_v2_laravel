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
            <div class="col-sm-4" style="color: white">
                <div class="contentHeader">
                    <div class="title-header">
                        {{-- <i class="fas fa-history pr-2"></i> --}}
                        Tambah User
                    </div>
                    {{-- <button class="title-button"><i class="fas fa-plus pr-2"></i>Tambah</button> --}}
                </div>
                <form id="form_tambah_user">
                    @csrf
                    {{-- image_url using filepond --}}
                    <div class="form-group row" style="margin: 5px 5px 5px 5px;">
                        <label for="image_url" class="col-sm-4 col-form-label ">Photo</label>
                        <div class="col-sm-8">
                            <div>


                                <img src="{{ asset('') }}assets/dist/img/no_photo.png" alt="image"
                                    id="preview_tambah_user"
                                    style="width: 100px; height: 100px; border-radius:10%; border: 1px solid white;">
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
                                required maxlength="50" style="background-color: transparent; color: white;">

                        </div>
                    </div>
                    {{-- username --}}
                    <div class="form-group row" style="margin: 5px 2px 0px 2px;">
                        <label for="username" class="col-sm-4 col-form-label ">Username</label>
                        <div class="col-sm-8">
                            <input name="username" id="username" class="form-control form-control-sm" type="text"
                                required maxlength="50" style="background-color: transparent; color: white;">

                        </div>
                    </div>

                    {{-- role administrator, user --}}
                    <div class="form-group row" style="margin: 5px 2px 0px 2px;">
                        <label for="role" class="col-sm-4 col-form-label ">Role</label>
                        <div class="col-sm-8">
                            <select name="role" id="role" class="form-control form-control-sm" required
                                style="background-color: transparent; color: white;">
                                <option value="administrator" style="background-color: #222F3E; ">Administrator</option>
                                <option value="user" style="background-color: #222F3E; ">User</option>
                            </select>
                        </div>
                    </div>
                    {{-- password and confirm password with lock unlock to see password  --}}
                    <div class="form-group row" style="margin: 5px 2px 0px 2px;">
                        <label for="password" class="col-sm-4 col-form-label ">Password</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input name="password" id="password" class="form-control form-control-sm" type="password"
                                    required maxlength="50" style="background-color: transparent; color: white;">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="btn_password"><i class="fas fa-lock"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- confirm password --}}
                    <div class="form-group row" style="margin: 5px 2px 0px 2px;">
                        <label for="confirm_password" class="col-sm-4 col-form-label ">Konfirmasi</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input name="confirm_password" id="confirm_password" class="form-control form-control-sm"
                                    type="password" required maxlength="50"
                                    style="background-color: transparent; color: white;">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="btn_confirm_password"><i
                                            class="fas fa-lock"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>




                    {{-- current password with lock unlock --}}




                    <div class="form-group  text-right col-sm mt-2">
                        {{-- button save --}}
                        <button class="btn btn-primary btn-xs" id="simpan">Simpan</button>
                    </div>
                </form>




            </div>
            <div class="col-sm-8" style="color: white">
                <div class="contentHeader">
                    <div class="title-header">
                        {{-- <i class="fas fa-history pr-2"></i> --}}
                        List User
                    </div>
                </div>

                {{-- echo $users --}}
                <table class="table table-sm  table-striped  mt-1" id="table_layanan">
                    <thead>
                        <tr>
                            {{-- invisible id --}}
                            {{-- Image --}}
                            <th scope="col" width="10%" class="text-left">Photo</th>
                            <th scope="col" width="20%" class="text-left">Nama Lengkap</th>
                            <th scope="col" width="20%" class="text-left">Username</th>
                            <th scope="col" width="20%" class="text-left">Role</th>
                            {{-- last login --}}
                            <th scope="col" width="20%" class="text-left">Last Login</th>
                            <th scope="col" width="10%" class="text-center">Aksi</th>
                            <th scope="col" style="display: none">id</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- check if list not 0 --}}
                        @if (count($users) > 0)

                            @foreach ($users as $item)
                                <tr>
                                    {{-- invisible id --}}

                                    {{-- visible full_name --}}
                                    <td class="text-left">
                                        @if ($item->image_url != '')
                                            <img src="{{ asset('') }}{{ $item->image_url }}" alt="image"
                                                id="preview"
                                                style="width: 30px; height: 30px; border-radius:50%; border: 1px solid white;">
                                        @else
                                            <img src="{{ asset('') }}assets/dist/img/no_photo.png" alt="image"
                                                id="preview"
                                                style="width: 30px; height: 30px; border-radius:50%; border: 1px solid white;">
                                        @endif
                                    <td class="text-left">{{ $item->full_name }}</td>
                                    <td class="text-left">{{ $item->username }}</td>
                                    {{-- status if 1=enabled 0=disabled --}}
                                    <td class="text-left">{{ $item->role }}</td>
                                    {{-- last_login_at format dd/MM/yy hh:mm --}}
                                    <td class="text-left">
                                        {{-- format dd/MM/yy hh:mm --}}
                                        {{-- if not null --}}
                                        @if ($item->last_login_at != null)
                                            {{ date('d/m/y H:i', strtotime($item->last_login_at)) }}
                                        @else
                                            -
                                        @endif

                                    </td>

                                    {{-- action button alight right --}}
                                    <td class="text-center
                                    ">
                                        {{-- button with dropdown name menu sub menu with icon  background #222F3E --}}
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-xs btn-secondary dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Menu
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right"
                                                style="background-color: #222F3E;">
                                                <a style="color: cadetblue;" class="dropdown-item" data-toggle="modal"
                                                    data-target="#modal_edit_user_{{ $item->id }}"><i
                                                        class="fas fa-edit"></i> Edit</a>
                                                <a style="color: salmon;"class="dropdown-item" id="delete_user"><i
                                                        class="fas fa-trash"></i> Hapus</a>
                                                {{-- line --}}
                                                <div class="dropdown-divider"></div>
                                                {{-- change password --}}
                                                <a style="color: cornflowerblue;"class="dropdown-item"
                                                    data-toggle="modal"
                                                    data-target="#modal_change_password_{{ $item->id }}"><i
                                                        class="fas fa-key"></i> Ganti Password</a>

                                            </div>
                                        </div>



                                    </td>
                                    <td style="display: none">{{ $item->id }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    {{-- for each users --}}

    @foreach ($users as $items)
        {{-- modal delete user --}}
        <div class="modal fade" id="modal_delete_user_{{ $items->id }}" tabindex="-1" role="dialog"
            aria-labelledby="modal_delete_user" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="background-color: #222F3E; color:white;">

                    <div class="modal-body
                    ">
                        <div class="row">
                            <div class="col-sm-12" style="color: white">
                                <div class="contentHeader">
                                    {{-- banner --}}
                                    <div class="banner-header">
                                        <div class="text">
                                            Apakah anda yakin ingin menghapus user ini?
                                        </div>
                                    </div>
                                </div>
                                {{-- user detail --}}
                                <div class="user-detail">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="text-center">
                                                <img src="{{ asset('') }}{{ $items->image_url }}" alt="image"
                                                    id="preview"
                                                    style="width: 100px; height: 100px; border-radius:50%; border: 1px solid white;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="text-center">
                                                <h5>{{ $items->full_name }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="text-center">
                                                <h6>{{ $items->username }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        {{-- yes no --}}
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="text-center text-sm-right">
                                    {{-- button delete with method delete --}}

                                    <button type="submit" class="btn btn-sm btn-danger" {{-- id --}}
                                        id="delete_user">Ya</button>
                                    <button type="button" class="btn btn-sm btn-secondary"
                                        data-dismiss="modal">Tidak</button>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- modal edit user --}}
        <div class="modal fade" id="modal_edit_user_{{ $items->id }}" tabindex="-1" role="dialog"
            aria-labelledby="modal_edit_user" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="background-color: #222F3E; color:white;">

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12" style="color: white">
                                <div class="contentHeader">
                                    <div class="title-header">
                                        {{-- <i class="fas fa-history pr-2"></i> --}}
                                        Edit Profile
                                    </div>
                                    {{-- banner --}}
                                    <div class="text-center text-sm-right">
                                        <span class="badge badge-secondary">{{ $items->role }}</span>
                                        <div class="text-muted"><small style="color: salmon">Joined
                                                {{ date('d M Y', strtotime($items->created_at)) }}</small>
                                        </div>
                                    </div>
                                </div>
                                <form id="form_profile_{{ $items->id }}">
                                    @csrf
                                    {{-- image_url using filepond --}}
                                    <div class="form-group row" style="margin: 5px 5px 5px 5px;">
                                        <label for="image_url" class="col-sm-4 col-form-label ">Photo</label>
                                        <div class="col-sm">
                                            <div>
                                                {{-- check if $profile->image_url has valid image --}}
                                                @if ($items->image_url != '')
                                                    <img src="{{ asset('') }}{{ $items->image_url }}" alt="image"
                                                        id="preview_edit_{{ $items->id }}"
                                                        style="width: 100px; height: 100px; border-radius:10%; border: 1px solid white;">
                                                @else
                                                    <img src="{{ asset('') }}assets/dist/img/no_photo.png"
                                                        alt="image" id="preview_edit_{{ $items->id }}"
                                                        style="width: 100px; height: 100px; border-radius:10%; border: 1px solid white;">
                                                @endif
                                                <input class="form-control-sm" id="image_edit_{{ $items->id }}"
                                                    type="file" style="background-color: transparent; color: white;"
                                                    accept="image/png, image/jpeg">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Nama Perusahaan --}}
                                    <div class="form-group row" style="margin: 5px 2px 0px 2px;">
                                        <label for="full_name_edit" class="col-sm-4 col-form-label ">Nama
                                            Lengkap</label>
                                        <div class="col-sm">
                                            <input name="full_name_edit" id="full_name_edit_{{ $items->id }}"
                                                class="form-control form-control-sm" type="text" required
                                                maxlength="50" style="background-color: transparent; color: white;"
                                                value="{{ $items->full_name }} ">

                                        </div>
                                    </div>
                                    {{-- username --}}
                                    <div class="form-group row" style="margin: 5px 2px 0px 2px;">
                                        <label for="username_edit" class="col-sm-4 col-form-label ">Nama
                                            Pengguna</label>
                                        <div class="col-sm">
                                            <input name="username_edit" id="username_edit_{{ $items->id }}"
                                                class="form-control form-control-sm" type="text" required
                                                maxlength="50" style="background-color: transparent; color: white;"
                                                value="{{ $items->username }}">

                                        </div>
                                    </div>

                                    {{-- select option role administrator and user --}}
                                    <div class="form-group row" style="margin: 5px 2px 0px 2px;">
                                        <label for="role_edit" class="col-sm-4 col-form-label ">Role</label>
                                        <div class="col-sm">
                                            <select name="role_edit" id="role_edit_{{ $items->id }}"
                                                class="form-control form-control-sm"
                                                style="background-color: transparent; color: white;">
                                                <option value="administrator" style="background-color: #222F3E; "
                                                    @if ($items->role == 'administrator') selected @endif>Administrator
                                                </option>
                                                <option value="user" style="background-color: #222F3E; "
                                                    @if ($items->role == 'user') selected @endif>
                                                    User</option>
                                            </select>
                                        </div>
                                    </div>




                                    <div class="form-group  text-right col-sm mt-2">
                                        {{-- Ganti Password --}}
                                        {{-- <button type="button" class="btn btn-danger btn-xs"
                                            id="changePassword_{{ $items->id }}">Ganti
                                            Kata Sandi</button> --}}
                                        {{-- button close --}}
                                        <button type="button" class="btn btn-secondary btn-xs"
                                            data-dismiss="modal">Tutup</button>
                                        {{-- button save --}}
                                        <button class="btn btn-primary btn-xs"
                                            id="simpan_{{ $items->id }}">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- modal change password --}}
        <div class="modal fade" id="modal_change_password_{{ $items->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content pr-3 pl-3"style="background-color: #222F3E; color:white;">

                    <form id="form_change_password_{{ $items->id }}">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12" style="color: white">
                                    <div class="contentHeader">
                                        <div class="title-header">
                                            {{-- <i class="fas fa-history pr-2"></i> --}}
                                            User Details
                                        </div>
                                        {{-- banner --}}
                                        <div class="text-center text-sm-right">
                                            <span class="badge badge-secondary">{{ $items->role }}</span>
                                            <div class="text-muted"><small style="color: salmon">Joined
                                                    {{ date('d M Y', strtotime($items->created_at)) }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    <form id="form_profile_{{ $items->id }}">
                                        @csrf
                                        {{-- show user details in text --}}
                                        <div class="form-group row" style="margin: 5px 2px 0px 2px;">
                                            {{-- use table without border and head --}}
                                            <table class="table table-borderless table-sm">
                                                <tbody>
                                                    <tr>
                                                        <td class="text-left" style="width: 30%">Nama Lengkap</td>
                                                        <td class="text-left" style="width: 5%">:</td>
                                                        <td class="text-left" style="width: 65%">
                                                            {{ $items->full_name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-left" style="width: 30%">Nama Pengguna</td>
                                                        <td class="text-left" style="width: 5%">:</td>
                                                        <td class="text-left" style="width: 65%">
                                                            {{ $items->username }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-left" style="width: 30%">Role</td>
                                                        <td class="text-left" style="width: 5%">:</td>
                                                        <td class="text-left" style="width: 65%">
                                                            {{ $items->role }}</td>
                                                    </tr>
                                                    {{-- last login --}}
                                                    <tr>
                                                        <td class="text-left" style="width: 30%">Terakhir Login</td>
                                                        <td class="text-left" style="width: 5%">:</td>
                                                        <td class="text-left" style="width: 65%">
                                                            @if ($item->last_login_at != null)
                                                                {{ date('d/m/y H:i', strtotime($items->last_login_at)) }}

                                                                {{-- calculate how many days or time ago --}}
                                                                @php
                                                                    $last_login = $items->last_login_at;
                                                                    $now = date('Y-m-d H:i:s');
                                                                    $diff = strtotime($now) - strtotime($last_login);
                                                                    $days = floor($diff / (60 * 60 * 24));
                                                                    $hours = floor($diff / (60 * 60));
                                                                    $minutes = floor($diff / 60);
                                                                    $seconds = $diff;
                                                                @endphp
                                                                @if ($days > 0)
                                                                    ({{ $days }} hari yang lalu)
                                                                @elseif ($hours > 0)
                                                                    ({{ $hours }} jam yang lalu)
                                                                @elseif ($minutes > 0)
                                                                    ({{ $minutes }} menit yang lalu)
                                                                @else
                                                                    ({{ $seconds }} detik yang lalu)
                                                                @endif
                                                            @else
                                                                -
                                                            @endif

                                                        </td>
                                                    </tr>
                                                    {{-- change password --}}
                                                    <tr>
                                                        <td class="text-left" style="width: 30%">Kata Sandi Baru
                                                        </td>
                                                        <td class="text-left" style="width: 5%">:</td>
                                                        <td class="text-left" style="width: 65%">
                                                            <input name="passwordEdit"
                                                                id="passwordEdit{{ $items->id }}"
                                                                class="form-control form-control-sm" type="text"
                                                                required maxlength="50"
                                                                style="background-color: transparent; color: white;">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>



                                        <div class="form-group  text-right col-sm mt-2">
                                            {{-- Ganti Password --}}
                                            {{-- <button type="button" class="btn btn-danger btn-xs"
                                                id="changePassword_{{ $items->id }}">Ganti
                                                Kata Sandi</button> --}}
                                            {{-- button close --}}
                                            <button type="button" class="btn btn-secondary btn-xs"
                                                data-dismiss="modal">Tutup</button>
                                            {{-- button save --}}
                                            <button class="btn btn-primary btn-xs"
                                                id="simpanPassword_{{ $items->id }}">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach





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

    {{-- lock unlock password  --}}
    <script>
        // on click btn_password 
        $('#btn_password').click(function() {
            // if password type is password
            if ($('#password').attr('type') == 'password') {
                // change to text
                $('#password').attr('type', 'text');
                // change icon to lock
                $('#btn_password').html('<i class="fas fa-lock"></i>');
            } else {
                // change to password
                $('#password').attr('type', 'password');
                // change icon to unlock
                $('#btn_password').html('<i class="fas fa-unlock"></i>');
            }
        });

        // on click btn_confirm_password
        $('#btn_confirm_password').click(function() {
            // if password type is password
            if ($('#confirm_password').attr('type') == 'password') {
                // change to text
                $('#confirm_password').attr('type', 'text');
                // change icon to lock
                $('#btn_confirm_password').html('<i class="fas fa-lock"></i>');
            } else {
                // change to password
                $('#confirm_password').attr('type', 'password');
                // change icon to unlock
                $('#btn_confirm_password').html('<i class="fas fa-unlock"></i>');
            }
        });
    </script>
    <script>
        // fi file image choosen update image box preview
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#preview_tambah_user').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#image").change(function() {
            readURL(this);
        });
    </script>

    <script>
        $(document).on('change', '[id^="image_edit_"]', function(e) {
            e.preventDefault();
            var id = $(this).attr('id').split('_')[2];

            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#preview_edit_' + id).attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]); // convert to base64 string
            }

        });
    </script>
    <script>
        // add new user 
        const full_name = document.getElementById('full_name');
        const username = document.getElementById('username');
        const role = document.getElementById('role');
        const password = document.getElementById('password');
        const confirm_password = document.getElementById('confirm_password');
        const image_url = document.getElementById('image');
        const simpan = document.getElementById('simpan');

        simpan.addEventListener('click', function(e) {
            e.preventDefault();

            // check if password and confirm password is same
            if (password.value != confirm_password.value) {
                alert('Password and Confirm Password is not same');
                return;
            }

            var formData = new FormData();
            // uppercase first letter of full name
            full_name.value = full_name.value.charAt(0).toUpperCase() + full_name.value.slice(1);
            formData.append('full_name', full_name.value);
            formData.append('username', username.value);
            formData.append('role', role.value);
            formData.append('password', password.value);
            formData.append('photo', image_url.files[0]);
            formData.append('requestorUsername', '{{ session()->get('username') }}');
            formData.append('Authorization', 'Bearer ' + '{{ session()->get('tokenJwt') }}');
            for (var pair of formData.entries()) {
                console.log(pair[0] + ', ' + pair[1]);
            }

            $.ajax({
                url: '/api/users',
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
                        text: 'Data berhasil dibuat',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // destroy jwt token
                            sessionStorage.removeItem('tokenJwt');
                            // reload page without # 
                            window.location.href = window.location.href.split('#')[0];


                        }
                    });

                },
                error: function(data) {
                    // swallfire
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Data gagal dibuat',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // reload page

                        }
                    });
                }
            });



        });




        // if id="delete" button clicked delete data show confirmation dialog
        $(document).on('click', '#delete_user', function() {

            var currentRow = $(this).closest("tr");
            var full_name = currentRow.find("td:eq(1)").text();
            var nama = currentRow.find("td:eq(2)").text();
            var role = currentRow.find("td:eq(3)").text();
            // get id
            var id = currentRow.find("td:eq(6)").text();
            // swall.fire yes no dialog
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Anda akan menghapus data " + full_name + " - " + nama + " - " + role,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // delete data to database
                    var myJson = {
                        requestorUsername: '{{ session()->get('username') }}',
                    };
                    var myJsonString = JSON.stringify(myJson);

                    console.log(myJsonString);
                    const xhr = new XMLHttpRequest();
                    // delete based on id
                    xhr.open('DELETE', '/api/users/' + id);
                    xhr.setRequestHeader("Authorization", "Bearer " +
                        '{{ session()->get('tokenJwt') }}');
                    xhr.setRequestHeader("Content-Type", "application/json");
                    xhr.send(myJsonString);
                    xhr.onload = function() {
                        if (xhr.status != 200) {
                            // swallfire 
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'Data gagal dihapus',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // reload page

                                }
                            });
                        } else {

                            const response = JSON.parse(xhr.response);
                            // swallfire 
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Data berhasil dihapus',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // reload page
                                    window.location.href = window.location.href.split('#')[0];
                                }
                            });
                        }
                    };
                }
            });




        });

        // find element start with simpan_
        $(document).on('click', '[id^="simpan_"]', function(e) {
            e.preventDefault();
            console.log('Edit User Profile');
            // get id
            var id = $(this).attr('id').split('_')[1];
            // get value
            var full_name = $('#full_name_edit_' + id);
            var username = $('#username_edit_' + id);
            var role = $('#role_edit_' + id);

            var image_url = $('#image_edit_' + id);
            var formData = new FormData();
            // set data
            formData.append('full_name', full_name.val());
            formData.append('username', username.val());
            formData.append('role', role.val());
            formData.append('photo', image_url[0].files[0]);
            formData.append('requestorUsername', '{{ session()->get('username') }}')
            // set authorization bearer token
            formData.append('Authorization', 'Bearer ' + '{{ session()->get('tokenJwt') }}');
            // formData.append('_token', '{{ csrf_token() }}');
            for (var pair of formData.entries()) {
                console.log(pair[0] + ', ' + pair[1]);
            }

            // send Data to database
            $.ajax({
                url: '/api/edit_profile/' + id,
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

        $(document).on('click', '[id^="simpanPassword_"]', function(e) {
            e.preventDefault();
            console.log('Edit User Password');
            // get id
            var id = $(this).attr('id').split('_')[1];
            // get value
            var password = $('#passwordEdit' + id);
            var myJsonString = JSON.stringify({
                password: password.val(),
                requestorUsername: '{{ session()->get('username') }}'
            });
            console.log(myJsonString);
            const xhr = new XMLHttpRequest();
            xhr.open('PUT', '/api/edit_profile/password/' + id);
            xhr.setRequestHeader("Authorization", "Bearer " +
                '{{ session()->get('tokenJwt') }}');
            xhr.setRequestHeader("Content-Type", "application/json");
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
                        $('#form_change_password_' + id)[0].reset();
                        // hide modal
                        $('#modal_change_password_' + id).modal('hide');

                    });
                    // hide modal

                }


            };

        });
    </script>
@endpush
