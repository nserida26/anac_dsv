@extends('layouts.app')

@section('template_title')
    {{ $commune->name ?? 'Show Commune' }}
@endsection

@section('content')
    <section class="content container-fluid">
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
    </section>
@endsection
