@extends('layouts.app')

@section('template_title')
    {{ $bayeur->name ?? 'Show Bayeur' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Bayeur</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('bayeurs.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nom:</strong>
                            {{ $bayeur->nom }}
                        </div>
                        <div class="form-group">
                            <strong>Code:</strong>
                            {{ $bayeur->code }}
                        </div>
                        <div class="form-group">
                            <strong>Tel:</strong>
                            {{ $bayeur->tel }}
                        </div>
                        <div class="form-group">
                            <strong>Adresse:</strong>
                            {{ $bayeur->adresse }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
