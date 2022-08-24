@extends('layouts.master')



@section('content')
    <!-- BEGIN: Content-->
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
                                    <span class="card-title">Update Bayeur</span>
                                </div>
                                <div class="card-body">
                                    <form class="form form-horizontal" method="POST" action="{{ route('bayeurs.update', $bayeur->id) }}"  role="form" enctype="multipart/form-data">
                                        {{ method_field('PATCH') }}
                                        @csrf

                                        @include('bayeur.form')

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
