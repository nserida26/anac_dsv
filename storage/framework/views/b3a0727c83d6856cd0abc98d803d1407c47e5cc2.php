<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ID Card</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @font-face {
            font-family: 'Louguiya';
            src: url('/assets/admin/fonts/LouguiyaFR.ttf') format('ttf'),
                url('/assets/admin/fonts/LouguiyaFR.ttf') format('ttf');
            font-weight: normal;
            font-style: normal;
        }

        body {
            font-family: 'Louguiya', sans-serif;

        }

        .id-card {
            width: 600px;
            height: 350px;
            /*border: 2px solid black;
            border-radius: 10px;*/
            padding: 15px;
            /*background: linear-gradient(45deg, #eee, #ddd);*/
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.3);
            position: relative;
            margin-bottom: 20px;
            font-size: 12px;
        }

        .photo {
            width: 100px;
            height: 120px;
            position: absolute;
            top: 20px;
            left: 20px;
        }

        .qr-code {
            position: absolute;
            top: 200px;
            /* Adjust this value to position the QR code below the photo */
            left: 20px;
            width: 100px;
            /* Match the width of the photo */
            text-align: center;
            /* Center the QR code */
        }

        .id-details {
            margin-left: 140px;
        }

        .logo {
            position: absolute;
            top: 10px;
            right: 20px;
            width: 80px;
        }

        p {
            font-size: 11px;
            margin: 0 0;
        }

        li {
            font-size: 10px;
            /*margin: 0.5px 0;*/
        }

        .no-bullets {
            list-style-type: none;
        }
    </style>
</head>

