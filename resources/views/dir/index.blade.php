@extends('dir.layouts.app')
@section('title')
    @lang('trans.dashboard_dir')
@endsection
@section('contentheader')
    @lang('trans.dashboard_dir')
@endsection
@section('contentheaderlink')
    @if (auth()->user()->hasRole('dsv'))
        <a href="{{ route('dsv') }}">
            @lang('trans.dashboard_dir') </a>
    @endif
    @if (auth()->user()->hasRole('dg'))
        <a href="{{ route('dg') }}">
            @lang('trans.dashboard_dir') </a>
    @endif
@endsection
@section('contentheaderactive')
    @lang('trans.dashboard_dir')
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
                                        @if (auth()->user()->hasRole('dg'))
                                            <th>#</th>
                                        @endif
                                        <th>@lang('trans.actions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($demandes as $demande)
                                        <tr>
                                            <td>{{ $demande->code }}</td>
                                            <td>{{ optional($demande->demandeur)->np }}</td>
                                            <td>{{ LaravelLocalization::getCurrentLocale() == 'fr' ? optional($demande->typeDemande)->nom_fr : optional($demande->typeDemande)->nom_en }}
                                            </td>
                                            <td>{{ $demande->typeLicence->nom }}</td>
                                            <td>{{ $demande->status }}</td>
                                            @if (auth()->user()->hasRole('dg'))
                                                <td>

                                                    @if ($demande->etatDemande->dsv_dg_annoter)
                                                        <span class="badge badge-primary">@lang('trans.annotated_dsv')</span>
                                                    @endif
                                                    @if ($demande->etatDemande->dsv_dg_valider)
                                                        <span class="badge badge-primary">@lang('trans.validated_dsv')</span>
                                                    @endif
                                                    @if ($demande->etatDemande->dsv_dg_signer)
                                                        <span class="badge badge-primary">@lang('trans.signed_dsv')</span>
                                                    @endif


                                                </td>
                                            @endif

                                            <td>


                                                @if (auth()->user()->hasRole('dg'))
                                                    @if (optional($demande->etatDemande)->demandeur_cree_demande === 1)
                                                        <a href="{{ route('dg.show', $demande->id) }}"
                                                            class="btn btn-info btn-sm">@lang('trans.view')</a>
                                                    @endif

                                                    @if (optional($demande->etatDemande)->dg_annoter !== 1 && optional($demande->etatDemande)->dg_rejeter !== 1)
                                                        <form action="{{ route('dg.annoter', $demande->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-success btn-sm"
                                                                onclick="return confirm('Confirmer l\' annotation vers DSV ?')">
                                                                @lang('trans.annotate')
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('dg.rejeter', $demande->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Confirmer le rejeter ?')">
                                                                @lang('trans.reject')
                                                            </button>
                                                        </form>
                                                    @endif


                                                    @if (optional($demande->etatDemande)->sl_valider === 1 &&
                                                            optional($demande->etatDemande)->sm_valider === 1 &&
                                                            optional($demande->etatDemande)->pel_valider === 1 &&
                                                            optional($demande->etatDemande)->dsv_valider === 1 &&
                                                            optional($demande->etatDemande)->dg_valider !== 1)
                                                        <form action="{{ route('dg.valider', $demande->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-success btn-sm"
                                                                onclick="return confirm('Confirmer la validation ?')">
                                                                @lang('trans.validate')
                                                            </button>
                                                        </form>
                                                    @endif
                                                    @if (optional($demande->paiement)->statut === 'Payé' && optional($demande->etatDemande)->dg_signer !== 1)
                                                        <form action="{{ route('dg.signer', $demande->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-success btn-sm"
                                                                onclick="return confirm('Confirmer la signature ?')">
                                                                @lang('trans.sign')
                                                            </button>
                                                        </form>
                                                    @endif
                                                @endif


                                                @if (auth()->user()->hasRole('dsv'))
                                                    @if (optional($demande->etatDemande)->demandeur_cree_demande === 1)
                                                        <a href="{{ route('dsv.show', $demande->id) }}"
                                                            class="btn btn-info btn-sm">@lang('trans.view')</a>
                                                    @endif

                                                    @if (optional($demande->etatDemande)->dg_annoter !== 1 && optional($demande->etatDemande)->dg_rejeter !== 1)
                                                        <form action="{{ route('dg.annoter', $demande->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-success btn-sm"
                                                                onclick="return confirm('Confirmer l\' annotation vers DSV ?')">
                                                                @lang('trans.annotate_dg')
                                                            </button>
                                                        </form>
                                                    @endif
                                                    @if (optional($demande->etatDemande)->sl_valider === 1 &&
                                                            optional($demande->etatDemande)->sm_valider === 1 &&
                                                            optional($demande->etatDemande)->pel_valider === 1 &&
                                                            optional($demande->etatDemande)->dsv_valider === 1 &&
                                                            optional($demande->etatDemande)->dg_valider !== 1)
                                                        <form action="{{ route('dg.valider', $demande->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-success btn-sm"
                                                                onclick="return confirm('Confirmer la validation ?')">
                                                                @lang('trans.validate_dg')
                                                            </button>
                                                        </form>
                                                    @endif
                                                    @if (optional($demande->paiement)->statut === 'Payé' && optional($demande->etatDemande)->dg_signer !== 1)
                                                        <form action="{{ route('dg.signer', $demande->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-success btn-sm"
                                                                onclick="return confirm('Confirmer la signature ?')">
                                                                @lang('trans.sign_dg')
                                                            </button>
                                                        </form>
                                                    @endif

                                                    @if (optional($demande->etatDemande)->dg_annoter === 1 &&
                                                            optional($demande->etatDemande)->dg_rejeter !== 1 &&
                                                            (optional($demande->etatDemande)->dsv_annoter !== 1 && optional($demande->etatDemande)->dsv_rejeter !== 1))
                                                        <form action="{{ route('dsv.annoter', $demande->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-success btn-sm"
                                                                onclick="return confirm('Confirmer l\' annotation vers Service PEL ?')">
                                                                @lang('trans.annotate')
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('dsv.rejeter', $demande->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Confirmer le rejeter ?')">
                                                                @lang('trans.reject')
                                                            </button>
                                                        </form>
                                                    @endif


                                                    @if (optional($demande->etatDemande)->sl_valider === 1 &&
                                                            optional($demande->etatDemande)->sm_valider === 1 &&
                                                            optional($demande->etatDemande)->pel_valider === 1 &&
                                                            optional($demande->etatDemande)->dsv_valider !== 1)
                                                        <form action="{{ route('dsv.valider', $demande->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-success btn-sm"
                                                                onclick="return confirm('Confirmer la validation ?')">
                                                                @lang('trans.validate')
                                                            </button>
                                                        </form>
                                                    @endif


                                                    @if (optional($demande->etatDemande)->sl_valider === 1 &&
                                                            optional($demande->etatDemande)->sm_valider === 1 &&
                                                            optional($demande->etatDemande)->pel_valider === 1 &&
                                                            optional($demande->etatDemande)->dsv_valider === 1 &&
                                                            optional($demande->etatDemande)->dg_valider === 1 &&
                                                            empty($demande->ordre))
                                                        {{-- <a href="{{ route('dsv.create', $demande->id) }}"
                                                            class="btn btn-primary btn-sm">Generer l'Ordre de
                                                            recette</a> --}}
                                                        <form action="{{ route('dsv.store', $demande) }}" method="POST"
                                                            class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-success btn-sm"
                                                                onclick="return confirm('Confirmer la generation ?')">
                                                                @lang('trans.generate_order')
                                                            </button>
                                                        </form>
                                                    @endif
                                                    @if (optional($demande->paiement)->statut === 'Payé' &&
                                                            optional($demande->etatDemande)->dg_signer === 1 &&
                                                            optional($demande->etatDemande)->dsv_signer !== 1)
                                                        <form action="{{ route('dsv.signer', $demande->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-success btn-sm"
                                                                onclick="return confirm('Confirmer la signature ?')">
                                                                @lang('trans.sign')
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
        @if (auth()->user()->hasRole('dsv') && $ordres->isNotEmpty())
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">@lang('trans.orders')</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="ordres">
                                    <thead>
                                        <tr>
                                            <th>@lang('trans.ref')</th>
                                            <th>@lang('trans.applicant')</th>
                                            <th>@lang('trans.date')</th>
                                            <th>@lang('trans.amount')</th>
                                            <th>@lang('trans.status')</th>

                                            <th>@lang('trans.actions')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ordres as $ordre)
                                            <tr>
                                                <td>{{ $ordre->reference }}</td>
                                                <td>{{ $ordre->demande->code }}</td>
                                                <td>{{ $ordre->date_ordre }}</td>
                                                <td>{{ $ordre->montant }}</td>

                                                <td>{{ $ordre->statut }}</td>

                                                <td>

                                                    @if ($ordre->statut !== 'Validé')
                                                        <form action="{{ route('dsv.ordre.valider', $ordre) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-success btn-sm"
                                                                onclick="return confirm('Confirmer la validation ?')">
                                                                @lang('trans.validate')
                                                            </button>
                                                        </form>

                                                        <form action="{{ route('dsv.ordre.destroy', $ordre) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Confirmer la suppression ?')">
                                                                @lang('trans.destroy')
                                                            </button>
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
        @endif


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
