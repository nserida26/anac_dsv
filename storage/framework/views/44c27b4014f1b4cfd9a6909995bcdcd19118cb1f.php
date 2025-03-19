<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('examinateur.dashboard'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheader'); ?>
    <?php echo app('translator')->get('examinateur.dashboard'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheaderlink'); ?>
    <a href="">
        <?php echo app('translator')->get('examinateur.dashboard'); ?> </a>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheaderactive'); ?>
    <?php echo app('translator')->get('examinateur.dashboard'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><?php echo app('translator')->get('compagnie.demandeurs'); ?>
                        <div class="card-tools">
                            <!-- Buttons, labels, and many other things can be placed here! -->
                            <!-- Here is a label for example -->
                            <span class="badge badge-primary">Situation financière
                                : <?php echo e($compagnie->panier); ?></span>
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
                                    <?php $__currentLoopData = $demandeurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $demandeur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($demandeur->id); ?></td>
                                            <td><img src="<?php echo e(asset('/uploads/' . $demandeur->photo)); ?>" width="64"
                                                    height="64" class="card-img-top img-cover" alt=""></td>
                                            <td><?php echo e($demandeur->np); ?></td>

                                            <td><?php echo e($demandeur->date_naissance); ?></td>
                                            <td><?php echo e($demandeur->adresse); ?></td>
                                            <td>
                                                <?php if($demandeur->valider_compagnie): ?>
                                                    <button class="btn btn-info btn-sm toggle-btn"
                                                        data-target="demandeur-<?php echo e($demandeur->id); ?>">
                                                        Voir Demandes
                                                    </button>
                                                <?php endif; ?>
                                                <?php if(!$demandeur->valider_compagnie): ?>
                                                    <form action="<?php echo e(route('compagnie.valider', $demandeur)); ?>"
                                                        method="POST" class="d-inline">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('PATCH'); ?>
                                                        <button type="submit" class="btn btn-success btn-sm"
                                                            onclick="return confirm('Confirmer la validation ?')">
                                                            Valider
                                                        </button>
                                                    </form>
                                                <?php endif; ?>

                                            </td>
                                            <!-- Lignes cachées des demandes du demandeur -->
                                        <tr id="demandeur-<?php echo e($demandeur->id); ?>" class="toggle-row" style="display: none;">
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
                                                        <?php $__currentLoopData = $demandeur->demandes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $demande): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr>
                                                                <td><?php echo e($demande->code); ?></td>
                                                                <td><?php echo e($demande->demandeur->np); ?></td>
                                                                <td><?php echo e($demande->objet_licence); ?></td>
                                                                <td><?php echo e($demande->type_licence); ?></td>
                                                                <td><?php echo e($demande->status); ?></td>
                                                                <td>
                                                                    <?php if(!empty($demande->paiement)): ?>
                                                                        <button class="btn btn-warning btn-sm toggle-btn"
                                                                            data-target="paiements-<?php echo e($demande->id); ?>">
                                                                            Voir Paiements
                                                                        </button>
                                                                    <?php endif; ?>

                                                                </td>
                                                            </tr>
                                                            <!-- Lignes cachées des paiements liés à la demande -->
                                                            <tr id="paiements-<?php echo e($demande->id); ?>" class="toggle-row"
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
                                                                                <td><?php echo e(optional($demande->paiement)->reference); ?>

                                                                                </td>
                                                                                <td><?php echo e(number_format(optional($demande->paiement)->montant, 2)); ?>

                                                                                </td>
                                                                                <td><?php echo e(optional($demande->paiement)->statut); ?>

                                                                                </td>

                                                                                <td><?php echo e(optional($demande->paiement)->date_paiement ? date('d-m-Y', strtotime(optional($demande->paiement)->date_paiement)) : '-'); ?>

                                                                                </td>
                                                                                <td>
                                                                                    <?php if($demande->paiement && $demande->paiement->statut === 'En attente'): ?>
                                                                                        <a href="<?php echo e(route('compagnie.pay', $demande->paiement)); ?>"
                                                                                            class="btn btn-warning btn-sm">Payer</a>
                                                                                    <?php endif; ?>
                                                                                </td>
                                                                            </tr>

                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>

                            </table>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('assets/admin/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('custom'); ?>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('examinateur.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lapto\OneDrive\Documents\laravel\anac\resources\views/compagnie/index.blade.php ENDPATH**/ ?>