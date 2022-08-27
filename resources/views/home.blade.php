@extends('layouts.master')
@push('plugin-styles')
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/charts/apexcharts.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/extensions/toastr.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">

@endpush
@push('custom-styles')
<link rel="stylesheet" type="text/css" href="/app-assets/css/pages/dashboard-ecommerce.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/charts/chart-apex.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/extensions/ext-component-toastr.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/pickers/form-flat-pickr.css">
@endpush

@section('content')
<!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Dashboard Ecommerce Starts -->
                <section id="dashboard-ecommerce">
                    <div class="row match-height">
                        <!-- Medal Card -->
                        <!--/ Medal Card -->

                        <!-- Statistics Card -->
                        <div class="col-xl-12 col-md-12 col-12">
                            <div class="card card-statistics">
                                <div class="card-body statistics-body">
                                    <div class="row">
                                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                            <div class="d-flex flex-row">
                                                <div class="avatar bg-light-info me-2">
                                                    <div class="avatar-content">
                                                        <i data-feather="user" class="avatar-icon"></i>
                                                    </div>
                                                </div>
                                                <div class="my-auto">
                                                    <h4 class="fw-bolder mb-0">NaN</h4>
                                                    <p class="card-text font-small-3 mb-0">Taux  de financement réalisé par financement prévu</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                                            <div class="d-flex flex-row">
                                                <div class="avatar bg-light-danger me-2">
                                                    <div class="avatar-content">
                                                        <i data-feather="box" class="avatar-icon"></i>
                                                    </div>
                                                </div>
                                                <div class="my-auto">
                                                    <h4 class="fw-bolder mb-0">{{$total_projets}}</h4>
                                                    <p class="card-text font-small-3 mb-0">Nombre des projets adaptés au thème</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                                            <div class="d-flex flex-row">
                                                <div class="avatar bg-light-danger me-2">
                                                    <div class="avatar-content">
                                                        <i data-feather="box" class="avatar-icon"></i>
                                                    </div>
                                                </div>
                                                <div class="my-auto">
                                                    <h4 class="fw-bolder mb-0">{{$total_hygienes}}</h4>
                                                    <p class="card-text font-small-3 mb-0">Nombre de séance de sensibilisation</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Statistics Card -->
                        <!-- Statistics Card -->
                        <div class="col-xl-12 col-md-12 col-12">
                            <div class="card card-statistics">
                                <div class="card-body statistics-body">
                                    <div class="row">
                                        <div class="col-xl-4 col-sm-6 col-12 mb-2 mb-xl-0">
                                            <div class="d-flex flex-row">
                                                <div class="avatar bg-light-primary me-2">
                                                    <div class="avatar-content">
                                                        <i data-feather="trending-up" class="avatar-icon"></i>
                                                    </div>
                                                </div>
                                                <div class="my-auto">
                                                    <h4 class="fw-bolder mb-0">{{$total_intervenants}}</h4>
                                                    <p class="card-text font-small-3 mb-0">Nombre des Sources de finances</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-sm-6 col-12 mb-2 mb-xl-0">
                                            <div class="d-flex flex-row">
                                                <div class="avatar bg-light-info me-2">
                                                    <div class="avatar-content">
                                                        <i data-feather="user" class="avatar-icon"></i>
                                                    </div>
                                                </div>
                                                <div class="my-auto">
                                                    <h4 class="fw-bolder mb-0">{{$total_intervenants}}</h4>
                                                    <p class="card-text font-small-3 mb-0">Nombre des Structures d’Execution</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-sm-6 col-12 mb-2 mb-sm-0">
                                            <div class="d-flex flex-row">
                                                <div class="avatar bg-light-danger me-2">
                                                    <div class="avatar-content">
                                                        <i data-feather="box" class="avatar-icon"></i>
                                                    </div>
                                                </div>
                                                <div class="my-auto">
                                                    <h4 class="fw-bolder mb-0">{{$total_interventions}}</h4>
                                                    <p class="card-text font-small-3 mb-0">Nombre des Interventions</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Statistics Card -->
                    </div>

                    <div class="row match-height">
                        <div class="col-lg-12 col-12">
                            <div class="row match-height">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!--Bar Chart Start -->
                        <div class="col-xl-12 col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                                    <div class="header-left">
                                        <h4 class="card-title">Nombre de projets initiés par secteur</h4>
                                    </div>
                                    <!--<div class="header-right d-flex align-items-center mt-sm-0 mt-1">
                                        <i data-feather="calendar"></i>
                                        <input type="text" class="form-control flat-picker border-0 shadow-none bg-transparent pe-0" placeholder="YYYY-MM-DD" />
                                    </div>-->
                                </div>
                                <div class="card-body">
                                    <canvas class="barpSecteur chartjs" data-height="400"></canvas>
                                </div>
                            </div>
                        </div>
                        <!-- Bar Chart End -->
                        <!--Bar Chart Start -->
                        <div class="col-xl-12 col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                                    <div class="header-left">
                                        <h4 class="card-title">Nombre des projets initiés par zone</h4>
                                    </div>
                                    <div class="header-right d-flex align-items-center mt-sm-0 mt-1">
                                        <div class="btn-group mt-md-0 mt-1" role="group" aria-label="Basic radio toggle button group">
                                            <input type="radio" class="btn-check" name="radio_options" id="radio_projet_commune" autocomplete="off" />
                                            <label class="btn btn-outline-primary" for="radio_projet_commune">Commune</label>
    
                                            <input type="radio" class="btn-check" name="radio_options" id="radio_projet_localite" autocomplete="off" />
                                            <label class="btn btn-outline-primary" for="radio_projet_localite">Localité</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <canvas class="bproZone chartjs" data-height="400"></canvas>
                                </div>
                            </div>
                        </div>
                        <!-- Bar Chart End -->
        
                        <!-- Polar Area Chart Starts -->
                        <div class="col-lg-12 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Nombre de bénéficiares financés par secteur</h4>
                                </div>
                                <div class="card-body">
                                    <canvas class="bSecteur chartjs" data-height="400"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                                    <div class="header-left">
                                        
                                        <h4 class="card-title">Nombre de bénéficiares financés par zone                                        </h4>
                                    </div>
                                    <div class="header-right d-flex align-items-center mt-sm-0 mt-1">
                                        <div class="btn-group mt-md-0 mt-1" role="group" aria-label="Basic radio toggle button group">
                                            <input type="radio" class="btn-check" name="radio_options" id="radio_beneficiare_commune" autocomplete="off" />
                                            <label class="btn btn-outline-primary" for="radio_beneficiare_commune">Commune</label>
    
                                            <input type="radio" class="btn-check" name="radio_options" id="radio_beneficiare_localite" autocomplete="off" />
                                            <label class="btn btn-outline-primary" for="radio_beneficiare_localite">Localité</label>
                                    </div>
                                </div>
                                </div>
                                <div class="card-body">
                                    <canvas class="bZone chartjs" data-height="400"></canvas>
                                </div>
                            </div>
                        </div>
                        <!-- Horizontal Bar Chart End -->
                        <div class="col-lg-12 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Nombre des infrastructures benificiaires par secteur</h4>
                                </div>
                                <div class="card-body">
                                    <canvas id="pinfraSecteur" style=" height: 300px"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Nombre des infrastructures benificiaires par zone</h4>
                                    <div class="header-right d-flex align-items-center mt-sm-0 mt-1">
                                        <div class="btn-group mt-md-0 mt-1" role="group" aria-label="Basic radio toggle button group">
                                            <input type="radio" class="btn-check" name="radio_options" id="radio_infrastructure_commune" autocomplete="off" />
                                            <label class="btn btn-outline-primary" for="radio_infrastructure_commune">Commune</label>
    
                                            <input type="radio" class="btn-check" name="radio_options" id="radio_infrastructure_localite" autocomplete="off" />
                                            <label class="btn btn-outline-primary" for="radio_infrastructure_localite">Localité</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <canvas id="pinfraZone" style="height: 300px"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-12">
                            <div class="card">
                            <div class="
                                    card-header
                                    d-flex
                                    flex-sm-row flex-column
                                    justify-content-md-between
                                    align-items-start
                                    justify-content-start
                                ">
                                    <h4 class="card-title mb-sm-0 mb-1">Répartition des interventions par secteur</h4>
                                </div>
                                <div class="card-body">
                                    <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-12">
                            <div class="card">
                            <div class="
                                    card-header
                                    d-flex
                                    flex-sm-row flex-column
                                    justify-content-md-between
                                    align-items-start
                                    justify-content-start
                                ">
                                    <h4 class="card-title mb-sm-0 mb-1">Répartition des interventions par zone</h4>
                                    <div class="header-right d-flex align-items-center mt-sm-0 mt-1">
                                        <div class="btn-group mt-md-0 mt-1" role="group" aria-label="Basic radio toggle button group">
                                            <input type="radio" class="btn-check" name="radio_options" id="radio_interventions_commune" autocomplete="off" />
                                            <label class="btn btn-outline-primary" for="radio_interventions_commune">Commune</label>
    
                                            <input type="radio" class="btn-check" name="radio_options" id="radio_interventions_localite" autocomplete="off" />
                                            <label class="btn btn-outline-primary" for="radio_interventions_localite">Localité</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                        </div>
                        <!-- Donut Chart Ends-->
                        <!-- Apex charts section end -->
                    </div>
                </section>
                <!-- Dashboard Ecommerce ends -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
