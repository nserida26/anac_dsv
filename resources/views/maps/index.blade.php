@extends('layouts.master')
@push('plugin-styles')
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/maps/leaflet.min.css">
@endpush
@push('custom-styles')
<link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/maps/map-leaflet.css">
@endpush
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-body">
                <section class="maps-leaflet" >
                    <div class="row" >
                        <!-- Basic Starts -->
                        <div class="col-12" >
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h4 class="card-title">Carte</h4>
                                </div>
                                <div class="card-body" >
                                    <div class="leaflet-map" id="basic-map" style="height: 1000px"></div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- /Basic Ends -->

                        <!--
                        <div class="col-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h4 class="card-title">Marker Circle & Polygon</h4>
                                </div>
                                <div class="card-body">
                                    <div class="leaflet-map" id="shape-map"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h4 class="card-title">Draggable Marker With Popup</h4>
                                </div>
                                <div class="card-body">
                                    <div class="leaflet-map" id="drag-map"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h4 class="card-title">User Location</h4>
                                </div>
                                <div class="card-body">
                                    <div class="leaflet-map" id="user-location"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h4 class="card-title">Custom Icons</h4>
                                </div>
                                <div class="card-body">
                                    <div class="leaflet-map" id="custom-icons"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h4 class="card-title">GeoJson</h4>
                                </div>
                                <div class="card-body">
                                    <div class="leaflet-map" id="geojson"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Layer Control</h4>
                                </div>
                                <div class="card-body">
                                    <div class="leaflet-map" id="layer-control"></div>
                                </div>
                            </div>
                        </div>
                         /Layer Control Ends -->
                        
                    </div>
                </section>
                <div class="modal fade" id="pricingModal" tabindex="-1" aria-labelledby="pricingModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-transparent">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body px-sm-5 mx-50 pb-5">
                                <div id="pricing-plan">
                                    <!-- title text and switch button -->
                                    <div class="text-center" id="infrastructureTitle">
                                    </div>
                                    <!--/ title text and switch button -->
            
                                    <!-- pricing plan cards -->
                                    <div class="row pricing-card">
            
                                        <!-- standard plan -->
                                        <div class="col-12 col-lg-12">
                                            <div class="card standard-pricing border-primary text-center shadow-none">
                                                <div class="card-body">
                                                   
                                            <div class="custom-options-checkable" id="interventionBody">
                                            </div>
                                
                                                </div>
                                            </div>
                                        </div>
                                        <!--/ standard plan -->
                                    </div>
                                    <!--/ pricing plan cards -->
            
                                    <!-- pricing free trial -->
                                    <!--/ pricing free trial -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('plugin-js')
    <!-- BEGIN: Page Vendor JS-->
    <script src="/app-assets/vendors/js/maps/leaflet.min.js"></script>
    <!-- END: Page Vendor JS-->
@endpush
@push('custom-js')
    
    <!-- BEGIN: Pa ge JS
    <script src="/app-assets/js/scripts/maps/map-leaflet.js"></script>-->
    <script>
        
        /*
            var polygon = L.polygon([
      [23.186, -6.327],
      [17.311, -9.075],
      [17.381, -8.655],
      [16.963, -8.263],
      [16.3932, -8.8921],
      [16.3233, -8.868],
      [16.0607, -9.0167],
      [15.524, -8.944],
      [15.519, -5.422],
      [16.333, -5.367],
      [16.465, -5.674],
      [23.186, -6.327]
    ]).addTo(basicMap);
        */
$(function () {
  'use strict';
    var infrastructures = {!! json_encode($infrastructures,JSON_HEX_TAG) !!};
    if ($('#basic-map').length) {
    var basicMap = L.map('basic-map').setView([17.249, -7.053], 6);
    L.tileLayer('https://{s}.tile.osm.org/{z}/{x}/{y}.png', {
      attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a>',
      maxZoom: 18
    }).addTo(basicMap);
    console.log($('#infrastructureTitle'));
    infrastructures.forEach( element => {
        //console.log(element.longitude);
        //console.log(element.altitude);
        var altitude = element.altitude;
        var longitude = element.longitude;
        L.marker([altitude,longitude]).addTo(basicMap);
        var marker = L.marker([element.altitude ,  element.longitude]);

        marker.addTo(basicMap).on('click',function () {
        $('#infrastructureTitle').html("");
        $('#interventionBody').html("");
        $('#infrastructureTitle').empty();
        $('#interventionBody').empty();

            $.ajax({
                type : 'get',
                url : '/maps/getinfra',
                data : {
                    '_token' : '{{csrf_token()}}',
                    longitude : longitude,
                    altitude : altitude
                },
                success : function(res) {
                    console.log(res);
                    $.each(res,function(key,value) {
                        console.log();
                        var h1 = "<h1 id='pricingModalTitle'>" + value.infrastructure + "</h1>";
                        
                        $('#infrastructureTitle').append(h1);
                        var p = "<p class='mb-1'><span class='badge badge-glow bg-success'>"+value.type+"</span></p>";
                        $('#infrastructureTitle').append(p);
                    });
                    //
                    $.each(res,function(key,value) {

                        var label = "<label class='align-items-center flex-column flex-sm-row'>";
                            label = label + "<span><span class='custom-option-item-title h3'> Designation : "+value.designation+"</span>";
                            label = label + "<span class='d-block mt-75 badge badge-glow bg-success'>Code : " + value.code + "</span>";
                            label = label + "<span class='d-block mt-75 badge badge-glow bg-success'> Avancement : " + value.avancement + "</span>";
                            label = label + "<span class='d-block mt-75 badge badge-glow bg-success'> Montant : " + value.montant + "</span>";
                            label = label + "<span class='d-block mt-75 badge badge-glow bg-success'> Source de financement : " + value.bayeur + "</span>";
                            label = label + "<span class='d-block mt-75 badge badge-glow bg-success'> Projet : " + value.projet + "</span>";
                            label = label + "</span></label>"
                            $('#interventionBody').append(label);
                    });
                    $('#pricingModal').modal('show');
                    
                },
                error : function(){
                    alert('getInfra');
                }
            });
            
        });
    });



    ///marker.bindPopup("<b>You're here!</b>").openPopup();

  }
});
    </script>
    <!-- END: Page JS-->
@endpush