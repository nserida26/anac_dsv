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
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">@lang('admin.licences')</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="licences">
                                <thead>
                                    <tr>

                                        <th>Categorie</th>
                                        <th>Type</th>
                                        <th>Numero de licence</th>
                                        <th>Nom et Prenom</th>
                                        <th>Date de naissance</th>
                                        <th>Adresse</th>
                                        <th>Nationalite</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($licences as $licence)
                                        <tr>
                                            <td>{{ $licence->categorie_licence }}</td>
                                            <td>{{ $licence->type_licence }}</td>
                                            <td>{{ $licence->numero_licence }}</td>
                                            <td>{{ $licence->np }}</td>
                                            <td>{{ $licence->date_naissance }}</td>
                                            <td>{{ $licence->adresse }}</td>
                                            <td>{{ strtoupper($licence->nationalite) }}</td>
                                            <td>
                                                <a href="{{ route('licences.show', $licence) }}"
                                                    class="btn btn-info btn-sm">View</a>
                                                @if (!$licence->licence_valide)
                                                    <form action="{{ route('licences.valider', $licence) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-primary btn-sm"
                                                            onclick="return confirm('Confirmer la validation de la licence ?')">Valider</button>
                                                    </form>
                                                @endif
                                                @if ($licence->licence_valide)
                                                    <form action="{{ route('licences.bloquer', $licence) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Confirmer la révocation  de la licence ?')">Révoquer</button>
                                                    </form>
                                                @endif


                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
@endpush
@push('custom')
    <script>
        $(function() {
            $('#licences').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "columnDefs": [{
                        "targets": 7,
                        "orderable": false
                    },
                    {
                        "targets": 3,
                        "searchable": true
                    }
                ]

            });
        });
    </script>
@endpush
