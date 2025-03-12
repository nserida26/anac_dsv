
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

                <h4 class="text-center"><?php echo e($demande->type_licence); ?> - <?php echo e($demande->objet_licence); ?></h4>

                
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Licence
                    </div>

                    <div class="card-body">
                        <form id="licenceForm" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" value="<?php echo e($id); ?>" id="demande_id" name="demande_id">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="num_licence">Numéro de licence</label>
                                        <input type="text" class="form-control" id="num_licence" name="num_licence">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="date_licence">Date de licence</label>
                                        <input type="date" class="form-control" id="date_licence" name="date_licence">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="autorite_id">Autorité de délivrance</label>
                                        <select class="form-control" id="autorite_id" name="autorite_id">
                                            <?php $__currentLoopData = $autorites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $autorite): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($autorite->id); ?>"><?php echo e($autorite->libelle); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="lieu_delivrance">Lieu de délivrance</label>
                                        <input type="text" class="form-control" id="lieu_delivrance"
                                            name="lieu_delivrance">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="document">Justificatif</label>
                                        <input type="file" class="form-control" id="document" name="document">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-success float-right"><i class="fas fa-plus"></i>
                                        Submit</button>
                                </div>
                            </div>
                        </form>
                        <br>

                        <?php if(isset($licence_demandeurs)): ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-striped table-bordered" id="licenceTable">
                                        <thead>
                                            <tr>
                                                <th>Date de licence</th>
                                                <th>Numéro de licence</th>
                                                <th>Autorité de délivrance</th>
                                                <th>Lieu</th>
                                                <th>Justificatif</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $licence_demandeurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $licence_demandeur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($licence_demandeur->date_licence); ?></td>
                                                    <td><?php echo e($licence_demandeur->num_licence); ?></td>
                                                    <td><?php echo e($licence_demandeur->autorite->libelle); ?></td>
                                                    <td><?php echo e($licence_demandeur->lieu_delivrance); ?></td>
                                                    <td>
                                                        <a target="_blank"
                                                            href="<?php echo e(asset('/uploads/' . $licence_demandeur->document)); ?>"
                                                            class="btn btn-primary btn-sm">
                                                            <i class="fas fa-download"></i>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <?php if(!$licence_demandeur->valider): ?>
                                                            <button class="btn btn-warning btn-sm edit-licence"
                                                                data-id="<?php echo e($licence_demandeur->id); ?>">Modifier</button>
                                                        <?php endif; ?>
                                                        <button class="btn btn-danger btn-sm delete-licence"
                                                            data-id="<?php echo e($licence_demandeur->id); ?>">Supprimer</button>
                                                    </td>
                                                </tr>

                                                
                                                <tr id="edit-form-licence-<?php echo e($licence_demandeur->id); ?>" style="display: none;">
                                                    <td colspan="6">
                                                        <form id="updateLicenceForm-<?php echo e($licence_demandeur->id); ?>"
                                                            enctype="multipart/form-data">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PUT'); ?>
                                                            <input type="hidden" name="licence_id"
                                                                value="<?php echo e($licence_demandeur->id); ?>">
                                                            <div class="row">
                                                                <div class="col-lg-2">
                                                                    <div class="form-group">
                                                                        <label>Numéro de licence</label>
                                                                        <input type="text" class="form-control"
                                                                            name="num_licence"
                                                                            value="<?php echo e($licence_demandeur->num_licence); ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-2">
                                                                    <div class="form-group">
                                                                        <label>Date de licence</label>
                                                                        <input type="date" class="form-control"
                                                                            name="date_licence"
                                                                            value="<?php echo e($licence_demandeur->date_licence); ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <label>Autorité de délivrance</label>
                                                                        <select class="form-control" name="autorite_id">
                                                                            <?php $__currentLoopData = $autorites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $autorite): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <option value="<?php echo e($autorite->id); ?>"
                                                                                    <?php echo e($licence_demandeur->autorite_id == $autorite->id ? 'selected' : ''); ?>>
                                                                                    <?php echo e($autorite->libelle); ?>

                                                                                </option>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-2">
                                                                    <div class="form-group">
                                                                        <label>Lieu de délivrance</label>
                                                                        <input type="text" class="form-control"
                                                                            name="lieu_delivrance"
                                                                            value="<?php echo e($licence_demandeur->lieu_delivrance); ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <label>Justificatif (Nouveau)</label>
                                                                        <input type="file" class="form-control"
                                                                            name="document">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <button type="submit"
                                                                class="btn btn-primary btn-sm update-licence"
                                                                data-id="<?php echo e($licence_demandeur->id); ?>">Enregistrer</button>
                                                            <button type="button" class="btn btn-secondary btn-sm"
                                                                onclick="toggleEditForm(<?php echo e($licence_demandeur->id); ?>, 'licence')">Annuler</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>


                

                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Formations
                    </div>

                    <div class="card-body">
                        <form id="formationForm" enctype="multipart/form-data" method="POST">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" value="<?php echo e($id); ?>" id="demande_id" name="demande_id">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="date_formation">Date de Formation</label>
                                        <input type="date" class="form-control" id="date_formation"
                                            name="date_formation" placeholder="">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="centre_formation_id">Centre de formation</label>
                                        <select class="form-control" id="centre_formation_id" name="centre_formation_id">
                                            <?php $__currentLoopData = $centre_formations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $centre_formation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($centre_formation->id); ?>">
                                                    <?php echo e($centre_formation->libelle); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="lieu">Lieu</label>
                                        <input type="text" class="form-control" id="lieu" name="lieu"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="document">Justificatif</label>
                                        <input type="file" class="form-control" id="document" name="document"
                                            placeholder="" accept="application/pdf">

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-success float-right"><i
                                            class="fas fa-plus"></i>
                                        Submit</button>
                                </div>
                            </div>
                        </form>
                        <br>

                        <?php if(isset($formation_demandeurs)): ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-striped table-bordered" id="formationTable">
                                        <thead>
                                            <tr>
                                                <th>Date de formation</th>
                                                <th>Centre de formation</th>
                                                <th>Lieu</th>
                                                <th>Justificatif</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $formation_demandeurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formation_demandeur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($formation_demandeur->date_formation); ?></td>
                                                    <td><?php echo e($formation_demandeur->centre_formation); ?></td>
                                                    <td><?php echo e($formation_demandeur->lieu); ?></td>
                                                    <td>
                                                        <a target="_blank"
                                                            href="<?php echo e(asset('/uploads/' . $formation_demandeur->document)); ?>"
                                                            type="button" class="btn btn-primary btn-sm"><i
                                                                class="fas fa-download"></i></a>
                                                    </td>
                                                    <td>
                                                        <?php if(!$formation_demandeur->valider): ?>
                                                            <button class="btn btn-warning btn-sm edit-formation"
                                                                data-id="<?php echo e($formation_demandeur->id); ?>">Modifier</button>
                                                        <?php endif; ?>
                                                        <button class="btn btn-danger btn-sm delete-formation"
                                                            data-id="<?php echo e($formation_demandeur->id); ?>">Supprimer</button>

                                                    </td>
                                                </tr>

                                                
                                                <tr id="edit-form-formation-<?php echo e($formation_demandeur->id); ?>"
                                                    style="display: none;">
                                                    <td colspan="4">
                                                        <form id="updateFormationForm-<?php echo e($formation_demandeur->id); ?>"
                                                            enctype="multipart/form-data">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PUT'); ?>
                                                            <input type="hidden" name="formation_id"
                                                                value="<?php echo e($formation_demandeur->id); ?>">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <label for="edit_date_formation">Date de
                                                                            Formation</label>
                                                                        <input type="date" class="form-control"
                                                                            name="date_formation"
                                                                            value="<?php echo e($formation_demandeur->date_formation); ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <label for="edit_centre_formation_id">Centre de
                                                                            formation</label>
                                                                        <select class="form-control"
                                                                            name="centre_formation_id">
                                                                            <?php $__currentLoopData = $centre_formations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $centre_formation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <option value="<?php echo e($centre_formation->id); ?>"
                                                                                    <?php echo e($formation_demandeur->centre_formation_id == $centre_formation->id ? 'selected' : ''); ?>>
                                                                                    <?php echo e($centre_formation->libelle); ?>

                                                                                </option>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <label for="edit_lieu">Lieu</label>
                                                                        <input type="text" class="form-control"
                                                                            name="lieu"
                                                                            value="<?php echo e($formation_demandeur->lieu); ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <label for="document">Justificatif</label>
                                                                        <input type="file" class="form-control"
                                                                            id="document" name="document" placeholder="">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <button type="submit"
                                                                class="btn btn-primary btn-sm update-formation"
                                                                data-id="<?php echo e($formation_demandeur->id); ?>">Enregistrer</button>
                                                            <button type="button" class="btn btn-secondary btn-sm"
                                                                onclick="toggleEditForm(<?php echo e($formation_demandeur->id); ?>, 'formation')">Annuler</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Qualifications
                    </div>

                    <div class="card-body">
                        <form id="qualificationForm" enctype="multipart/form-data" method="POST">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" value="<?php echo e($id); ?>" id="demande_id" name="demande_id">

                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="qualification_id">Qualifications</label>
                                        <select class="form-control" id="qualification_id" name="qualification_id">
                                            <?php $__currentLoopData = $qualifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $qualification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($qualification->id); ?>"
                                                    data-type="<?php echo e($qualification->libelle); ?>">
                                                    <?php echo e($qualification->libelle); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="date_examen">Date de l'Examen</label>
                                        <input type="date" class="form-control" id="date_examen" name="date_examen">
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="centre_formation_id">Simulateur</label>
                                        <select class="form-control" id="centre_formation_id" name="centre_formation_id">
                                            <?php $__currentLoopData = $centre_formations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $centre_formation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($centre_formation->id); ?>">
                                                    <?php echo e($centre_formation->libelle); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="lieu">Lieu</label>
                                        <input type="text" class="form-control" id="lieu" name="lieu">
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="document">Justificatif</label>
                                        <input type="file" class="form-control" id="document" name="document">
                                    </div>
                                </div>
                            </div>

                            <!-- Champ "Type d'Avion" caché par défaut -->

                            <div class="col-lg-3" id="type_avion_col" style="display: none;">
                                <div class="form-group">
                                    <label for="type_avion_id">Type d'Avion</label>
                                    <select class="form-control" id="type_avion_id" name="type_avion_id">
                                        <?php $__currentLoopData = $type_avions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type_avion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($type_avion->id); ?>">
                                                <?php echo e($type_avion->code); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3" id="type_engine_col" style="display: none;">
                                <div class="form-group">
                                    <label for="type_moteur">Type d'engins</label>
                                    <select class="form-control" id="type_moteur" name="type_moteur">

                                        <option value="SE">
                                            SE
                                        </option>
                                        <option value="ME">
                                            ME
                                        </option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3" id="instructeur_privilege_col" style="display: none;">
                                <div class="form-group">
                                    <label for="type_privilege">Privilege</label>
                                    <select class="form-control" id="type_privilege" name="type_privilege">

                                        <option value="TRI">TRI</option>
                                        <option value="IRI">IRI</option>
                                        <option value="FI">FI</option>
                                        <option value="CRI">CRI</option>
                                        <option value="SFI">SFI</option>
                                        <option value="GI">GI</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3" id="examinateur_privilege_col" style="display: none;">
                                <div class="form-group">
                                    <label for="type_privilege">Privilege</label>
                                    <select class="form-control" id="type_privilege" name="type_privilege">
                                        <option value="TRE">TRE</option>
                                        <option value="IRE">IRE</option>
                                        <option value="FE">FE</option>
                                        <option value="CRE">CRE</option>
                                        <option value="SFE">SFE</option>
                                        <option value="FIE">FIE</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-success float-right">
                                        <i class="fas fa-plus"></i> Submit
                                    </button>
                                </div>
                            </div>
                        </form>


                        <br>

                        <?php if(isset($qualification_demandeurs)): ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Qualification</th>
                                                <th>Type d'avion</th>
                                                <th>Type de moteur</th>
                                                <th>Privilege</th>
                                                <th>Date de l'Examen</th>
                                                <th>Simulateur</th>
                                                <th>Lieu</th>
                                                <th>Justificatif</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $qualification_demandeurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $qualification_demandeur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($qualification_demandeur->qualification); ?></td>
                                                    <td><?php echo e(optional($qualification_demandeur->typeAvion)->code); ?></td>
                                                    <td><?php echo e($qualification_demandeur->type_moteur); ?></td>
                                                    <td><?php echo e($qualification_demandeur->type_privilege); ?></td>
                                                    <td><?php echo e($qualification_demandeur->date_examen); ?></td>
                                                    <td><?php echo e($qualification_demandeur->centre_formation); ?></td>
                                                    <td><?php echo e($qualification_demandeur->lieu); ?></td>
                                                    <td>
                                                        <?php if($qualification_demandeur->document): ?>
                                                            <a target="_blank"
                                                                href="<?php echo e(asset('/uploads/' . $qualification_demandeur->document)); ?>"
                                                                class="btn btn-primary btn-sm">
                                                                <i class="fas fa-download"></i>
                                                            </a>
                                                        <?php else: ?>
                                                            Aucun fichier
                                                        <?php endif; ?>

                                                    </td>
                                                    <td>
                                                        <?php if(!$qualification_demandeur->valider): ?>
                                                            <button class="btn btn-warning btn-sm edit-qualification"
                                                                data-id="<?php echo e($qualification_demandeur->id); ?>">Modifier</button>
                                                        <?php endif; ?>
                                                        <button class="btn btn-danger btn-sm delete-qualification"
                                                            data-id="<?php echo e($qualification_demandeur->id); ?>">Supprimer</button>

                                                    </td>
                                                </tr>

                                                <!-- Formulaire d'édition caché -->
                                                <tr id="edit-form-qualification-<?php echo e($qualification_demandeur->id); ?>"
                                                    style="display: none;">
                                                    <td colspan="6">
                                                        <form id="updateQualificationForm-<?php echo e($qualification_demandeur->id); ?>"
                                                            enctype="multipart/form-data">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PUT'); ?>

                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <label>Qualification</label>
                                                                    <select class="form-control" name="qualification_id">
                                                                        <?php $__currentLoopData = $qualifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $qualification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option value="<?php echo e($qualification->id); ?>"
                                                                                <?php echo e($qualification_demandeur->qualification_id == $qualification->id ? 'selected' : ''); ?>>
                                                                                <?php echo e($qualification->libelle); ?>

                                                                            </option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                </div>

                                                                <div class="col-lg-2">
                                                                    <label>Date de l'Examen</label>
                                                                    <input type="date" class="form-control"
                                                                        name="date_examen"
                                                                        value="<?php echo e($qualification_demandeur->date_examen); ?>">
                                                                </div>

                                                                <div class="col-lg-2">
                                                                    <label>Simulateur</label>
                                                                    <select class="form-control" name="centre_formation_id">
                                                                        <?php $__currentLoopData = $centre_formations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $centre_formation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option value="<?php echo e($centre_formation->id); ?>"
                                                                                <?php echo e($qualification_demandeur->centre_formation_id == $centre_formation->id ? 'selected' : ''); ?>>
                                                                                <?php echo e($centre_formation->libelle); ?>

                                                                            </option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                </div>

                                                                <div class="col-lg-2">
                                                                    <label>Lieu</label>
                                                                    <input type="text" class="form-control" name="lieu"
                                                                        value="<?php echo e($qualification_demandeur->lieu); ?>">
                                                                </div>

                                                                <div class="col-lg-3">
                                                                    <label>Justificatif</label>
                                                                    <input type="file" class="form-control"
                                                                        name="document">
                                                                </div>
                                                            </div>

                                                            <br>
                                                            <button type="submit"
                                                                class="btn btn-success">Enregistrer</button>
                                                            <button type="button" class="btn btn-secondary"
                                                                onclick="toggleEditForm(<?php echo e($qualification_demandeur->id); ?>,'qualification'
                                                                )">Annuler</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <!----->

                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Aptitude Médicale
                    </div>
                    <div class="card-body">
                        <form id="aptitudeForm" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" value="<?php echo e($id); ?>" id="demande_id" name="demande_id">
                            <div class="row">

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="date_examen">Date de l'Examen</label>
                                        <input type="date" class="form-control" id="date_examen" name="date_examen"
                                            placeholder="">

                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="validite">Validité en mois</label>
                                        <input type="number" min="0" class="form-control" id="validite"
                                            name="validite" placeholder="">

                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="centre_medical_id">Centre Médical</label>
                                        <select class="form-control" id="centre_medical_id" name="centre_medical_id"
                                            placeholder="">
                                            <?php $__currentLoopData = $centre_medicals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $centre_medical): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($centre_medical->id); ?>">
                                                    <?php echo e($centre_medical->libelle); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="document">Justificatif</label>
                                        <input type="file" class="form-control" id="document" name="document"
                                            placeholder="">

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-success float-right"><i
                                            class="fas fa-plus"></i>
                                        Submit

                                    </button>
                                </div>
                            </div>
                        </form>

                        <br>
                        <?php if(isset($medical_examinations)): ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>

                                                <th>Date de l'Examen</th>
                                                <th>Validité en mois</th>
                                                <th>Centre Médical</th>
                                                <th>Justificatif</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $medical_examinations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $medical_examination): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($medical_examination->date_examen); ?></td>
                                                    <td><?php echo e($medical_examination->validite); ?></td>
                                                    <td><?php echo e($medical_examination->centre_medical); ?></td>
                                                    <td>
                                                        <?php if($medical_examination->document): ?>
                                                            <a target="_blank"
                                                                href="<?php echo e(asset('/uploads/' . $medical_examination->document)); ?>"
                                                                class="btn btn-primary btn-sm">
                                                                <i class="fas fa-download"></i>
                                                            </a>
                                                        <?php else: ?>
                                                            Aucun fichier
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>

                                                        <?php if(!$medical_examination->valider): ?>
                                                            <button class="btn btn-warning btn-sm edit-aptitude"
                                                                data-id="<?php echo e($medical_examination->id); ?>">Modifier</button>
                                                        <?php endif; ?>
                                                        <button class="btn btn-danger btn-sm delete-aptitude"
                                                            data-id="<?php echo e($medical_examination->id); ?>">Supprimer</button>

                                                    </td>
                                                </tr>

                                                <!-- Formulaire d'édition caché -->
                                                <tr id="edit-form-medical-<?php echo e($medical_examination->id); ?>"
                                                    style="display: none;">
                                                    <td colspan="5">
                                                        <form id="updateAptitudeForm-<?php echo e($medical_examination->id); ?>"
                                                            enctype="multipart/form-data">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PUT'); ?>

                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <label>Date de l'Examen</label>
                                                                    <input type="date" class="form-control"
                                                                        name="date_examen"
                                                                        value="<?php echo e($medical_examination->date_examen); ?>">
                                                                </div>

                                                                <div class="col-lg-3">
                                                                    <label>Validité en mois</label>
                                                                    <input type="number" min="0" class="form-control"
                                                                        name="validite"
                                                                        value="<?php echo e($medical_examination->validite); ?>">
                                                                </div>

                                                                <div class="col-lg-3">
                                                                    <label>Centre Médical</label>
                                                                    <select class="form-control" name="centre_medical_id">
                                                                        <?php $__currentLoopData = $centre_medicals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $centre_medical): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option value="<?php echo e($centre_medical->id); ?>"
                                                                                <?php echo e($medical_examination->centre_medical_id == $centre_medical->id ? 'selected' : ''); ?>>
                                                                                <?php echo e($centre_medical->libelle); ?>

                                                                            </option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                </div>

                                                                <div class="col-lg-3">
                                                                    <label>Justificatif</label>
                                                                    <input type="file" class="form-control"
                                                                        name="document">
                                                                </div>
                                                            </div>

                                                            <br>
                                                            <button type="submit"
                                                                class="btn btn-success">Enregistrer</button>
                                                            <button type="button" class="btn btn-secondary"
                                                                onclick="toggleEditForm(<?php echo e($medical_examination->id); ?>,'medical')">Annuler</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>

                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Expérience en heures de vol
                    </div>

                    <div class="card-body">
                        <form action="<?php echo e(route('user.store_experiences')); ?>" method="POST"
                            enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" value="<?php echo e($id); ?>" name="demande_id">

                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="nature">Nature</label>
                                        <select class="form-control" id="nature" name="nature">
                                            <option value="Sur tous types d'aéronefs">Sur tous types d'aéronefs</option>
                                            <option value="Sur les types d'aéronefs exploités par l'employeur">Sur les
                                                types d'aéronefs exploités par l'employeur</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="total">Total</label>
                                        <input type="number" min="0" class="form-control" id="total"
                                            name="total">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="six_mois">Six (6) derniers mois</label>
                                        <input type="number" min="0" class="form-control" id="six_mois"
                                            name="six_mois">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="trois_mois">Trois (3) derniers mois</label>
                                        <input type="number" min="0" class="form-control" id="trois_mois"
                                            name="trois_mois">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="document">Justificatif</label>
                                        <input type="file" class="form-control" id="document" name="document">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success float-right"><i class="fas fa-plus"></i>
                                Submit</button>
                        </form>


                        <?php if(isset($experience_demandeurs)): ?>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nature</th>
                                        <th>Total</th>
                                        <th>Six (6) derniers mois</th>
                                        <th>Trois (3) derniers mois</th>
                                        <th>Justificatif</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $experience_demandeurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $experience): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($experience->nature); ?></td>
                                            <td><?php echo e($experience->total); ?></td>
                                            <td><?php echo e($experience->six_mois); ?></td>
                                            <td><?php echo e($experience->trois_mois); ?></td>
                                            <td>
                                                <a target="_blank" href="<?php echo e(asset('/uploads/' . $experience->document)); ?>"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <?php if(!$experience->valider): ?>
                                                    <button class="btn btn-warning btn-sm"
                                                        onclick="toggleEditForm(<?php echo e($experience->id); ?>, 'experience')">

                                                        Modifier
                                                    </button>
                                                <?php endif; ?>

                                                <form action="<?php echo e(route('user.destroy_experiences', $experience)); ?>"
                                                    method="POST" class="d-inline">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Confirmer la suppression ?')">
                                                        Supprimer
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>

                                        
                                        <tr id="edit-form-experience-<?php echo e($experience->id); ?>" style="display: none;">
                                            <td colspan="6">
                                                <form action="<?php echo e(route('user.update_experiences', $experience)); ?>"
                                                    method="POST" enctype="multipart/form-data">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('PUT'); ?>
                                                    <input type="hidden" name="experience_id"
                                                        value="<?php echo e($experience->id); ?>">

                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label for="edit_nature">Nature</label>
                                                                <select class="form-control" name="nature">
                                                                    <option value="Sur tous types d'aéronefs"
                                                                        <?php echo e($experience->nature == "Sur tous types d'aéronefs" ? 'selected' : ''); ?>>
                                                                        Sur tous types d'aéronefs</option>
                                                                    <option
                                                                        value="Sur les types d'aéronefs exploités par l'employeur"
                                                                        <?php echo e($experience->nature == "Sur les types d'aéronefs exploités par l'employeur" ? 'selected' : ''); ?>>
                                                                        Sur les types d'aéronefs exploités par l'employeur
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label>Total</label>
                                                                <input type="number" min="0" class="form-control"
                                                                    name="total" value="<?php echo e($experience->total); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label>Six (6) derniers mois</label>
                                                                <input type="number" min="0" class="form-control"
                                                                    name="six_mois" value="<?php echo e($experience->six_mois); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label>Trois (3) derniers mois</label>
                                                                <input type="number" min="0" class="form-control"
                                                                    name="trois_mois" value="<?php echo e($experience->trois_mois); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label>Justificatif</label>
                                                                <input type="file" class="form-control" name="document">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <button type="submit" class="btn btn-primary btn-sm">Enregistrer</button>
                                                    <button type="button" class="btn btn-secondary btn-sm"
                                                        onclick="toggleEditForm(<?php echo e($experience->id); ?>,'experience')">
                                                        Annuler
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </div>
                </div>




                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Contrôles de compétence les plus récents
                    </div>

                    <div class="card-body">

                        <form action="<?php echo e(route('user.store_competences')); ?>" method="POST"
                            enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" value="<?php echo e($id); ?>" id="demande_id" name="demande_id">
                            <div class="row">

                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="type">Type de compétence</label>
                                        <select class="form-control" id="type" name="type" placeholder="">
                                            <option value="Hors Ligne (SIMU)">Hors Ligne (SIMU)
                                            </option>
                                            <option value="Contrôle de compétence linguistique">
                                                Contrôle de compétence linguistique
                                            </option>
                                        </select>

                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="niveau">Niveau</label>
                                        <select class="form-control" id="niveau" name="niveau" placeholder="">
                                            <option value="4">4
                                            </option>
                                            <option value="5">5
                                            </option>
                                            <option value="6">6
                                            </option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="date">Date</label>
                                        <input type="date" class="form-control" id="date" name="date"
                                            placeholder="">

                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="validite">Validité en mois</label>
                                        <input type="number" min="0" class="form-control" id="validite"
                                            name="validite" placeholder="">

                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="centre_formation_id">Lieu</label>
                                        <select class="form-control" id="centre_formation_id" name="centre_formation_id"
                                            placeholder="">
                                            <?php $__currentLoopData = $centre_formations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $centre_formation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($centre_formation->id); ?>">
                                                    <?php echo e($centre_formation->libelle); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="document">Justificatif</label>
                                        <input type="file" class="form-control" id="document" name="document"
                                            placeholder="">

                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-success float-right"><i
                                            class="fas fa-plus"></i>
                                        Submit

                                    </button>
                                </div>
                            </div>
                        </form>
                        <br>
                        <?php if(isset($competence_demandeurs)): ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>

                                                <th>Type</th>
                                                <th>Niveau</th>
                                                <th>Date</th>
                                                <th>Validité en mois</th>
                                                <th>Lieu</th>
                                                <th>Justificatif</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $competence_demandeurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $competence_demandeur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($competence_demandeur->type); ?></td>
                                                    <td><?php echo e($competence_demandeur->niveau); ?></td>
                                                    <td><?php echo e($competence_demandeur->date); ?></td>
                                                    <td><?php echo e($competence_demandeur->validite); ?></td>
                                                    <td><?php echo e($competence_demandeur->centre_formation); ?></td>
                                                    <td>
                                                        <a target="_blank"
                                                            href="<?php echo e(asset('/uploads/' . $competence_demandeur->document)); ?>"
                                                            type="button" class="btn btn-primary btn-sm"><i
                                                                class="fas fa-download"></i></a>
                                                    </td>
                                                    <td>
                                                        <?php if(!$competence_demandeur->valider): ?>
                                                            <button class="btn btn-warning btn-sm"
                                                                onclick="toggleEditForm(<?php echo e($competence_demandeur->id); ?>, 'competence')">

                                                                Modifier</button>
                                                        <?php endif; ?>
                                                        <form
                                                            action="<?php echo e(route('user.destroy_competences', $competence_demandeur)); ?>"
                                                            method="POST" class="d-inline">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('DELETE'); ?>
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                                                        </form>
                                                    </td>
                                                </tr>

                                                <!-- Edit form for the competence -->
                                                <tr id="edit-form-competence-<?php echo e($competence_demandeur->id); ?>"
                                                    style="display: none;">
                                                    <td colspan="7">
                                                        <form
                                                            action="<?php echo e(route('user.update_competences', $competence_demandeur)); ?>"
                                                            method="POST" enctype="multipart/form-data">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PUT'); ?>
                                                            <input type="hidden" name="competence_id"
                                                                value="<?php echo e($competence_demandeur->id); ?>">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <label for="type">Type de compétence</label>
                                                                        <select class="form-control" name="type">
                                                                            <option value="Hors Ligne (SIMU)"
                                                                                <?php echo e($competence_demandeur->type == 'Hors Ligne (SIMU)' ? 'selected' : ''); ?>>
                                                                                Hors Ligne (SIMU)</option>
                                                                            <option value="Contrôle de compétence linguistique"
                                                                                <?php echo e($competence_demandeur->type == 'Contrôle de compétence linguistique' ? 'selected' : ''); ?>>
                                                                                Contrôle de compétence linguistique</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-2">
                                                                    <div class="form-group">
                                                                        <label for="niveau">Niveau</label>
                                                                        <select class="form-control" name="niveau">
                                                                            <option value="4"
                                                                                <?php echo e($competence_demandeur->niveau == 4 ? 'selected' : ''); ?>>
                                                                                4</option>
                                                                            <option value="5"
                                                                                <?php echo e($competence_demandeur->niveau == 5 ? 'selected' : ''); ?>>
                                                                                5</option>
                                                                            <option value="6"
                                                                                <?php echo e($competence_demandeur->niveau == 6 ? 'selected' : ''); ?>>
                                                                                6</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-1">
                                                                    <div class="form-group">
                                                                        <label for="date">Date</label>
                                                                        <input type="date" class="form-control"
                                                                            name="date"
                                                                            value="<?php echo e($competence_demandeur->date); ?>">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-2">
                                                                    <div class="form-group">
                                                                        <label for="validite">Validité en mois</label>
                                                                        <input type="number" min="0"
                                                                            class="form-control" name="validite"
                                                                            value="<?php echo e($competence_demandeur->validite); ?>">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-2">
                                                                    <div class="form-group">
                                                                        <label for="centre_formation_id">Lieu</label>
                                                                        <select class="form-control"
                                                                            name="centre_formation_id">
                                                                            <?php $__currentLoopData = $centre_formations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $centre_formation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <option value="<?php echo e($centre_formation->id); ?>"
                                                                                    <?php echo e($competence_demandeur->centre_formation_id == $centre_formation->id ? 'selected' : ''); ?>>
                                                                                    <?php echo e($centre_formation->libelle); ?></option>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-2">
                                                                    <div class="form-group">
                                                                        <label for="document">Justificatif
                                                                            (Nouveau)
                                                                        </label>
                                                                        <input type="file" class="form-control"
                                                                            name="document">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <button type="submit"
                                                                class="btn btn-primary btn-sm">Enregistrer</button>
                                                            <button type="button" class="btn btn-secondary btn-sm"
                                                                onclick="toggleEditForm(<?php echo e($competence_demandeur->id); ?>,
                                                                'competence')">Annuler</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>

                </div>

                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Entraînements périodiques
                    </div>

                    <div class="card-body">
                        <form action="<?php echo e(route('user.store_entrainements')); ?>" method="POST"
                            enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" value="<?php echo e($id); ?>" id="demande_id" name="demande_id">
                            <div class="row">

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="type">Type d'entraînement</label>
                                        <select class="form-control" id="type" name="type" placeholder="">
                                            <option value="Simulateur">
                                                Simulateur
                                            </option>

                                            <option value="En Ligne">
                                                En Ligne
                                            </option>
                                            <option value="Rafraîchissement au sol">
                                                Rafraîchissement du sol
                                            </option>
                                            <option value="CRM">
                                                CRM
                                            </option>
                                            <option value="Sécurité sauvetage">
                                                Sécurité sauvetage
                                            </option>
                                            <option value="Surete">
                                                Surete
                                            </option>
                                            <option value="Matière dangereuse">
                                                Matière dangereuse
                                            </option>
                                        </select>

                                    </div>
                                </div>


                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="date">Date</label>
                                        <input type="date" class="form-control" id="date" name="date"
                                            placeholder="">

                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="validite">Validité en mois</label>
                                        <input type="number" min="0" class="form-control" id="validite"
                                            name="validite" placeholder="">

                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="centre_formation_id">Lieu</label>
                                        <select class="form-control" id="centre_formation_id" name="centre_formation_id"
                                            placeholder="">
                                            <?php $__currentLoopData = $centre_formations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $centre_formation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($centre_formation->id); ?>">
                                                    <?php echo e($centre_formation->libelle); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="document">Justificatif</label>
                                        <input type="file" class="form-control" id="document" name="document"
                                            placeholder="">

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-success float-right"><i
                                            class="fas fa-plus"></i>
                                        Submit

                                    </button>
                                </div>
                            </div>
                        </form>
                        <br>
                        <?php if(isset($entrainement_demandeurs)): ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>

                                                <th>Type</th>

                                                <th>Date</th>
                                                <th>Validité en mois</th>
                                                <th>Lieu</th>
                                                <th>Justificatif</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $entrainement_demandeurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entrainement_demandeur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($entrainement_demandeur->type); ?></td>
                                                    <td><?php echo e($entrainement_demandeur->date); ?></td>
                                                    <td><?php echo e($entrainement_demandeur->validite); ?></td>
                                                    <td><?php echo e($entrainement_demandeur->centre_formation); ?></td>

                                                    <td>
                                                        <a target="_blank"
                                                            href="<?php echo e(asset('/uploads/' . $entrainement_demandeur->document)); ?>"
                                                            type="button" class="btn btn-primary btn-sm"><i
                                                                class="fas fa-download"></i></a>
                                                    </td>
                                                    <td>
                                                        <?php if(!$entrainement_demandeur->valider): ?>
                                                            <button class="btn btn-warning btn-sm"
                                                                onclick="toggleEditForm(<?php echo e($entrainement_demandeur->id); ?>, 'entrainement')">

                                                                Modifier</button>
                                                        <?php endif; ?>
                                                        <form
                                                            action="<?php echo e(route('user.destroy_entrainements', $entrainement_demandeur)); ?>"
                                                            method="POST" class="d-inline">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('DELETE'); ?>
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                                                        </form>
                                                    </td>
                                                </tr>

                                                <!-- Edit Form (Hidden by default) -->
                                                <tr id="edit-form-entrainement-<?php echo e($entrainement_demandeur->id); ?>"
                                                    style="display: none;">
                                                    <td colspan="4">
                                                        <form
                                                            action="<?php echo e(route('user.update_entrainements', $entrainement_demandeur)); ?>"
                                                            method="POST" enctype="multipart/form-data">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PUT'); ?>
                                                            <input type="hidden" name="entrainement_id"
                                                                value="<?php echo e($entrainement_demandeur->id); ?>">

                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <label for="edit_type">Type d'entraînement</label>
                                                                        <select class="form-control" name="type"
                                                                            id="edit_type">
                                                                            <option value="En Ligne"
                                                                                <?php echo e($entrainement_demandeur->type == 'En Ligne' ? 'selected' : ''); ?>>
                                                                                En Ligne</option>
                                                                            <option value="Rafraîchissement au sol"
                                                                                <?php echo e($entrainement_demandeur->type == 'Rafraîchissement au sol' ? 'selected' : ''); ?>>
                                                                                Rafraîchissement du sol</option>
                                                                            <option value="CRM"
                                                                                <?php echo e($entrainement_demandeur->type == 'CRM' ? 'selected' : ''); ?>>
                                                                                CRM</option>
                                                                            <option value="Sécurité sauvetage"
                                                                                <?php echo e($entrainement_demandeur->type == 'Sécurité sauvetage' ? 'selected' : ''); ?>>
                                                                                Sécurité sauvetage</option>
                                                                            <option value="Surete"
                                                                                <?php echo e($entrainement_demandeur->type == 'Surete' ? 'selected' : ''); ?>>
                                                                                Surete</option>
                                                                            <option value="Matière dangereuse"
                                                                                <?php echo e($entrainement_demandeur->type == 'Matière dangereuse' ? 'selected' : ''); ?>>
                                                                                Matière dangereuse</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-2">
                                                                    <div class="form-group">
                                                                        <label for="edit_date">Date</label>
                                                                        <input type="date" class="form-control"
                                                                            name="date"
                                                                            value="<?php echo e($entrainement_demandeur->date); ?>">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-2">
                                                                    <div class="form-group">
                                                                        <label for="edit_validite">Validité en mois</label>
                                                                        <input type="number" min="0"
                                                                            class="form-control" name="validite"
                                                                            value="<?php echo e($entrainement_demandeur->validite); ?>">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-2">
                                                                    <div class="form-group">
                                                                        <label for="edit_centre_formation_id">Lieu</label>
                                                                        <select class="form-control"
                                                                            name="centre_formation_id">
                                                                            <?php $__currentLoopData = $centre_formations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $centre_formation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <option value="<?php echo e($centre_formation->id); ?>"
                                                                                    <?php echo e($entrainement_demandeur->centre_formation_id == $centre_formation->id ? 'selected' : ''); ?>>
                                                                                    <?php echo e($centre_formation->libelle); ?>

                                                                                </option>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <label for="edit_justificatif">Justificatif</label>
                                                                        <input type="file" class="form-control"
                                                                            name="document">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <button type="submit"
                                                                        class="btn btn-primary btn-sm">Enregistrer</button>
                                                                    <button type="button" class="btn btn-secondary btn-sm"
                                                                        onclick="toggleEditForm(<?php echo e($entrainement_demandeur->id); ?>,'entrainement')">Annuler</button>
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
                        <?php endif; ?>
                    </div>


                </div>


                
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Interruptions
                    </div>

                    <div class="card-body">
                        <form action="<?php echo e(route('user.store_interruptions')); ?>" method="POST"
                            enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" value="<?php echo e($id); ?>" id="demande_id" name="demande_id">

                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="date_debut">Date de debut</label>
                                        <input type="date" class="form-control" id="date_debut" name="date_debut"
                                            placeholder="">

                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="date_fin">Date de fin</label>
                                        <input type="date" class="form-control" id="date_fin" name="date_fin"
                                            placeholder="">

                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label for="raison">Raisons</label>
                                        <textarea type="text" class="form-control" id="raison" name="raison" placeholder=""></textarea>

                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="document">Justificatif</label>
                                        <input type="file" class="form-control" id="document" name="document"
                                            placeholder="">

                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-success float-right"><i
                                            class="fas fa-plus"></i>
                                        Submit

                                    </button>
                                </div>
                            </div>
                        </form>
                        <br>
                        <?php if(isset($interruption_demandeurs)): ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>



                                                <th>Date de debut</th>
                                                <th>Date de fin</th>
                                                <th>Raisons</th>
                                                <th>Justificatif</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $interruption_demandeurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $interruption_demandeur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($interruption_demandeur->date_debut); ?></td>
                                                    <td><?php echo e($interruption_demandeur->date_fin); ?></td>
                                                    <td><?php echo e($interruption_demandeur->raison); ?></td>
                                                    <td>
                                                        <a target="_blank"
                                                            href="<?php echo e(asset('/uploads/' . $interruption_demandeur->document)); ?>"
                                                            type="button" class="btn btn-primary btn-sm"><i
                                                                class="fas fa-download"></i></a>
                                                    </td>
                                                    <td>
                                                        <?php if(!$interruption_demandeur->valider): ?>
                                                            <button class="btn btn-warning btn-sm"
                                                                onclick="toggleEditForm(<?php echo e($interruption_demandeur->id); ?>, 'interruption')">Modifier</button>
                                                        <?php endif; ?>
                                                        <form
                                                            action="<?php echo e(route('user.destroy_interruptions', $interruption_demandeur)); ?>"
                                                            method="POST" class="d-inline">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('DELETE'); ?>
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                                                        </form>
                                                    </td>
                                                </tr>

                                                
                                                <tr id="edit-form-interruption-<?php echo e($interruption_demandeur->id); ?>"
                                                    style="display: none;">
                                                    <td colspan="6">
                                                        <form
                                                            action="<?php echo e(route('user.update_interruptions', $interruption_demandeur)); ?>"
                                                            method="POST" enctype="multipart/form-data">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PUT'); ?>
                                                            <input type="hidden" name="interruption_id"
                                                                value="<?php echo e($interruption_demandeur->id); ?>">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <label for="edit_date_debut">Date de debut</label>
                                                                        <input type="date" class="form-control"
                                                                            name="date_debut"
                                                                            value="<?php echo e($interruption_demandeur->date_debut); ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <label for="edit_date_fin">Date de fin</label>
                                                                        <input type="date" class="form-control"
                                                                            name="date_fin"
                                                                            value="<?php echo e($interruption_demandeur->date_fin); ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <label for="edit_raison">Raisons</label>
                                                                        <textarea class="form-control" name="raison"><?php echo e($interruption_demandeur->raison); ?></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <label for="edit_justificatif">Justificatif</label>
                                                                        <input type="file" class="form-control"
                                                                            name="document">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <button type="submit"
                                                                class="btn btn-primary btn-sm">Enregistrer</button>
                                                            <button type="button" class="btn btn-secondary btn-sm"
                                                                onclick="toggleEditForm(<?php echo e($interruption_demandeur->id); ?>,'interruption')">Annuler</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>


                </div>

                
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Expérience en maintenance d'aéronefs
                    </div>

                    <div class="card-body">
                        <form action="<?php echo e(route('user.store_maintenances')); ?>" method="POST"
                            enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" value="<?php echo e($id); ?>" id="demande_id" name="demande_id">
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="date_debut">Date de debut</label>
                                        <input type="date" class="form-control" id="date_debut" name="date_debut"
                                            placeholder="">

                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="date_fin">Date de fin</label>
                                        <input type="date" class="form-control" id="date_fin" name="date_fin"
                                            placeholder="">

                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label for="description_maintenance">Descriptions</label>
                                        <textarea type="text" class="form-control" id="description_maintenance" name="description_maintenance"
                                            placeholder=""></textarea>

                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="document">Justificatif</label>
                                        <input type="file" class="form-control" id="document" name="document"
                                            placeholder="">

                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-success float-right"><i
                                            class="fas fa-plus"></i>
                                        Submit

                                    </button>
                                </div>
                            </div>
                        </form>
                        <br>
                        <?php if(isset($experience_maintenance_demandeurs)): ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>



                                                <th>Date de debut</th>
                                                <th>Date de fin</th>
                                                <th>Descriptions</th>

                                                <th>Justificatif</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $experience_maintenance_demandeurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $experience_maintenance_demandeur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($experience_maintenance_demandeur->date_debut); ?></td>
                                                    <td><?php echo e($experience_maintenance_demandeur->date_fin); ?></td>
                                                    <td><?php echo e($experience_maintenance_demandeur->description_maintenance); ?>

                                                    </td>
                                                    <td>
                                                        <a target="_blank"
                                                            href="<?php echo e(asset('/uploads/' . $experience_maintenance_demandeur->document)); ?>"
                                                            type="button" class="btn btn-primary btn-sm"><i
                                                                class="fas fa-download"></i></a>
                                                    </td>
                                                    <td>
                                                        <?php if(!$experience_maintenance_demandeur->valider): ?>
                                                            <button class="btn btn-warning btn-sm"
                                                                onclick="toggleEditForm(<?php echo e($experience_maintenance_demandeur->id); ?>, 'maintenance')">
                                                                Modifier
                                                            </button>
                                                        <?php endif; ?>
                                                        <form
                                                            action="<?php echo e(route('user.destroy_maintenances', $experience_maintenance_demandeur)); ?>"
                                                            method="POST" class="d-inline">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('DELETE'); ?>
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                                                        </form>
                                                    </td>
                                                </tr>

                                                
                                                <tr id="edit-form-maintenance-<?php echo e($experience_maintenance_demandeur->id); ?>"
                                                    style="display: none;">
                                                    <td colspan="4">
                                                        <form
                                                            action="<?php echo e(route('user.update_maintenances', $experience_maintenance_demandeur)); ?>"
                                                            method="POST" enctype="multipart/form-data">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PUT'); ?>
                                                            <input type="hidden" name="maintenance_id"
                                                                value="<?php echo e($experience_maintenance_demandeur->id); ?>">
                                                            <div class="row">
                                                                <div class="col-lg-2">
                                                                    <div class="form-group">
                                                                        <label for="edit_date_debut">Date de debut</label>
                                                                        <input type="date" class="form-control"
                                                                            name="date_debut"
                                                                            value="<?php echo e($experience_maintenance_demandeur->date_debut); ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-2">
                                                                    <div class="form-group">
                                                                        <label for="edit_date_fin">Date de fin</label>
                                                                        <input type="date" class="form-control"
                                                                            name="date_fin"
                                                                            value="<?php echo e($experience_maintenance_demandeur->date_fin); ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-5">
                                                                    <div class="form-group">
                                                                        <label
                                                                            for="edit_description_maintenance">Descriptions</label>
                                                                        <textarea class="form-control" name="description_maintenance"><?php echo e($experience_maintenance_demandeur->description_maintenance); ?></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <label for="edit_justificatif">Justificatif</label>
                                                                        <input type="file" class="form-control"
                                                                            name="document">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <button type="submit"
                                                                class="btn btn-primary btn-sm">Enregistrer</button>
                                                            <button type="button" class="btn btn-secondary btn-sm"
                                                                onclick="toggleEditForm(<?php echo e($experience_maintenance_demandeur->id); ?>,'maintenance')">
                                                                Annuler
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>


                </div>
                

                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Employeurs
                    </div>

                    <div class="card-body">
                        <form action="<?php echo e(route('user.store_employeurs')); ?>" method="POST"
                            enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" value="<?php echo e($id); ?>" id="demande_id" name="demande_id">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="employeur">Employeur</label>
                                        <input type="text" class="form-control" id="employeur" name="employeur"
                                            placeholder="">

                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="periode_du">Date de debut</label>
                                        <input type="date" class="form-control" id="periode_du" name="periode_du"
                                            placeholder="">

                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="periode_au">Date de fin</label>
                                        <input type="date" class="form-control" id="periode_au" name="periode_au"
                                            placeholder="">

                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="fonction">Fonction</label>
                                        <input type="text" class="form-control" id="fonction" name="fonction"
                                            placeholder="">

                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="document">Justificatif</label>
                                        <input type="file" class="form-control" id="document" name="document"
                                            placeholder="">

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-success float-right"><i
                                            class="fas fa-plus"></i>
                                        Submit

                                    </button>
                                </div>
                            </div>
                        </form>
                        <br>
                        <?php if(isset($employeur_demandeurs)): ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>


                                                <th>Employeur</th>
                                                <th>Date de debut</th>
                                                <th>Date de fin</th>
                                                <th>Fonction</th>
                                                <th>Justificatif</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $employeur_demandeurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employeur_demandeur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($employeur_demandeur->employeur); ?></td>
                                                    <td><?php echo e($employeur_demandeur->periode_du); ?></td>
                                                    <td><?php echo e($employeur_demandeur->periode_au); ?></td>
                                                    <td><?php echo e($employeur_demandeur->fonction); ?></td>

                                                    <td>
                                                        <a target="_blank"
                                                            href="<?php echo e(asset('/uploads/' . $employeur_demandeur->document)); ?>"
                                                            type="button" class="btn btn-primary btn-sm"><i
                                                                class="fas fa-download"></i></a>
                                                    </td>
                                                    <td>
                                                        <?php if(!$employeur_demandeur->valider): ?>
                                                            <button class="btn btn-warning btn-sm"
                                                                onclick="toggleEditForm(<?php echo e($employeur_demandeur->id); ?>, 'employeur')">
                                                                Modifier</button>
                                                        <?php endif; ?>
                                                        <form
                                                            action="<?php echo e(route('user.destroy_employeurs', $employeur_demandeur)); ?>"
                                                            method="POST" class="d-inline">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('DELETE'); ?>
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                                                        </form>
                                                    </td>
                                                </tr>

                                                
                                                <tr id="edit-form-employeur-<?php echo e($employeur_demandeur->id); ?>"
                                                    style="display: none;">
                                                    <td colspan="5">
                                                        <form
                                                            action="<?php echo e(route('user.update_employeurs', $employeur_demandeur)); ?>"
                                                            enctype="multipart/form-data" method="POST">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PUT'); ?>
                                                            <input type="hidden" name="employeur_id"
                                                                value="<?php echo e($employeur_demandeur->id); ?>">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <label for="edit_employeur">Employeur</label>
                                                                        <input type="text" class="form-control"
                                                                            name="employeur"
                                                                            value="<?php echo e($employeur_demandeur->employeur); ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-2">
                                                                    <div class="form-group">
                                                                        <label for="edit_periode_du">Date de debut</label>
                                                                        <input type="date" class="form-control"
                                                                            name="periode_du"
                                                                            value="<?php echo e($employeur_demandeur->periode_du); ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-2">
                                                                    <div class="form-group">
                                                                        <label for="edit_periode_au">Date de fin</label>
                                                                        <input type="date" class="form-control"
                                                                            name="periode_au"
                                                                            value="<?php echo e($employeur_demandeur->periode_au); ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-2">
                                                                    <div class="form-group">
                                                                        <label for="edit_fonction">Fonction</label>
                                                                        <input type="text" class="form-control"
                                                                            name="fonction"
                                                                            value="<?php echo e($employeur_demandeur->fonction); ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <label for="edit_justificatif">Justificatif</label>
                                                                        <input type="file" class="form-control"
                                                                            name="document">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <button type="submit"
                                                                class="btn btn-primary btn-sm">Enregistrer</button>
                                                            <button type="button" class="btn btn-secondary btn-sm"
                                                                onclick="toggleEditForm(<?php echo e($employeur_demandeur->id); ?>,'employeur')">Annuler</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>


                </div>
                
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Pièce-jointe
                    </div>

                    <div class="card-body">
                        <form action="<?php echo e(route('user.store_documents')); ?>" method="POST"
                            enctype="multipart/form-data" id="documentForm">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" value="<?php echo e($id); ?>" id="demande_id" name="demande_id">
                            <div class="row">

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="libele">Libellé de pièce</label>
                                        <select class="form-control" id="libelle" name="libelle" placeholder="">
                                            <option value="La carte nationale d'identité">
                                                La carte nationale d'identité
                                            </option>
                                            <option
                                                value="Les
                                                                                                        Résultats des examens théoriques et pratiques">
                                                Les
                                                Résultats des examens théoriques et pratiques</option>
                                            <option
                                                value="Baccalauréat de
                                                                                                        l'enseignement secondaire">
                                                Baccalauréat de
                                                l'enseignement secondaire</option>

                                            <option
                                                value="Copie des pages du passeport du demandeur
                                                                                                        permettant son identification">
                                                Copie des pages du passeport du demandeur
                                                permettant son identification</option>
                                            <option value="CV">CV</option>
                                            <option
                                                value="Copie authentifiée des diplômes et certificats
                                                                                                        étrangers">
                                                Copie authentifiée des diplômes et certificats
                                                étrangers</option>
                                            <option value="Copie de la licence étrangère">Copie de la licence étrangère
                                            </option>
                                            <option
                                                value="Copie du baccalauréat (série scientifique ou
                                                                                                        technologique) ou document équivalent certifié">
                                                Copie du baccalauréat (série scientifique ou
                                                technologique) ou document équivalent certifié</option>
                                            <option
                                                value="Attestation du pays émetteur
                                                                                                        certifiant l'authenticité et le total des heures de vol">
                                                Attestation du pays émetteur
                                                certifiant l'authenticité et le total des heures de vol</option>
                                            <option
                                                value="Copie de l'ensemble des pages du carnet de vol
                                                                                                        certifiées">
                                                Copie de l'ensemble des pages du carnet de vol
                                                certifiées</option>
                                            <option
                                                value="Relevé détaillé des heures de vol des six
                                                                                                        derniers mois">
                                                Relevé détaillé des heures de vol des six
                                                derniers mois</option>
                                            <option
                                                value="Lettre de l'exploitant aérien mauritanien
                                                                                                        employeur">
                                                Lettre de l'exploitant aérien mauritanien
                                                employeur</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="piece">Pièce</label>
                                        <input type="file" class="form-control" id="piece" name="piece"
                                            placeholder="">

                                    </div>
                                </div>

                            </div>
                            <div class="row">

                                <div class="col-lg-12">
                                    <button id="submitDocument" type="submit" class="btn btn-success float-right"><i
                                            class="fas fa-plus"></i>
                                        Submit

                                    </button>
                                </div>
                            </div>
                        </form>
                        <br>
                        <?php if(isset($documents)): ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-striped table-bordered" id="documentTable">
                                        <thead>
                                            <tr>

                                                <th>Libellé</th>

                                                <th>Document</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr id="document-<?php echo e($document->id); ?>">
                                                    <td><?php echo e($document->libelle); ?></td>
                                                    <td>
                                                        <a target="_blank"
                                                            href="<?php echo e(asset('/uploads/' . $document->url)); ?>"
                                                            type="button" class="btn btn-primary btn-sm"><i
                                                                class="fas fa-download"></i></a>
                                                    </td>
                                                    <td>
                                                        <?php if(!$document->valider): ?>
                                                            <button class="btn btn-warning btn-sm edit-document"
                                                                data-id="<?php echo e($document->id); ?>">Modifier</button>
                                                        <?php endif; ?>
                                                        <button class="btn btn-danger btn-sm delete-document"
                                                            data-id="<?php echo e($document->id); ?>">Supprimer</button>

                                                    </td>
                                                </tr>
                                                <tr id="edit-form-document-<?php echo e($document->id); ?>" style="display: none;">
                                                    <td colspan="3">
                                                        <form id="updateForm-<?php echo e($document->id); ?>"
                                                            enctype="multipart/form-data">
                                                            <?php echo csrf_field(); ?>
                                                            <input type="hidden" name="_method" value="PUT">
                                                            <input type="hidden" name="document_id"
                                                                value="<?php echo e($document->id); ?>">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label>Libellé</label>
                                                                        <select class="form-control" name="libelle">
                                                                            <option value="La carte nationale d'identité"
                                                                                <?php echo e($document->libelle == 'La carte nationale d\'identité' ? 'selected' : ''); ?>>
                                                                                La carte nationale d'identité</option>
                                                                            <option
                                                                                value="Les Résultats des examens théoriques et pratiques"
                                                                                <?php echo e($document->libelle == 'Les Résultats des examens théoriques et pratiques' ? 'selected' : ''); ?>>
                                                                                Résultats des examens</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label>Pièce</label>
                                                                        <input type="file" class="form-control"
                                                                            name="piece">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <button type="submit"
                                                                class="btn btn-primary btn-sm update-document"
                                                                data-id="<?php echo e($document->id); ?>">Enregistrer</button>
                                                            <button type="button" class="btn btn-secondary btn-sm"
                                                                onclick="toggleEditForm(<?php echo e($document->id); ?>,'document')">Annuler</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>


                </div>



            </div>
            <!-- /.card-body -->

        </div>
    </div>


