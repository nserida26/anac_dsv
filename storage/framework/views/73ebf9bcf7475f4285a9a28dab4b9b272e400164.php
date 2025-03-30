
<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('trans.dashboard'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheader'); ?>
    <?php echo app('translator')->get('trans.dashboard'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheaderlink'); ?>
    <a href="<?php echo e(route('licences')); ?>">
        <?php echo app('translator')->get('trans.dashboard'); ?> </a>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheaderactive'); ?>
    <?php echo app('translator')->get('trans.dashboard'); ?>
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
                                            <th><?php echo app('translator')->get('trans.category'); ?></th>
                                            <td><?php echo e($licence->categorie_licence ?? '-'); ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo app('translator')->get('trans.machine'); ?></th>
                                            <td><?php echo e($licence->machine_licence ?? '-'); ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo app('translator')->get('trans.type'); ?></th>
                                            <td><?php echo e($licence->type_licence ?? '-'); ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo app('translator')->get('trans.license_number'); ?></th>
                                            <td><?php echo e($licence->numero_licence ?? '-'); ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo app('translator')->get('trans.fl_name'); ?></th>
                                            <td><?php echo e($licence->np ?? '-'); ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo app('translator')->get('trans.dob'); ?></th>
                                            <td><?php echo e(!empty($licence->date_naissance) ? date('Y-m-d', strtotime($licence->date_naissance)) : '-'); ?>

                                            </td>

                                        </tr>
                                        <tr>
                                            <th><?php echo app('translator')->get('trans.address'); ?></th>
                                            <td><?php echo e($licence->adresse ?? '-'); ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo app('translator')->get('trans.signature'); ?></th>
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
                                            <th><?php echo app('translator')->get('trans.deliverance_date'); ?></th>
                                            <td><?php echo e(!empty($licence->date_deliverance) ? date('Y-m-d', strtotime($licence->date_deliverance)) : '-'); ?>

                                            </td>
                                        </tr>
                                        <tr>
                                            <th><?php echo app('translator')->get('trans.update_date'); ?></th>
                                            <td><?php echo e(!empty($licence->date_mise_a_jour) ? date('Y-m-d', strtotime($licence->date_mise_a_jour)) : '-'); ?>

                                            </td>
                                        </tr>
                                        <tr>
                                            <th><?php echo app('translator')->get('trans.expiration_date'); ?></th>
                                            <td><?php echo e(!empty($licence->date_expiration) ? date('Y-m-d', strtotime($licence->date_expiration)) : '-'); ?>

                                            </td>
                                        </tr>
                                        <tr>
                                            <th><?php echo app('translator')->get('trans.stamp'); ?></th>
                                            <td class="text-center">
                                                <?php if(isset($licence->cachet) && $licence->cachet != ''): ?>
                                                    <img src="<?php echo e(asset('/uploads/' . $licence->cachet)); ?>" alt="User Signature"
                                                        class="img-thumbnail" width="120">
                                                <?php else: ?>
                                                    -
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th><?php echo app('translator')->get('trans.signature_dg'); ?></th>
                                            <td class="text-center">
                                                <?php if(isset($licence->signature_dg) && $licence->signature_dg != ''): ?>
                                                    <img src="<?php echo e(asset('/uploads/' . $licence->signature_dg)); ?>"
                                                        alt="User Signature" class="img-thumbnail" width="120">
                                                <?php else: ?>
                                                    -
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th><?php echo app('translator')->get('trans.signature_dsv'); ?></th>
                                            <td class="text-center">
                                                <?php if(isset($licence->signature_dsv) && $licence->signature_dsv != ''): ?>
                                                    <img src="<?php echo e(asset('/uploads/' . $licence->signature_dsv)); ?>"
                                                        alt="User Signature" class="img-thumbnail" width="120">
                                                <?php else: ?>
                                                    -
                                                <?php endif; ?>
                                            </td>
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