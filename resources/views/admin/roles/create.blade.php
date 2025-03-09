@extends('layouts.admin')
@section('title')
    @lang('user.users')
@endsection
@section('contentheader')
    @lang('user.users')
@endsection
@section('contentheaderlink')
    <a href="{{ route('users.index') }}"> @lang('sidebar.users') </a>
@endsection
@section('contentheaderactive')
    @lang('user.users')
@endsection
@push('css')
@endpush
@section('content')
    <div class="row">


        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Create Role</div>
                <div class="card-body">
                    <form action="{{ route('roles.store') }}" method="POST">
                        @csrf
                        <label for="name">Role Name</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                        <button type="submit" class="btn btn-warning">Create Role</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
