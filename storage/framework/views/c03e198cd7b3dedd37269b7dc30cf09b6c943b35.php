<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('daf.dashboard'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheader'); ?>
    <?php echo app('translator')->get('daf.dashboard'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheaderlink'); ?>
    <a href="<?php echo e(route('daf')); ?>">
        <?php echo app('translator')->get('daf.dashboard'); ?> </a>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheaderactive'); ?>
    <?php echo app('translator')->get('daf.dashboard'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css'); ?>
    <style>
        #documentViewer {
            width: 210mm;
            height: 297mm;
            max-width: 100%;
            /* Makes it responsive */
            display: block;
            margin: auto;
            /* Center horizontally */
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>

    <div class="container">
        <h1></h1>
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <?php echo app('translator')->get('daf.paiement'); ?>
                    </div>
                    <div class="card-body">
                        <?php if(isset($paiement)): ?>
                            <div class="row justify-content-center">

                                <div class="col-lg-9">
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <th><?php echo app('translator')->get('daf.reference'); ?></th>
                                            <td><?php echo e($paiement->reference ?? '-'); ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo app('translator')->get('daf.demande'); ?></th>
                                            <td><?php echo e($paiement->demande->code ?? '-'); ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo app('translator')->get('daf.demandeur'); ?></th>
                                            <td><?php echo e($paiement->demande->demandeur->np ?? '-'); ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo app('translator')->get('daf.montant'); ?></th>
                                            <td><?php echo e($paiement->montant ?? '-'); ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo app('translator')->get('daf.statut'); ?></th>
                                            <td><?php echo e($paiement->statut ?? '-'); ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo app('translator')->get('daf.date_paiement'); ?></th>
                                            <td><?php echo e($paiement->date_paiement ?? '-'); ?></td>
                                        </tr>


                                        <tr>
                                            <th><?php echo app('translator')->get('daf.quittance'); ?></th>
                                            <td class="text-center">
                                                <?php if(isset($paiement->quittance) && $paiement->quittance != ''): ?>
                                                    <button class="btn btn-primary"
                                                        onclick="openPdfModal('<?php echo e(asset('/uploads/' . $paiement->quittance)); ?>')"><i
                                                            class="fas fa-eye"></i></button>
                                                <?php else: ?>
                                                    -
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>



                            </div>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('custom'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('daf.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lapto\OneDrive\Documents\laravel\anac\resources\views/daf/show.blade.php ENDPATH**/ ?>