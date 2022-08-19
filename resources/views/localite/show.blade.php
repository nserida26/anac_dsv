@extends('layouts.app')

@section('template_title')
    {{ $localite->name ?? 'Show Localite' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Localite</span>
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
                            <strong>Commune Id:</strong>
                            {{ $localite->commune_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
