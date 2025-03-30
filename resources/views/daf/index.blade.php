@extends('daf.layouts.app')
@section('title')
    @lang('trans.dashboard_dir')
@endsection
@section('contentheader')
    @lang('trans.dashboard_dir')
@endsection
@section('contentheaderlink')
    <a href="">
        @lang('trans.dashboard_dir') </a>
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
                    <div class="card-header">@lang('trans.orders')</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="ordres">
                                <thead>
                                    <tr>
                                        <th>@lang('trans.ref')</th>
                                        <th>@lang('trans.application')</th>
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

                                                @if ($ordre->statut === 'Validé' && empty($ordre->demande->facture))
                                                    <a href="{{ route('daf.create', $ordre) }}"
                                                        class="btn btn-primary btn-sm">@lang('trans.bill')</a>
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
                    <div class="card-header">@lang('trans.invoices')</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="factures">
                                <thead>
                                    <tr>
                                        <th>@lang('trans.ref')</th>
                                        <th>@lang('trans.application')</th>
                                        <th>@lang('trans.date')</th>
                                        <th>@lang('trans.end_date')</th>
                                        <th>@lang('trans.amount')</th>
                                        <th>@lang('trans.status')</th>
                                        <th>@lang('trans.actions')</th>
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
                                                            @lang('trans.validate')
                                                        </button>
                                                    </form>

                                                    <form action="{{ route('daf.destroy', $facture) }}" method="POST"
                                                        class="d-inline">
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
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">@lang('trans.paiements')</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="paiements">
                                <thead>
                                    <tr>
                                        <th>@lang('trans.ref')</th>
                                        <th>@lang('trans.application')</th>
                                        <th>@lang('trans.date')</th>

                                        <th>@lang('trans.amount')</th>
                                        <th>@lang('trans.status')</th>
                                        <th>@lang('trans.actions')</th>
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
                                                        class="btn btn-primary btn-sm">@lang('trans.view')</a>
                                                    <form action="{{ route('daf.valider_paiement', $paiement) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-success btn-sm"
                                                            onclick="return confirm('Confirmer la paiement ?')">
                                                            @lang('trans.confirm')
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
