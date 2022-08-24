@extends('layouts.master')


@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    

                                        <span id="card_title">
                                            {{ __('Menage') }}
                                        </span>

                                        <div class="float-right">
                                            <a href="{{ route('menages.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                            {{ __('Ajouter') }}
                                            </a>
                                        </div>
                                    
                                </div>


                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead class="thead">
                                                <tr>
                                                    <th>No</th>
                                                    
                                                    <th>Designation</th>
                                                    <th>Nbr</th>
                                                    <th>Projet</th>

                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($menages as $menage)
                                                    <tr>
                                                        <td>{{ ++$i }}</td>
                                                        
                                                        <td>{{ $menage->designation }}</td>
                                                        <td>{{ $menage->nbr }}</td>
                                                        <td>{{ $menage->projet }}</td>

                                                        <td>
                                                            <form action="{{ route('menages.destroy',$menage->id) }}" method="POST">
                                                                <a class="btn btn-sm btn-primary " href="{{ route('menages.show',$menage->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                                <a class="btn btn-sm btn-success" href="{{ route('menages.edit',$menage->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            {!! $menages->links() !!}
                        </div>
                    </div>
                </div>
            </div></div></div>
@endsection
@push('plugin-js')
<script src="../../../app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
<script src="../../../app-assets/vendors/js/extensions/polyfill.min.js"></script>
@endpush
@push('custom-js')
    <script>

    var message = {!! json_encode(Session::get('success')) !!}
    console.log(message);
    if (message) {
        Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: message,
        customClass: {
        confirmButton: 'btn btn-success'
        }}); 
    }
      
    </script>
@endpush
