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
                    <div class="title-header">
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
                                    <option style="background-color: #222F3E; " value="{{ $item->id }}">
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
                                    <option style="background-color: #222F3E; " value="{{ $item->id }}">
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
                                    <option style="background-color: #222F3E; " value="{{ $item->id }}">
                                        {{ $item->nomor }}. {{ $item->nama }}</option>
                                @endforeach
                            </Select>
                        </div>
                    </div>

                    {{-- check box transfer based on $loket and select all check box --}}




                    <div class="form-group  text-right col-sm mt-2">
                        <button class="btn btn-primary btn-xs" id="simpan">Tambahkan</button>
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
    {{-- <script>
        $(document).ready(function() {
            $("#pilihan_transfer").CreateMultiCheckBox({
                width: '230px',
                defaultText: 'Select Below',
                height: '250px'
            });
        });
        $(document).ready(function() {
            $(document).on("click", ".MultiCheckBox", function() {
                var detail = $(this).next();
                detail.show();
            });

            $(document).on("click", ".MultiCheckBoxDetailHeader input", function(e) {
                e.stopPropagation();
                var hc = $(this).prop("checked");
                $(this).closest(".MultiCheckBoxDetail").find(".MultiCheckBoxDetailBody input").prop(
                    "checked", hc);
                $(this).closest(".MultiCheckBoxDetail").next().UpdateSelect();
            });

            $(document).on("click", ".MultiCheckBoxDetailHeader", function(e) {
                var inp = $(this).find("input");
                var chk = inp.prop("checked");
                inp.prop("checked", !chk);
                $(this).closest(".MultiCheckBoxDetail").find(".MultiCheckBoxDetailBody input").prop(
                    "checked", !chk);
                $(this).closest(".MultiCheckBoxDetail").next().UpdateSelect();
            });

            $(document).on("click", ".MultiCheckBoxDetail .cont input", function(e) {
                e.stopPropagation();
                $(this).closest(".MultiCheckBoxDetail").next().UpdateSelect();

                var val = ($(".MultiCheckBoxDetailBody input:checked").length == $(
                    ".MultiCheckBoxDetailBody input").length)
                $(".MultiCheckBoxDetailHeader input").prop("checked", val);
            });

            $(document).on("click", ".MultiCheckBoxDetail .cont", function(e) {
                var inp = $(this).find("input");
                var chk = inp.prop("checked");
                inp.prop("checked", !chk);

                var multiCheckBoxDetail = $(this).closest(".MultiCheckBoxDetail");
                var multiCheckBoxDetailBody = $(this).closest(".MultiCheckBoxDetailBody");
                multiCheckBoxDetail.next().UpdateSelect();

                var val = ($(".MultiCheckBoxDetailBody input:checked").length == $(
                    ".MultiCheckBoxDetailBody input").length)
                $(".MultiCheckBoxDetailHeader input").prop("checked", val);
            });

            $(document).mouseup(function(e) {
                var container = $(".MultiCheckBoxDetail");
                if (!container.is(e.target) && container.has(e.target).length === 0) {
                    container.hide();
                }
            });
        });

        var defaultMultiCheckBoxOption = {
            width: '220px',
            defaultText: 'Select Below',
            height: '200px'
        };

        jQuery.fn.extend({
            CreateMultiCheckBox: function(options) {

                var localOption = {};
                localOption.width = (options != null && options.width != null && options.width != undefined) ?
                    options.width : defaultMultiCheckBoxOption.width;
                localOption.defaultText = (options != null && options.defaultText != null && options
                        .defaultText != undefined) ? options.defaultText : defaultMultiCheckBoxOption
                    .defaultText;
                localOption.height = (options != null && options.height != null && options.height !=
                    undefined) ? options.height : defaultMultiCheckBoxOption.height;

                this.hide();
                this.attr("multiple", "multiple");
                var divSel = $("<div class='MultiCheckBox'>" + localOption.defaultText +
                    "<span class='k-icon k-i-arrow-60-down'><svg aria-hidden='true' focusable='false' data-prefix='fas' data-icon='sort-down' role='img' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 320 512' class='svg-inline--fa fa-sort-down fa-w-10 fa-2x'><path fill='currentColor' d='M41 288h238c21.4 0 32.1 25.9 17 41L177 448c-9.4 9.4-24.6 9.4-33.9 0L24 329c-15.1-15.1-4.4-41 17-41z' class=''></path></svg></span></div>"
                ).insertBefore(this);
                divSel.css({
                    "width": localOption.width
                });

                var detail = $(
                    "<div class='MultiCheckBoxDetail'><div class='MultiCheckBoxDetailHeader'><input type='checkbox' class='mulinput' value='-1982' /><div>Select All</div></div><div class='MultiCheckBoxDetailBody'></div></div>"
                ).insertAfter(divSel);
                detail.css({
                    "width": parseInt(options.width) + 10,
                    "max-height": localOption.height
                });
                var multiCheckBoxDetailBody = detail.find(".MultiCheckBoxDetailBody");

                this.find("option").each(function() {
                    var val = $(this).attr("value");

                    if (val == undefined)
                        val = '';

                    multiCheckBoxDetailBody.append(
                        "<div class='cont'><div><input type='checkbox' class='mulinput' value='" +
                        val + "' /></div><div>" + $(this).text() + "</div></div>");
                });

                multiCheckBoxDetailBody.css("max-height", (parseInt($(".MultiCheckBoxDetail").css(
                    "max-height")) - 28) + "px");
            },
            UpdateSelect: function() {
                var arr = [];

                this.prev().find(".mulinput:checked").each(function() {
                    arr.push($(this).val());
                });

                this.val(arr);
            },
        });
    </script> --}}

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
            if (value == 1) {
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
@endpush
