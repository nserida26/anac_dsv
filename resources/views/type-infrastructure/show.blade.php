@extends('layouts.master')



@section('content')
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
                            <span class="card-title">Show Type Infrastructure</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('type-infrastructures.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Type:</strong>
                            {{ $typeInfrastructure->type }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
        </div></div></div>
@endsection
