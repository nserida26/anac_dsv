
<?php $__env->startSection('title'); ?>
    500
<?php $__env->stopSection(); ?>


<?php $__env->startPush('css'); ?>
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/plugins/select2/css/select2.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="error-page">
        <h2 class="headline text-danger">500</h2>

        <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-danger"></i> Oops! Something went wrong.</h3>

            <p>
                <a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo app('translator')->get('sidebar.dashboard'); ?></a>
            </p>
        </div>
    </div>
    <!-- /.error-page -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <!-- Select2 -->
    <script src="<?php echo e(asset('assets/admin/plugins/select2/js/select2.full.min.js')); ?>"></script>
    <!-- dropzonejs -->
    <!-- Page specific script -->
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

        });
    </script>
    <script type="text/javascript"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lapto\OneDrive\Documents\laravel\anac\resources\views/errors/500.blade.php ENDPATH**/ ?>