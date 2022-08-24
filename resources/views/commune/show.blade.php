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
                                        <span class="card-title">Show Commune</span>
                                    </div>
                                    <div class="float-right">
                                        <a class="btn btn-primary" href="{{ route('communes.index') }}"> Back</a>
                                    </div>
                                </div>

                                <div class="card-body">
                                    
                                    <div class="form-group">
                                        <strong>Libele:</strong>
                                        {{ $commune->libele }}
                                    </div>
                                    <div class="form-group">
                                        <strong>Population:</strong>
                                        {{ $commune->population }}
                                    </div>
                                    <div class="form-group">
                                        <strong>Altitude:</strong>
                                        {{ $commune->altitude }}
                                    </div>
                                    <div class="form-group">
                                        <strong>Longitude:</strong>
                                        {{ $commune->longitude }}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                
            </div>
        </div>
    </div>
@endsection
