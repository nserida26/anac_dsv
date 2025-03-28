
<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('dir.dashboard'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheader'); ?>
    <?php echo app('translator')->get('dir.dashboard'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheaderlink'); ?>
    <a href="">
        <?php echo app('translator')->get('dir.dashboard'); ?> </a>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheaderactive'); ?>
    <?php echo app('translator')->get('dir.dashboard'); ?>
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
                    <div class="card-header"><?php echo app('translator')->get('user.demandes'); ?></div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="demandes">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Demandeur</th>
                                        <th>Phase</th>
                                        <th>Type de licence</th>
                                        <th>Status</th>
                                        <?php if(auth()->user()->hasRole('dg')): ?>
                                            <th>#</th>
                                        <?php endif; ?>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $demandes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $demande): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($demande->code); ?></td>
                                            <td><?php echo e(optional($demande->demandeur)->np); ?></td>
                                            <td><?php echo e(LaravelLocalization::getCurrentLocale() == 'fr' ? optional($demande->typeDemande)->nom_fr : optional($demande->typeDemande)->nom_en); ?>

                                            </td>
                                            <td><?php echo e($demande->typeLicence->nom); ?></td>
                                            <td><?php echo e($demande->status); ?></td>
                                            <?php if(auth()->user()->hasRole('dg')): ?>
                                                <td>

                                                    <?php if($demande->etatDemande->dsv_dg_annoter): ?>
                                                        <span class="badge badge-primary">Annoter par DSV</span>
                                                    <?php endif; ?>
                                                    <?php if($demande->etatDemande->dsv_dg_valider): ?>
                                                        <span class="badge badge-primary">Valider par DSV</span>
                                                    <?php endif; ?>
                                                    <?php if($demande->etatDemande->dsv_dg_signer): ?>
                                                        <span class="badge badge-primary">Signer par DSV</span>
                                                    <?php endif; ?>


                                                </td>
                                            <?php endif; ?>

                                            <td>


                                                <?php if(auth()->user()->hasRole('dg')): ?>
                                                    <?php if(optional($demande->etatDemande)->demandeur_cree_demande === 1): ?>
                                                        <a href="<?php echo e(route('dg.show', $demande->id)); ?>"
                                                            class="btn btn-info btn-sm">View</a>
                                                    <?php endif; ?>

                                                    <?php if(optional($demande->etatDemande)->dg_annoter !== 1 && optional($demande->etatDemande)->dg_rejeter !== 1): ?>
                                                        <form action="<?php echo e(route('dg.annoter', $demande->id)); ?>"
                                                            method="POST" class="d-inline">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PATCH'); ?>
                                                            <button type="submit" class="btn btn-success btn-sm"
                                                                onclick="return confirm('Confirmer l\' annotation vers DSV ?')">
                                                                Annoter
                                                            </button>
                                                        </form>
                                                        <form action="<?php echo e(route('dg.rejeter', $demande->id)); ?>"
                                                            method="POST" class="d-inline">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PATCH'); ?>
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Confirmer le rejeter ?')">
                                                                Rejeter
                                                            </button>
                                                        </form>
                                                    <?php endif; ?>


                                                    <?php if(optional($demande->etatDemande)->sl_valider === 1 &&
                                                            optional($demande->etatDemande)->sm_valider === 1 &&
                                                            optional($demande->etatDemande)->pel_valider === 1 &&
                                                            optional($demande->etatDemande)->dsv_valider === 1 &&
                                                            optional($demande->etatDemande)->dg_valider !== 1): ?>
                                                        <form action="<?php echo e(route('dg.valider', $demande->id)); ?>"
                                                            method="POST" class="d-inline">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PATCH'); ?>
                                                            <button type="submit" class="btn btn-success btn-sm"
                                                                onclick="return confirm('Confirmer la validation ?')">
                                                                Valider
                                                            </button>
                                                        </form>
                                                    <?php endif; ?>
                                                    <?php if(optional($demande->paiement)->statut === 'Payé' &&
                                                            optional($demande->etatDemande)->dg_signer !== 1 &&
                                                            optional($demande->typeDemande)->id === 1): ?>
                                                        <form action="<?php echo e(route('dg.signer', $demande->id)); ?>"
                                                            method="POST" class="d-inline">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PATCH'); ?>
                                                            <button type="submit" class="btn btn-success btn-sm"
                                                                onclick="return confirm('Confirmer la signature ?')">
                                                                Signer
                                                            </button>
                                                        </form>
                                                    <?php endif; ?>
                                                <?php endif; ?>


                                                <?php if(auth()->user()->hasRole('dsv')): ?>
                                                    <?php if(optional($demande->etatDemande)->demandeur_cree_demande === 1): ?>
                                                        <a href="<?php echo e(route('dsv.show', $demande->id)); ?>"
                                                            class="btn btn-info btn-sm">View</a>
                                                    <?php endif; ?>

                                                    <?php if(optional($demande->etatDemande)->dg_annoter !== 1 && optional($demande->etatDemande)->dg_rejeter !== 1): ?>
                                                        <form action="<?php echo e(route('dg.annoter', $demande->id)); ?>"
                                                            method="POST" class="d-inline">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PATCH'); ?>
                                                            <button type="submit" class="btn btn-success btn-sm"
                                                                onclick="return confirm('Confirmer l\' annotation vers DSV ?')">
                                                                Annoter DSV
                                                            </button>
                                                        </form>
                                                    <?php endif; ?>

                                                    <?php if(optional($demande->etatDemande)->dg_annoter === 1 &&
                                                            optional($demande->etatDemande)->dg_rejeter !== 1 &&
                                                            (optional($demande->etatDemande)->dsv_annoter !== 1 && optional($demande->etatDemande)->dsv_rejeter !== 1)): ?>
                                                        <form action="<?php echo e(route('dsv.annoter', $demande->id)); ?>"
                                                            method="POST" class="d-inline">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PATCH'); ?>
                                                            <button type="submit" class="btn btn-success btn-sm"
                                                                onclick="return confirm('Confirmer l\' annotation vers Service PEL ?')">
                                                                Annoter
                                                            </button>
                                                        </form>
                                                        <form action="<?php echo e(route('dsv.rejeter', $demande->id)); ?>"
                                                            method="POST" class="d-inline">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PATCH'); ?>
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Confirmer le rejeter ?')">
                                                                Rejeter
                                                            </button>
                                                        </form>
                                                    <?php endif; ?>


                                                    <?php if(optional($demande->etatDemande)->sl_valider === 1 &&
                                                            optional($demande->etatDemande)->sm_valider === 1 &&
                                                            optional($demande->etatDemande)->pel_valider === 1 &&
                                                            optional($demande->etatDemande)->dsv_valider !== 1): ?>
                                                        <form action="<?php echo e(route('dsv.valider', $demande->id)); ?>"
                                                            method="POST" class="d-inline">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PATCH'); ?>
                                                            <button type="submit" class="btn btn-success btn-sm"
                                                                onclick="return confirm('Confirmer la validation ?')">
                                                                Valider
                                                            </button>
                                                        </form>
                                                    <?php endif; ?>


                                                    <?php if(optional($demande->etatDemande)->sl_valider === 1 &&
                                                            optional($demande->etatDemande)->sm_valider === 1 &&
                                                            optional($demande->etatDemande)->pel_valider === 1 &&
                                                            optional($demande->etatDemande)->dsv_valider === 1 &&
                                                            optional($demande->etatDemande)->dg_valider === 1 &&
                                                            empty($demande->ordre)): ?>
                                                        
                                                        <form action="<?php echo e(route('dsv.store', $demande)); ?>" method="POST"
                                                            class="d-inline">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PATCH'); ?>
                                                            <button type="submit" class="btn btn-success btn-sm"
                                                                onclick="return confirm('Confirmer la generation ?')">
                                                                Generer l'Ordre de
                                                                recette
                                                            </button>
                                                        </form>
                                                    <?php endif; ?>
                                                    <?php if(optional($demande->paiement)->statut === 'Payé' &&
                                                            //optional($demande->etatDemande)->dg_signer === 1 &&
                                                            optional($demande->etatDemande)->dsv_signer !== 1 &&
                                                            optional($demande->typeDemande)->id !== 1): ?>
                                                        <form action="<?php echo e(route('dsv.signer', $demande->id)); ?>"
                                                            method="POST" class="d-inline">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PATCH'); ?>
                                                            <button type="submit" class="btn btn-success btn-sm"
                                                                onclick="return confirm('Confirmer la signature ?')">
                                                                Signer
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
        <?php if(auth()->user()->hasRole('dsv') && !empty($ordres)): ?>
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header"><?php echo app('translator')->get('dir.ordres'); ?></div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="ordres">
                                    <thead>
                                        <tr>
                                            <th>Reference</th>
                                            <th>Demande</th>
                                            <th>Date recette</th>
                                            <th>Montant</th>
                                            <th>Status</th>

                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $ordres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ordre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($ordre->reference); ?></td>
                                                <td><?php echo e($ordre->demande->code); ?></td>
                                                <td><?php echo e($ordre->date_ordre); ?></td>
                                                <td><?php echo e($ordre->montant); ?></td>

                                                <td><?php echo e($ordre->statut); ?></td>

                                                <td>

                                                    <?php if($ordre->statut !== 'Validé'): ?>
                                                        <form action="<?php echo e(route('dsv.ordre.valider', $ordre)); ?>"
                                                            method="POST" class="d-inline">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PATCH'); ?>
                                                            <button type="submit" class="btn btn-success btn-sm"
                                                                onclick="return confirm('Confirmer la validation ?')">
                                                                Valider
                                                            </button>
                                                        </form>

                                                        <form action="<?php echo e(route('dsv.ordre.destroy', $ordre)); ?>"
                                                            method="POST" class="d-inline">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('DELETE'); ?>
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Confirmer la suppression ?')">
                                                                Supprimer
                                                            </button>
                                                        </form>
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
        <?php endif; ?>


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

<?php echo $__env->make('dir.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lapto\OneDrive\Documents\laravel\anac\resources\views/dir/index.blade.php ENDPATH**/ ?>