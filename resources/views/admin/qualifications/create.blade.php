@extends('layouts.admin')
@section('title')
    @lang('admin.qualifications')
@endsection
@section('contentheader')
    @lang('admin.qualifications')
@endsection
@section('contentheaderlink')
    <a href="{{ route('qualifications.index') }}">
        @lang('admin.qualifications') </a>
@endsection
@section('contentheaderactive')
    @lang('admin.qualifications')
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Qualification</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('qualifications.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('admin.qualifications.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
