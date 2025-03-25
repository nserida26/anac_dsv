@extends('sec.layouts.app')
@section('title')
    @lang('sec.dashboard')
@endsection
@section('contentheader')
    @lang('sec.dashboard')
@endsection
@section('contentheaderlink')
    <a href="">
        @lang('sec.dashboard') </a>
@endsection
@section('contentheaderactive')
    @lang('sec.dashboard')
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
                                        @if (auth()->user()->hasRole('sla'))
                                            <th>Formations</th>
                                        @endif
                                        @if (auth()->user()->hasRole('sma'))
                                            <th>Examens</th>
                                        @endif
                                        <th>Actions</th>
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
                                                    @if ($demande->demandeur->formations)
                                                        <span class="badge badge-primary">
                                                            OUI
                                                        </span>
                                                    @else
                                                        <span class="badge badge-danger">
                                                            NON
                                                        </span>
                                                    @endif
                                                </td>
                                            @endif
                                            @if (auth()->user()->hasRole('sma'))
                                                <td>
                                                    @if ($demande->demandeur->examens)
                                                        <span class="badge badge-primary">
                                                            OUI
                                                        </span>
                                                    @else
                                                        <span class="badge badge-danger">
                                                            NON
                                                        </span>
                                                    @endif
                                                </td>
                                            @endif

                                            <td>


                                                @if (auth()->user()->hasRole('sla'))
                                                    @if (optional($demande->etatDemande)->demandeur_cree_demande === 1)
                                                        <a href="{{ route('sla.show', $demande->id) }}"
                                                            class="btn btn-info btn-sm">View</a>
                                                    @endif
                                                    @if (optional($demande->etatDemande)->dg_annoter === 1 &&
                                                            optional($demande->etatDemande)->dg_rejeter !== 1 &&
                                                            optional($demande->etatDemande)->dsv_annoter === 1 &&
                                                            optional($demande->etatDemande)->dsv_rejeter !== 1 &&
                                                            optional($demande->etatDemande)->pel_annoter === 1 &&
                                                            optional($demande->etatDemande)->sl_valider !== 1)
                                                        <!-- motif de rejet-->
                                                        <form action="{{ route('sla.valider', $demande->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-success btn-sm"
                                                                onclick="return confirm('Confirmer la validation de dossier de licence ?')">
                                                                Valider
                                                            </button>
                                                        </form>
                                                    @endif
                                                @endif
                                                @if (auth()->user()->hasRole('sma'))
                                                    @if (optional($demande->etatDemande)->demandeur_cree_demande === 1)
                                                        <a href="{{ route('sma.show', $demande->id) }}"
                                                            class="btn btn-info btn-sm">View</a>
                                                    @endif
                                                    @if (optional($demande->etatDemande)->dg_annoter === 1 &&
                                                            optional($demande->etatDemande)->dg_rejeter !== 1 &&
                                                            optional($demande->etatDemande)->dsv_annoter === 1 &&
                                                            optional($demande->etatDemande)->dsv_rejeter !== 1 &&
                                                            optional($demande->etatDemande)->pel_annoter === 1 &&
                                                            optional($demande->etatDemande)->sm_valider !== 1)
                                                        {{-- &&
                                                            optional($demande->demandeur->examens)->isNotEmpty() --}}
                                                        <form action="{{ route('sma.valider', $demande->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-success btn-sm"
                                                                onclick="return confirm('Confirmer la validation de dossier medical ?')">
                                                                Valider
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
                                                        <form action="{{ route('sma.annoter', $demande->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-warning btn-sm"
                                                                onclick="return confirm('Confirmer l\' annotation vers Evaluateur ?')">
                                                                Annoter
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
