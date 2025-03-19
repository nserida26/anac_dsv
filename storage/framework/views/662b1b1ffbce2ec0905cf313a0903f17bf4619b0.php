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
    <link rel="stylesheet"
        href="<?php echo e(asset('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><?php echo app('translator')->get('examinateur.demandes'); ?></div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="demandes">
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
                                            <td><img src="<?php echo e(asset('/uploads/' . $demandeur->photo)); ?>" width="64" height="64"
                                                    class="card-img-top img-cover" alt=""></td>
                                            <td><?php echo e($demandeur->np); ?></td>

                                            <td><?php echo e($demandeur->date_naissance); ?></td>
                                            <td><?php echo e($demandeur->adresse); ?></td>
                                            <td>

                                                <a href="<?php echo e(route('examinateur.create', $demandeur)); ?>"
                                                    class="btn btn-info btn-sm">Create</a>

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
                    <div class="card-header"><?php echo app('translator')->get('examinateur.examens'); ?></div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="demandes">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Demandeur</th>

                                        <th>Date Examen</th>
                                        <th>Aptitude</th>

                                        <th>Actions</th>
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

                                                <a href="<?php echo e(route('examinateur.show', $examen)); ?>"
                                                    class="btn btn-info btn-sm">Show</a>
                                                <?php if(!$examen->valider_examinateur): ?>
                                                    <a href="<?php echo e(route('examinateur.edit', $examen)); ?>"
                                                        class="btn btn-primary btn-sm">Edit</a>

                                                    <form action="<?php echo e(route('examinateur.valider', $examen)); ?>" method="POST"
                                                        class="d-inline">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('PATCH'); ?>
                                                        <button type="submit" class="btn btn-warning btn-sm"
                                                            onclick="return confirm('Confirmer la validation ?')">Valider</button>
                                                    </form>
                                                    <form action="<?php echo e(route('examinateur.destroy', $examen)); ?>" method="POST"
                                                        class="d-inline">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
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
        $(function () {
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
<?php echo $__env->make('examinateur.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lapto\OneDrive\Documents\laravel\anac\resources\views/examinateur/index.blade.php ENDPATH**/ ?>