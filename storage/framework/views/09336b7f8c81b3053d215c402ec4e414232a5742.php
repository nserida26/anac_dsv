
<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('trans.dashboard'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheader'); ?>
    <?php echo app('translator')->get('trans.dashboard'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheaderlink'); ?>
    <a href="">
        <?php echo app('translator')->get('trans.dashboard'); ?> </a>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheaderactive'); ?>
    <?php echo app('translator')->get('trans.dashboard'); ?>
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
                                        <th>ID</th>
                                        <th><?php echo app('translator')->get('trans.applicant'); ?></th>
                                        <th><?php echo app('translator')->get('trans.type_application'); ?></th>
                                        <th><?php echo app('translator')->get('trans.type_license'); ?></th>
                                        <th><?php echo app('translator')->get('trans.status'); ?></th>
                                        <?php if(auth()->user()->hasRole('sla')): ?>
                                            <th><?php echo app('translator')->get('trans.training'); ?></th>
                                        <?php endif; ?>
                                        <?php if(auth()->user()->hasRole('sma')): ?>
                                            <th><?php echo app('translator')->get('trans.exams'); ?></th>
                                        <?php endif; ?>
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
                                            <?php if(auth()->user()->hasRole('sla')): ?>
                                                <td>
                                                    <?php if($demande->demandeur->formations->isNotEmpty()): ?>
                                                        <span class="badge badge-primary">
                                                            <?php echo app('translator')->get('trans.yes'); ?>
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="badge badge-danger">
                                                            <?php echo app('translator')->get('trans.no'); ?>
                                                        </span>
                                                    <?php endif; ?>
                                                </td>
                                            <?php endif; ?>
                                            <?php if(auth()->user()->hasRole('sma')): ?>
                                                <td>
                                                    <?php if($demande->demandeur->examens->isNotEmpty()): ?>
                                                        <span class="badge badge-primary">
                                                            <?php echo app('translator')->get('trans.yes'); ?>
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="badge badge-danger">
                                                            <?php echo app('translator')->get('trans.no'); ?>
                                                        </span>
                                                    <?php endif; ?>
                                                </td>
                                            <?php endif; ?>
                                            <td>
                                                <?php if(auth()->user()->hasRole('sla')): ?>
                                                    <?php if(optional($demande->etatDemande)->demandeur_cree_demande === 1): ?>
                                                        <a href="<?php echo e(route('sla.show', $demande->id)); ?>"
                                                            class="btn btn-info btn-sm"><?php echo app('translator')->get('trans.view'); ?></a>
                                                    <?php endif; ?>
                                                    <?php if(optional($demande->etatDemande)->dg_annoter === 1 &&
                                                            optional($demande->etatDemande)->dg_rejeter !== 1 &&
                                                            optional($demande->etatDemande)->dsv_annoter === 1 &&
                                                            optional($demande->etatDemande)->dsv_rejeter !== 1 &&
                                                            optional($demande->etatDemande)->pel_annoter === 1 &&
                                                            optional($demande->etatDemande)->sl_valider !== 1): ?>
                                                        <form action="<?php echo e(route('sla.valider', $demande->id)); ?>"
                                                            method="POST" class="d-inline">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PATCH'); ?>
                                                            <button type="submit" class="btn btn-success btn-sm"
                                                                onclick="return confirm('<?php echo app('translator')->get('trans.confirm_license_validation'); ?>')">
                                                                <?php echo app('translator')->get('trans.validate'); ?>
                                                            </button>
                                                        </form>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <?php if(auth()->user()->hasRole('sma')): ?>
                                                    <?php if(optional($demande->etatDemande)->demandeur_cree_demande === 1): ?>
                                                        <a href="<?php echo e(route('sma.show', $demande->id)); ?>"
                                                            class="btn btn-info btn-sm"><?php echo app('translator')->get('trans.view'); ?></a>
                                                    <?php endif; ?>
                                                    <?php if(optional($demande->etatDemande)->dg_annoter === 1 &&
                                                            optional($demande->etatDemande)->dg_rejeter !== 1 &&
                                                            optional($demande->etatDemande)->dsv_annoter === 1 &&
                                                            optional($demande->etatDemande)->dsv_rejeter !== 1 &&
                                                            optional($demande->etatDemande)->pel_annoter === 1 &&
                                                            optional($demande->etatDemande)->sm_valider !== 1): ?>
                                                        <form action="<?php echo e(route('sma.valider', $demande->id)); ?>"
                                                            method="POST" class="d-inline">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PATCH'); ?>
                                                            <button type="submit" class="btn btn-success btn-sm"
                                                                onclick="return confirm('<?php echo app('translator')->get('trans.confirm_medical_validation'); ?>')">
                                                                <?php echo app('translator')->get('trans.validate'); ?>
                                                            </button>
                                                        </form>
                                                    <?php endif; ?>
                                                    <?php if(optional($demande->etatDemande)->dg_annoter === 1 &&
                                                            optional($demande->etatDemande)->dg_rejeter !== 1 &&
                                                            optional($demande->etatDemande)->dsv_annoter === 1 &&
                                                            optional($demande->etatDemande)->dsv_rejeter !== 1 &&
                                                            optional($demande->etatDemande)->pel_annoter === 1 &&
                                                            optional($demande->etatDemande)->sm_valider !== 1 &&
                                                            optional($demande->etatDemande)->evaluateur_annoter !== 1): ?>
                                                        <button type="button" class="btn btn-warning btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#annotationModal-<?php echo e($demande->id); ?>">
                                                            <?php echo app('translator')->get('trans.annotate_btn'); ?>
                                                        </button>
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
    <div class="modal fade" id="annotationModal-<?php echo e($demande->id); ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?php echo e(route('sma.annoter', $demande->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>

                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo app('translator')->get('trans.annotate_to_evaluator'); ?></h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="evaluateur-<?php echo e($demande->id); ?>" class="form-label"><?php echo app('translator')->get('trans.select_evaluator'); ?></label>
                            <select class="form-control" id="evaluateur-<?php echo e($demande->user_id); ?>" name="evaluateur_id"
                                required>
                                <option value=""><?php echo app('translator')->get('trans.choose'); ?></option>
                                <?php $__currentLoopData = $evaluateurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $evaluateur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($evaluateur->user_id); ?>"><?php echo e($evaluateur->np); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo app('translator')->get('trans.cancel'); ?></button>
                        <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('trans.annotate'); ?></button>
                    </div>
                </form>
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

<?php echo $__env->make('sec.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lapto\OneDrive\Documents\laravel\anac\resources\views/sec/index.blade.php ENDPATH**/ ?>