@extends('layouts.app')

@section('template_title')
    Commune
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Commune') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('communes.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Libele</th>
										<th>Population</th>
										<th>Altitude</th>
										<th>Longitude</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($communes as $commune)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $commune->libele }}</td>
											<td>{{ $commune->population }}</td>
											<td>{{ $commune->altitude }}</td>
											<td>{{ $commune->longitude }}</td>

                                            <td>
                                                <form action="{{ route('communes.destroy',$commune->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('communes.show',$commune->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('communes.edit',$commune->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $communes->links() !!}
            </div>
        </div>
    </div>
@endsection
