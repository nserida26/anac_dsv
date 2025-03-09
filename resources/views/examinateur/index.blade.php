@extends('examinateur.layouts.app')
@section('title')
    @lang('examinateur.dashboard')
@endsection
@section('contentheader')
    @lang('examinateur.dashboard')
@endsection
@section('contentheaderlink')
    <a href="">
        @lang('examinateur.dashboard') </a>
@endsection
@section('contentheaderactive')
    @lang('examinateur.dashboard')
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endpush
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">@lang('examinateur.demandes')</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="demandes">
                                <thead>
                                    <tr>
                                        <th>ID</th>

                                        <th>Photo</th>
                                        <th>Nom et Prenom</th>
                                        <th>Date de naissance </th>
                                        <th>Adresse</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($demandeurs as $demandeur)
                                        <tr>
                                            <td>{{ $demandeur->id }}</td>
                                            <td><img src="{{asset('/uploads/' . $demandeur->photo)}}" width="64" height="64"
                                                    class="card-img-top img-cover" alt=""></td>
                                            <td>{{ $demandeur->np }}</td>

                                            <td>{{ $demandeur->date_naissance }}</td>
                                            <td>{{ $demandeur->adresse }}</td>
                                            <td>

                                                <a href="{{ route('examinateur.create', $demandeur) }}"
                                                    class="btn btn-info btn-sm">Create</a>

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
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">@lang('examinateur.examens')</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="demandes">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Demandeur</th>

                                        <th>Date Examen</th>
                                        <th>Aptitude</th>

                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($examens as $examen)
                                        <tr>
                                            <td>{{ $examen->id }}</td>
                                            <td>{{ $examen->demandeur->np }}</td>
                                            <td>{{ $examen->date_examen }}</td>
                                            <td>{{ $examen->aptitude }}</td>

                                            <td>

                                                <a href="{{ route('examinateur.show', $examen) }}"
                                                    class="btn btn-info btn-sm">Show</a>
                                                @if (!$examen->valider_examinateur)
                                                    <a href="{{ route('examinateur.edit', $examen) }}"
                                                        class="btn btn-primary btn-sm">Edit</a>

                                                    <form action="{{ route('examinateur.valider', $examen) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-warning btn-sm"
                                                            onclick="return confirm('Confirmer la validation ?')">Valider</button>
                                                    </form>
                                                    <form action="{{ route('examinateur.destroy', $examen) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
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
        $(function () {
            $('#demandes').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "columnDefs": [{
                    "targets": 5,
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