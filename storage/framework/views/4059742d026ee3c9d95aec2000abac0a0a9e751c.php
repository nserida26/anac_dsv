
<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('dir.dashboard'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheader'); ?>
    <?php echo app('translator')->get('dir.dashboard'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheaderlink'); ?>
    <?php if(auth()->user()->hasRole('dsv')): ?>
        <a href="<?php echo e(route('dsv')); ?>">
            <?php echo app('translator')->get('dir.dashboard'); ?> </a>
    <?php endif; ?>
    <?php if(auth()->user()->hasRole('dg')): ?>
        <a href="<?php echo e(route('dg')); ?>">
            <?php echo app('translator')->get('dir.dashboard'); ?> </a>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheaderactive'); ?>
    <?php echo app('translator')->get('dir.dashboard'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css'); ?>
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
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $formation_demandeurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formation_demandeur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>

                                                    <td><?php echo e($formation_demandeur->date_formation); ?></td>
                                                    <td><?php echo e($formation_demandeur->centre_formation); ?></td>
                                                    <td><?php echo e($formation_demandeur->lieu); ?></td>
                                                    
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
                                                <th>Date de l'Examen</th>
                                                <th>Simulateur</th>
                                                <th>Lieu</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $qualification_demandeurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $qualification_demandeur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($qualification_demandeur->qualification); ?></td>
                                                    <td><?php echo e($qualification_demandeur->date_examen); ?></td>
                                                    <td><?php echo e($qualification_demandeur->centre_formation); ?></td>
                                                    <td><?php echo e($qualification_demandeur->lieu); ?></td>
                                                    
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

                        <?php if(isset($medical_examinations)): ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>

                                                <th>Date de l'Examen</th>
                                                <th>Validité en mois</th>
                                                <th>Centre Médical</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $medical_examinations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $medical_examination): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($medical_examination->date_examen); ?></td>
                                                    <td><?php echo e($medical_examination->validite); ?></td>
                                                    <td><?php echo e($medical_examination->centre_medical); ?></td>
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
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $experience_demandeurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $experience_demandeur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($experience_demandeur->nature); ?></td>
                                                    <td><?php echo e($experience_demandeur->total); ?></td>
                                                    <td><?php echo e($experience_demandeur->six_mois); ?></td>
                                                    <td><?php echo e($experience_demandeur->trois_mois); ?></td>
                                                    
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
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $entrainement_demandeurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entrainement_demandeur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($entrainement_demandeur->type); ?></td>
                                                    <td><?php echo e($entrainement_demandeur->date); ?></td>
                                                    <td><?php echo e($entrainement_demandeur->validite); ?></td>
                                                    <td><?php echo e($entrainement_demandeur->centre_formation); ?></td>
                                                    
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>


                </div>
                
                <?php if($interruption_demandeurs->isNotEmpty()): ?>
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
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__currentLoopData = $interruption_demandeurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $interruption_demandeur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><?php echo e($interruption_demandeur->date_debut); ?></td>
                                                        <td><?php echo e($interruption_demandeur->date_fin); ?></td>
                                                        <td><?php echo e($interruption_demandeur->raison); ?></td>

                                                        
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

                
                <?php if($experience_maintenance_demandeurs->isNotEmpty()): ?>
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
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__currentLoopData = $experience_maintenance_demandeurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $experience_maintenance_demandeur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><?php echo e($experience_maintenance_demandeur->date_debut); ?></td>
                                                        <td><?php echo e($experience_maintenance_demandeur->date_fin); ?></td>
                                                        <td><?php echo e($experience_maintenance_demandeur->description_maintenance); ?>

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
                
                <?php if($employeur_demandeurs->isNotEmpty()): ?>
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
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__currentLoopData = $employeur_demandeurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employeur_demandeur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><?php echo e($employeur_demandeur->employeur); ?></td>
                                                        <td><?php echo e($employeur_demandeur->periode_du); ?></td>
                                                        <td><?php echo e($employeur_demandeur->periode_au); ?></td>
                                                        <td><?php echo e($employeur_demandeur->fonction); ?></td>

                                                        
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
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e(LaravelLocalization::getCurrentLocale() == 'fr' ? $document->nom_fr : $document->nom_en); ?>

                                                    </td>
                                                    <td>
                                                        <button class="btn btn-primary"
                                                            onclick="openPdfModal('<?php echo e(asset('/uploads/' . $document->url)); ?>')"><i
                                                                class="fas fa-eye"></i></button>
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

    <!-- Modal -->


    <div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pdfModalLabel">PDF Preview</h5>
                </div>
                <div class="modal-body">
                    <iframe id="pdfViewer" src="" width="100%" height="500px"></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script>
        function openPdfModal(pdfUrl) {
            $("#pdfViewer").attr("src", pdfUrl);
            $("#pdfModal").modal("show");
        }
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('custom'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('dir.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lapto\OneDrive\Documents\laravel\anac\resources\views/dir/show.blade.php ENDPATH**/ ?>