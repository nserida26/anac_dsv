
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

                                <div class="col-lg-9">
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
                                    <div class="col-lg-12">
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
                                    <div class="col-lg-12">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>

                                                    <th>Date de l'Examen</th>
                                                    <th>Validité en mois</th>
                                                    <th>Centre Médical</th>
                                                    <th> Justificatif</th>
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
                                                                <iframe id="documentViewer"
                                                                    src="<?php echo e(asset('/uploads/' . $medical_examination->document)); ?>"
                                                                    frameborder="0"></iframe>
                                                            <?php endif; ?>

                                                        </td>
                                                        <td>
                                                            <form
                                                                action="<?php echo e(route('rejeter', ['table' => 'medical_examinations', 'id' => $medical_examination->id, 'demande' => $demande])); ?>"
                                                                method="POST" class="d-inline">
                                                                <?php echo csrf_field(); ?>
                                                                <?php echo method_field('PATCH'); ?>
                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Confirmer le rejet de cette  informtion ?')">
                                                                    Rejeter
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
                <?php endif; ?>
                <?php if(auth()->user()->hasRole('sla')): ?>
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Formations , Qualifications et Entraînements periodiques
                        </div>
                        <div class="card-body">

                            <?php if(isset($formations)): ?>
                                <div class="row">
                                    <div class="col-lg-12">
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
                                                        <td><iframe id="documentViewer"
                                                                src="<?php echo e(asset('/uploads/' . $formation->attestation)); ?>"></iframe>
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
                                    <div class="col-lg-12">
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
                                                                <iframe id="documentViewer"
                                                                    src="<?php echo e(asset('/uploads/' . $licence_demandeur->document)); ?>"
                                                                    frameborder="0"></iframe>
                                                            <?php endif; ?>

                                                        </td>
                                                        <td>
                                                            <form
                                                                action="<?php echo e(route('rejeter', ['table' => 'licence_demandeurs', 'id' => $licence_demandeur->id, 'demande' => $demande])); ?>"
                                                                method="POST" class="d-inline">
                                                                <?php echo csrf_field(); ?>
                                                                <?php echo method_field('PATCH'); ?>
                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Confirmer le rejet de cette  informtion ?')">
                                                                    Rejeter
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
                            Formations
                        </div>
                        <div class="card-body">
                            <?php if(isset($formation_demandeurs)): ?>
                                <div class="row">
                                    <div class="col-lg-12">
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
                                                                <iframe id="documentViewer"
                                                                    src="<?php echo e(asset('/uploads/' . $formation_demandeur->document)); ?>"
                                                                    frameborder="0"></iframe>
                                                            <?php endif; ?>

                                                        </td>
                                                        <td>

                                                            <form
                                                                action="<?php echo e(route('rejeter', ['table' => 'formation_demandeurs', 'id' => $formation_demandeur->id, 'demande' => $demande])); ?>"
                                                                method="POST" class="d-inline">

                                                                <?php echo csrf_field(); ?>
                                                                <?php echo method_field('PATCH'); ?>
                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Confirmer le rejet de cette  informtion ?')">
                                                                    Rejeter
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
                            Qualifications
                        </div>
                        <div class="card-body">
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
                                                        <td><?php echo e($qualification_demandeur->date_examen); ?></td>
                                                        <td><?php echo e($qualification_demandeur->centre_formation); ?></td>
                                                        <td><?php echo e($qualification_demandeur->lieu); ?></td>
                                                        <td>
                                                            <?php if($qualification_demandeur->document): ?>
                                                                <iframe id="documentViewer"
                                                                    src="<?php echo e(asset('/uploads/' . $qualification_demandeur->document)); ?>"
                                                                    frameborder="0"></iframe>
                                                            <?php endif; ?>

                                                        </td>
                                                        <td>
                                                            <form
                                                                action="<?php echo e(route('rejeter', ['table' => 'qualification_demandeurs', 'id' => $qualification_demandeur->id, 'demande' => $demande])); ?>"
                                                                method="POST" class="d-inline">

                                                                <?php echo csrf_field(); ?>
                                                                <?php echo method_field('PATCH'); ?>
                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Confirmer le rejet de cette  informtion ?')">
                                                                    Rejeter
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
                            Expérience en heures de vol
                        </div>

                        <div class="card-body">
                            <?php if(isset($experience_demandeurs)): ?>
                                <div class="row">
                                    <div class="col-lg-12">
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
                                                                <iframe id="documentViewer"
                                                                    src="<?php echo e(asset('/uploads/' . $experience_demandeur->document)); ?>"
                                                                    frameborder="0"></iframe>
                                                            <?php endif; ?>

                                                        </td>
                                                        <td>
                                                            <form
                                                                action="<?php echo e(route('rejeter', ['table' => 'experience_demandeurs', 'id' => $experience_demandeur->id, 'demande' => $demande])); ?>"
                                                                method="POST" class="d-inline">

                                                                <?php echo csrf_field(); ?>
                                                                <?php echo method_field('PATCH'); ?>
                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Confirmer le rejet de cette  informtion ?')">
                                                                    Rejeter
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
                            Contrôles de compétence les plus récents
                        </div>
                        <div class="card-body">
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
                                                            <?php if($competence_demandeur->document): ?>
                                                                <iframe id="documentViewer"
                                                                    src="<?php echo e(asset('/uploads/' . $competence_demandeur->document)); ?>"
                                                                    frameborder="0"></iframe>
                                                            <?php endif; ?>

                                                        </td>
                                                        <td>
                                                            <form
                                                                action="<?php echo e(route('rejeter', ['table' => 'competence_demandeurs', 'id' => $competence_demandeur->id, 'demande' => $demande])); ?>"
                                                                method="POST" class="d-inline">

                                                                <?php echo csrf_field(); ?>
                                                                <?php echo method_field('PATCH'); ?>
                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Confirmer le rejet de cette  informtion ?')">
                                                                    Rejeter
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
                            Entraînements périodiques
                        </div>
                        <div class="card-body">
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
                                                            <?php if($entrainement_demandeur->document): ?>
                                                                <iframe id="documentViewer"
                                                                    src="<?php echo e(asset('/uploads/' . $entrainement_demandeur->document)); ?>"
                                                                    frameborder="0"></iframe>
                                                            <?php endif; ?>

                                                        </td>
                                                        <td>
                                                            <form
                                                                action="<?php echo e(route('rejeter', ['table' => 'training_demandeurs', 'id' => $entrainement_demandeur->id, 'demande' => $demande])); ?>"
                                                                method="POST" class="d-inline">
                                                                <?php echo csrf_field(); ?>
                                                                <?php echo method_field('PATCH'); ?>
                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Confirmer le rejet de cette  informtion ?')">
                                                                    Rejeter
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
                            Interruptions
                        </div>

                        <div class="card-body">
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
                                                            <?php if($interruption_demandeur->document): ?>
                                                                <iframe id="documentViewer"
                                                                    src="<?php echo e(asset('/uploads/' . $interruption_demandeur->document)); ?>"
                                                                    frameborder="0"></iframe>
                                                            <?php endif; ?>

                                                        </td>
                                                        <td>
                                                            <form
                                                                action="<?php echo e(route('rejeter', ['table' => 'interruption_demandeurs', 'id' => $interruption_demandeur->id, 'demande' => $demande])); ?>"
                                                                method="POST" class="d-inline">

                                                                <?php echo csrf_field(); ?>
                                                                <?php echo method_field('PATCH'); ?>
                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Confirmer le rejet de cette  informtion ?')">
                                                                    Rejeter
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
                            Expérience en maintenance d'aéronefs
                        </div>

                        <div class="card-body">
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
                                                            <?php if($experience_maintenance_demandeur->document): ?>
                                                                <iframe id="documentViewer"
                                                                    src="<?php echo e(asset('/uploads/' . $experience_maintenance_demandeur->document)); ?>"
                                                                    frameborder="0"></iframe>
                                                            <?php endif; ?>

                                                        </td>
                                                        <td>
                                                            <form
                                                                action="<?php echo e(route('rejeter', ['table' => 'experience_maintenance_demandeurs', 'id' => $experience_maintenance_demandeur->id, 'demande' => $demande])); ?>"
                                                                method="POST" class="d-inline">

                                                                <?php echo csrf_field(); ?>
                                                                <?php echo method_field('PATCH'); ?>
                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Confirmer le rejet de cette  informtion ?')">
                                                                    Rejeter
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
                                                            <?php if($experience_maintenance_demandeur->document): ?>
                                                                <iframe id="documentViewer"
                                                                    src="<?php echo e(asset('/uploads/' . $experience_maintenance_demandeur->document)); ?>"
                                                                    frameborder="0"></iframe>
                                                            <?php endif; ?>

                                                        </td>
                                                        <td>

                                                            <form
                                                                action="<?php echo e(route('rejeter', ['table' => 'employeur_demandeurs', 'id' => $employeur_demandeur->id, 'demande' => $demande])); ?>"
                                                                method="POST" class="d-inline">
                                                                <?php echo csrf_field(); ?>
                                                                <?php echo method_field('PATCH'); ?>
                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Confirmer le rejet de cette  informtion ?')">
                                                                    Rejeter
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
                            Pièce-jointe
                        </div>

                        <div class="card-body">
                            <?php if(isset($documents)): ?>
                                <div class="row">
                                    <div class="col-lg-12">
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
                                                        <td><?php echo e($document->libelle); ?></td>
                                                        <td>
                                                            <iframe id="documentViewer"
                                                                src="<?php echo e(asset('/uploads/' . $document->url)); ?>"
                                                                frameborder="0"></iframe>

                                                        </td>
                                                        <td>

                                                            <form
                                                                action="<?php echo e(route('rejeter', ['table' => 'documents', 'id' => $document->id, 'demande' => $demande])); ?>"
                                                                method="POST" class="d-inline">
                                                                <?php echo csrf_field(); ?>
                                                                <?php echo method_field('PATCH'); ?>
                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Confirmer le rejet de cette  informtion ?')">
                                                                    Rejeter
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
                <?php endif; ?>
            </div>
            <!-- /.card-body -->
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('custom'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('sec.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lapto\OneDrive\Documents\laravel\anac\resources\views/sec/show.blade.php ENDPATH**/ ?>