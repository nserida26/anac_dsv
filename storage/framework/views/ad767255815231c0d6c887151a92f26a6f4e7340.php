<?php $__env->startSection('template_title'); ?>
    <?php echo e($setting->name ?? "{{ __('Show') Setting"); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title"><?php echo e(__('Show')); ?> Setting</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="<?php echo e(route('settings.index')); ?>"> <?php echo e(__('Back')); ?></a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Key:</strong>
                            <?php echo e($setting->key); ?>

                        </div>
                        <div class="form-group">
                            <strong>Value:</strong>
                            <?php echo e($setting->value); ?>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lapto\OneDrive\Documents\laravel\anac\resources\views/admin/settings/show.blade.php ENDPATH**/ ?>