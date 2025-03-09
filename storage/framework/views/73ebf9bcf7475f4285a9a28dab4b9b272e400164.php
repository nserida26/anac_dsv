
<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('admin.dashboard'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheader'); ?>
    <?php echo app('translator')->get('admin.dashboard'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheaderlink'); ?>
    <a href="<?php echo e(route('licences')); ?>">
        <?php echo app('translator')->get('admin.dashboard'); ?> </a>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheaderactive'); ?>
    <?php echo app('translator')->get('admin.dashboard'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
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
                        Profile
                    </div>
                    <div class="card-body">
                        <?php if(isset($licence)): ?>
                            <div class="row justify-content-center">

                                <div class="col-lg-9">
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <th><?php echo app('translator')->get('user.categorie_licence'); ?></th>
                                            <td><?php echo e($licence->categorie_licence ?? '-'); ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo app('translator')->get('user.machine_licence'); ?></th>
                                            <td><?php echo e($licence->machine_licence ?? '-'); ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo app('translator')->get('user.type_licence'); ?></th>
                                            <td><?php echo e($licence->type_licence ?? '-'); ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo app('translator')->get('user.numero_licence'); ?></th>
                                            <td><?php echo e($licence->numero_licence ?? '-'); ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo app('translator')->get('user.np'); ?></th>
                                            <td><?php echo e($licence->np ?? '-'); ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo app('translator')->get('user.date_naissance'); ?></th>
                                            <td><?php echo e($licence->date_naissance ?? '-'); ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo app('translator')->get('user.adresse'); ?></th>
                                            <td><?php echo e($licence->adresse ?? '-'); ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo app('translator')->get('user.signature'); ?></th>
                                            <td class="text-center">
                                                <?php if(isset($licence->signature) && $licence->signature != ''): ?>
                                                    <img src="<?php echo e(asset('/uploads/' . $licence->signature)); ?>"
                                                        alt="User Signature" class="img-thumbnail" width="120">
                                                <?php else: ?>
                                                    -
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th><?php echo app('translator')->get('user.date_deliverance'); ?></th>
                                            <td><?php echo e($licence->date_deliverance ?? '-'); ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo app('translator')->get('user.date_mise_a_jour'); ?></th>
                                            <td><?php echo e($licence->date_mise_a_jour ?? '-'); ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo app('translator')->get('user.date_expiration'); ?></th>
                                            <td><?php echo e($licence->date_expiration ?? '-'); ?></td>
                                        </tr>
                                    </table>
                                </div>

                                <!-- Profile Picture -->
                                <div class="col-lg-3 text-center">
                                    <img src="<?php echo e(asset('/uploads/' . ($licence->photo ?? 'default.png'))); ?>"
                                        alt="Profile Picture" class="img-fluid rounded-circle"
                                        style="width: 150px; height: 150px; object-fit: cover;">
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if(
                            (empty($licence->date_deliverance) && empty($licence->date_expiration)) ||
                                (empty($licence->date_mise_a_jour) && empty($licence->date_expiration))): ?>
                            <form action="<?php echo e(route('licences.update', $licence)); ?>" method="POST"
                                enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>

                                <div class="row">
                                    <?php if($licence->demande->objet_licence === 'Delivrance'): ?>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="date_deliverance">Date de delivreance</label>
                                                <input type="date" class="form-control" id="date_deliverance"
                                                    name="date_deliverance" placeholder="">
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if($licence->demande->objet_licence === 'Renouvellement'): ?>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="date_mise_a_jour">Date de mise a jour</label>
                                                <input type="date" class="form-control" id="date_mise_a_jour"
                                                    name="date_mise_a_jour" placeholder="">
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="date_expiration">Date d'expiration</label>
                                            <input type="date" class="form-control" id="date_expiration"
                                                name="date_expiration" placeholder="">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-success float-right"><i
                                                class="fas fa-plus"></i>
                                            Ok</button>
                                    </div>
                                </div>
                            </form>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lapto\OneDrive\Documents\laravel\anac\resources\views/admin/licences/show.blade.php ENDPATH**/ ?>