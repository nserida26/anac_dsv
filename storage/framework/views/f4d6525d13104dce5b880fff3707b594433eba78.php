<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('trans.dashboard'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheader'); ?>
    <?php echo app('translator')->get('trans.dashboard'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheaderlink'); ?>
    <a href="<?php echo e(route('examinateur')); ?>">
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
                    <div class="card-header"><?php echo app('translator')->get('trans.add_medical_fitness'); ?></div>
                    <div class="card-body">
                        <!-- Formulaire -->
                        <form action="<?php echo e(route('examinateur.store')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="examinateur_id" value="<?php echo e($examinateur->id); ?>">
                            <input type="hidden" name="demandeur_id" value="<?php echo e($demandeur->id); ?>">

                            <div class="mb-3">
                                <label class="form-label"><?php echo app('translator')->get('trans.exam_date'); ?></label>
                                <input type="date" name="date_examen" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><?php echo app('translator')->get('trans.validity'); ?></label>
                                <input type="number" min="0" name="validite" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><?php echo app('translator')->get('trans.medical_fitness'); ?></label>
                                <select name="aptitude" class="form-control" required>
                                    <option value="Apte"><?php echo app('translator')->get('trans.fit'); ?></option>
                                    <option value="Inapte"><?php echo app('translator')->get('trans.unfit'); ?></option>
                                </select>
                            </div>


                            <div class="mb-3">
                                <label class="form-label"><?php echo app('translator')->get('trans.report'); ?></label>
                                <textarea name="rapport" class="form-control summernote" rows="3"></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label"><?php echo app('translator')->get('trans.certificate'); ?></label>
                                <input type="file" name="attestation" class="form-control" accept="application/pdf"
                                    required>
                            </div>

                            <button type="submit" class="btn btn-success"><?php echo app('translator')->get('trans.send'); ?></button>
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

<?php echo $__env->make('examinateur.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lapto\OneDrive\Documents\laravel\anac\resources\views/examinateur/create.blade.php ENDPATH**/ ?>