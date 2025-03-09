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
    <div class="container">
        <div class="row">


            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Create User</div>
                    <div class="card-body">

                        <form action="{{ route('users.store') }}" method="POST">
                            @csrf
                           
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="roles">Roles</label>
                                <select name="roles[]" id="roles" class="form-control" multiple>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
