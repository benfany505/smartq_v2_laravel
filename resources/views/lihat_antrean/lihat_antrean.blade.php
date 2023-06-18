@extends('layouts.master')
@section('title', 'ETN | Invoice')
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
    {{-- Custom CSS --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/ben.css') }}"> --}}

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


        <div class="row ">
            <div class="col-sm-4" style="color: white">
                <div class="contentHeader">
                    <div class="title-header">
                        <i class="fas fa-volume-up pr-2"></i>
                        Proses Pemanggilan
                    </div>
                </div>
                <div class="col-sm" style="color: white;">
                    <div class="mycard light-green">

                        <div class="mycard-text">

                            <h5>LOKET : 1 PENDAFTARAN UMUM</h5>
                            <hr>
                            <p class="text-center mt-2" style="font-size: 40px">A001</p>

                        </div>
                        <div class="mycard-stats">
                            <div class="stat">
                                <div class="value">10</div>
                                <div class="type">Quot</div>
                            </div>
                            <div class="stat vborder">
                                <div class="value">4</div>
                                <div class="type">Invoice</div>
                            </div>
                            <div class="stat">
                                <div class="value">3</div>
                                <div class="type">Payment</div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-sm-8" style="color: white">
                <div class="contentHeader">
                    <div class="title-header">
                        <i class="fas fa-user pr-2"></i>
                        Loket
                    </div>


                    {{-- <button class="title-button"><i class="fas fa-plus pr-2"></i>Add Client</button> --}}

                </div>
                <div class="row">
                    <div class="col-sm-3" style="color: white;">
                        <div class="mycard light-red">

                            <div class="mycard-text">

                                <h5>PT Minyak Bumi Mahals </h5>
                                <hr>
                                <p>
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid ullam repellat
                                    sunt provident magni iste quibusdam. Dolorum distinctio atque, itaque unde nisi,
                                    ex, amet dolore veniam molestiae molestias perspiciatis blanditiis.
                                </p>

                            </div>
                            <div class="mycard-stats">
                                <div class="stat">
                                    <div class="value">10</div>
                                    <div class="type">Quot</div>
                                </div>
                                <div class="stat vborder">
                                    <div class="value">4</div>
                                    <div class="type">Invoice</div>
                                </div>
                                <div class="stat">
                                    <div class="value">3</div>
                                    <div class="type">Payment</div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-3" style="color: white;">
                        <div class="mycard light-blue">

                            <div class="mycard-text">

                                <h5>PT Minyak Murah Tapi Curah</h5>
                                <hr>
                                <p>
                                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eum ipsam ratione
                                    repudiandae. Pariatur praesentium unde obcaecati a, deserunt et voluptate
                                    adipisci porro excepturi, saepe iure magni laboriosam, voluptatem molestias!
                                    Voluptas?
                                </p>

                            </div>
                            <div class="mycard-stats">
                                <div class="stat">
                                    <div class="value">10</div>
                                    <div class="type">Quot</div>
                                </div>
                                <div class="stat vborder">
                                    <div class="value">4</div>
                                    <div class="type">Invoice</div>
                                </div>
                                <div class="stat">
                                    <div class="value">3</div>
                                    <div class="type">Payment</div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-3" style="color: white;">
                        <div class="mycard light-green">

                            <div class="mycard-text">

                                <h5>PT Minyak Gratis Tapi Boong</h5>
                                <hr>
                                <p>
                                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eius fugiat
                                    consequatur dolorem provident architecto exercitationem, libero consequuntur
                                    molestiae amet a placeat veritatis alias quaerat molestias laudantium
                                    perferendis sint ea voluptates.
                                </p>

                            </div>
                            <div class="mycard-stats">
                                <div class="stat">
                                    <div class="value">10</div>
                                    <div class="type">Quot</div>
                                </div>
                                <div class="stat vborder">
                                    <div class="value">4</div>
                                    <div class="type">Invoice</div>
                                </div>
                                <div class="stat">
                                    <div class="value">3</div>
                                    <div class="type">Payment</div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-3" style="color: white;">
                        <div class="mycard light-brown">

                            <div class="mycard-text">

                                <h5>PT Minyak Angin Ribut</h5>
                                <hr>
                                <p>
                                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Similique amet quos
                                    neque iure? Voluptate maxime, assumenda rerum, dicta, sint illo mollitia totam
                                    hic recusandae iusto sed! Expedita magni ratione quod?
                                </p>

                            </div>
                            <div class="mycard-stats">
                                <div class="stat">
                                    <div class="value">10</div>
                                    <div class="type">Quot</div>
                                </div>
                                <div class="stat vborder">
                                    <div class="value">4</div>
                                    <div class="type">Invoice</div>
                                </div>
                                <div class="stat">
                                    <div class="value">3</div>
                                    <div class="type">Payment</div>
                                </div>
                            </div>

                        </div>
                    </div>
                    {{-- <div class="col-sm-4" style="color: white;">
                            <div class="mycard light-brown">
    
                                <div class="mycard-text">
    
                                    <h5>PT. Pertamina Hulu Rokan</h5>
                                    <hr>
                                    <p>
                                        17, Jl. Prof. DR. Satrio No.30, RW.4, Kuningan, Karet Kuningan, Kota Jakarta
                                        Selatan, 12940 Selatan, 12940
                                    </p>
    
                                </div>
                                <div class="mycard-stats">
                                    <div class="stat">
                                        <div class="value">10</div>
                                        <div class="type">Quot</div>
                                    </div>
                                    <div class="stat">
                                        <div class="value">4</div>
                                        <div class="type">Invoice</div>
                                    </div>
                                    <div class="stat">
                                        <div class="value">3</div>
                                        <div class="type">Payment</div>
                                    </div>
                                </div>
    
                            </div>
                        </div> --}}


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


    <script>
        FilePond.registerPlugin(
            FilePondPluginImageCrop,
            FilePondPluginImagePreview,
            FilePondPluginImageResize,
            FilePondPluginImageTransform,
            FilePondPluginImageEdit,
            FilePondPluginFileValidateType
        );
        // Get a reference to the file input element
        const inputElement = document.querySelector('input[id="image"]');


        // Create a FilePond instance
        const pond = FilePond.create(inputElement, {
            credits: {
                url: "",
                label: ""
            },
            labelIdle: 'Drag & Drop your Image or <span class="filepond--label-action"> Browse </span>',
            acceptedFileTypes: ['image/png', 'image/jpeg', ],
            labelFileTypeNotAllowed: 'Only Images are allowed',
            fileValidateTypeDetectType: (source, type) =>
                new Promise((resolve, reject) => {
                    // Do custom type detection here and return with promise

                    resolve(type);
                }),
            // add the Image Crop default aspect ratio
            imageCropAspectRatio: 1,
            imageResizeTargetWidth: 256,
            imageResizeMode: 'contain',
            imageTransformVariants: {
                thumb_medium_: transforms => {
                    transforms.resize.size.width = 512;

                    // this will be a landscape crop
                    transforms.crop.aspectRatio = .5;

                    return transforms;
                },
                thumb_small_: transforms => {
                    transforms.resize.size.width = 128;
                    return transforms;
                }
            },
            onaddfile: (err, fileItem) => {
                console.log(err, fileItem.getMetadata('resize'));
            },
            onpreparefile: (fileItem, outputFiles) => {
                outputFiles.forEach(output => {
                    const img = new Image();
                    img.src = URL.createObjectURL(output.file);
                    // document.body.appendChild(img);
                })
            }


        });

        FilePond.setOptions({
            server: {
                process: '/uploadImage',
                revert: '/deleteImage',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
        });
    </script>
@endpush
