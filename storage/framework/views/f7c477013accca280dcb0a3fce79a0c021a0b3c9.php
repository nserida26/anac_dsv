<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('trans.dashboard_evaluator'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheader'); ?>
    <?php echo app('translator')->get('trans.dashboard_evaluator'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheaderlink'); ?>
    <a href="">
        <?php echo app('translator')->get('trans.dashboard_evaluator'); ?> </a>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheaderactive'); ?>
    <?php echo app('translator')->get('trans.dashboard_evaluator'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">
    <style>
        #documentViewer {

            width: 105mm;
            height: 148mm;
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
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <?php echo app('translator')->get('trans.medical_fitness'); ?>
                    </div>
                    <div class="card-body">

                        <?php if(isset($medical_examinations)): ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>

                                                <th><?php echo app('translator')->get('trans.exam_date'); ?></th>
                                                <th><?php echo app('translator')->get('trans.validity'); ?></th>
                                                <th><?php echo app('translator')->get('trans.medical_center'); ?></th>
                                                <th> <?php echo app('translator')->get('trans.proof'); ?></th>
                                                <th><?php echo app('translator')->get('trans.actions'); ?> </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $medical_examinations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $medical_examination): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($medical_examination->date_examen); ?></td>
                                                    <td><?php echo e($medical_examination->validite); ?></td>
                                                    <td><?php echo e($medical_examination->centre_medical); ?></td>
                                                    <td>
                                                        <?php if($medical_examination->document): ?>
                                                            <button class="btn btn-primary"
                                                                onclick="openPdfModal('<?php echo e(asset('/uploads/' . $medical_examination->document)); ?>')"><i
                                                                    class="fas fa-eye"></i></button>
                                                        <?php endif; ?>

                                                    </td>
                                                    <td>
                                                        <?php if(!$medical_examination->valider_evaluateur): ?>
                                                            <form
                                                                action="<?php echo e(route('evaluateur.valider', ['table' => 'medical_examinations', 'id' => $medical_examination->id])); ?>"
                                                                method="POST" class="d-inline">
                                                                <?php echo csrf_field(); ?>
                                                                <?php echo method_field('PATCH'); ?>
                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Confirmer la validation de cette  informtion ?')">
                                                                    <?php echo app('translator')->get('trans.validate'); ?>
                                                                </button>
                                                            </form>
                                                        <?php else: ?>
                                                            <?php echo app('translator')->get('trans.validated'); ?>
                                                        <?php endif; ?>

                                                    </td>

                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>
        <?php if($examens->isNotEmpty()): ?>
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header"><?php echo app('translator')->get('trans.exams'); ?></div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="demandes">
                                    <thead>
                                        <tr>
                                            <th><?php echo app('translator')->get('trans.id'); ?></th>
                                            <th><?php echo app('translator')->get('trans.applicant'); ?></th>

                                            <th><?php echo app('translator')->get('trans.exam_date'); ?></th>
                                            <th><?php echo app('translator')->get('trans.medical_fitness'); ?></th>

                                            <th><?php echo app('translator')->get('trans.actions'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $examens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $examen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($examen->id); ?></td>
                                                <td><?php echo e($examen->demandeur->np); ?></td>
                                                <td><?php echo e($examen->date_examen); ?></td>
                                                <td><?php echo e($examen->aptitude); ?></td>

                                                <td>

                                                    <a href="<?php echo e(route('evaluateur.show', $examen)); ?>"
                                                        class="btn btn-info btn-sm"><?php echo app('translator')->get('trans.view'); ?></a>
                                                    <?php if($examen->valider_examinateur && !$examen->valider_evaluateur): ?>
                                                        <a href="<?php echo e(route('evaluateur.edit', $examen)); ?>"
                                                            class="btn btn-primary btn-sm"><?php echo app('translator')->get('trans.edit'); ?></a>

                                                        <form
                                                            action="<?php echo e(route('evaluateur.valider', ['table' => 'examens_medicaux', 'id' => $examen->id])); ?>"
                                                            method="POST" class="d-inline">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PATCH'); ?>
                                                            <button type="submit" class="btn btn-warning btn-sm"
                                                                onclick="return confirm('Confirmer la validation ?')"><?php echo app('translator')->get('trans.validate'); ?></button>
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
        <?php endif; ?>

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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('evaluateur.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lapto\OneDrive\Documents\laravel\anac\resources\views/evaluateur/index.blade.php ENDPATH**/ ?>