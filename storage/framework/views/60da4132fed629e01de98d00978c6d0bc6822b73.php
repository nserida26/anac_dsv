
<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('user.dashboard'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheader'); ?>
    <?php echo app('translator')->get('user.dashboard'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheaderlink'); ?>
    <a href="<?php echo e(route('user')); ?>">
        <?php echo app('translator')->get('user.dashboard'); ?> </a>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheaderactive'); ?>
    <?php echo app('translator')->get('user.dashboard'); ?>
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
                        <h3 class="card-title">Créer un Demande</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="<?php echo e(route('user.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="objet_licence">Phase</label>
                                        <select class="form-control" id="objet_licence" name="objet_licence" placeholder="">
                                            <option value="Delivrance">Délivrance</option>
                                            <option value="Renouvellement">Renouvellement</option>
                                            <option value="Validation">Validation</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="type_licence">Type de licence</label>
                                        <select class="form-control" id="type_licence" name="type_licence" placeholder="">
                                            <option value="PPL">PPL - Private Pilot License (Pilote privé)</option>
                                            <option value="CPL">CPL - Commercial Pilot License (Pilote commercial)
                                            </option>
                                            <option value="ATPL">ATPL - Airline Transport Pilot License (Pilote de ligne)
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="specialite">Spécialité</label>
                                        <select class="form-control" id="specialite" name="specialite" placeholder="">
                                            <option value="Avion">Avion</option>
                                            <option value="Helicoptere">Hélicoptère</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-lg-4">
                                    <button type="submit" class="btn btn-success">Créer</button>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('user.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lapto\OneDrive\Documents\laravel\anac\resources\views/user/create.blade.php ENDPATH**/ ?>