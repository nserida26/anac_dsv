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
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endpush
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">@lang('compagnie.demandeurs')
                        <div class="card-tools">
                            <!-- Buttons, labels, and many other things can be placed here! -->
                            <!-- Here is a label for example -->
                            <span class="badge badge-primary">Situation financière
                                : {{ $compagnie->panier }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="demandeurs">
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
                                            <td><img src="{{ asset('/uploads/' . $demandeur->photo) }}" width="64"
                                                    height="64" class="card-img-top img-cover" alt=""></td>
                                            <td>{{ $demandeur->np }}</td>

                                            <td>{{ $demandeur->date_naissance }}</td>
                                            <td>{{ $demandeur->adresse }}</td>
                                            <td>
                                                @if ($demandeur->valider_compagnie)
                                                    <button class="btn btn-info btn-sm toggle-btn"
                                                        data-target="demandeur-{{ $demandeur->id }}">
                                                        Voir Demandes
                                                    </button>
                                                @endif
                                                @if (!$demandeur->valider_compagnie)
                                                    <form action="{{ route('compagnie.valider', $demandeur) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-success btn-sm"
                                                            onclick="return confirm('Confirmer la validation ?')">
                                                            Valider
                                                        </button>
                                                    </form>
                                                @endif

                                            </td>
                                            <!-- Lignes cachées des demandes du demandeur -->
                                        <tr id="demandeur-{{ $demandeur->id }}" class="toggle-row" style="display: none;">
                                            <td colspan="6">
                                                <table class="table table-sm">
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
                                                        @foreach ($demandeur->demandes as $demande)
                                                            <tr>
                                                                <td>{{ $demande->code }}</td>
                                                                <td>{{ $demande->demandeur->np }}</td>
                                                                <td>{{ $demande->type_demande }}</td>
                                                                <td>{{ $demande->type_licence }}</td>
                                                                <td>{{ $demande->status }}</td>
                                                                <td>
                                                                    @if (!empty($demande->paiement))
                                                                        <button class="btn btn-warning btn-sm toggle-btn"
                                                                            data-target="paiements-{{ $demande->id }}">
                                                                            Voir Paiements
                                                                        </button>
                                                                    @endif

                                                                </td>
                                                            </tr>
                                                            <!-- Lignes cachées des paiements liés à la demande -->
                                                            <tr id="paiements-{{ $demande->id }}" class="toggle-row"
                                                                style="display: none;">
                                                                <td colspan="5">
                                                                    <table class="table table-sm">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Ref</th>
                                                                                <th>Montant</th>

                                                                                <th>Statut</th>
                                                                                <th>Date de Paiement</th>
                                                                                <th>Actions</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>

                                                                            <tr>
                                                                                <td>{{ optional($demande->paiement)->reference }}
                                                                                </td>
                                                                                <td>{{ number_format(optional($demande->paiement)->montant, 2) }}
                                                                                </td>
                                                                                <td>{{ optional($demande->paiement)->statut }}
                                                                                </td>

                                                                                <td>{{ optional($demande->paiement)->date_paiement ? date('d-m-Y', strtotime(optional($demande->paiement)->date_paiement)) : '-' }}
                                                                                </td>
                                                                                <td>
                                                                                    @if ($demande->paiement && $demande->paiement->statut === 'En attente')
                                                                                        <a href="{{ route('compagnie.pay', $demande->paiement) }}"
                                                                                            class="btn btn-warning btn-sm">Payer</a>
                                                                                    @endif
                                                                                </td>
                                                                            </tr>

                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
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
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.toggle-btn').forEach(button => {
                button.addEventListener('click', function() {
                    let targetId = this.getAttribute('data-target');
                    let row = document.getElementById(targetId);
                    if (row.style.display === "none") {
                        row.style.display = "table-row";
                    } else {
                        row.style.display = "none";
                    }
                });
            });
        });
        $(function() {
            $('#demandeurs').DataTable({
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
                ],
            });

        });
    </script>
@endpush
