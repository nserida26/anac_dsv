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
                                            {{ __('Localite') }}
                                        </span>

                                        <div class="float-right">
                                            <a href="{{ route('localites.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                                    
                                                    <th>Libele</th>
                                                    <th>Population</th>
                                                    <th>Altitude</th>
                                                    <th>Longitude</th>
                                                    <th>Commune</th>

                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($localites as $localite)
                                                    <tr>
                                                        <td>{{ ++$i }}</td>
                                                        
                                                        <td>{{ $localite->libele }}</td>
                                                        <td>{{ $localite->population }}</td>
                                                        <td>{{ $localite->altitude }}</td>
                                                        <td>{{ $localite->longitude }}</td>
                                                        <td>{{ $localite->commune }}</td>

                                                        <td>
                                                            <form action="{{ route('localites.destroy',$localite->id) }}" method="POST">
                                                                <a class="btn btn-sm btn-primary " href="{{ route('localites.show',$localite->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                                <a class="btn btn-sm btn-success" href="{{ route('localites.edit',$localite->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                            {!! $localites->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div></div>
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

