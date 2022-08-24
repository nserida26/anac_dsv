@extends('layouts.master')



@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-body">
                
                    <div class="row">
                        <div class="col-md-12">

                            @includeif('partials.errors')

                            <div class="card card-default">
                                <div class="card-header">
                                    <span class="card-title">Ajouter Localite</span>
                                </div>
                                <div class="card-body">
                                    <form class="form form-horizontal" method="POST" action="{{ route('localites.store') }}"  role="form" enctype="multipart/form-data">
                                        @csrf

                                        @include('localite.form')

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            </div></div></div>
@endsection
