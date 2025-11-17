<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KneeCovery - Graphs</title>

    <!-- Meta -->
    <meta name="description" content="Patient Graphs and Analytics">
    <meta property="og:title" content="KneeCovery - Graphs">
    <meta property="og:description" content="View patient progress graphs">
    <meta property="og:type" content="Website">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}">

    @vite([
        'resources/css/main.css',
        'resources/css/daterange.css',
        'resources/css/overlayScrollbars.css',
        'resources/css/remixicon.css',
        'resources/js/app.js',
        'resources/js/vendor.js'
    ])

    @vite(['resources/js/graphs.js'])

</head>

<body>

<!-- Page wrapper starts -->
<div class="page-wrapper">

    <!-- Main container starts -->
    <div class="main-container">

        <!-- Sidebar Component -->
        <x-sidebar userName="{{ $userName ?? 'John Doe' }}" userRole="{{ $userRole ?? 'Patient' }}"/>

        <!-- App container starts -->
        <div class="app-container">

            <!-- Header Component -->
            <x-header/>

            <!-- App hero header starts -->
            <div class="app-hero-header d-flex align-items-center">

                <!-- Breadcrumb starts -->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/homepage') }}">
                            <i class="ri-home-3-line"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item text-primary" aria-current="page">
                        Graphs
                    </li>
                </ol>
                <!-- Breadcrumb ends -->

                <!-- Sales stats starts -->
                <div class="ms-auto d-lg-flex d-none flex-row">
                    <div class="input-group">
                        <span class="input-group-text bg-primary-lighten">
                            <i class="ri-calendar-2-line text-primary"></i>
                        </span>
                        <input type="text" id="abc" class="form-control custom-daterange">
                    </div>
                </div>
                <!-- Sales stats ends -->

            </div>
            <!-- App Hero header ends -->

            <!-- App body starts -->
            <div class="app-body">

                <!-- Row start -->
                <div class="row gx-4">
                    <div class="col-xl-6 col-lg-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title">Gauge</h5>
                            </div>
                            <div class="card-body">
                                <div class="chart-height">
                                    <div id="gauge" class="auto-align-graph"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title">Radial</h5>
                            </div>
                            <div class="card-body">
                                <div class="chart-height">
                                    <div id="radial" class="auto-align-graph"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title">Funnel</h5>
                            </div>
                            <div class="card-body">
                                <div class="chart-height-xl">
                                    <div id="funnel" class="auto-align-graph"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title">Pyramid</h5>
                            </div>
                            <div class="card-body">
                                <div class="chart-height-xl">
                                    <div id="pyramid" class="auto-align-graph"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title">Donut</h5>
                            </div>
                            <div class="card-body">
                                <div class="chart-height">
                                    <div id="donut" class="auto-align-graph"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title">Pie</h5>
                            </div>
                            <div class="card-body">
                                <div class="chart-height">
                                    <div id="pie" class="auto-align-graph"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-6 col-xl-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title">CandleStick</h5>
                            </div>
                            <div class="card-body">
                                <div class="chart-height-xl">
                                    <div id="candleStick"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-6 col-xl-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title">Area Graph</h5>
                            </div>
                            <div class="card-body">
                                <div class="chart-height-xl">
                                    <div id="areaGraph"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-6 col-xl-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title">Line Graph</h5>
                            </div>
                            <div class="card-body">
                                <div class="chart-height-xl">
                                    <div id="lineGraph"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-6 col-xl-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title">Bar Graph</h5>
                            </div>
                            <div class="card-body">
                                <div class="chart-height-xl">
                                    <div id="barGraph"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-6 col-xl-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title">Column Area Graph</h5>
                            </div>
                            <div class="card-body">
                                <div class="chart-height-xl">
                                    <div id="columnArea"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-6 col-xl-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title">Heatmap</h5>
                            </div>
                            <div class="card-body">
                                <div class="chart-height-xl">
                                    <div id="heatmap"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row end -->

            </div>
            <!-- App body ends -->

            <!-- App footer starts -->
            <div class="app-footer">
                <span>© KneeCovery 2025</span>
            </div>
            <!-- App footer ends -->

        </div>
        <!-- App container ends -->

    </div>
    <!-- Main container ends -->

</div>
<!-- Page wrapper ends -->

</body>

</html>
