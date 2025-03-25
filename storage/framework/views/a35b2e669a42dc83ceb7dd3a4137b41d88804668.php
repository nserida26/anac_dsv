
<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('sec.dashboard'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheader'); ?>
    <?php echo app('translator')->get('sec.dashboard'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheaderlink'); ?>
    <?php if(auth()->user()->hasRole('sla')): ?>
        <a href="<?php echo e(route('sla')); ?>">
            <?php echo app('translator')->get('sec.dashboard'); ?> </a>
    <?php endif; ?>
    <?php if(auth()->user()->hasRole('sma')): ?>
        <a href="<?php echo e(route('sma')); ?>">
            <?php echo app('translator')->get('sec.dashboard'); ?> </a>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheaderactive'); ?>
    <?php echo app('translator')->get('sec.dashboard'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css'); ?>
    <style>
        #documentViewer {

            width: 105mm;
            height: 148mm;
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
                        Profile
                    </div>
                    <div class="card-body">
                        <?php if(isset($demandeur)): ?>
                            <div class="row justify-content-center">

                                <div class="col-lg-9 table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <th><?php echo app('translator')->get('user.np'); ?></th>
                                            <td><?php echo e($demandeur->np ?? '-'); ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo app('translator')->get('user.date_naissance'); ?></th>
                                            <td><?php echo e($demandeur->date_naissance ?? '-'); ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo app('translator')->get('user.lieu_naissance'); ?></th>
                                            <td><?php echo e($demandeur->lieu_naissance ?? '-'); ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo app('translator')->get('user.adresse'); ?></th>
                                            <td><?php echo e($demandeur->adresse ?? '-'); ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo app('translator')->get('user.adresse_employeur'); ?></th>
                                            <td><?php echo e($demandeur->adresse_employeur ?? '-'); ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo app('translator')->get('user.signature'); ?></th>
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


                <!----->
                <?php if(auth()->user()->hasRole('sma')): ?>
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Aptitude Médicale par l'examinateur medical
                        </div>
                        <div class="card-body">

                            <?php if(isset($medical_examinations)): ?>
                                <div class="row">
                                    <div class="col-lg-12 table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>

                                                    <th>Date de l'Examen</th>
                                                    <th>Validité en mois</th>
                                                    <th>Examinateur</th>
                                                    <th>Centre Médical</th>
                                                    <th>Avis de l'Examinateur</th>
                                                    <th>Avis de l'Evaluateur</th>

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
                                                                Validé
                                                            <?php else: ?>
                                                                Non Validé
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php if($examen->valider_evaluateur): ?>
                                                                Validé
                                                            <?php else: ?>
                                                                Non Validé
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
                            Aptitude Médicale
                        </div>
                        <div class="card-body">

                            <?php if(isset($medical_examinations)): ?>
                                <div class="row">
                                    <div class="col-lg-12 table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>

                                                    <th>Date de l'Examen</th>
                                                    <th>Validité en mois</th>
                                                    <th>Centre Médical</th>
                                                    <th> Justificatif</th>
                                                    <th> Valider par l'evaluateur</th>
                                                    <th>Actions </th>

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
                                                                Valideé
                                                            <?php else: ?>
                                                                Non Valideé
                                                            <?php endif; ?>

                                                        </td>
                                                        <td>
                                                            <?php if(!$medical_examination->valider_evaluateur && $medical_examination->valider): ?>
                                                                <button type="button" class="btn btn-danger btn-sm"
                                                                    onclick="openRejectionModal('medical_examinations', '<?php echo e($medical_examination->id); ?>', '<?php echo e($demande->id); ?>')">
                                                                    Rejeter
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
                <?php endif; ?>
                <?php if(auth()->user()->hasRole('sla')): ?>
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Formations , Qualifications et Entraînements periodiques
                        </div>
                        <div class="card-body">

                            <?php if(isset($formations)): ?>
                                <div class="row">
                                    <div class="col-lg-12 table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Type</th>
                                                    <th>Centre de formation</th>
                                                    <th>Lieu</th>
                                                    <th>Date de formation</th>
                                                    <th>Attestation</th>


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
                            Licence
                        </div>

                        <div class="card-body">
                            <?php if(isset($licence_demandeurs)): ?>
                                <div class="row">
                                    <div class="col-lg-12 table-responsive">
                                        <table class="table table-striped table-bordered">
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
                                                                    Rejeter
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
                            Formations
                        </div>
                        <div class="card-body">
                            <?php if(isset($formation_demandeurs)): ?>
                                <div class="row">
                                    <div class="col-lg-12 table-responsive">
                                        <table class="table table-striped table-bordered">
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
                                                                    Rejeter
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
                            Qualifications
                        </div>
                        <div class="card-body">
                            <br>
                            <?php if(isset($qualification_demandeurs)): ?>
                                <div class="row">
                                    <div class="col-lg-12 table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Qualification</th>
                                                    <?php if(in_array($demande->typeLicence->id, [27, 28, 29, 30, 31, 32, 37, 38, 39])): ?>
                                                        <th>Type d'avion</th>
                                                        <th>Machine</th>
                                                    <?php endif; ?>
                                                    <?php if(in_array($demande->typeLicence->id, [27, 28, 29, 30, 31, 32])): ?>
                                                        <th>Type de moteur</th>
                                                    <?php endif; ?>
                                                    <?php if($demande->typeLicence->id !== 33): ?>
                                                        <th>Privilege</th>
                                                    <?php endif; ?>
                                                    <?php if($demande->typeLicence->id === 11): ?>
                                                        <th>Qualification AMT</th>
                                                    <?php endif; ?>
                                                    <?php if(in_array($demande->typeLicence->id, [37, 38])): ?>
                                                        <th>Qualification ATC</th>
                                                    <?php endif; ?>
                                                    <?php if($demande->typeLicence->id === 34): ?>
                                                        <th>Qualification RPA</th>
                                                    <?php endif; ?>
                                                    <?php if($demande->typeLicence->id === 33): ?>
                                                        <th>Qualification ULM</th>
                                                    <?php endif; ?>
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
                                                                    Rejeter
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
                            Expérience en heures de vol
                        </div>

                        <div class="card-body">
                            <?php if(isset($experience_demandeurs)): ?>
                                <div class="row">
                                    <div class="col-lg-12 table-responsive">
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
                                                                    Rejeter
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
                            Contrôles de compétence les plus récents
                        </div>
                        <div class="card-body">
                            <?php if(isset($competence_demandeurs)): ?>
                                <div class="row">
                                    <div class="col-lg-12 table-responsive">
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
                                                                    Rejeter
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
                            Entraînements périodiques
                        </div>
                        <div class="card-body">
                            <?php if(isset($entrainement_demandeurs)): ?>
                                <div class="row">
                                    <div class="col-lg-12 table-responsive">
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
                                                                    Rejeter
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
                            Interruptions
                        </div>

                        <div class="card-body">
                            <?php if(isset($interruption_demandeurs)): ?>
                                <div class="row">
                                    <div class="col-lg-12 table-responsive">
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
                                                                    Rejeter
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
                            Expérience en maintenance d'aéronefs
                        </div>

                        <div class="card-body">
                            <?php if(isset($experience_maintenance_demandeurs)): ?>
                                <div class="row">
                                    <div class="col-lg-12 table-responsive">
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
                                                                    Rejeter
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
                            Employeurs
                        </div>

                        <div class="card-body">
                            <?php if(isset($employeur_demandeurs)): ?>
                                <div class="row">
                                    <div class="col-lg-12 table-responsive">
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
                                                                    Rejeter
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
                            Pièce-jointe
                        </div>

                        <div class="card-body">
                            <?php if(isset($documents)): ?>
                                <div class="row">
                                    <div class="col-lg-12 table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>

                                                    <th>Libellé</th>

                                                    <th>Document</th>
                                                    <th>Actions</th>
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
                                                                    Rejeter
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
                <?php endif; ?>
            </div>
            <!-- /.card-body -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Checklist

                        <?php if(auth()->user()->hasRole('sma') && !empty($demande->checklist_sma)): ?>
                            <div class="card-tools">
                                <a href="<?php echo e(asset('uploads/' . $demande->checklist_sma)); ?>" target="_blank"
                                    class="btn btn-sm btn-success">
                                    <i class="fas fa-eye"></i> Voir
                                </a>
                            </div>
                        <?php endif; ?>
                        <?php if(auth()->user()->hasRole('sla') && !empty($demande->checklist_sla)): ?>
                            <div class="card-tools">
                                <a href="<?php echo e(asset('uploads/' . $demande->checklist_sla)); ?>" target="_blank"
                                    class="btn btn-sm btn-success">
                                    <i class="fas fa-eye"></i> Voir
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo e(route('dsv.checklist', ['demande' => $demande])); ?>" method="POST"
                            enctype="multipart/form-data" class="mb-4">
                            <?php echo csrf_field(); ?>
                            <div class="mb-3">
                                <label for="checklistFile" class="form-label">Fichier Checklist (PDF
                                    uniquement)</label>
                                <input class="form-control" type="file" id="checklistFile" name="checklist"
                                    accept=".pdf" required>
                                <div class="form-text">Veuillez sélectionner un fichier PDF (max: 5MB)</div>
                            </div>
                            <button type="submit" class="btn btn-primary float-right">
                                <?php if(auth()->user()->hasRole('sla')): ?>
                                    <?php echo e($demande->checklist_sla ? 'Mettre à jour' : 'Envoyer'); ?>

                                <?php else: ?>
                                    <?php echo e($demande->checklist_sma ? 'Mettre à jour' : 'Envoyer'); ?>

                                <?php endif; ?>
                            </button>
                        </form>
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
                    <h5 class="modal-title" id="rejectionModalLabel">Motif de rejet</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="rejectionForm" method="POST" class="d-inline">
                        <?php echo csrf_field(); ?>

                        <div class="form-group">
                            <label for="motif">Veuillez préciser le motif de rejet :</label>
                            <textarea name="motif" id="motif" class="form-control" rows="3" required></textarea>
                        </div>
                        <input type="hidden" name="table" id="table">
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="demande_id" id="demande_id">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-danger" onclick="submitRejectionForm()">Rejeter</button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('sec.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lapto\OneDrive\Documents\laravel\anac\resources\views/sec/show.blade.php ENDPATH**/ ?>