@extends('sec.layouts.app')
@section('title')
    @lang('trans.dashboard_sec')
@endsection
@section('contentheader')
    @lang('trans.dashboard_sec')
@endsection
@section('contentheaderlink')
    <a href="">
        @lang('trans.dashboard_sec') </a>
@endsection
@section('contentheaderactive')
    @lang('trans.dashboard_sec')
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
                                        <th>ID</th>
                                        <th>@lang('trans.applicant')</th>
                                        <th>@lang('trans.type_application')</th>
                                        <th>@lang('trans.type_license')</th>
                                        <th>@lang('trans.status')</th>
                                        @if (auth()->user()->hasRole('sla'))
                                            <th>@lang('trans.training')</th>
                                        @endif
                                        @if (auth()->user()->hasRole('sma'))
                                            <th>@lang('trans.exams')</th>
                                        @endif
                                        <th>@lang('trans.actions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($demandes as $demande)
                                        <tr>
                                            <td>{{ $demande->code }}</td>
                                            <td>{{ $demande->demandeur->np }}</td>
                                            <td>{{ LaravelLocalization::getCurrentLocale() == 'fr' ? optional($demande->typeDemande)->nom_fr : optional($demande->typeDemande)->nom_en }}
                                            </td>
                                            <td>{{ $demande->typeLicence->nom }}</td>
                                            <td>{{ $demande->status }}</td>
                                            @if (auth()->user()->hasRole('sla'))
                                                <td>
                                                    @if ($demande->demandeur->formations->isNotEmpty())
                                                        <span class="badge badge-primary">
                                                            @lang('trans.yes')
                                                        </span>
                                                    @else
                                                        <span class="badge badge-danger">
                                                            @lang('trans.no')
                                                        </span>
                                                    @endif
                                                </td>
                                            @endif
                                            @if (auth()->user()->hasRole('sma'))
                                                <td>
                                                    @if ($demande->demandeur->examens->isNotEmpty())
                                                        <span class="badge badge-primary">
                                                            @lang('trans.yes')
                                                        </span>
                                                    @else
                                                        <span class="badge badge-danger">
                                                            @lang('trans.no')
                                                        </span>
                                                    @endif
                                                </td>
                                            @endif
                                            <td>
                                                @if (auth()->user()->hasRole('sla'))
                                                    @if (optional($demande->etatDemande)->demandeur_cree_demande === 1)
                                                        <a href="{{ route('sla.show', $demande->id) }}"
                                                            class="btn btn-info btn-sm">@lang('trans.view')</a>
                                                    @endif
                                                    @if (optional($demande->etatDemande)->dg_annoter === 1 &&
                                                            optional($demande->etatDemande)->dg_rejeter !== 1 &&
                                                            optional($demande->etatDemande)->dsv_annoter === 1 &&
                                                            optional($demande->etatDemande)->dsv_rejeter !== 1 &&
                                                            optional($demande->etatDemande)->pel_annoter === 1 &&
                                                            optional($demande->etatDemande)->sl_valider !== 1)
                                                        <form action="{{ route('sla.valider', $demande->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-success btn-sm"
                                                                onclick="return confirm('@lang('trans.confirm_license_validation')')">
                                                                @lang('trans.validate')
                                                            </button>
                                                        </form>
                                                    @endif
                                                @endif
                                                @if (auth()->user()->hasRole('sma'))
                                                    @if (optional($demande->etatDemande)->demandeur_cree_demande === 1)
                                                        <a href="{{ route('sma.show', $demande->id) }}"
                                                            class="btn btn-info btn-sm">@lang('trans.view')</a>
                                                    @endif
                                                    @if (optional($demande->etatDemande)->dg_annoter === 1 &&
                                                            optional($demande->etatDemande)->dg_rejeter !== 1 &&
                                                            optional($demande->etatDemande)->dsv_annoter === 1 &&
                                                            optional($demande->etatDemande)->dsv_rejeter !== 1 &&
                                                            optional($demande->etatDemande)->pel_annoter === 1 &&
                                                            optional($demande->etatDemande)->sm_valider !== 1)
                                                        <form action="{{ route('sma.valider', $demande->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-success btn-sm"
                                                                onclick="return confirm('@lang('trans.confirm_medical_validation')')">
                                                                @lang('trans.validate')
                                                            </button>
                                                        </form>
                                                    @endif
                                                    @if (optional($demande->etatDemande)->dg_annoter === 1 &&
                                                            optional($demande->etatDemande)->dg_rejeter !== 1 &&
                                                            optional($demande->etatDemande)->dsv_annoter === 1 &&
                                                            optional($demande->etatDemande)->dsv_rejeter !== 1 &&
                                                            optional($demande->etatDemande)->pel_annoter === 1 &&
                                                            optional($demande->etatDemande)->sm_valider !== 1 &&
                                                            optional($demande->etatDemande)->evaluateur_annoter !== 1)
                                                        <button type="button" class="btn btn-warning btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#annotationModal-{{ $demande->id }}">
                                                            @lang('trans.annotate')
                                                        </button>
                                                    @endif
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
    <div class="modal fade" id="annotationModal-{{ $demande->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('sma.annoter', $demande->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="modal-header">
                        <h5 class="modal-title">@lang('trans.annotate_to_evaluator')</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="evaluateur-{{ $demande->id }}" class="form-label">@lang('trans.select_evaluator')</label>
                            <select class="form-control" id="evaluateur-{{ $demande->user_id }}" name="evaluateur_id"
                                required>
                                <option value="">@lang('trans.choose')</option>
                                @foreach ($evaluateurs as $evaluateur)
                                    <option value="{{ $evaluateur->user_id }}">{{ $evaluateur->np }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('trans.cancel')</button>
                        <button type="submit" class="btn btn-primary">@lang('trans.annotate')</button>
                    </div>
                </form>
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
