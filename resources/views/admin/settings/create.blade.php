@extends('layouts.admin')
@section('title')
    @lang('admin.dashboard')
@endsection
@section('contentheader')
    @lang('admin.dashboard')
@endsection
@section('contentheaderlink')
    <a href="">
        @lang('admin.dashboard') </a>
@endsection
@section('contentheaderactive')
    @lang('admin.dashboard')
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endpush
@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">



                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Setting</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('settings.store') }}" role="form"
                            enctype="multipart/form-data">
                            @csrf

                            @include('admin.settings.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
