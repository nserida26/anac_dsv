
<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('user.users'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheader'); ?>
    <?php echo app('translator')->get('user.users'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheaderlink'); ?>
    <a href="<?php echo e(route('users.index')); ?>"> <?php echo app('translator')->get('sidebar.users'); ?> </a>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheaderactive'); ?>
    <?php echo app('translator')->get('user.users'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">


        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Create Role</div>
                <div class="card-body">
                    <form action="<?php echo e(route('roles.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <label for="name">Role Name</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                        <button type="submit" class="btn btn-warning">Create Role</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lapto\OneDrive\Documents\laravel\anac\resources\views/admin/roles/create.blade.php ENDPATH**/ ?>