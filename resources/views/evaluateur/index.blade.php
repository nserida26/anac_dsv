@extends('evaluateur.layouts.app')
@section('title')
    @lang('evaluateur.dashboard')
@endsection
@section('contentheader')
    @lang('evaluateur.dashboard')
@endsection
@section('contentheaderlink')
    <a href="">
        @lang('evaluateur.dashboard') </a>
@endsection
@section('contentheaderactive')
    @lang('evaluateur.dashboard')
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
                    <div class="card-header">@lang('evaluateur.examens')</div>
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

                                                <a href="{{ route('evaluateur.show', $examen) }}"
                                                    class="btn btn-info btn-sm">Show</a>
                                                @if ($examen->valider_examinateur && !$examen->valider_evaluateur)
                                                    <a href="{{ route('evaluateur.edit', $examen) }}"
                                                        class="btn btn-primary btn-sm">Edit</a>

                                                    <form action="{{ route('evaluateur.valider', $examen) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-warning btn-sm"
                                                            onclick="return confirm('Confirmer la validation ?')">Valider</button>
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