@extends('layouts.master')
@push('plugin-styles')
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/file-uploaders/dropzone.min.css">
@push('custom-styles')
<link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/form-file-uploader.css">
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
                            <h2 class="content-header-title float-start mb-0">Importations</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Dropzone section start -->
                <section id="dropzone-examples">
                    <!-- single file upload starts -->
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Infrastructure</h4>
                                </div>
                                <div class="card-body">

                                    <form action="{{route('infra.importInfrastructure')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-1">
                                            <input class="form-control" type="file" name="file" id="file"/>
                                        </div>
                                        
                                        <div class="offset-sm-10">
                                            <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">Import</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- single file upload ends -->
                </section>
                <!-- Dropzone section end -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
@push('plugin-js')
    <!-- BEGIN: Page Vendor JS-->
    <script src="/app-assets/vendors/js/file-uploaders/dropzone.min.js"></script>
    <script src="../../../app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
    <script src="../../../app-assets/vendors/js/extensions/polyfill.min.js"></script>
@endpush
@push('custom-js')
    <!-- BEGIN: Page JS-->
    <script src="/app-assets/js/scripts/forms/form-file-uploader.js"></script>
        <script>

    var message = {!! json_encode(Session::get('success')) !!}
    console.log(message);
    if (message) {
        Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: message,
        customClass: {
        confirmButton: 'btn btn-success'
        }}); 
    }
    var message = {!! json_encode(Session::get('error')) !!}
    console.log(message);
    if (message) {
        Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: message,
        customClass: {
        confirmButton: 'btn btn-success'
        }}); 
    }
      
    </script>
@endpush