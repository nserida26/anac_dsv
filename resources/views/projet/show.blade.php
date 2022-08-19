@extends('layouts.app')

@section('template_title')
    {{ $projet->name ?? 'Show Projet' }}
@endsection

@section('content')
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
@endsection