<body>
    <div class="container mt-3 d-flex justify-content-center flex-column align-items-center">
        <button id="downloadPDF" style="text-align: center;" class="btn btn-primary">Download PDF</button>
        <div id="idCardContainer" class="mt-2">
            <!-- Front Side -->
            <div class="id-card" id="frontSide">

                <img style="margin-top: 50px" src="<?php echo e(asset('/uploads/' . $licence->photo)); ?>" alt="Profile Photo"
                    class="photo">
                <div class="qr-code">
                    XIVe <?php echo QrCode::size(100)->errorCorrection('H')->margin(0)->encoding('UTF-8')->generate(json_encode($licence)); ?>

                </div>
                <!-- Placeholder for profile photo -->
                <div class="id-details" style="margin-top: 50px">
                    <h6 style="text-align: center;"> <?php echo e($licence->categorie_licence); ?></h6>
                    <p>II <?php echo e($licence->type_licence); ?></p>
                    <p>III <?php echo e($licence->numero_licence); ?></p>
                    <p>IV <?php echo e($licence->np); ?></p>
                    <?php
                        use Carbon\Carbon;
                        $date_naissance = Carbon::parse($licence->date_naissance);
                        $date_naissance = $date_naissance->format('d-M-Y');

                        $date_deliverance = Carbon::parse($licence->date_deliverance);
                        $date_deliverance = $date_deliverance->format('d-M-Y');

                        $date_expiration = Carbon::parse($licence->date_expiration);
                        $date_expiration = $date_expiration->format('d-M-Y');

                        $date_mise_a_jour = Carbon::parse($licence->date_mise_a_jour);
                        $date_mise_a_jour = $date_mise_a_jour->format('d-M-Y');

                    ?>
                    <p>IVa <?php echo e($date_naissance); ?></p>
                    <p>V <?php echo e($licence->adresse); ?></p>
                    <p>VI <?php echo e(strtoupper($licence->nationalite)); ?></p>
                    <p>VII <img src="<?php echo e(asset('/uploads/' . $licence->signature_dsv)); ?>" width="150" height="40">
                    </p>
                    <p>VIII Issued in accordance with Mauritanian Regulation RTA1-PEL and compliant with applicable ICAO
                        Standards</p>
                    <p>IX HAS BEEN FOUND TO BE QUALIFIED TO EXERCISE THE PRILEGES OF THIS LICENCE</p>
                </div>


            </div>

            <!-- Back Side -->
            <div class="id-card" id="backSide">
                <div class="id-details">

                    <p>X Issued on <?php echo e($date_deliverance); ?> <img src="<?php echo e(asset('/uploads/' . $licence->signature_dg)); ?>"
                            width="150" height="40"></p>
                    <p>XI <img src="<?php echo e(asset('/uploads/' . $licence->cachet)); ?>" width="100" height="100">
                    </p>
                    <p>
                        <?php
                            $typeDetails = [];
                        ?>
                        <?php if(!empty($qualification_types) && $qualification_types->isNotEmpty()): ?>
                            <?php $__currentLoopData = $qualification_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $qualification_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $typeStartDate = $qualification_type->date_examen;
                                    $typeStartDate = Carbon::parse($typeStartDate);
                                    $typeExpiryDate = $typeStartDate->copy()->addMonths(12);
                                    $typeExpiryDate = $typeExpiryDate->format('d-M-Y');
                                    $codeAirCraft = $qualification_type->code;

                                    $typeDetails[] = "{$codeAirCraft} [{$typeExpiryDate}]";
                                ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $typeString = implode('; ', $typeDetails);
                            ?>
                            <span>XII <?php echo e($typeString); ?></span>
                        <?php endif; ?>
                        <?php
                            $amtDetails = [];
                        ?>
                        <?php if(!empty($qualification_amts) && $qualification_amts->isNotEmpty()): ?>
                            <?php $__currentLoopData = $qualification_amts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $qualification_amt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $amtStartDate = $qualification_amt->date_examen;
                                    $amtStartDate = Carbon::parse($amtStartDate);
                                    $amtExpiryDate = $amtStartDate->copy()->addMonths(12);
                                    $amtExpiryDate = $amtExpiryDate->format('d-M-Y');
                                    $amt = $qualification_amt->amt;

                                    $amtDetails[] = "{$amt} [{$amtExpiryDate}]";
                                ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $amtString = implode('; ', $amtDetails);
                            ?>
                            <span>XII <?php echo e($amtString); ?></span>
                        <?php endif; ?>
                        <?php
                            $atcDetails = [];
                        ?>
                        <?php if(!empty($qualification_atcs) && $qualification_atcs->isNotEmpty()): ?>
                            <?php $__currentLoopData = $qualification_atcs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $qualification_atc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $atcStartDate = $qualification_atc->date_examen;
                                    $atcStartDate = Carbon::parse($atcStartDate);
                                    $atcExpiryDate = $atcStartDate->copy()->addMonths(12);
                                    $atcExpiryDate = $atcExpiryDate->format('d-M-Y');
                                    $atc = $qualification_atc->atc;

                                    $amtDetails[] = "{$atc} [{$atcExpiryDate}]";
                                ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $atcString = implode('; ', $amtDetails);
                            ?>
                            <span>XII <?php echo e($atcString); ?></span>
                        <?php endif; ?>
                        <?php
                            $rpaDetails = [];
                        ?>
                        <?php if(!empty($qualification_rpas) && $qualification_rpas->isNotEmpty()): ?>
                            <?php $__currentLoopData = $qualification_rpas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $qualification_rpa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $rpaStartDate = $qualification_rpa->date_examen;
                                    $rpaStartDate = Carbon::parse($rpaStartDate);
                                    $rpaExpiryDate = $rpaStartDate->copy()->addMonths(12);
                                    $rpaExpiryDate = $rpaExpiryDate->format('d-M-Y');
                                    $rpa = $qualification_rpa->rpa;

                                    $rpaDetails[] = "{$rpa} [{$rpaExpiryDate}]";
                                ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $rpaString = implode('; ', $rpaDetails);
                            ?>
                            <span>XII <?php echo e($rpaString); ?></span>
                        <?php endif; ?>
                    <ul class="no-bullets">

                        <?php if(!empty($qualification_ifr) || !empty($qualification_classe)): ?>
                            <?php
                                $ifrExpiryDate = '';
                                $classeExpiryDate = '';

                                if (!empty($qualification_ifr)) {
                                    $ifrStartDate = Carbon::parse($qualification_ifr->date_examen);
                                    $ifrExpiryDate = $ifrStartDate->copy()->addMonths(12)->format('d-M-Y');
                                }

                                if (!empty($qualification_classe)) {
                                    $classeStartDate = Carbon::parse($qualification_classe->date_examen);
                                    $classeExpiryDate = $classeStartDate->copy()->addMonths(12)->format('d-M-Y');
                                }
                            ?>

                            <li>
                                <?php if(!empty($qualification_ifr)): ?>
                                    IR [<?php echo e($ifrExpiryDate); ?>]
                                <?php endif; ?>
                                <?php if(!empty($qualification_classe)): ?>
                                    <?php echo e($qualification_classe->type_moteur); ?> [<?php echo e($classeExpiryDate); ?>]
                                <?php endif; ?>
                            </li>
                        <?php endif; ?>

                        <?php if(!empty($qualification_ulm)): ?>
                            <?php
                                $ulmStartDate = $qualification_ulm->date_examen;
                                $ulmStartDate = Carbon::parse($ulmStartDate);
                                $ulmExpiryDate = $ulmStartDate->copy()->addMonths(12);
                                $ulmExpiryDate = $ulmExpiryDate->format('d-M-Y');

                            ?>
                            <li><?php echo e($qualification_ulm->ulm); ?>

                                [<?php echo e($ulmExpiryDate); ?>]</li>
                        <?php endif; ?>

                        <?php if(!empty($qualification_instructeur)): ?>
                            <?php

                                # code...
                                $instructeurStartDate = $qualification_instructeur->date_examen;
                                $instructeurStartDate = Carbon::parse($instructeurStartDate);
                                $instExpiryDate = $instructeurStartDate->copy()->addMonths(12);
                                $instExpiryDate = $instExpiryDate->format('d-M-Y');

                            ?>
                            <li><?php echo e($qualification_instructeur->type_privilege); ?>

                                (<?php echo e($qualification_instructeur->machine); ?>)
                                (<?php echo e($qualification_examinateur->code); ?>) [<?php echo e($instExpiryDate); ?>]</li>
                        <?php endif; ?>
                        <?php if(!empty($qualification_examinateur)): ?>
                            <?php

                                # code...
                                $examinateurStartDate = $qualification_examinateur->date_examen;
                                $examinateurStartDate = Carbon::parse($examinateurStartDate);
                                $examExpiryDate = $examinateurStartDate->copy()->addMonths(12);
                                $examExpiryDate = $examExpiryDate->format('d-M-Y');

                            ?>
                            <li><?php echo e($qualification_examinateur->type_privilege); ?>

                                (<?php echo e($qualification_examinateur->machine); ?>)
                                (<?php echo e($qualification_examinateur->code); ?>) [<?php echo e($examExpiryDate); ?>]</li>
                        <?php endif; ?>
                    </ul>
                    </p>
                    <?php if(!empty($competence_demandeur)): ?>
                        <?php

                            # code...
                            $langStartDate = $competence_demandeur->date;
                            $langStartDate = Carbon::parse($langStartDate);
                            $langExpiryDate = $langStartDate->copy()->addMonths($competence_demandeur->validite);
                            $langExpiryDate = $langExpiryDate->format('d-M-Y');

                        ?>
                        <p>XIII E L P (<?php echo e($competence_demandeur->niveau); ?> [<?php echo e($langExpiryDate); ?>])</p>
                    <?php endif; ?>

                    <?php if(!empty($entrainement_demandeurs) && $entrainement_demandeurs->isNotEmpty()): ?>
                        <?php
                            $entrainementDetails = [];
                        ?>

                        <?php $__currentLoopData = $entrainement_demandeurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entrainement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $entrStartDate = Carbon::parse($entrainement->date);
                                $entrExpiryDate = $entrStartDate->copy()->addMonths($entrainement->validite);
                                $entrExpiryDateFormatted = $entrExpiryDate->format('d-M-Y');
                                $entrainementDetails[] = "{$entrainement->libelle} [{$entrExpiryDateFormatted}]";
                            ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php
                            $entrainementString = implode('; ', $entrainementDetails);
                        ?>
                        <?php if(!empty($entrainementString)): ?>
                            <p>XIVa Recurent training

                                (<?php echo e($entrainementString); ?>)


                            </p>
                        <?php endif; ?>


                    <?php endif; ?>

                    <?php if(!empty($medical_certificat)): ?>
                        <?php
                            $medicalStartDate = $medical_certificat->date_examen;
                            $medicalStartDate = Carbon::parse($medicalStartDate);
                            $medicalExpiryDate = $medicalStartDate->copy()->addMonths($medical_certificat->validite);
                            $medicalExpiryDate = $medicalExpiryDate->format('d-M-Y');

                            $class = '';
                            $class1 = ['CPL', 'ATPL'];
                            $class2 = ['PPL', 'PNC'];
                            $class3 = ['ATM', 'ATE', 'ATC'];
                            $prefix = substr($licence->type_licence, 0, 3);

                            if (in_array($prefix, $class1)) {
                                # code...
                                $class = 'Class 1';
                            } elseif (in_array($prefix, $class2)) {
                                $class = 'Class 2';
                            } elseif (in_array($prefix, $class3)) {
                                $class = 'Class 3';
                            }
                        ?>
                        <p>XIVb Medical certificat (<?php echo e($class); ?> [<?php echo e($medicalExpiryDate); ?>])</p>
                    <?php endif; ?>


                    <p>XIVc Licence updated by: DSV ANAC at <?php echo e($date_mise_a_jour); ?></p>
                    <p>XIVd Licence expiry date:<?php echo e($date_expiration); ?></p>

                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>


<script>
    $(document).ready(function() {

        var licence = <?php echo json_encode($licence->id); ?>;
        $("#downloadPDF").click(function() {
            const {
                jsPDF
            } = window.jspdf;
            let pdf = new jsPDF({
                orientation: "landscape",
                unit: "px",
                format: [600, 350] // Match the ID card size
            });

            let options = {
                scale: 2 // Increase resolution
            };

            let frontSide = document.getElementById("frontSide");
            let backSide = document.getElementById("backSide");

            html2canvas(frontSide, options).then(canvas => {
                let imgData = canvas.toDataURL("image/png");

                // Add the front side on first page
                pdf.addImage(imgData, "PNG", 0, 0, 600, 350);

                // Capture the back side
                html2canvas(backSide, options).then(canvas => {
                    let imgData = canvas.toDataURL("image/png");

                    // Add new page and place the back side
                    pdf.addPage();
                    pdf.addImage(imgData, "PNG", 0, 0, 600, 350);

                    // Download the PDF
                    pdf.save(`ID_Card_${licence}.pdf`);
                });
            });
        });
    });
</script>

</html>
<?php /**PATH C:\Users\lapto\OneDrive\Documents\laravel\anac\resources\views/agent/print.blade.php ENDPATH**/ ?>