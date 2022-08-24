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
                                        <span class="card-title">Show Menage</span>
                                    </div>
                                    <div class="float-right">
                                        <a class="btn btn-primary" href="{{ route('menages.index') }}"> Back</a>
                                    </div>
                                </div>

                                <div class="card-body">
                                    
                                    <div class="form-group">
                                        <strong>Designation:</strong>
                                        {{ $menage->designation }}
                                    </div>
                                    <div class="form-group">
                                        <strong>Nbr:</strong>
                                        {{ $menage->nbr }}
                                    </div>
                                    <div class="form-group">
                                        <strong>Projet Id:</strong>
                                        {{ $menage->projet_id }}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                
            </div>
        </div>
    </div>
@endsection
