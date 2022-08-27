@extends('layouts.master')



@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-body">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Update Menage</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('menages.update', $menage->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('menage.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div></div>
@endsection
