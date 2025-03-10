@extends('daf.layouts.app')
@section('title')
    @lang('daf.dashboard')
@endsection
@section('contentheader')
    @lang('daf.dashboard')
@endsection
@section('contentheaderlink')
    <a href="">
        @lang('daf.dashboard') </a>
@endsection
@section('contentheaderactive')
    @lang('daf.dashboard')
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
                    <div class="card-header">@lang('daf.ordres')</div>
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

                                                @if ($ordre->statut === 'Validé')
                                                    <a href="{{ route('daf.create', $ordre) }}"
                                                        class="btn btn-primary btn-sm">Facturer</a>
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
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">@lang('dir.factures')</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="factures">
                                <thead>
                                    <tr>
                                        <th>Reference</th>
                                        <th>Demande</th>
                                        <th>Date de facture</th>
                                        <th>Date de limite</th>
                                        <th>Montant</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($factures as $facture)
                                        <tr>
                                            <td>{{ $facture->reference }}</td>
                                            <td>{{ $facture->demande->code }}</td>
                                            <td>{{ $facture->date_facture }}</td>
                                            <td>{{ $facture->date_limite }}</td>
                                            <td>{{ $facture->montant }}</td>

                                            <td>{{ $facture->statut }}</td>
                                            <td>

                                                @if ($facture->statut !== 'Confirmée')
                                                    <a href="{{ route('daf.edit', $facture) }}"
                                                        class="btn btn-primary btn-sm">Edit</a>
                                                    <form action="{{ route('daf.valider', $facture) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-success btn-sm"
                                                            onclick="return confirm('Confirmer la validation ?')">
                                                            Valider
                                                        </button>
                                                    </form>

                                                    <form action="{{ route('daf.destroy', $facture) }}" method="POST"
                                                        class="d-inline">
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
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">@lang('dir.paiements')</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="paiements">
                                <thead>
                                    <tr>
                                        <th>Reference</th>
                                        <th>Demande</th>
                                        <th>Date de paiement</th>

                                        <th>Montant</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($paiements as $paiement)
                                        <tr>
                                            <td>{{ $paiement->reference }}</td>
                                            <td>{{ $paiement->demande->code }}</td>
                                            <td>{{ $paiement->date_paiement }}</td>

                                            <td>{{ $paiement->montant }}</td>

                                            <td>{{ $paiement->statut }}</td>
                                            <td>

                                                @if ($paiement->statut === 'Réglée')
                                                    <a href="{{ route('daf.show', $paiement) }}"
                                                        class="btn btn-primary btn-sm">Show</a>
                                                    <form action="{{ route('daf.valider_paiement', $paiement) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-success btn-sm"
                                                            onclick="return confirm('Confirmer la paiement ?')">
                                                            Confirmer
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
            $('#ordres').DataTable({
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
                }]

            });
            $('#factures').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "columnDefs": [{
                    "targets": 6,
                    "orderable": false
                }]

            });
            $('#paiements').DataTable({
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
                }]

            });
        });
    </script>
@endpush
