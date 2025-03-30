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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><?php echo app('translator')->get('trans.update_medical_fitness'); ?></div>
                    <div class="card-body">



                        <!-- Formulaire -->
                        <form action="<?php echo e(route('evaluateur.update', $examen)); ?>" method="POST"
                            enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>

                            <div class="mb-3">
                                <label class="form-label"><?php echo app('translator')->get('trans.medical_fitness_by_evaluator'); ?></label>
                                <input type="number" min="0" name="validite_evaluateur" class="form-control"
                                    value="<?php echo e($examen->validite); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><?php echo app('translator')->get('trans.report_by_evaluator'); ?></label>
                                <textarea name="rapport_evaluateur" class="form-control summernote"></textarea>
                            </div>



                            <button type="submit" class="btn btn-success"><?php echo app('translator')->get('trans.update'); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('custom'); ?>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 200, // Set height of the editor
                placeholder: 'Enter your text...',

            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('evaluateur.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lapto\OneDrive\Documents\laravel\anac\resources\views/evaluateur/edit.blade.php ENDPATH**/ ?>