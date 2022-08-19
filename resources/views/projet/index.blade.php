@extends('layouts.app')

@section('template_title')
    Projet
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Projet') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('projets.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

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
										<th>Bayeur Id</th>

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
											<td>{{ $projet->bayeur_id }}</td>

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
@endsection
