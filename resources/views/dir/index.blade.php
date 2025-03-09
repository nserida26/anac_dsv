@extends('dir.layouts.app')
@section('title')
    @lang('dir.dashboard')
@endsection
@section('contentheader')
    @lang('dir.dashboard')
@endsection
@section('contentheaderlink')
    <a href="">
        @lang('dir.dashboard') </a>
@endsection
@section('contentheaderactive')
    @lang('dir.dashboard')
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
                    <div class="card-header">@lang('user.demandes')</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="demandes">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Demandeur</th>
                                        <th>Phase</th>
                                        <th>Type de licence</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($demandes as $demande)
                                        <tr>
                                            <td>{{ $demande->code }}</td>
                                            <td>{{ $demande->demandeur->np }}</td>
                                            <td>{{ $demande->objet_licence }}</td>
                                            <td>{{ $demande->type_licence }}</td>
                                            <td>{{ $demande->status }}</td>
                                            <td>


                                                @if (auth()->user()->hasRole('dg'))
                                                    @if (optional($demande->etatDemande)->demandeur_cree_demande === 1)
                                                        <a href="{{ route('dg.show', $demande->id) }}"
                                                            class="btn btn-info btn-sm">View</a>
                                                    @endif


                                                    @if (optional($demande->etatDemande)->dg_annoter !== 1 && optional($demande->etatDemande)->dg_rejeter !== 1)
                                                        <form action="{{ route('dg.annoter', $demande->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-success btn-sm"
                                                                onclick="return confirm('Confirmer l\' annotation vers DSV ?')">
                                                                Annoter
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('dg.rejeter', $demande->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Confirmer le rejeter ?')">
                                                                Rejeter
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
                                                                Valider
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
                                                                Signer
                                                            </button>
                                                        </form>
                                                    @endif
                                                @endif


                                                @if (auth()->user()->hasRole('dsv'))
                                                    @if (optional($demande->etatDemande)->demandeur_cree_demande === 1)
                                                        <a href="{{ route('dsv.show', $demande->id) }}"
                                                            class="btn btn-info btn-sm">View</a>
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
                                                                Annoter
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('dsv.rejeter', $demande->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Confirmer le rejeter ?')">
                                                                Rejeter
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
                                                                Valider
                                                            </button>
                                                        </form>
                                                    @endif


                                                    @if (optional($demande->etatDemande)->sl_valider === 1 &&
                                                            optional($demande->etatDemande)->sm_valider === 1 &&
                                                            optional($demande->etatDemande)->pel_valider === 1 &&
                                                            optional($demande->etatDemande)->dsv_valider === 1 &&
                                                            optional($demande->etatDemande)->dg_valider === 1 &&
                                                            optional($demande->ordre)->statut !== 'Généré')
                                                        <a href="{{ route('dsv.create', $demande->id) }}"
                                                            class="btn btn-primary btn-sm">Generer l'Ordre de recette</a>
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
                                                                Signer
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
        @if (auth()->user()->hasRole('dsv') && !empty($ordres))
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">@lang('dir.ordres')</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="ordres">
                                    <thead>
                                        <tr>
                                            <th>Reference</th>
                                            <th>Demande</th>
                                            <th>Date recette</th>
                                            <th>Montant</th>
                                            <th>Status</th>
                                            <th>Document</th>
                                            <th>Actions</th>
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
                                                    <a target="_blank" href="{{ asset('/uploads/' . $ordre->ordre) }}"
                                                        class="btn btn-primary btn-sm">
                                                        <i class="fas fa-download"></i>
                                                    </a>
                                                </td>
                                                <td>

                                                    @if ($ordre->statut !== 'Validé')
                                                        <a href="{{ route('dsv.edit', $ordre) }}"
                                                            class="btn btn-primary btn-sm">Edit</a>
                                                        <form action="{{ route('dsv.ordre.valider', $ordre) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-success btn-sm"
                                                                onclick="return confirm('Confirmer la validation ?')">
                                                                Valider
                                                            </button>
                                                        </form>

                                                        <form action="{{ route('dsv.ordre.destroy', $ordre) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Confirmer la suppression ?')">
                                                                Supprimer
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
