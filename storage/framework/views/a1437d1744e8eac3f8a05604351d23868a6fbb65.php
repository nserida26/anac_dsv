
<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('trans.dashboard_center'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheader'); ?>
    <?php echo app('translator')->get('trans.dashboard_center'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheaderlink'); ?>
    <a href="<?php echo e(route('centre')); ?>">
        <?php echo app('translator')->get('trans.dashboard_center'); ?> </a>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheaderactive'); ?>
    <?php echo app('translator')->get('trans.dashboard_center'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><?php echo app('translator')->get('trans.add_training'); ?></div>
                    <div class="card-body">
                        <!-- Formulaire -->
                        <form action="<?php echo e(route('centre.store')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="centre_formation_id" value="<?php echo e($centre->id); ?>">
                            <input type="hidden" name="demandeur_id" value="<?php echo e($demandeur->id); ?>">
                            <div class="mb-3">
                                <label class="form-label"><?php echo app('translator')->get('trans.training_type'); ?></label>
                                <select class="form-control" name="type_formation_id">
                                    <?php $__currentLoopData = $type_formations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type_formation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($type_formation->id); ?>">
                                            <?php echo e($type_formation->nom); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>

                            </div>
                            <div class="mb-3">
                                <label class="form-label"><?php echo app('translator')->get('trans.training_date'); ?></label>
                                <input type="date" name="date_formation" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><?php echo app('translator')->get('trans.location'); ?></label>
                                <input type="text" class="form-control" id="lieu" name="lieu">
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><?php echo app('translator')->get('trans.certificate'); ?></label>
                                <input type="file" name="attestation" class="form-control" accept="application/pdf"
                                    required>
                            </div>


                            <button type="submit" class="btn btn-success"><?php echo app('translator')->get('trans.save'); ?></button>
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

<?php echo $__env->make('centre.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lapto\OneDrive\Documents\laravel\anac\resources\views/centre/create.blade.php ENDPATH**/ ?>