<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('assets/admin/plugins/sweetalert2/sweetalert2.all.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('custom'); ?>
    <script>
        $(document).ready(function() {
            // Soumission du formulaire avec AJAX
            $("#licenceForm").submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    url: "<?php echo e(route('user.store_licences')); ?>",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            let newRow = `
                        <tr id="licence-${response.licence.id}">
                            <td>${response.licence.num_licence}</td>
                            <td>${response.licence.date_licence}</td>
                            <td>
                                <button class="btn btn-warning btn-sm edit-licence" data-id="${response.licence.id}">Modifier</button>
                                <button class="btn btn-danger btn-sm delete-licence" data-id="${response.licence.id}">Supprimer</button>
                            </td>
                        </tr>
                    `;
                            $("#licenceTable tbody").append(newRow);
                            $("#licenceForm")[0].reset();
                            Swal.fire({
                                title: 'Succès',
                                text: 'Licence créée avec succès !',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload();
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: 'Erreur',
                            text: 'Une erreur est survenue lors de la création.',
                        });
                    }
                });
            });

            // Modification de la licence avec AJAX
            $(".edit-licence").click(function() {
                let licenceId = $(this).data("id");
                $("#edit-form-licence-" + licenceId).toggle();
            });

            $(".update-licence").click(function(e) {
                e.preventDefault();
                let licenceId = $(this).data("id");
                let formData = new FormData($("#updateLicenceForm-" + licenceId)[0]);

                $.ajax({
                    url: "<?php echo e(route('user.update_licences', ':id')); ?>".replace(':id', licenceId),
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            $(`#licence-${licenceId}`).html(`
                        <td>${response.licence.num_licence}</td>
                        <td>${response.licence.date_licence}</td>
                        <td>
                            <button class="btn btn-warning btn-sm edit-licence" data-id="${response.licence.id}">Modifier</button>
                            <button class="btn btn-danger btn-sm delete-licence" data-id="${response.licence.id}">Supprimer</button>
                        </td>
                    `);
                            Swal.fire({
                                title: 'Succès',
                                text: 'Licence mise à jour avec succès !',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload();
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Erreur',
                            text: 'Une erreur est survenue lors de la mise à jour.',
                        });
                    }
                });
            });

            // Suppression de la licence avec AJAX
            $(document).on("click", ".delete-licence", function() {
                let licenceId = $(this).data("id");
                let row = $(this).closest("tr");

                Swal.fire({
                    title: "Êtes-vous sûr ?",
                    text: "Cette action est irréversible !",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Oui, supprimer !",
                    cancelButtonText: "Annuler"
                }).then((result) => {
                    if (result) {
                        $.ajax({
                            url: "<?php echo e(route('user.destroy_licences', ':id')); ?>".replace(
                                ':id', licenceId),
                            type: "DELETE",
                            data: {
                                _token: "<?php echo e(csrf_token()); ?>"
                            },
                            success: function() {
                                row.remove();
                                Swal.fire({
                                    title: 'Succès',
                                    text: 'Licence supprimée !',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    location.reload();
                                });
                            },
                            error: function() {
                                Swal.fire({
                                    title: 'Erreur',
                                    text: 'Erreur lors de la suppression !',
                                });
                            }
                        });
                    }
                });
            });
        });
        $(document).ready(function() {
            // Soumission du formulaire avec AJAX
            $("#formationForm").submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    url: "<?php echo e(route('user.store_formations')); ?>",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            let newRow = `
                        <tr id="formation-${response.formation.id}">
                            <td>${response.formation.date_formation}</td>
                            <td>${response.formation.centre_formation}</td>
                            <td>
                                <button class="btn btn-warning btn-sm edit-formation" data-id="${response.formation.id}">Modifier</button>
                                <button class="btn btn-danger btn-sm delete-formation" data-id="${response.formation.id}">Supprimer</button>
                            </td>
                        </tr>
                    `;
                            $("#formationTable tbody").append(newRow);
                            $("#formationForm")[0].reset();
                            Swal.fire({
                                title: 'Succès',
                                text: 'Formation créée avec succès !',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload();
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: 'Erreur',
                            text: 'Une erreur est survenue lors de la création.',
                        });
                    }
                });
            });

            // Modification de la formation avec AJAX
            $(".edit-formation").click(function() {
                let formationId = $(this).data("id");
                $("#edit-form-formation-" + formationId).toggle();
            });

            $(".update-formation").click(function(e) {
                e.preventDefault();
                let formationId = $(this).data("id");
                let formData = new FormData($("#updateFormationForm-" + formationId)[0]);

                $.ajax({
                    url: "<?php echo e(route('user.update_formations', ':id')); ?>".replace(':id',
                        formationId),
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            $(`#formation-${formationId}`).html(`
                        <td>${response.formation.date_formation}</td>
                        <td>${response.formation.centre_formation}</td>
                        <td>
                            <button class="btn btn-warning btn-sm edit-formation" data-id="${response.formation.id}">Modifier</button>
                            <button class="btn btn-danger btn-sm delete-formation" data-id="${response.formation.id}">Supprimer</button>
                        </td>
                    `);
                            Swal.fire({
                                title: 'Succès',
                                text: 'Formation mise à jour avec succès !',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload();
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Erreur',
                            text: 'Une erreur est survenue lors de la mise à jour.',
                        });
                    }
                });
            });

            // Suppression de la formation avec AJAX
            $(document).on("click", ".delete-formation", function() {
                let formationId = $(this).data("id");
                let row = $(this).closest("tr");

                Swal.fire({
                    title: "Êtes-vous sûr ?",
                    text: "Cette action est irréversible !",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Oui, supprimer !",
                    cancelButtonText: "Annuler"
                }).then((result) => {
                    if (result) {
                        $.ajax({
                            url: "<?php echo e(route('user.destroy_formations', ':id')); ?>".replace(
                                ':id', formationId),
                            type: "DELETE",
                            data: {
                                _token: "<?php echo e(csrf_token()); ?>"
                            },
                            success: function() {
                                row.remove();
                                Swal.fire({
                                    title: 'Succès',
                                    text: 'Formation supprimée !',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    location.reload();
                                });
                            },
                            error: function() {
                                Swal.fire({
                                    title: 'Erreur',
                                    text: 'Erreur lors de la suppression !',
                                });
                            }
                        });
                    }
                });
            });
        });
        $(document).ready(function() {

            $('#qualification_id').on('change', function() {
                let selectedText = $('#qualification_id option:selected').data('type');

                const toggleField = (selector, condition) => {
                    if (selectedText.includes(condition)) {
                        $(selector).show();
                    } else {
                        $(selector).hide().find('input, select').val('');
                    }
                };

                toggleField('#type_avion_col', "Qualification Type Machine");
                toggleField('#type_engine_col', "Qualification de Class");
                toggleField('#instructeur_privilege_col', "Qualification instructeur");
                toggleField('#examinateur_privilege_col', "Autorisation examinateur");
            });

            $("#qualificationForm").submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    url: "<?php echo e(route('user.store_qualifications')); ?>",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            // Ajouter la nouvelle ligne dans le tableau
                            let newRow = `
                        <tr id="qualification-${response.qualification.id}">
                            <td>${response.qualification.qualification}</td>
                            <td>${response.qualification.date_examen}</td>
                            <td>
                                <button class="btn btn-warning btn-sm edit-qualification" data-id="${response.qualification.id}">Modifier</button>
                                <button class="btn btn-danger btn-sm delete-qualification" data-id="${response.qualification.id}">Supprimer</button>
                            </td>
                        </tr>
                    `;
                            $("#qualificationTable tbody").append(newRow);
                            $("#qualificationForm")[0].reset();
                            Swal.fire({
                                title: 'Succès',
                                text: 'Qualification créée avec succès !',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload();
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: 'Erreur',
                            text: 'Une erreur est survenue lors de la création.',
                        });
                    }
                });
            });
            $(".edit-qualification").click(function() {
                let qualificationId = $(this).data("id");
                $("#edit-form-qualification-" + qualificationId).toggle();
            });

            $(".update-qualification").click(function(e) {
                e.preventDefault();
                let qualificationId = $(this).data("id");
                let formData = new FormData($("#updateQualificationForm-" + qualificationId)[0]);

                $.ajax({
                    url: "<?php echo e(route('user.update_qualifications', ':id')); ?>".replace(':id',
                        qualificationId),
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            $(`#qualification-${qualificationId}`).html(`
                    <td>${response.qualification.qualification}</td>
                    <td>${response.qualification.date_examen}</td>
                    <td>
                        <button class="btn btn-warning btn-sm edit-qualification" data-id="${response.qualification.id}">Modifier</button>
                        <button class="btn btn-danger btn-sm delete-qualification" data-id="${response.qualification.id}">Supprimer</button>
                    </td>
                `);
                            Swal.fire({
                                title: 'Succès',
                                text: 'Qualification mise à jour avec succès !',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload();
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Erreur',
                            text: 'Une erreur est survenue lors de la mise à jour.',
                        });
                    }
                });
            });
            $(document).on("click", ".delete-qualification", function() {
                let qualificationId = $(this).data("id");
                let row = $(this).closest("tr");

                Swal.fire({
                    title: "Êtes-vous sûr ?",
                    text: "Cette action est irréversible !",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Oui, supprimer !",
                    cancelButtonText: "Annuler"
                }).then((result) => {
                    if (result) {
                        $.ajax({
                            url: "<?php echo e(route('user.destroy_qualifications', ':id')); ?>"
                                .replace(':id', qualificationId),
                            type: "DELETE",
                            data: {
                                _token: "<?php echo e(csrf_token()); ?>"
                            },
                            success: function() {
                                row.remove();
                                Swal.fire({
                                    title: 'Succès',
                                    text: 'Qualification supprimée !',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    location.reload();
                                });
                            },
                            error: function() {
                                Swal.fire({
                                    title: 'Erreur',
                                    text: 'Erreur lors de la suppression !',
                                });
                            }
                        });
                    }
                });
            });

        });
        $(document).ready(function() {
            $("#aptitudeForm").submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    url: "<?php echo e(route('user.store_aptitudes')); ?>",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            // Ajouter la nouvelle ligne dans le tableau
                            let newRow = `
                        <tr id="aptitude-${response.aptitude.id}">
                            <td>${response.aptitude.date_examen}</td>
                            <td>${response.aptitude.validite}</td>
                            <td>
                                <button class="btn btn-warning btn-sm edit-aptitude" data-id="${response.aptitude.id}">Modifier</button>
                                <button class="btn btn-danger btn-sm delete-aptitude" data-id="${response.aptitude.id}">Supprimer</button>
                            </td>
                        </tr>
                    `;
                            $("#aptitudeTable tbody").append(newRow);
                            $("#aptitudeForm")[0].reset();
                            Swal.fire({
                                title: 'Succès',
                                text: 'Aptitude créée avec succès !',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload();
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: 'Erreur',
                            text: 'Une erreur est survenue lors de la création.',
                        });
                    }
                });
            });
            $(".edit-aptitude").click(function() {
                let aptitudeId = $(this).data("id");
                $("#edit-form-aptitude-" + aptitudeId).toggle();
            });

            $(".update-aptitude").click(function(e) {
                e.preventDefault();
                let aptitudeId = $(this).data("id");
                let formData = new FormData($("#updateAptitudeForm-" + aptitudeId)[0]);

                $.ajax({
                    url: "<?php echo e(route('user.update_aptitudes', ':id')); ?>".replace(':id', aptitudeId),
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            $(`#aptitude-${aptitudeId}`).html(`
                    <td>${response.aptitude.date_examen}</td>
                    <td>${response.aptitude.validite}</td>
                    <td>
                        <button class="btn btn-warning btn-sm edit-aptitude" data-id="${response.aptitude.id}">Modifier</button>
                        <button class="btn btn-danger btn-sm delete-aptitude" data-id="${response.aptitude.id}">Supprimer</button>
                    </td>
                `);
                            Swal.fire({
                                title: 'Succès',
                                text: 'Aptitude mise à jour avec succès !',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload();
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Erreur',
                            text: 'Une erreur est survenue lors de la mise à jour.',
                        });
                    }
                });
            });
            $(document).on("click", ".delete-aptitude", function() {
                let aptitudeId = $(this).data("id");
                let row = $(this).closest("tr");

                Swal.fire({
                    title: "Êtes-vous sûr ?",
                    text: "Cette action est irréversible !",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Oui, supprimer !",
                    cancelButtonText: "Annuler"
                }).then((result) => {
                    if (result) {
                        $.ajax({
                            url: "<?php echo e(route('user.destroy_aptitudes', ':id')); ?>".replace(
                                ':id', aptitudeId),
                            type: "DELETE",
                            data: {
                                _token: "<?php echo e(csrf_token()); ?>"
                            },
                            success: function() {
                                row.remove();
                                Swal.fire({
                                    title: 'Succès',
                                    text: 'Aptitude supprimée !',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    location.reload();
                                });
                            },
                            error: function() {
                                Swal.fire({
                                    title: 'Erreur',
                                    text: 'Erreur lors de la suppression !',
                                });
                            }
                        });
                    }
                });
            });
        });
        $(document).ready(function() {
            // Soumission du formulaire avec AJAX
            $("#submitDocument").click(function(e) {
                e.preventDefault();
                let formData = new FormData($("#documentForm")[0]);

                $.ajax({
                    url: "<?php echo e(route('user.store_documents')); ?>",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            let newRow = `
                        <tr id="document-${response.document.id}">
                            <td>${response.document.libelle}</td>
                            <td>
                                <a target="_blank" href="/storage/${response.document.url}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-download"></i>
                                </a>
                            </td>
                            <td>
                                <button class="btn btn-warning btn-sm edit-document" data-id="${response.document.id}">Modifier</button>
                                <button class="btn btn-danger btn-sm delete-document" data-id="${response.document.id}">Supprimer</button>
                            </td>
                        </tr>
                    `;
                            $("#documentTable tbody").append(newRow);
                            $("#documentForm")[0].reset();
                            // SweetAlert pour confirmer la mise à jour et recharger la page
                            Swal.fire({

                                title: 'Succès',
                                text: 'Document cree avec succès !',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                location
                                    .reload(); // Recharger la page après confirmation
                            });

                        }
                    },
                    error: function(xhr) {
                        Swal.fire({

                            title: 'Erreur',
                            text: 'Une erreur est survenue lors de la creation.',
                        });
                    }
                });
            });

            // Modification du document avec AJAX
            $(".edit-document").click(function() {
                let documentId = $(this).data("id");
                $("#edit-form-document-" + documentId).toggle(); // Afficher/Masquer le formulaire
            });

            $(".update-document").click(function(e) {
                e.preventDefault();
                let documentId = $(this).data("id");


                let formData = new FormData($("#updateForm-" + documentId)[0]);


                $.ajax({
                    url: "<?php echo e(route('user.update_documents', ':id')); ?>".replace(':id', documentId),
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);

                        if (response.success) {
                            $(`#document-${documentId}`).html(`
                        <td>${response.document.libelle}</td>
                        <td>
                            <a target="_blank" href="/storage/${response.document.url}" class="btn btn-primary btn-sm">
                                <i class="fas fa-download"></i>
                            </a>
                        </td>
                        <td>
                            <button class="btn btn-warning btn-sm edit-document" data-id="${response.document.id}" data-libelle="${response.document.libelle}">Modifier</button>
                            <button class="btn btn-danger btn-sm delete-document" data-id="${response.document.id}">Supprimer</button>
                        </td>
                    `);

                            $("#documentForm")[0].reset();
                        }
                        $(".edit-document").off("click").on("click", function() {
                            let documentId = $(this).data("id");
                            $("#edit-form-document-" + documentId).toggle();
                        });

                        // SweetAlert pour confirmer la mise à jour et recharger la page
                        Swal.fire({

                            title: 'Succès',
                            text: 'Document mis à jour avec succès !',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            //location.reload(); // Recharger la page après confirmation
                        });
                    },
                    error: function() {
                        Swal.fire({

                            title: 'Erreur',
                            text: 'Une erreur est survenue lors de la mise à jour.',
                        });

                    }
                });
            });
            // Suppression du document avec AJAX
            $(document).on("click", ".delete-document", function() {
                let documentId = $(this).data("id");
                let row = $(this).closest("tr");

                Swal.fire({
                    title: "Êtes-vous sûr ?",
                    text: "Cette action est irréversible !",

                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Oui, supprimer !",
                    cancelButtonText: "Annuler"
                }).then((result) => {


                    if (result) {
                        $.ajax({
                            url: "<?php echo e(route('user.destroy_documents', ':id')); ?>".replace(
                                ':id', documentId),
                            type: "DELETE",
                            data: {
                                _token: "<?php echo e(csrf_token()); ?>"
                            },
                            success: function() {
                                row.remove();

                                Swal.fire({

                                    title: 'Succès',
                                    text: 'Document supprimé !',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    location
                                        .reload(); // Recharger la page après confirmation
                                });
                            },
                            error: function() {

                                Swal.fire({

                                    title: 'Erreur',
                                    text: 'Erreur lors de la suppression !.',
                                });
                            }
                        });
                    }
                });
            });

        });

        function toggleEditForm(id, type) {
            let form = document.getElementById("edit-form-" + type + "-" + id);
            if (form) {
                form.style.display = (form.style.display === "none") ? "table-row" : "none";
            }
        }

        $(document).ready(function() {

            function toggleNiveauField() {
                let typeField = $("#type").closest(".form-group").parent();
                let niveauField = $("#niveau").closest(".form-group").parent();
                if ($("#type").val() === "Hors Ligne (SIMU)") {
                    $("#niveau").closest(".form-group").hide();
                    niveauField.removeClass("col-lg-2").addClass("col-lg-0");
                    typeField.removeClass("col-lg-2").addClass("col-lg-3");
                    $("#niveau").val(null);
                } else {
                    $("#niveau").closest(".form-group").show();
                    niveauField.removeClass("col-lg-0").addClass("col-lg-2");
                    typeField.removeClass("col-lg-3").addClass("col-lg-2");
                }
            }
            toggleNiveauField();

            $("#type").change(function() {
                toggleNiveauField();
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('user.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lapto\OneDrive\Documents\laravel\anac\resources\views/user/edit.blade.php ENDPATH**/ ?>