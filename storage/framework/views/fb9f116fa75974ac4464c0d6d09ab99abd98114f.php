
<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('trans.dashboard_admin'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheader'); ?>
    <?php echo app('translator')->get('trans.dashboard_admin'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheaderlink'); ?>
    <a href="">
        <?php echo app('translator')->get('trans.dashboard_admin'); ?> </a>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheaderactive'); ?>
    <?php echo app('translator')->get('trans.dashboard_admin'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><?php echo app('translator')->get('trans.applicants'); ?></div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="demandes">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('trans.id'); ?></th>
                                        <th><?php echo app('translator')->get('trans.applicant'); ?></th>
                                        <th><?php echo app('translator')->get('trans.type_application'); ?></th>
                                        <th><?php echo app('translator')->get('trans.type_license'); ?></th>
                                        <th><?php echo app('translator')->get('trans.status'); ?></th>
                                        <th><?php echo app('translator')->get('trans.actions'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $demandes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $demande): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($demande->code); ?></td>
                                            <td><?php echo e($demande->demandeur->np); ?></td>
                                            <td><?php echo e(LaravelLocalization::getCurrentLocale() == 'fr' ? optional($demande->typeDemande)->nom_fr : optional($demande->typeDemande)->nom_en); ?>

                                            </td>
                                            <td><?php echo e($demande->typeLicence->nom); ?></td>
                                            <td><?php echo e($demande->status); ?></td>
                                            <td>


                                                <?php if(auth()->user()->hasRole('admin')): ?>
                                                    <?php if(optional($demande->etatDemande)->demandeur_cree_demande === 1): ?>
                                                        <a href="<?php echo e(route('demandes.show', $demande->id)); ?>"
                                                            class="btn btn-info btn-sm"><?php echo app('translator')->get('trans.view'); ?></a>
                                                    <?php endif; ?>
                                                    <?php if(optional($demande->etatDemande)->dg_annoter === 1 &&
                                                            optional($demande->etatDemande)->dg_rejeter !== 1 &&
                                                            optional($demande->etatDemande)->dsv_annoter === 1 &&
                                                            optional($demande->etatDemande)->dsv_rejeter !== 1 &&
                                                            optional($demande->etatDemande)->pel_annoter !== 1): ?>
                                                        <form action="<?php echo e(route('admin.annoter', $demande->id)); ?>"
                                                            method="POST" class="d-inline">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PATCH'); ?>
                                                            <button type="submit" class="btn btn-success btn-sm"
                                                                onclick="return confirm('Confirmer l\' annotation vers SECTIONS (Section de médecine aéronautique et Licence aéronautique)   ?')">
                                                                <?php echo app('translator')->get('trans.annotate'); ?>
                                                            </button>
                                                        </form>
                                                    <?php endif; ?>
                                                    <?php if(optional($demande->etatDemande)->sl_valider === 1 &&
                                                            optional($demande->etatDemande)->sm_valider === 1 &&
                                                            optional($demande->etatDemande)->pel_valider !== 1): ?>
                                                        <form action="<?php echo e(route('admin.valider', $demande->id)); ?>"
                                                            method="POST" class="d-inline">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PATCH'); ?>
                                                            <button type="submit" class="btn btn-success btn-sm"
                                                                onclick="return confirm('Confirmer la validation ?')">
                                                                <?php echo app('translator')->get('trans.validate'); ?>
                                                            </button>
                                                        </form>
                                                    <?php endif; ?>
                                                    <?php if(optional($demande->paiement)->statut === 'Payé' &&
                                                            optional($demande->etatDemande)->dg_signer === 1 &&
                                                            optional($demande->typeDemande)->id === 1): ?>
                                                        <form action="<?php echo e(route('admin.generer', $demande->id)); ?>"
                                                            method="POST" class="d-inline">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PATCH'); ?>
                                                            <button type="submit" class="btn btn-success btn-sm"
                                                                onclick="return confirm('Generer la licence ?')">
                                                                <?php echo app('translator')->get('trans.generate_license'); ?>
                                                            </button>
                                                        </form>
                                                    <?php endif; ?>
                                                    <?php if(optional($demande->paiement)->statut === 'Payé' &&
                                                            optional($demande->etatDemande)->dsv_signer === 1 &&
                                                            optional($demande->typeDemande)->id !== 1): ?>
                                                        <form action="<?php echo e(route('admin.generer', $demande->id)); ?>"
                                                            method="POST" class="d-inline">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PATCH'); ?>
                                                            <button type="submit" class="btn btn-primary btn-sm"
                                                                onclick="return confirm('Mis a jour de la licence ?')">
                                                                <?php echo app('translator')->get('trans.update_license'); ?>
                                                            </button>
                                                        </form>
                                                    <?php endif; ?>
                                                <?php endif; ?>

                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('assets/admin/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('custom'); ?>
    <script>
        $(function() {
            $('#demandes').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "columnDefs": [{
                        "targets": 5,
                        "orderable": false
                    },
                    {
                        "targets": 3,
                        "searchable": true
                    }
                ]

            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lapto\OneDrive\Documents\laravel\anac\resources\views/admin/demandes/index.blade.php ENDPATH**/ ?>