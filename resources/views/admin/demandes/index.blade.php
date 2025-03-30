@extends('layouts.admin')
@section('title')
    @lang('trans.dashboard_admin')
@endsection
@section('contentheader')
    @lang('trans.dashboard_admin')
@endsection
@section('contentheaderlink')
    <a href="">
        @lang('trans.dashboard_admin') </a>
@endsection
@section('contentheaderactive')
    @lang('trans.dashboard_admin')
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
                                        <th>@lang('trans.applicant')</th>
                                        <th>@lang('trans.type_application')</th>
                                        <th>@lang('trans.type_license')</th>
                                        <th>@lang('trans.status')</th>
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
                                            <td>


                                                @if (auth()->user()->hasRole('admin'))
                                                    @if (optional($demande->etatDemande)->demandeur_cree_demande === 1)
                                                        <a href="{{ route('demandes.show', $demande->id) }}"
                                                            class="btn btn-info btn-sm">@lang('trans.view')</a>
                                                    @endif
                                                    @if (optional($demande->etatDemande)->dg_annoter === 1 &&
                                                            optional($demande->etatDemande)->dg_rejeter !== 1 &&
                                                            optional($demande->etatDemande)->dsv_annoter === 1 &&
                                                            optional($demande->etatDemande)->dsv_rejeter !== 1 &&
                                                            optional($demande->etatDemande)->pel_annoter !== 1)
                                                        <form action="{{ route('admin.annoter', $demande->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-success btn-sm"
                                                                onclick="return confirm('Confirmer l\' annotation vers SECTIONS (Section de médecine aéronautique et Licence aéronautique)   ?')">
                                                                @lang('trans.annotate')
                                                            </button>
                                                        </form>
                                                    @endif
                                                    @if (optional($demande->etatDemande)->sl_valider === 1 &&
                                                            optional($demande->etatDemande)->sm_valider === 1 &&
                                                            optional($demande->etatDemande)->pel_valider !== 1)
                                                        <form action="{{ route('admin.valider', $demande->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-success btn-sm"
                                                                onclick="return confirm('Confirmer la validation ?')">
                                                                @lang('trans.validate')
                                                            </button>
                                                        </form>
                                                    @endif
                                                    @if (optional($demande->paiement)->statut === 'Payé' &&
                                                            optional($demande->etatDemande)->dg_signer === 1 &&
                                                            optional($demande->typeDemande)->id === 1)
                                                        <form action="{{ route('admin.generer', $demande->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-success btn-sm"
                                                                onclick="return confirm('Generer la licence ?')">
                                                                @lang('trans.generate_license')
                                                            </button>
                                                        </form>
                                                    @endif
                                                    @if (optional($demande->paiement)->statut === 'Payé' &&
                                                            optional($demande->etatDemande)->dsv_signer === 1 &&
                                                            optional($demande->typeDemande)->id !== 1)
                                                        <form action="{{ route('admin.generer', $demande->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-primary btn-sm"
                                                                onclick="return confirm('Mis a jour de la licence ?')">
                                                                @lang('trans.update_license')
                                                            </button>
                                                        </form>
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
