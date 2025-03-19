@extends('layouts.admin')

@section('template_title')
    {{ $setting->name ?? "{{ __('Show') Setting" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Setting</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('settings.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Key:</strong>
                            {{ $setting->key }}
                        </div>
                        <div class="form-group">
                            <strong>Value:</strong>
                            {{ $setting->value }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
