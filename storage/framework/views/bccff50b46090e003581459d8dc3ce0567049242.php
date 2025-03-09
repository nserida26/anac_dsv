
<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('admin.dashboard'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheader'); ?>
    <?php echo app('translator')->get('admin.dashboard'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheaderlink'); ?>
    <a href="<?php echo e(route('dashboard')); ?>">
        <?php echo app('translator')->get('admin.dashboard'); ?> </a>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheaderactive'); ?>
    <?php echo app('translator')->get('admin.dashboard'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
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
                            Nombre total de demandeurs : <strong id="nombreDemandeurs">0</strong>
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
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('custom'); ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetch("<?php echo e(route('dashboard.data')); ?>")
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/a/Documents/anac/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>