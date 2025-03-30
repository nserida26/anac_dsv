
<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('trans.dashboard_admin'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheader'); ?>
    <?php echo app('translator')->get('trans.dashboard_admin'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheaderlink'); ?>
    <a href="">
        <?php echo app('translator')->get('trans.dashboard_admin'); ?> </a>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheaderactive'); ?>
    <?php echo app('translator')->get('trans.dashboard_admin'); ?>
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
                    <div class="card-header"><?php echo app('translator')->get('trans.licences'); ?></div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="licences">
                                <thead>
                                    <tr>

                                        <th><?php echo app('translator')->get('trans.category'); ?></th>
                                        <th><?php echo app('translator')->get('trans.type'); ?></th>
                                        <th><?php echo app('translator')->get('trans.license_number'); ?></th>
                                        <th><?php echo app('translator')->get('trans.fl_name'); ?></th>
                                        <th><?php echo app('translator')->get('trans.dob'); ?></th>
                                        <th><?php echo app('translator')->get('trans.address'); ?></th>
                                        <th><?php echo app('translator')->get('trans.nationality'); ?></th>
                                        <th><?php echo app('translator')->get('trans.actions'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $licences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $licence): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($licence->categorie_licence); ?></td>
                                            <td><?php echo e($licence->type_licence); ?></td>
                                            <td><?php echo e($licence->numero_licence); ?></td>
                                            <td><?php echo e($licence->np); ?></td>
                                            <td><?php echo e($licence->date_naissance); ?></td>
                                            <td><?php echo e($licence->adresse); ?></td>
                                            <td><?php echo e(strtoupper($licence->nationalite)); ?></td>
                                            <td>
                                                <a href="<?php echo e(route('licences.show', $licence)); ?>"
                                                    class="btn btn-info btn-sm">View</a>
                                                <?php if(!$licence->licence_valide): ?>
                                                    <form action="<?php echo e(route('licences.valider', $licence)); ?>" method="POST"
                                                        class="d-inline">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('PATCH'); ?>
                                                        <button type="submit" class="btn btn-primary btn-sm"
                                                            onclick="return confirm('Confirmer la validation de la licence ?')"><?php echo app('translator')->get('trans.validate'); ?></button>
                                                    </form>
                                                <?php endif; ?>
                                                <?php if($licence->licence_valide): ?>
                                                    <form action="<?php echo e(route('licences.bloquer', $licence)); ?>" method="POST"
                                                        class="d-inline">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('PATCH'); ?>
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Confirmer la révocation  de la licence ?')"><?php echo app('translator')->get('trans.revoke'); ?></button>
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
            $('#licences').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "columnDefs": [{
                        "targets": 7,
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lapto\OneDrive\Documents\laravel\anac\resources\views/admin/licences/index.blade.php ENDPATH**/ ?>