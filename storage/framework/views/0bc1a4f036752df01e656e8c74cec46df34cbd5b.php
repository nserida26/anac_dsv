<?php $__env->startSection('content'); ?>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title"><?php echo e(__('Show')); ?> Type Document</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="<?php echo e(route('type-documents.index')); ?>"> <?php echo e(__('Back')); ?></a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Type Licence :</strong>
                            <?php echo e($typeDocument->typeLicence->nom); ?>

                        </div>
                        <div class="form-group">
                            <strong>Type Demande :</strong>
                            <?php echo e($typeDocument->typeDemande->nom_fr); ?>

                        </div>
                        <div class="form-group">
                            <strong>Nom Fr:</strong>
                            <?php echo e($typeDocument->nom_fr); ?>

                        </div>
                        <div class="form-group">
                            <strong>Nom En:</strong>
                            <?php echo e($typeDocument->nom_en); ?>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lapto\OneDrive\Documents\laravel\anac\resources\views/admin/type-documents/show.blade.php ENDPATH**/ ?>