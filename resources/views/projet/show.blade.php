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
                            <span class="card-title">Show Projet</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('projets.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Designation:</strong>
                            {{ $projet->designation }}
                        </div>
                        <div class="form-group">
                            <strong>Code:</strong>
                            {{ $projet->code }}
                        </div>
                        <div class="form-group">
                            <strong>Date Debut:</strong>
                            {{ $projet->date_debut }}
                        </div>
                        <div class="form-group">
                            <strong>Date Fin:</strong>
                            {{ $projet->date_fin }}
                        </div>
                        <div class="form-group">
                            <strong>Bayeur Id:</strong>
                            {{ $projet->bayeur_id }}
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
