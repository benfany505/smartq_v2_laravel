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
@endpush

@section('content')
    <div class="container-fluid">

        <div class="row ">
            <div class="col-sm-8" style="color: white">
                <div class="contentHeader">
                    <div class="title-header">
                        <i class="fas fa-building pr-2"></i>
                        Clients
                    </div>




                    <button class="title-button"><i class="fas fa-plus pr-2"></i>Add Client</button>


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
            <div class="col-sm-4" style="color: white">
                <div class="contentHeader">
                    <div class="title-header">
                        <i class="fas fa-chart-pie pr-2"></i>
                        Income 2022
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12" style="color: white">
                <div class="contentHeader">
                    <div class="title-header">
                        <i class="fas fa-history pr-2"></i>
                        Recent Activity
                    </div>
                </div>
                {{-- create table with header name "a, B, c D", random text --}}
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">A</th>
                                <th scope="col">B</th>
                                <th scope="col">C</th>
                                <th scope="col">D</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>@twitter</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--
                                                                                                                                                                                                                                                                                                                                                                                                            <div class="col-sm-8">
                                                                                                                                                                                                                                                                                                                                                                                                                <div class="row">
                                                                                                                                                                                                                                                                                                                                                                                                                    <div class="mycard">
                                                                                                                                                                                                                                                                                                                                                                                                                        <div class="mycard-image"></div>
                                                                                                                                                                                                                                                                                                                                                                                                                        <div class="mycard-text">

                                                                                                                                                                                                                                                                                                                                                                                                                            <h5>PT. Pertamina Hulu Rokan</h5>
                                                                                                                                                                                                                                                                                                                                                                                                                            <p>
                                                                                                                                                                                                                                                                                                                                                                                                                                17, Jl. Prof. DR. Satrio No.30, RW.4,
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
                                                                                                                                                                                                                                                                                                                                                                                                                    <div class="mycard">
                                                                                                                                                                                                                                                                                                                                                                                                                        <div class="mycard-image"></div>
                                                                                                                                                                                                                                                                                                                                                                                                                        <div class="mycard-text">

                                                                                                                                                                                                                                                                                                                                                                                                                            <h5>PT. Pertamina Hulu Rokan Pertamina Hulu Rokan</h5>
                                                                                                                                                                                                                                                                                                                                                                                                                            <p>
                                                                                                                                                                                                                                                                                                                                                                                                                                17, Jl. Prof. DR. Satrio No.30, RW.4, Kuningan, Karet Kuningan, Kota Jakarta Selatan, 12940
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
                                                                                                                                                                                                                                                                                                                                                                                                                    <div class="mycard">
                                                                                                                                                                                                                                                                                                                                                                                                                        <div class="mycard-image"></div>
                                                                                                                                                                                                                                                                                                                                                                                                                        <div class="mycard-text">

                                                                                                                                                                                                                                                                                                                                                                                                                            <h5>PT. Pertamina Hulu Rokan Pertamina Hulu Rokan</h5>
                                                                                                                                                                                                                                                                                                                                                                                                                            <p>
                                                                                                                                                                                                                                                                                                                                                                                                                                17, Jl. Prof. DR. Satrio No.30, RW.4, Kuningan, Karet Kuningan, Kota Jakarta Selatan, 12940
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

                                                                                                                                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                                                                                                                            -->


    </div><!-- /.container-fluid -->

@endsection

@push('custom-js')
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
@endpush
