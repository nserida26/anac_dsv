
<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('compagnie.dashboard'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheader'); ?>
    <?php echo app('translator')->get('compagnie.dashboard'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheaderlink'); ?>
    <a href="<?php echo e(route('compagnie')); ?>">
        <?php echo app('translator')->get('compagnie.dashboard'); ?> </a>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheaderactive'); ?>
    <?php echo app('translator')->get('compagnie.dashboard'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Paiement</div>
                    <div class="card-body">
                        <!-- Formulaire -->
                        <form action="<?php echo e(route('compagnie.update', $paiement)); ?>" method="POST"
                            enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>

                            <input type="hidden" name="paiement_id" value="<?php echo e($paiement->id); ?>">

                            <div class="mb-3">
                                <label class="form-label">Date paiement</label>
                                <input type="date" name="date_paiement" class="form-control"
                                    value="<?php echo e($paiement->date_paiement); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Quittance(PDF)</label>
                                <input type="file" name="quittance" class="form-control" accept="application/pdf"
                                    required>
                            </div>

                            <button type="submit" class="btn btn-success">Enregistrer</button>
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

<?php echo $__env->make('compagnie.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lapto\OneDrive\Documents\laravel\anac\resources\views/compagnie/pay.blade.php ENDPATH**/ ?>