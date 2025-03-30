<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('trans.dashboard'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheader'); ?>
    <?php echo app('translator')->get('trans.dashboard'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheaderlink'); ?>
    <a href="">
        <?php echo app('translator')->get('trans.dashboard'); ?> </a>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheaderactive'); ?>
    <?php echo app('translator')->get('trans.dashboard'); ?>
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
                    <div class="card-header"><?php echo app('translator')->get('trans.orders'); ?></div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="ordres">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('trans.ref'); ?></th>
                                        <th><?php echo app('translator')->get('trans.application'); ?></th>
                                        <th><?php echo app('translator')->get('trans.date'); ?></th>
                                        <th><?php echo app('translator')->get('trans.amount'); ?></th>
                                        <th><?php echo app('translator')->get('trans.status'); ?></th>
                                        <th><?php echo app('translator')->get('trans.actions'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $ordres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ordre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($ordre->reference); ?></td>
                                            <td><?php echo e($ordre->demande->code); ?></td>
                                            <td><?php echo e($ordre->date_ordre); ?></td>
                                            <td><?php echo e($ordre->montant); ?></td>

                                            <td><?php echo e($ordre->statut); ?></td>
                                            <td>

                                                <?php if($ordre->statut === 'Validé' && empty($ordre->demande->facture)): ?>
                                                    <a href="<?php echo e(route('daf.create', $ordre)); ?>"
                                                        class="btn btn-primary btn-sm"><?php echo app('translator')->get('trans.bill'); ?></a>
                                                <?php endif; ?>


                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                    <div class="card-header"><?php echo app('translator')->get('trans.invoices'); ?></div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="factures">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('trans.ref'); ?></th>
                                        <th><?php echo app('translator')->get('trans.application'); ?></th>
                                        <th><?php echo app('translator')->get('trans.date'); ?></th>
                                        <th><?php echo app('translator')->get('trans.end_date'); ?></th>
                                        <th><?php echo app('translator')->get('trans.amount'); ?></th>
                                        <th><?php echo app('translator')->get('trans.status'); ?></th>
                                        <th><?php echo app('translator')->get('trans.actions'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $factures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $facture): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($facture->reference); ?></td>
                                            <td><?php echo e($facture->demande->code); ?></td>
                                            <td><?php echo e($facture->date_facture); ?></td>
                                            <td><?php echo e($facture->date_limite); ?></td>
                                            <td><?php echo e($facture->montant); ?></td>

                                            <td><?php echo e($facture->statut); ?></td>
                                            <td>

                                                <?php if($facture->statut !== 'Confirmée'): ?>
                                                    <a href="<?php echo e(route('daf.edit', $facture)); ?>"
                                                        class="btn btn-primary btn-sm">Edit</a>
                                                    <form action="<?php echo e(route('daf.valider', $facture)); ?>" method="POST"
                                                        class="d-inline">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('PATCH'); ?>
                                                        <button type="submit" class="btn btn-success btn-sm"
                                                            onclick="return confirm('Confirmer la validation ?')">
                                                            <?php echo app('translator')->get('trans.validate'); ?>
                                                        </button>
                                                    </form>

                                                    <form action="<?php echo e(route('daf.destroy', $facture)); ?>" method="POST"
                                                        class="d-inline">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Confirmer la suppression ?')">
                                                            <?php echo app('translator')->get('trans.destroy'); ?>
                                                        </button>
                                                    </form>
                                                <?php endif; ?>


                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                    <div class="card-header"><?php echo app('translator')->get('trans.paiements'); ?></div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="paiements">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('trans.ref'); ?></th>
                                        <th><?php echo app('translator')->get('trans.application'); ?></th>
                                        <th><?php echo app('translator')->get('trans.date'); ?></th>

                                        <th><?php echo app('translator')->get('trans.amount'); ?></th>
                                        <th><?php echo app('translator')->get('trans.status'); ?></th>
                                        <th><?php echo app('translator')->get('trans.actions'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $paiements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paiement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($paiement->reference); ?></td>
                                            <td><?php echo e($paiement->demande->code); ?></td>
                                            <td><?php echo e($paiement->date_paiement); ?></td>

                                            <td><?php echo e($paiement->montant); ?></td>

                                            <td><?php echo e($paiement->statut); ?></td>
                                            <td>

                                                <?php if($paiement->statut === 'Réglée'): ?>
                                                    <a href="<?php echo e(route('daf.show', $paiement)); ?>"
                                                        class="btn btn-primary btn-sm"><?php echo app('translator')->get('trans.view'); ?></a>
                                                    <form action="<?php echo e(route('daf.valider_paiement', $paiement)); ?>"
                                                        method="POST" class="d-inline">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('PATCH'); ?>
                                                        <button type="submit" class="btn btn-success btn-sm"
                                                            onclick="return confirm('Confirmer la paiement ?')">
                                                            <?php echo app('translator')->get('trans.confirm'); ?>
                                                        </button>
                                                    </form>
                                                <?php endif; ?>


                                            </td>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('daf.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lapto\OneDrive\Documents\laravel\anac\resources\views/daf/index.blade.php ENDPATH**/ ?>