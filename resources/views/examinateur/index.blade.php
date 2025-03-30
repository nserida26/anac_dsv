@extends('examinateur.layouts.app')
@section('title')
    @lang('trans.dashboard_examiner')
@endsection
@section('contentheader')
    @lang('trans.dashboard_examiner')
@endsection
@section('contentheaderlink')
    <a href="">
        @lang('trans.dashboard_examiner') </a>
@endsection
@section('contentheaderactive')
    @lang('trans.dashboard_examiner')
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
                    <div class="card-header">@lang('trans.applicants')</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="demandes">
                                <thead>
                                    <tr>
                                        <th>@lang('trans.id')</th>

                                        <th>@lang('trans.photo')</th>
                                        <th>@lang('trans.fl_name')</th>
                                        <th>@lang('trans.dob') </th>
                                        <th>@lang('trans.address')</th>
                                        <th>@lang('trans.actions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($demandeurs as $demandeur)
                                        <tr>
                                            <td>{{ $demandeur->id }}</td>
                                            <td><img src="{{ asset('/uploads/' . $demandeur->photo) }}" width="64"
                                                    height="64" class="card-img-top img-cover" alt=""></td>
                                            <td>{{ $demandeur->np }}</td>

                                            <td>{{ $demandeur->date_naissance }}</td>
                                            <td>{{ $demandeur->adresse }}</td>
                                            <td>

                                                <a href="{{ route('examinateur.create', $demandeur) }}"
                                                    class="btn btn-info btn-sm">@lang('trans.create')</a>

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
                    <div class="card-header">@lang('trans.exams')</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="demandes">
                                <thead>
                                    <tr>
                                        <th>@lang('trans.id')</th>
                                        <th>@lang('trans.applicant')</th>

                                        <th>@lang('trans.exam_date')</th>
                                        <th>@lang('trans.medical_fitness')</th>

                                        <th>@lang('trans.actions')</th>
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
                                                    class="btn btn-info btn-sm">@lang('trans.view')</a>
                                                @if (!$examen->valider_examinateur)
                                                    <a href="{{ route('examinateur.edit', $examen) }}"
                                                        class="btn btn-primary btn-sm">@lang('trans.edit')</a>

                                                    <form action="{{ route('examinateur.valider', $examen) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-warning btn-sm"
                                                            onclick="return confirm('Confirmer la validation ?')">@lang('trans.validate')</button>
                                                    </form>
                                                    <form action="{{ route('examinateur.destroy', $examen) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Confirmer la suppression ?')">@lang('trans.destroy')</button>
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
