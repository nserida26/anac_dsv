@extends('layouts.master')

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-body">
                
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="float-left">
                                        <span class="card-title">Detail Localite</span>
                                    </div>
                                    <div class="float-right">
                                        <a class="btn btn-primary" href="{{ route('localites.index') }}"> Back</a>
                                    </div>
                                </div>

                                <div class="card-body">
                                    
                                    <div class="form-group">
                                        <strong>Libele:</strong>
                                        {{ $localite->libele }}
                                    </div>
                                    <div class="form-group">
                                        <strong>Population:</strong>
                                        {{ $localite->population }}
                                    </div>
                                    <div class="form-group">
                                        <strong>Altitude:</strong>
                                        {{ $localite->altitude }}
                                    </div>
                                    <div class="form-group">
                                        <strong>Longitude:</strong>
                                        {{ $localite->longitude }}
                                    </div>
                                    <div class="form-group">
                                        <strong>Commune:</strong>
                                        {{ $localite->commune }}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
