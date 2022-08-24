@extends('layouts.master')



@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-body">
                <section class="content container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="float-left">
                                        <span class="card-title">Show Intervenant</span>
                                    </div>
                                    <div class="float-right">
                                        <a class="btn btn-primary" href="{{ route('intervenants.index') }}"> Back</a>
                                    </div>
                                </div>

                                <div class="card-body">
                                    
                                    <div class="form-group">
                                        <strong>Nom:</strong>
                                        {{ $intervenant->nom }}
                                    </div>
                                    <div class="form-group">
                                        <strong>Code:</strong>
                                        {{ $intervenant->code }}
                                    </div>
                                    <div class="form-group">
                                        <strong>Tel:</strong>
                                        {{ $intervenant->tel }}
                                    </div>
                                    <div class="form-group">
                                        <strong>Adresse:</strong>
                                        {{ $intervenant->adresse }}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
