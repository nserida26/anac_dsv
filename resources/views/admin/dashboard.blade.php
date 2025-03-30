@extends('layouts.admin')
@section('title')
    @lang('trans.dashboard_admin')
@endsection
@section('contentheader')
    @lang('trans.dashboard_admin')
@endsection
@section('contentheaderlink')
    <a href="{{ route('dashboard') }}">
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
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <!--<div class="card-header bg-primary text-white">
                                        Statistiques des Demandes
                                    </div>-->

                    <div class="card-body">

                        <!-- Affichage du nombre de demandeurs -->
                        <div class="alert alert-info">
                            @lang('trans.total_applicants') : <strong id="nombreDemandeurs">0</strong>
                        </div>

                        <!-- Graphique des demandes par jour -->
                        <canvas id="chartJour" width="400" height="200"></canvas>
                        <br>

                        <!-- Graphique des demandes par mois -->
                        <canvas id="chartMois" width="400" height="200"></canvas>
                        <br>

                        <!-- Graphique des demandes par année -->
                        <canvas id="chartAnnee" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
@endpush
@push('custom')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetch("{{ route('dashboard.data') }}")
                .then(response => response.json())
                .then(data => {
                    document.getElementById('nombreDemandeurs').innerText = data.nombreDemandeurs;

                    const labelsJour = data.demandesParJour.map(d => d.date);
                    const traiteeJour = data.demandesParJour.map(d => d.traitees);
                    const nonTraiteeJour = data.demandesParJour.map(d => d.non_traitees);

                    const labelsMois = data.demandesParMois.map(d => d.mois);
                    const traiteeMois = data.demandesParMois.map(d => d.traitees);
                    const nonTraiteeMois = data.demandesParMois.map(d => d.non_traitees);

                    const labelsAnnee = data.demandesParAnnee.map(d => d.annee);
                    const traiteeAnnee = data.demandesParAnnee.map(d => d.traitees);
                    const nonTraiteeAnnee = data.demandesParAnnee.map(d => d.non_traitees);

                    function renderChart(canvasId, labels, dataTraitees, dataNonTraitees, labelX) {
                        new Chart(document.getElementById(canvasId), {
                            type: 'bar',
                            data: {
                                labels: labels,
                                datasets: [{
                                        label: 'Demandes Traitées',
                                        backgroundColor: 'green',
                                        data: dataTraitees
                                    },
                                    {
                                        label: 'Demandes Non Traitées',
                                        backgroundColor: 'red',
                                        data: dataNonTraitees
                                    }
                                ]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    x: {
                                        title: {
                                            display: true,
                                            text: labelX
                                        }
                                    },
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    }

                    renderChart('chartJour', labelsJour, traiteeJour, nonTraiteeJour, 'Date');
                    renderChart('chartMois', labelsMois, traiteeMois, nonTraiteeMois, 'Mois');
                    renderChart('chartAnnee', labelsAnnee, traiteeAnnee, nonTraiteeAnnee, 'Année');
                });
        });
    </script>
@endpush
