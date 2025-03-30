
<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('trans.dashboard'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheader'); ?>
    <?php echo app('translator')->get('trans.dashboard'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheaderlink'); ?>
    <a href="<?php echo e(route('user')); ?>">
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
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo app('translator')->get('trans.add_application'); ?></h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="<?php echo e(route('user.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="type_demande_id"><?php echo app('translator')->get('trans.type_application'); ?></label>
                                        <select class="form-control" id="type_demande_id" name="type_demande_id"
                                            placeholder="">
                                            <?php $__currentLoopData = $type_demandes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type_demande): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($type_demande->id); ?>"><?php echo e($type_demande->nom_fr); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="type_licence_id"><?php echo app('translator')->get('trans.type_license'); ?></label>
                                        <select class="form-control" id="type_licence_id" name="type_licence_id"
                                            placeholder="">
                                            <?php $__currentLoopData = $type_licences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type_licence): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($type_licence->id); ?>">
                                                    <?php echo e($type_licence->nom); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-success float-right"><?php echo app('translator')->get('trans.send'); ?></button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->


                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('custom'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const typeDemandeSelect = document.getElementById('type_demande_id');
            const typeLicenceSelect = document.getElementById('type_licence_id');

            // Options à cacher (ATE et ATC)
            const optionsToHide = ['ATE', 'ATC'];

            function updateLicenceOptions() {
                const selectedDemande = typeDemandeSelect.value;

                // Activer toutes les options
                Array.from(typeLicenceSelect.options).forEach(option => {
                    option.disabled = false;
                });


                if (selectedDemande === '7') {
                    Array.from(typeLicenceSelect.options).forEach(option => {
                        if (optionsToHide.includes(option.text)) {
                            option.disabled = true;
                        }
                    });
                }
            }
            typeDemandeSelect.addEventListener('change', updateLicenceOptions);
            updateLicenceOptions();
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('user.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lapto\OneDrive\Documents\laravel\anac\resources\views/user/create.blade.php ENDPATH**/ ?>