
<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('trans.dashboard'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheader'); ?>
    <?php echo app('translator')->get('trans.dashboard'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheaderlink'); ?>
    <a href="<?php echo e(route('demandes')); ?>">
        <?php echo app('translator')->get('trans.dashboard'); ?> </a>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheaderactive'); ?>
    <?php echo app('translator')->get('trans.dashboard'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css">

    <style>
        #documentViewer {
            width: 210mm;
            height: 297mm;
            max-width: 100%;
            /* Makes it responsive */
            display: block;
            margin: auto;
            /* Center horizontally */
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>

    <div class="container">
        <h1></h1>
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <?php echo app('translator')->get('trans.profile'); ?>
                    </div>
                    <div class="card-body">
                        <?php if(isset($demandeur)): ?>
                            <div class="row justify-content-center">

                                <div class="col-lg-9">
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <th><?php echo app('translator')->get('trans.np'); ?></th>
                                            <td><?php echo e($demandeur->np ?? '-'); ?></td>
                                        </tr>
                                        <tr>

                                            <th><?php echo app('translator')->get('trans.date_naissance'); ?></th>
                                            <td><?php echo e(!empty($demandeur->date_naissance) ? date('Y-m-d', strtotime($demandeur->date_naissance)) : '-'); ?>

                                            </td>
                                        </tr>
                                        <tr>
                                            <th><?php echo app('translator')->get('trans.lieu_naissance'); ?></th>
                                            <td><?php echo e($demandeur->lieu_naissance ?? '-'); ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo app('translator')->get('trans.adresse'); ?></th>
                                            <td><?php echo e($demandeur->adresse ?? '-'); ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo app('translator')->get('trans.adresse_employeur'); ?></th>
                                            <td><?php echo e($demandeur->adresse_employeur ?? '-'); ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo app('translator')->get('trans.signature'); ?></th>
                                            <td class="text-center">
                                                <?php if(isset($demandeur->signature) && $demandeur->signature != ''): ?>
                                                    <img src="<?php echo e(asset('/uploads/' . $demandeur->signature)); ?>"
                                                        alt="User Signature" class="img-thumbnail" width="120">
                                                <?php else: ?>
                                                    -
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                <!-- Profile Picture -->
                                <div class="col-lg-3 text-center">
                                    <img src="<?php echo e(asset('/uploads/' . ($demandeur->photo ?? 'default.png'))); ?>"
                                        alt="Profile Picture" class="img-fluid rounded-circle"
                                        style="width: 150px; height: 150px; object-fit: cover;">
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>


                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <?php echo app('translator')->get('trans.medical_fitness_by_examiner'); ?>
                    </div>
                    <div class="card-body">

                        <?php if(isset($medical_examinations)): ?>
                            <div class="row">
                                <div class="col-lg-12 table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>

                                                <th><?php echo app('translator')->get('trans.exam_date'); ?></th>
                                                <th><?php echo app('translator')->get('trans.validity'); ?></th>
                                                <th><?php echo app('translator')->get('trans.examiner'); ?></th>
                                                <th><?php echo app('translator')->get('trans.medical_center'); ?></th>
                                                <th><?php echo app('translator')->get('trans.view_examiner'); ?></th>
                                                <th><?php echo app('translator')->get('trans.view_evaluator'); ?></th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $examens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $examen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($examen->date_examen); ?></td>
                                                    <td><?php echo e($examen->validite); ?></td>
                                                    <td><?php echo e($examen->examinateur->np); ?></td>
                                                    <td><?php echo e($examen->examinateur->centreMedical->libelle); ?></td>
                                                    <td>
                                                        <?php if($examen->valider_examinateur): ?>
                                                            <?php echo app('translator')->get('trans.validated'); ?>
                                                        <?php else: ?>
                                                            <?php echo app('translator')->get('trans.invalid'); ?>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php if($examen->valider_evaluateur): ?>
                                                            <?php echo app('translator')->get('trans.validated'); ?>
                                                        <?php else: ?>
                                                            <?php echo app('translator')->get('trans.invalid'); ?>
                                                        <?php endif; ?>
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
                        <?php echo app('translator')->get('trans.medical_fitness'); ?>
                    </div>
                    <div class="card-body">

                        <?php if(isset($medical_examinations)): ?>
                            <div class="row">
                                <div class="col-lg-12 table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>

                                                <th><?php echo app('translator')->get('trans.exam_date'); ?></th>
                                                <th><?php echo app('translator')->get('trans.validity'); ?></th>
                                                <th><?php echo app('translator')->get('trans.medical_center'); ?> </th>
                                                <th> <?php echo app('translator')->get('trans.proof'); ?></th>
                                                <th> <?php echo app('translator')->get('trans.validated_by_evaluator'); ?></th>
                                                <th><?php echo app('translator')->get('trans.actions'); ?> </th>

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
                                                            <button class="btn btn-primary"
                                                                onclick="openPdfModal('<?php echo e(asset('/uploads/' . $medical_examination->document)); ?>')"><i
                                                                    class="fas fa-eye"></i></button>
                                                        <?php endif; ?>


                                                    </td>
                                                    <td>
                                                        <?php if($medical_examination->valider_evaluateur): ?>
                                                            <?php echo app('translator')->get('trans.validated'); ?>
                                                        <?php else: ?>
                                                            <?php echo app('translator')->get('trans.invalid'); ?>
                                                        <?php endif; ?>

                                                    </td>
                                                    <td>
                                                        <?php if(!$medical_examination->valider_evaluateur && $medical_examination->valider): ?>
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                onclick="openRejectionModal('medical_examinations', '<?php echo e($medical_examination->id); ?>', '<?php echo e($demande->id); ?>')">
                                                                <?php echo app('translator')->get('trans.reject'); ?>
                                                            </button>
                                                        <?php endif; ?>

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
                        <?php echo app('translator')->get('trans.training'); ?>
                    </div>
                    <div class="card-body">

                        <?php if(isset($formations)): ?>
                            <div class="row">
                                <div class="col-lg-12 table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th><?php echo app('translator')->get('trans.training'); ?></th>
                                                <th><?php echo app('translator')->get('trans.training_center'); ?></th>
                                                <th><?php echo app('translator')->get('trans.location'); ?></th>
                                                <th><?php echo app('translator')->get('trans.training_date'); ?></th>
                                                <th><?php echo app('translator')->get('trans.proof'); ?></th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $formations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($formation->typeFormation->nom); ?></td>
                                                    <td><?php echo e($formation->centreFormation->libelle); ?></td>
                                                    <td><?php echo e($formation->lieu); ?></td>
                                                    <td><?php echo e($formation->date_formation); ?></td>
                                                    <td>
                                                        <?php if($formation->attestation): ?>
                                                            <button class="btn btn-primary"
                                                                onclick="openPdfModal('<?php echo e(asset('/uploads/' . $formation->attestation)); ?>')"><i
                                                                    class="fas fa-eye"></i></button>
                                                        <?php endif; ?>
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
                        <?php echo app('translator')->get('trans.license'); ?>
                    </div>

                    <div class="card-body">
                        <?php if(isset($licence_demandeurs)): ?>
                            <div class="row">
                                <div class="col-lg-12 table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th><?php echo app('translator')->get('trans.license_date'); ?></th>
                                                <th><?php echo app('translator')->get('trans.license_number'); ?></th>
                                                <th><?php echo app('translator')->get('trans.authority'); ?></th>
                                                <th><?php echo app('translator')->get('trans.location'); ?></th>
                                                <th><?php echo app('translator')->get('trans.proof'); ?></th>
                                                <th><?php echo app('translator')->get('trans.actions'); ?></th>
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
                                                        <?php if($licence_demandeur->document): ?>
                                                            <button class="btn btn-primary"
                                                                onclick="openPdfModal('<?php echo e(asset('/uploads/' . $licence_demandeur->document)); ?>')"><i
                                                                    class="fas fa-eye"></i></button>
                                                        <?php endif; ?>

                                                    </td>
                                                    <td>
                                                        <?php if($licence_demandeur->valider): ?>
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                onclick="openRejectionModal('licence_demandeurs', '<?php echo e($licence_demandeur->id); ?>', '<?php echo e($demande->id); ?>')">
                                                                <?php echo app('translator')->get('trans.reject'); ?>
                                                            </button>
                                                        <?php endif; ?>
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
                        <?php echo app('translator')->get('trans.training'); ?>
                    </div>
                    <div class="card-body">
                        <?php if(isset($formation_demandeurs)): ?>
                            <div class="row">
                                <div class="col-lg-12 table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>

                                                <th><?php echo app('translator')->get('trans.training_date'); ?></th>
                                                <th><?php echo app('translator')->get('trans.training_center'); ?></th>
                                                <th><?php echo app('translator')->get('trans.training_location'); ?></th>
                                                <th><?php echo app('translator')->get('trans.proof'); ?></th>
                                                <th><?php echo app('translator')->get('trans.actions'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $formation_demandeurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formation_demandeur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>

                                                    <td><?php echo e($formation_demandeur->date_formation); ?></td>
                                                    <td><?php echo e($formation_demandeur->centre_formation); ?></td>
                                                    <td><?php echo e($formation_demandeur->lieu); ?></td>
                                                    <td>
                                                        <?php if($formation_demandeur->document): ?>
                                                            <button class="btn btn-primary"
                                                                onclick="openPdfModal('<?php echo e(asset('/uploads/' . $formation_demandeur->document)); ?>')"><i
                                                                    class="fas fa-eye"></i></button>
                                                        <?php endif; ?>

                                                    </td>
                                                    <td>


                                                        <?php if($formation_demandeur->valider): ?>
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                onclick="openRejectionModal('formation_demandeurs', '<?php echo e($formation_demandeur->id); ?>', '<?php echo e($demande->id); ?>')">
                                                                <?php echo app('translator')->get('trans.reject'); ?>
                                                            </button>
                                                        <?php endif; ?>
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
                        <?php echo app('translator')->get('trans.ratings'); ?>
                    </div>
                    <div class="card-body">
                        <br>
                        <?php if(isset($qualification_demandeurs)): ?>
                            <div class="row">
                                <div class="col-lg-12 table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th><?php echo app('translator')->get('trans.rating'); ?></th>
                                                <?php if(in_array($demande->typeLicence->id, [27, 28, 29, 30, 31, 32, 37, 38, 39])): ?>
                                                    <th><?php echo app('translator')->get('trans.plane_type'); ?></th>
                                                    <th><?php echo app('translator')->get('trans.machine'); ?></th>
                                                <?php endif; ?>
                                                <?php if(in_array($demande->typeLicence->id, [27, 28, 29, 30, 31, 32])): ?>
                                                    <th><?php echo app('translator')->get('trans.engine_type'); ?></th>
                                                <?php endif; ?>
                                                <?php if($demande->typeLicence->id !== 33): ?>
                                                    <th><?php echo app('translator')->get('trans.privilege'); ?> </th>
                                                <?php endif; ?>
                                                <?php if($demande->typeLicence->id === 11): ?>
                                                    <th><?php echo app('translator')->get('trans.amt'); ?> </th>
                                                <?php endif; ?>
                                                <?php if(in_array($demande->typeLicence->id, [37, 38])): ?>
                                                    <th><?php echo app('translator')->get('trans.atc'); ?> </th>
                                                <?php endif; ?>
                                                <?php if($demande->typeLicence->id === 34): ?>
                                                    <th><?php echo app('translator')->get('trans.rpa'); ?> </th>
                                                <?php endif; ?>
                                                <?php if($demande->typeLicence->id === 33): ?>
                                                    <th><?php echo app('translator')->get('trans.ulm'); ?> </th>
                                                <?php endif; ?>
                                                <th><?php echo app('translator')->get('trans.exam_date'); ?> </th>
                                                <th><?php echo app('translator')->get('trans.training_center'); ?> </th>
                                                <th><?php echo app('translator')->get('trans.location'); ?> </th>
                                                <th><?php echo app('translator')->get('trans.proof'); ?> </th>
                                                <th><?php echo app('translator')->get('trans.privilege'); ?> </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $qualification_demandeurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $qualification_demandeur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($qualification_demandeur->qualification); ?></td>
                                                    <?php if(in_array($demande->typeLicence->id, [27, 28, 29, 30, 31, 32, 37, 38, 39])): ?>
                                                        <td><?php echo e(optional($qualification_demandeur->typeAvion)->code); ?></td>
                                                        <td><?php echo e($qualification_demandeur->machine); ?></td>
                                                    <?php endif; ?>
                                                    <?php if(in_array($demande->typeLicence->id, [27, 28, 29, 30, 31, 32])): ?>
                                                        <td><?php echo e($qualification_demandeur->type_moteur); ?></td>
                                                    <?php endif; ?>
                                                    <?php if($demande->typeLicence->id !== 33): ?>
                                                        <td><?php echo e($qualification_demandeur->type_privilege); ?></td>
                                                    <?php endif; ?>
                                                    <?php if(in_array($demande->typeLicence->id, [37, 38])): ?>
                                                        <td><?php echo e($qualification_demandeur->amt); ?></td>
                                                    <?php endif; ?>
                                                    <?php if($demande->typeLicence->id === 35): ?>
                                                        <td><?php echo e($qualification_demandeur->atc); ?></td>
                                                    <?php endif; ?>
                                                    <?php if($demande->typeLicence->id === 34): ?>
                                                        <td><?php echo e($qualification_demandeur->rpa); ?></td>
                                                    <?php endif; ?>
                                                    <?php if($demande->typeLicence->id === 33): ?>
                                                        <td><?php echo e($qualification_demandeur->ulm); ?></td>
                                                    <?php endif; ?>
                                                    <td><?php echo e($qualification_demandeur->date_examen); ?></td>
                                                    <td><?php echo e($qualification_demandeur->centre_formation); ?></td>
                                                    <td><?php echo e($qualification_demandeur->lieu); ?></td>
                                                    <td>
                                                        <?php if($qualification_demandeur->document): ?>
                                                            <button class="btn btn-primary"
                                                                onclick="openPdfModal('<?php echo e(asset('/uploads/' . $qualification_demandeur->document)); ?>')"><i
                                                                    class="fas fa-eye"></i></button>
                                                        <?php endif; ?>

                                                    </td>
                                                    <td>
                                                        <?php if($qualification_demandeur->valider): ?>
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                onclick="openRejectionModal('qualification_demandeurs', '<?php echo e($qualification_demandeur->id); ?>', '<?php echo e($demande->id); ?>')">
                                                                <?php echo app('translator')->get('trans.reject'); ?>
                                                            </button>
                                                        <?php endif; ?>
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
                        <?php echo app('translator')->get('trans.flights'); ?>
                    </div>

                    <div class="card-body">
                        <?php if(isset($experience_demandeurs)): ?>
                            <div class="row">
                                <div class="col-lg-12 table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>

                                                <th><?php echo app('translator')->get('trans.flights_type'); ?></th>
                                                <th><?php echo app('translator')->get('trans.total'); ?></th>
                                                <th><?php echo app('translator')->get('trans.six'); ?></th>
                                                <th><?php echo app('translator')->get('trans.three'); ?></th>
                                                <th><?php echo app('translator')->get('trans.proof'); ?></th>
                                                <th><?php echo app('translator')->get('trans.actions'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $experience_demandeurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $experience_demandeur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($experience_demandeur->nature); ?></td>
                                                    <td><?php echo e($experience_demandeur->total); ?></td>
                                                    <td><?php echo e($experience_demandeur->six_mois); ?></td>
                                                    <td><?php echo e($experience_demandeur->trois_mois); ?></td>
                                                    <td>
                                                        <?php if($experience_demandeur->document): ?>
                                                            <button class="btn btn-primary"
                                                                onclick="openPdfModal('<?php echo e(asset('/uploads/' . $experience_demandeur->document)); ?>')"><i
                                                                    class="fas fa-eye"></i></button>
                                                        <?php endif; ?>

                                                    </td>
                                                    <td>
                                                        <?php if($experience_demandeur->valider): ?>
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                onclick="openRejectionModal('experience_demandeurs', '<?php echo e($experience_demandeur->id); ?>', '<?php echo e($demande->id); ?>')">
                                                                <?php echo app('translator')->get('trans.reject'); ?>
                                                            </button>
                                                        <?php endif; ?>
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
                        <?php echo app('translator')->get('trans.control'); ?>
                    </div>
                    <div class="card-body">
                        <?php if(isset($competence_demandeurs)): ?>
                            <div class="row">
                                <div class="col-lg-12 table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>

                                                <th> <?php echo app('translator')->get('trans.type'); ?></th>
                                                <th> <?php echo app('translator')->get('trans.level'); ?></th>
                                                <th> <?php echo app('translator')->get('trans.date'); ?></th>
                                                <th> <?php echo app('translator')->get('trans.validity'); ?></th>
                                                <th> <?php echo app('translator')->get('trans.location'); ?></th>
                                                <th> <?php echo app('translator')->get('trans.proof'); ?></th>
                                                <th> <?php echo app('translator')->get('trans.actions'); ?></th>
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
                                                        <?php if($competence_demandeur->document): ?>
                                                            <button class="btn btn-primary"
                                                                onclick="openPdfModal('<?php echo e(asset('/uploads/' . $competence_demandeur->document)); ?>')"><i
                                                                    class="fas fa-eye"></i></button>
                                                        <?php endif; ?>

                                                    </td>
                                                    <td>
                                                        <?php if($competence_demandeur->valider): ?>
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                onclick="openRejectionModal('competence_demandeurs', '<?php echo e($competence_demandeur->id); ?>', '<?php echo e($demande->id); ?>')">
                                                                <?php echo app('translator')->get('trans.reject'); ?>
                                                            </button>
                                                        <?php endif; ?>
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
                        <?php echo app('translator')->get('trans.periodic_control'); ?>
                    </div>
                    <div class="card-body">
                        <?php if(isset($entrainement_demandeurs)): ?>
                            <div class="row">
                                <div class="col-lg-12 table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>

                                                <th><?php echo app('translator')->get('trans.type'); ?></th>

                                                <th><?php echo app('translator')->get('trans.date'); ?></th>
                                                <th><?php echo app('translator')->get('trans.validity'); ?></th>
                                                <th><?php echo app('translator')->get('trans.location'); ?></th>
                                                <th><?php echo app('translator')->get('trans.proof'); ?></th>
                                                <th><?php echo app('translator')->get('trans.actions'); ?></th>
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
                                                        <?php if($entrainement_demandeur->document): ?>
                                                            <button class="btn btn-primary"
                                                                onclick="openPdfModal('<?php echo e(asset('/uploads/' . $entrainement_demandeur->document)); ?>')"><i
                                                                    class="fas fa-eye"></i></button>
                                                        <?php endif; ?>

                                                    </td>
                                                    <td>
                                                        <?php if($entrainement_demandeur->valider): ?>
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                onclick="openRejectionModal('entrainement_demandeurs', '<?php echo e($entrainement_demandeur->id); ?>', '<?php echo e($demande->id); ?>')">
                                                                <?php echo app('translator')->get('trans.reject'); ?>
                                                            </button>
                                                        <?php endif; ?>
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
                        <?php echo app('translator')->get('trans.interruptions'); ?>
                    </div>

                    <div class="card-body">
                        <?php if(isset($interruption_demandeurs)): ?>
                            <div class="row">
                                <div class="col-lg-12 table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th><?php echo app('translator')->get('trans.start_date'); ?></th>
                                                <th><?php echo app('translator')->get('trans.end_date'); ?></th>
                                                <th><?php echo app('translator')->get('trans.reason'); ?></th>
                                                <th><?php echo app('translator')->get('trans.proof'); ?></th>
                                                <th><?php echo app('translator')->get('trans.actions'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $interruption_demandeurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $interruption_demandeur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($interruption_demandeur->date_debut); ?></td>
                                                    <td><?php echo e($interruption_demandeur->date_fin); ?></td>
                                                    <td><?php echo e($interruption_demandeur->raison); ?></td>
                                                    <td>
                                                        <?php if($interruption_demandeur->document): ?>
                                                            <button class="btn btn-primary"
                                                                onclick="openPdfModal('<?php echo e(asset('/uploads/' . $interruption_demandeur->document)); ?>')"><i
                                                                    class="fas fa-eye"></i></button>
                                                        <?php endif; ?>

                                                    </td>
                                                    <td>
                                                        <?php if($interruption_demandeur->valider): ?>
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                onclick="openRejectionModal('interruption_demandeurs', '<?php echo e($interruption_demandeur->id); ?>', '<?php echo e($demande->id); ?>')">
                                                                <?php echo app('translator')->get('trans.reject'); ?>
                                                            </button>
                                                        <?php endif; ?>
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

                        <?php echo app('translator')->get('trans.maintenance'); ?>
                    </div>

                    <div class="card-body">
                        <?php if(isset($experience_maintenance_demandeurs)): ?>
                            <div class="row">
                                <div class="col-lg-12 table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>



                                                <th><?php echo app('translator')->get('trans.start_date'); ?></th>
                                                <th><?php echo app('translator')->get('trans.end_date'); ?></th>
                                                <th><?php echo app('translator')->get('trans.description'); ?></th>
                                                <th><?php echo app('translator')->get('trans.proof'); ?></th>
                                                <th><?php echo app('translator')->get('trans.actions'); ?></th>
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
                                                        <?php if($experience_maintenance_demandeur->document): ?>
                                                            <button class="btn btn-primary"
                                                                onclick="openPdfModal('<?php echo e(asset('/uploads/' . $experience_maintenance_demandeur->document)); ?>')"><i
                                                                    class="fas fa-eye"></i></button>
                                                        <?php endif; ?>

                                                    </td>
                                                    <td>
                                                        <?php if($experience_maintenance_demandeur->valider): ?>
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                onclick="openRejectionModal('experience_maintenance_demandeurs', '<?php echo e($experience_maintenance_demandeur->id); ?>', '<?php echo e($demande->id); ?>')">
                                                                <?php echo app('translator')->get('trans.reject'); ?>
                                                            </button>
                                                        <?php endif; ?>
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
                        <?php echo app('translator')->get('trans.employers'); ?>
                    </div>

                    <div class="card-body">
                        <?php if(isset($employeur_demandeurs)): ?>
                            <div class="row">
                                <div class="col-lg-12 table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>


                                                <th><?php echo app('translator')->get('trans.employer'); ?></th>
                                                <th><?php echo app('translator')->get('trans.start_date'); ?></th>
                                                <th><?php echo app('translator')->get('trans.end_date'); ?></th>
                                                <th><?php echo app('translator')->get('trans.role'); ?></th>
                                                <th><?php echo app('translator')->get('trans.proof'); ?></th>
                                                <th><?php echo app('translator')->get('trans.actions'); ?></th>
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
                                                        <?php if($experience_maintenance_demandeur->document): ?>
                                                            <button class="btn btn-primary"
                                                                onclick="openPdfModal('<?php echo e(asset('/uploads/' . $experience_maintenance_demandeur->document)); ?>')"><i
                                                                    class="fas fa-eye"></i></button>
                                                        <?php endif; ?>

                                                    </td>
                                                    <td>

                                                        <?php if($experience_maintenance_demandeur->valider): ?>
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                onclick="openRejectionModal('experience_maintenance_demandeurs', '<?php echo e($experience_maintenance_demandeur->id); ?>', '<?php echo e($demande->id); ?>')">
                                                                <?php echo app('translator')->get('trans.reject'); ?>
                                                            </button>
                                                        <?php endif; ?>
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
                        <?php echo app('translator')->get('trans.attachments'); ?>
                    </div>

                    <div class="card-body">
                        <?php if(isset($documents)): ?>
                            <div class="row">
                                <div class="col-lg-12 table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>

                                                <th><?php echo app('translator')->get('trans.title'); ?></th>

                                                <th><?php echo app('translator')->get('trans.attachment'); ?></th>
                                                <th><?php echo app('translator')->get('trans.actions'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e(LaravelLocalization::getCurrentLocale() == 'fr' ? $document->nom_fr : $document->nom_en); ?>

                                                    </td>
                                                    <td>
                                                        <?php if(!empty($document->url)): ?>
                                                            <button class="btn btn-primary"
                                                                onclick="openPdfModal('<?php echo e(asset('/uploads/' . $document->url)); ?>')"><i
                                                                    class="fas fa-eye"></i></button>
                                                        <?php else: ?>
                                                            -
                                                        <?php endif; ?>

                                                    </td>
                                                    <td>


                                                        <?php if($document->valider): ?>
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                onclick="openRejectionModal('documents', '<?php echo e($document->id); ?>', '<?php echo e($demande->id); ?>')">
                                                                <?php echo app('translator')->get('trans.reject'); ?>
                                                            </button>
                                                        <?php endif; ?>
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



        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Checklist
                        <?php if(!empty($demande->checklist_admin)): ?>
                            <div class="card-tools">
                                <a href="<?php echo e(asset('uploads/' . $demande->checklist_admin)); ?>" target="_blank"
                                    class="btn btn-sm btn-success">
                                    <i class="fas fa-eye"></i> <?php echo app('translator')->get('trans.view'); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="card-body">

                        <form action="<?php echo e(route('dsv.checklist', ['demande' => $demande])); ?>" method="POST"
                            enctype="multipart/form-data" class="mb-4">
                            <?php echo csrf_field(); ?>
                            <div class="mb-3">
                                <label for="checklistFile" class="form-label"><?php echo app('translator')->get('trans.checklist'); ?></label>
                                <input class="form-control" type="file" id="checklistFile" name="checklist"
                                    accept=".pdf" required>
                                <div class="form-text"><?php echo app('translator')->get('trans.checklist_indication'); ?></div>
                            </div>
                            <button type="submit" class="btn btn-primary float-right">
                                <i class="fa fa-paper-plane" aria-hidden="true"></i>
                            </button>
                        </form>

                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <?php echo app('translator')->get('trans.description'); ?>
                    </div>
                    <div class="card-body">
                        <!-- Formulaire -->
                        <?php if(empty($demande->description)): ?>
                            <form action="<?php echo e(route('demandes.update', $demande)); ?>" method="POST"
                                enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="mb-3">
                                    <label class="form-label"><?php echo app('translator')->get('trans.description'); ?></label>
                                    <textarea name="description" class="form-control summernote" rows="3"></textarea>
                                </div>
                                <button type="submit" class="btn btn-success float-right"><?php echo app('translator')->get('trans.send'); ?></button>
                            </form>
                        <?php else: ?>
                            <?php echo $demande->description; ?>

                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modale pour le motif de rejet -->
    <div class="modal fade" id="rejectionModal" tabindex="-1" aria-labelledby="rejectionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectionModalLabel"><?php echo app('translator')->get('trans.rejection_reason'); ?></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="rejectionForm" method="POST" class="d-inline">
                        <?php echo csrf_field(); ?>

                        <div class="form-group">
                            <label for="motif"><?php echo app('translator')->get('trans.rejection_reason_indication'); ?></label>
                            <textarea name="motif" id="motif" class="form-control" rows="3" required></textarea>
                        </div>
                        <input type="hidden" name="table" id="table">
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="demande_id" id="demande_id">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo app('translator')->get('trans.close'); ?></button>
                    <button type="button" class="btn btn-danger"
                        onclick="submitRejectionForm()"><?php echo app('translator')->get('trans.reject'); ?></button>
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
        // Fonction pour ouvrir la modale et définir les valeurs du formulaire
        function openRejectionModal(table, id, demande) {
            // Définir les valeurs des champs cachés
            document.getElementById('table').value = table;
            document.getElementById('id').value = id;
            document.getElementById('demande_id').value = demande;

            // Ouvrir la modale
            new bootstrap.Modal(document.getElementById('rejectionModal')).show();
        }

        function submitRejectionForm() {
            const motif = document.getElementById('motif').value;
            if (!motif) {
                alert('Veuillez saisir un motif de rejet.');
                return;
            }

            // Confirmer avant de soumettre
            if (confirm('Confirmer le rejet de cette information ?')) {
                const form = $('#rejectionForm');
                const data = form.serialize();
                $.ajax({
                    url: "<?php echo e(route('rejeter')); ?>",
                    type: 'POST',
                    data: data,
                    success: function(response) {

                        alert('Rejet effectué avec succès !');
                        window.location.reload();
                    },
                    error: function(xhr) {
                        alert('Une erreur s\'est produite : ' + xhr.responseText);
                    }
                });


            }
        }
    </script>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 200, // Set height of the editor
                placeholder: 'Enter your text...',

            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lapto\OneDrive\Documents\laravel\anac\resources\views/admin/demandes/show.blade.php ENDPATH**/ ?>