@extends('layouts.master')

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row">
                        <div class="col-10">
                            <h2 class="content-header-title float-start mb-0">Gestion des utilisateurs</h2>
                        </div> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
            <!-- apex charts section start -->
            <section>
                <div class="row">
                    <div class="col-sm-12">
                    <div class="card">
                                        <div class="card">
                    <div class="card-header">
                        

                            <span id="card_title">
                                {{ __('Utilisateurs') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Ajouter') }}
                                </a>
                              </div>
                    </div>

                    <div class="card-body">
                    <table class="table text-center">
                        <thead class="thead-dark">
                            <tr>
                            <th scope="col">Nom et Prénom</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($users as $user)
                            <tr style="backgroundColor:#fff">
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->role}}</td>
                                <td class="justify-content-center"> 
                                    <a href={{"users/".$user->id}} class="btn btn-info btn-sm text-light">View</a>
                                    <a href={{"users/edit/".$user->id}} class="btn btn-success btn-sm text-light">Edit</a>
                                    <form action="{{url('users/'.$user->id)}}" method="POST" style="display:inline-block">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm text-light" value="Delete">
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <div class="text-center">No Users Available</div>
                        @endforelse
                        </tbody>
                    </table>
                    </div>
                    </div>
                    </div>
                </div>
            </section>
            </div></div></div>
    </div>
        {{ $users->links() }}
    </div>
@endsection