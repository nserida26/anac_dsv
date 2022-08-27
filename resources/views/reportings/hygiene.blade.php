@extends('layouts.master')

@push('plugin-styles')
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/charts/apexcharts.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css">
@endpush
@push('custom-styles')
<link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/pickers/form-flat-pickr.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/charts/chart-apex.css">
@endpush
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Reporting</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Column Search -->
                <section id="column-search-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-datatable">
                                    <table class="dt-column-search table table-responsive">
                                        <thead>
                                            <tr>
                                                <th>Description</th>
                                                <th>Type</th>
                                                <th>Béneficiares</th>
                                                <th>Intervenant</th>
                                                
                                                <th>Projet</th>
                                                <th>Date de début</th>
                                                <th>Date de fin</th>
                                                <th>SF</th>
                                                
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Description</th>
                                                <th>Type</th>
                                                <th>Béneficiares</th>
                                                <th>Intervenant</th>
                                                
                                                <th>Projet</th>
                                                <th>Date de début</th>
                                                <th>Date de fin</th>
                                                <th>SF</th>

                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!--<div class="col-lg-12 col-12" id="apexchart">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Average Skills</h4>
                                </div>
                                <div class="card-body">
                                    <canvas class="polar-area-chart-ex chartjs" data-height="350"></canvas>
                                </div>
                            </div>
                        </div>-->
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->

@endsection
@push('plugin-js')
    <!-- BEGIN: Vendor JS
    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>-->
    <!-- BEGIN Vendor JS-->
    <!-- BEGIN: Page Vendor JS
    <script src="../../../app-assets/vendors/js/charts/chart.min.js"></script>-->
    <script src="../../../app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
    <!-- END: Page Vendor JS-->
    <script src="../../../app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/responsive.bootstrap5.js"></script>
@endpush
@push('custom-js')
    <!-- BEGIN: Page JS-->    
    <!-- BEGIN: Theme JS
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>-->
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
            })

            
            $(function () {

                var dt_filter_table = $('.dt-column-search');
                if (dt_filter_table.length) {
                // Setup - add a text input to each footer cell
                $('.dt-column-search thead tr').clone(true).appendTo('.dt-column-search thead');
                $('.dt-column-search thead tr:eq(1) th').each(function (i) {
                    var title = $(this).text();
                    $(this).html('<input type="text" class="form-control form-control-sm" placeholder="Search ' + title + '" />');

                    $('input', this).on('keyup change', function () {
                    if (dt_filter.column(i).search() !== this.value) {
                        dt_filter.column(i).search(this.value).draw();
                    }
                    });
                }); 
                var dt_filter = dt_filter_table.DataTable({
                    ajax: '{{ route('reportings.gethygienes') }}', 
                    columns: [
                        { data: 'description'},
                        { data: 'type'},
                        { data: 'effectif'},
                        { data: 'intervenant' },
                        
                        { data: 'projet'},
                        { data: 'date_debut'},
                        { data: 'date_fin'},
                        { data: 'bayeur' },
                    
                    ],
                    dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                    orderCellsTop: true,
                    language: {
                    paginate: {
                        // remove previous & next text from pagination
                        previous: '&nbsp;',
                        next: '&nbsp;'
                    }
                    }
                });
                }
                // on key up from input field
                $('input.dt-input').on('keyup', function () {
                filterColumn($(this).attr('data-column'), $(this).val());
                });
                // Filter form control to default size for all tables
                $('.dataTables_filter .form-control').removeClass('form-control-sm');
                $('.dataTables_length .form-select').removeClass('form-select-sm').removeClass('form-control-sm');
                });
        </script>
@endpush
