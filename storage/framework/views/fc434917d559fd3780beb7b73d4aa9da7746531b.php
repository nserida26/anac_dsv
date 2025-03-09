<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('examinateur.dashboard'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheader'); ?>
    <?php echo app('translator')->get('examinateur.dashboard'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheaderlink'); ?>
    <a href="">
        <?php echo app('translator')->get('examinateur.dashboard'); ?> </a>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheaderactive'); ?>
    <?php echo app('translator')->get('examinateur.dashboard'); ?>
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
                    <div class="card-header"><?php echo app('translator')->get('examinateur.demandes'); ?></div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="demandes">
                                <thead>
                                    <tr>
                                        <th>ID</th>

                                        <th>Photo</th>
                                        <th>Nom et Prenom</th>
                                        <th>Date de naissance </th>
                                        <th>Adresse</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $demandeurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $demandeur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($demandeur->id); ?></td>
                                            <td><img src="<?php echo e(asset('/uploads/' . $demandeur->photo)); ?>" width="64"
                                                    height="64" class="card-img-top img-cover" alt=""></td>
                                            <td><?php echo e($demandeur->np); ?></td>

                                            <td><?php echo e($demandeur->date_naissance); ?></td>
                                            <td><?php echo e($demandeur->adresse); ?></td>
                                            <td>


                                                <a href="<?php echo e(route('centre.create', $demandeur)); ?>"
                                                    class="btn btn-primary btn-sm">Create</a>

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
        <?php if($formations): ?>
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header"><?php echo app('translator')->get('examinateur.formations'); ?></div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Type de formation</th>
                                            <th>Demandeur</th>

                                            <th>Centre</th>
                                            <th>Lieu</th>
                                            <th>Date</th>
                                            <th>Attestation</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $formations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($formation->id); ?></td>
                                                <td><?php echo e($formation->typeFormation->nom); ?></td>
                                                <td><?php echo e($formation->demandeur->np); ?></td>
                                                <td><?php echo e($formation->centreFormation->libelle); ?></td>
                                                <td><?php echo e($formation->lieu); ?></td>
                                                <td><?php echo e($formation->date_formation); ?></td>
                                                <td>
                                                    <a target="_blank"
                                                        href="<?php echo e(asset('/uploads/' . $formation->attestation)); ?>"
                                                        class="btn btn-primary btn-sm">
                                                        <i class="fas fa-download"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-warning btn-sm toggle-edit"
                                                        data-id="<?php echo e($formation->id); ?>">
                                                        Modifier
                                                    </button>
                                                    <form action="<?php echo e(route('centre.destroy', $formation)); ?>" method="POST"
                                                        class="d-inline">
                                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <!-- Formulaire caché pour modifier la formation -->
                                            <tr id="edit-form-<?php echo e($formation->id); ?>" class="edit-form-row"
                                                style="display: none;">
                                                <td colspan="7">
                                                    <form action="<?php echo e(route('centre.update', $formation->id)); ?>"
                                                        method="POST" class="edit-form" enctype="multipart/form-data">
                                                        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label>Type de Formation </label>
                                                                <select name="type_formation_id" class="form-control">
                                                                    <?php $__currentLoopData = $type_formations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($type->id); ?>"
                                                                            <?php echo e($type->id == $formation->type_formation_id ? 'selected' : ''); ?>>
                                                                            <?php echo e($type->nom); ?>

                                                                        </option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </div>

                                                            <div class="col-md-2">
                                                                <label>Lieu </label>
                                                                <input type="text" name="lieu" class="form-control"
                                                                    value="<?php echo e($formation->lieu); ?>" required>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label>Date </label>
                                                                <input type="date" name="date_formation"
                                                                    class="form-control"
                                                                    value="<?php echo e($formation->date_formation); ?>" required>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label>Attestation (PDF)</label>
                                                                <input type="file" name="attestation"
                                                                    class="form-control" accept="application/pdf" required>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <br>
                                                                <button type="submit"
                                                                    class="btn btn-success btn-sm">Enregistrer</button>
                                                                <button type="button"
                                                                    class="btn btn-secondary btn-sm cancel-edit"
                                                                    data-id="<?php echo e($formation->id); ?>">
                                                                    Annuler
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
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
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.toggle-edit').forEach(button => {
                button.addEventListener('click', function() {
                    let id = this.getAttribute('data-id');
                    let row = document.getElementById("edit-form-" + id);
                    row.style.display = row.style.display === "none" ? "table-row" : "none";
                });
            });

            document.querySelectorAll('.cancel-edit').forEach(button => {
                button.addEventListener('click', function() {
                    let id = this.getAttribute('data-id');
                    document.getElementById("edit-form-" + id).style.display = "none";
                });
            });
        });
    </script>
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
            $('#formations').DataTable({
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

<?php echo $__env->make('examinateur.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lapto\OneDrive\Documents\laravel\anac\resources\views/centre/index.blade.php ENDPATH**/ ?>