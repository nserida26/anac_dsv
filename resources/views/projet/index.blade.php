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
                                {{ __('Projet') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('projets.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
										<th>Code</th>
										<th>Date Debut</th>
										<th>Date Fin</th>
										<th>SF</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($projets as $projet)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $projet->designation }}</td>
											<td>{{ $projet->code }}</td>
											<td>{{ $projet->date_debut }}</td>
											<td>{{ $projet->date_fin }}</td>
											<td>{{ $projet->bayeur}}</td>

                                            <td>
                                                <form action="{{ route('projets.destroy',$projet->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('projets.show',$projet->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('projets.edit',$projet->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $projets->links() !!}
            </div>
        </div>
    </div>
            </div>
        </div>
    </div>
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