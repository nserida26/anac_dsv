<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('trans.dashboard'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheader'); ?>
    <?php echo app('translator')->get('trans.dashboard'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheaderlink'); ?>
    <a href="<?php echo e(route('evaluateur')); ?>">
        <?php echo app('translator')->get('trans.dashboard'); ?> </a>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheaderactive'); ?>
    <?php echo app('translator')->get('trans.dashboard'); ?>
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
                        <?php echo app('translator')->get('trans.exams'); ?>
                    </div>
                    <div class="card-body">
                        <?php if(isset($examen)): ?>
                            <div class="row justify-content-center">

                                <div class="col-lg-9">
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <th><?php echo app('translator')->get('trans.fl_name'); ?></th>
                                            <td><?php echo e($examen->demandeur->np ?? '-'); ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo app('translator')->get('trans.dob'); ?></th>
                                            <td><?php echo e($examen->demandeur->date_naissance ?? '-'); ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo app('translator')->get('trans.lieu_naissance'); ?></th>
                                            <td><?php echo e($examen->demandeur->lieu_naissance ?? '-'); ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo app('translator')->get('trans.address'); ?></th>
                                            <td><?php echo e($examen->demandeur->adresse ?? '-'); ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo app('translator')->get('trans.exam_date'); ?></th>
                                            <td><?php echo e($examen->date_examen ?? '-'); ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo app('translator')->get('trans.medical_fitness'); ?></th>
                                            <td><?php echo e($examen->aptitude ?? '-'); ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo app('translator')->get('trans.report'); ?></th>
                                            <td><?php echo $examen->rapport ?? '-'; ?></td>
                                        </tr>

                                        <tr>
                                            <th><?php echo app('translator')->get('trans.certificate'); ?></th>
                                            <td class="text-center">
                                                <?php if(isset($examen->attestation) && $examen->attestation != ''): ?>
                                                    <button class="btn btn-primary"
                                                        onclick="openPdfModal('<?php echo e(asset('/uploads/' . $examen->attestation)); ?>')"><i
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

<?php echo $__env->make('evaluateur.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lapto\OneDrive\Documents\laravel\anac\resources\views/evaluateur/show.blade.php ENDPATH**/ ?>