@push('plugin-js')
    <!-- BEGIN: Vendor JS
    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>-->
    <!-- BEGIN Vendor JS-->
    <!-- BEGIN: Page Vendor JS-->
    <script src="/app-assets/vendors/js/charts/apexcharts.min.js"></script>
    <script src="/app-assets/vendors/js/extensions/toastr.min.js"></script>
    <!-- END: Page Vendor JS-->
    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../app-assets/vendors/js/charts/chart.min.js"></script>
    <script src="../../../app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
    <!-- END: Page Vendor JS-->
@endpush
@push('custom-js')
    <!-- BEGIN: Page JS Répartition des interventions 
    <script src="/app-assets/js/scripts/pages/dashboard-ecommerce.js"></script>-->
    <!-- END: Page JS-->
    <!-- BEGIN: Page JS
    <script src="/app-assets/js/scripts/charts/chart-apex.js"></script>-->
    <!-- END: Page JS-->
    <!-- BEGIN: Page JS-->    
    <!-- BEGIN: Theme JS
    <script src="/app-assets/js/core/app-menu.js"></script>
    <script src="/app-assets/js/core/app.js"></script>-->
    <!-- END: Theme JS-->
    
    <!-- BEGIN: Page JS
    <script src="../../../app-assets/js/scripts/charts/chart-chartjs.js"></script>-->
    <!-- END: Page JS-->
    <script>
        $(window).on('load', function() {
                if (feather) {
                    feather.replace({
                        width: 14,
                        height: 14
                    });
                }
        });
        
        $(window).on('load', function () {
        'use strict';

        function max_array(arr) {
            var max_array = 0;
            for (let index = 0; index < arr.length; index++) {
                if (arr[index] >= max_array) {
                    max_array = arr[index];
                }
            }
            return max_array;
        }
        var projets_chart = {!! json_encode($projets_chart,JSON_HEX_TAG) !!}
        var projets_zone_chart = {!! json_encode($projets_zone_chart,JSON_HEX_TAG) !!}
        var beneficiare_chart = {!! json_encode($beneficiare_chart,JSON_HEX_TAG) !!}
        var infrastructure_chart = {!! json_encode($infrastructure_chart,JSON_HEX_TAG) !!}
        var intervention_chart = {!! json_encode($intervention_chart,JSON_HEX_TAG) !!}
        
        var projets_chart_key = [];
        var projets_chart_value = [];
        $.each(projets_chart,function(key,value) {
           projets_chart_key.push(key);
           projets_chart_value.push(value);
        });

        var infrastructure_chart_key = [];
        var infrastructure_chart_value = [];
        $.each(infrastructure_chart,function(key,value) {
            infrastructure_chart_key.push(key);
            infrastructure_chart_value.push(value);
        });

        var beneficiare_chart_key = [];
        var beneficiare_chart_value = [];
        $.each(beneficiare_chart,function(key,value) {
            beneficiare_chart_key.push(key);
            beneficiare_chart_value.push(value);
        });
        var intervention_chart_key = [];
        var intervention_chart_value = [];
        $.each(intervention_chart,function(key,value) {
            intervention_chart_key.push(key);
            intervention_chart_value.push(value);
        });

        
        
        var projets_chart_max =  max_array(projets_chart_value);
        var projets_chart_step;
        if (projets_chart_max >= 4) {
            projets_chart_step = projets_chart_max/4;
        }else{
            projets_chart_step = projets_chart_max;
        }
        console.log(projets_zone_chart);
        $('#radio_projet_commune')[0].checked = true;
        $('#radio_beneficiare_commune')[0].checked = true;
        $('#radio_infrastructure_commune')[0].checked = true;
        $('#radio_interventions_commune')[0].checked = true;

        $('#radio_projet_commune').on('change',function() {
            console.log('Commune : ' + $('#radio_projet_commune')[0].checked);
        });
        $('#radio_projet_localite').on('change',function() {
            console.log('Localité : ' + $('#radio_projet_localite')[0].checked);
        });

        
        //console.log($('#radio_projet_localite'));
        
        var primaryColorShade = '#836AF9',
            yellowColor = '#ffe800',
            successColorShade = '#28dac6',
            warningColorShade = '#ffe802',
            warningLightColor = '#FDAC34',
            infoColorShade = '#299AFF',
            greyColor = '#4F5D70',
            blueColor = '#2c9aff',
            blueLightColor = '#84D0FF',
            greyLightColor = '#EDF1F4',
            tooltipShadow = 'rgba(0, 0, 0, 0.25)',
            lineChartPrimary = '#666ee8',
            lineChartDanger = '#ff4961',
            labelColor = '#6e6b7b',
            grid_line_color = 'rgba(200, 200, 200, 0.2)';
            var chartColors = {
                column: {
                    series1: '#826af9',
                    series2: '#d2b0ff',
                    bg: '#f8d3ff'
                },
                success: {
                    shade_100: '#7eefc7',
                    shade_200: '#06774f'
                },
                donut: {
                    series1: '#ffe700',
                    series2: '#00d4bd',
                    series3: '#826bf8',
                    series4: '#2b9bf4',
                    series5: '#FFA1A1'
                },
                area: {
                    series3: '#a4f8cd',
                    series2: '#60f2ca',
                    series1: '#2bdac7'
                }
                };
        var chartWrapper = $('.chartjs'),
        barpSecteur = $('.barpSecteur'),bproZone = $('.bproZone'),bZone = $('.bZone'),bSecteur = $('.bSecteur');
        

        if (barpSecteur.length) {
                    var barChartExample = new Chart(barpSecteur, {
                    type: 'bar',
                    options: {
                        elements: {
                        rectangle: {
                            borderWidth: 2,
                            borderSkipped: 'bottom'
                        }
                        },
                        responsive: true,
                        maintainAspectRatio: false,
                        responsiveAnimationDuration: 500,
                        legend: {
                        display: false
                        },
                        tooltips: {
                        // Updated default tooltip UI
                        shadowOffsetX: 1,
                        shadowOffsetY: 1,
                        shadowBlur: 8,
                        shadowColor: tooltipShadow,
                        backgroundColor: window.colors.solid.white,
                        titleFontColor: window.colors.solid.black,
                        bodyFontColor: window.colors.solid.black
                        },
                        scales: {
                        xAxes: [
                            {
                            display: true,
                            gridLines: {
                                display: true,
                                color: grid_line_color,
                                zeroLineColor: grid_line_color
                            },
                            scaleLabel: {
                                display: false
                            },
                            ticks: {
                                fontColor: labelColor
                            }
                            }
                        ],
                        yAxes: [
                            {
                            display: true,
                            gridLines: {
                                color: grid_line_color,
                                zeroLineColor: grid_line_color
                            },
                            ticks: {
                                stepSize: projets_chart_step,
                                min: 0,
                                max: projets_chart_max,
                                fontColor: labelColor
                            }
                            }
                        ]
                        }
                    },
                    data: {
                        labels: projets_chart_key,
                        datasets: [
                        {
                            data: projets_chart_value,
                            barThickness: 15,
                            backgroundColor: successColorShade,
                            borderColor: 'transparent'
                        }
                        ]
                    }
                    });

                }
                var donutData        = {
                    labels: infrastructure_chart_key,
                    datasets: [
                        {
                        data: infrastructure_chart_value,
                        backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                        }
                    ]
                    }
                var pieChartCanvas = $('#pinfraSecteur').get(0).getContext('2d')
                var pieData        = donutData;
                var pieOptions     = {
                maintainAspectRatio : false,
                responsive : true,
                }
                //Create pie or douhnut chart
                // You can switch between pie and douhnut using the method below.
                new Chart(pieChartCanvas, {
                type: 'pie',
                data: pieData,
                options: pieOptions
                })
                var pieChartCanvas = $('#pinfraZone').get(0).getContext('2d')
                var pieData        = donutData;
                var pieOptions     = {
                maintainAspectRatio : false,
                responsive : true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        new Chart(pieChartCanvas, {
                type: 'pie',
                data: pieData,
                options: pieOptions
        })
        if (bproZone.length) {
                    var barChartExample = new Chart(bproZone, {
                    type: 'bar',
                    options: {
                        elements: {
                        rectangle: {
                            borderWidth: 2,
                            borderSkipped: 'bottom'
                        }
                        },
                        responsive: true,
                        maintainAspectRatio: false,
                        responsiveAnimationDuration: 500,
                        legend: {
                        display: false
                        },
                        tooltips: {
                        // Updated default tooltip UI
                        shadowOffsetX: 1,
                        shadowOffsetY: 1,
                        shadowBlur: 8,
                        shadowColor: tooltipShadow,
                        backgroundColor: window.colors.solid.white,
                        titleFontColor: window.colors.solid.black,
                        bodyFontColor: window.colors.solid.black
                        },
                        scales: {
                        xAxes: [
                            {
                            display: true,
                            gridLines: {
                                display: true,
                                color: grid_line_color,
                                zeroLineColor: grid_line_color
                            },
                            scaleLabel: {
                                display: false
                            },
                            ticks: {
                                fontColor: labelColor
                            }
                            }
                        ],
                        yAxes: [
                            {
                            display: true,
                            gridLines: {
                                color: grid_line_color,
                                zeroLineColor: grid_line_color
                            },
                            ticks: {
                                stepSize: 100,
                                min: 0,
                                max: 400,
                                fontColor: labelColor
                            }
                            }
                        ]
                        }
                    },
                    data: {
                        labels: ['Mosque', 'Ecole', 'Santé', 'Autres'],
                        datasets: [
                        {
                            data: [275, 90, 190, 205],
                            barThickness: 15,
                            backgroundColor: successColorShade,
                            borderColor: 'transparent'
                        }
                        ]
                    }
                    });
                    
        }
        if (bZone.length) {
            new Chart(bZone, {
            type: 'horizontalBar',
            options: {
                elements: {
                rectangle: {
                    borderWidth: 2,
                    borderSkipped: 'right'
                }
                },
                tooltips: {
                // Updated default tooltip UI
                shadowOffsetX: 1,
                shadowOffsetY: 1,
                shadowBlur: 8,
                shadowColor: tooltipShadow,
                backgroundColor: window.colors.solid.white,
                titleFontColor: window.colors.solid.black,
                bodyFontColor: window.colors.solid.black
                },
                responsive: true,
                maintainAspectRatio: false,
                responsiveAnimationDuration: 500,
                legend: {
                display: false
                },
                layout: {
                padding: {
                    bottom: -30,
                    left: -25
                }
                },
                scales: {
                xAxes: [
                    {
                    display: true,
                    gridLines: {
                        zeroLineColor: grid_line_color,
                        borderColor: 'transparent',
                        color: grid_line_color
                    },
                    scaleLabel: {
                        display: true
                    },
                    ticks: {
                        min: 0,
                        fontColor: labelColor
                    }
                    }
                ],
                yAxes: [
                    {
                    display: true,
                    gridLines: {
                        display: false
                    },
                    scaleLabel: {
                        display: true
                    },
                    ticks: {
                        fontColor: labelColor
                    }
                    }
                ]
                }
            },
            data: {
                labels: ['MON', 'TUE', 'WED ', 'THU', 'FRI', 'SAT', 'SUN'],
                datasets: [
                {
                    data: [710, 350, 470, 580, 230, 460, 120],
                    barThickness: 15,
                    backgroundColor: window.colors.solid.info,
                    borderColor: 'transparent'
                }
                ]
            }
            });
        }
        if (bSecteur.length) {
            new Chart(bSecteur, {
            type: 'horizontalBar',
            options: {
                elements: {
                rectangle: {
                    borderWidth: 2,
                    borderSkipped: 'right'
                }
                },
                tooltips: {
                // Updated default tooltip UI
                shadowOffsetX: 1,
                shadowOffsetY: 1,
                shadowBlur: 8,
                shadowColor: tooltipShadow,
                backgroundColor: window.colors.solid.white,
                titleFontColor: window.colors.solid.black,
                bodyFontColor: window.colors.solid.black
                },
                responsive: true,
                maintainAspectRatio: false,
                responsiveAnimationDuration: 500,
                legend: {
                display: false
                },
                layout: {
                padding: {
                    bottom: -30,
                    left: -25
                }
                },
                scales: {
                xAxes: [
                    {
                    display: true,
                    gridLines: {
                        zeroLineColor: grid_line_color,
                        borderColor: 'transparent',
                        color: grid_line_color
                    },
                    scaleLabel: {
                        display: true
                    },
                    ticks: {
                        min: 0,
                        fontColor: labelColor
                    }
                    }
                ],
                yAxes: [
                    {
                    display: true,
                    gridLines: {
                        display: false
                    },
                    scaleLabel: {
                        display: true
                    },
                    ticks: {
                        fontColor: labelColor
                    }
                    }
                ]
                }
            },
            data: {
                labels: beneficiare_chart_key,
                datasets: [
                {
                    data: beneficiare_chart_value,
                    barThickness: 15,
                    backgroundColor: window.colors.solid.info,
                    borderColor: 'transparent'
                }
                ]
            }
            });
        }
        //-------------
        //- DONUT CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
        var donutData        = {
        labels: intervention_chart_key,
        datasets: [
            {
            data: intervention_chart_value,
            backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
            }
        ]
        }
        var donutOptions     = {
        maintainAspectRatio : false,
        responsive : true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        new Chart(donutChartCanvas, {
        type: 'doughnut',
        data: donutData,
        options: donutOptions
        })

        //-------------
        //- PIE CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
        var pieData        = donutData;
        var pieOptions     = {
        maintainAspectRatio : false,
        responsive : true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        new Chart(pieChartCanvas, {
        type: 'doughnut',
        data: pieData,
        options: pieOptions
        })
    });
    </script>
@endpush