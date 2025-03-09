<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilot ID Card</title>
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
            /*border: 2px solid black;*/
            position: absolute;
            top: 20px;
            left: 20px;
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
            font-size: 12px;
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
                <img style="margin-top: 50px" src="{{ asset('/uploads/' . $licence->photo) }}" alt="Profile Photo"
                    class="photo">
                <!-- Placeholder for profile photo -->
                <div class="id-details" style="margin-top: 50px">
                    <h6 style="text-align: center;"> {{ $licence->categorie_licence }}</h6>
                    <p>II {{ $licence->type_licence }}({{ $licence->machine_licence }})</p>
                    <p>III {{ $licence->numero_licence }}</p>
                    <p>IV {{ $licence->np }}</p>
                    @php
                        use Carbon\Carbon;
                        $date_naissance = Carbon::parse($licence->date_naissance);
                        $date_naissance = $date_naissance->format('d-M-Y');

                        $date_deliverance = Carbon::parse($licence->date_deliverance);
                        $date_deliverance = $date_deliverance->format('d-M-Y');

                        $date_expiration = Carbon::parse($licence->date_expiration);
                        $date_expiration = $date_expiration->format('d-M-Y');

                        $date_mise_a_jour = Carbon::parse($licence->date_mise_a_jour);
                        $date_mise_a_jour = $date_mise_a_jour->format('d-M-Y');

                        $medicalStartDate = $medical_certificat->date_examen;
                        $medicalStartDate = Carbon::parse($medicalStartDate);
                        $medicalExpiryDate = $medicalStartDate->copy()->addMonths($medical_certificat->validite);
                        $medicalExpiryDate = $medicalExpiryDate->format('d-M-Y');

                        $class = '';
                        $class1 = ['CPL', 'ATPL'];
                        $class2 = ['PPL', 'PNC'];
                        $class3 = ['ATM', 'ATE', 'ATC'];

                        if (in_array($licence->type_licence, $class1)) {
                            # code...
                            $class = 'Class1';
                        } elseif (in_array($licence->type_licence, $class2)) {
                            $class = 'Class2';
                        } else {
                            $class = 'Class3';
                        }
                    @endphp
                    <p>IVa {{ $date_naissance }}</p>
                    <p>V {{ $licence->adresse }}</p>
                    <p>VI {{ strtoupper($licence->nationalite) }}</p>
                    <p>VII <img src="{{ asset('/assets/admin/imgs/signature.png') }}" width="150" height="40"></p>
                    <p>VIII Issued in accordance with Mauritanian Regulation RTA1-PEL and compliant with applicable ICAO
                        Standards</p>
                    <p>IX HAS BEEN FOUND TO BE QUALIFIED TO EXERCISE THE PRILEGES OF THIS LICENCE</p>
                </div>


            </div>

            <!-- Back Side -->
            <div class="id-card" id="backSide">
                <div class="id-details">

                    <p>X Issued on {{ $date_deliverance }} <img src="{{ asset('/assets/admin/imgs/signature.png') }}"
                            width="150" height="40"></p>
                    <p>XI <img src="{{ asset('/assets/admin/imgs/cachet.jpg') }}" width="100" height="100"> XIVe
                        {!! QrCode::size(100)->errorCorrection('H')->margin(2)->encoding('UTF-8')->generate(json_encode($licence->numero_licence)) !!}
                    </p>
                    <p>
                        @foreach ($qualification_types as $qualification_type)
                            @php
                                $typeStartDate = $qualification_type->date_examen;
                                $typeStartDate = Carbon::parse($typeStartDate);
                                $typeExpiryDate = $typeStartDate->copy()->addMonths(12);
                                $typeExpiryDate = $typeExpiryDate->format('d-M-Y');
                                $codeAirCraft = $qualification_type->code;

                            @endphp
                            <span>XII {{ $codeAirCraft }} [{{ $typeExpiryDate }}];</span>
                        @endforeach

                    <ul class="no-bullets">
                        @if (!empty($qualification_ifr) && !empty($qualification_classe))
                            @php
                                $ifrStartDate = $qualification_ifr->date_examen;
                                $ifrStartDate = Carbon::parse($ifrStartDate);
                                $ifrExpiryDate = $ifrStartDate->copy()->addMonths(12);
                                $ifrExpiryDate = $ifrExpiryDate->format('d-M-Y');

                                $classeStartDate = $qualification_classe->date_examen;
                                $classeStartDate = Carbon::parse($classeStartDate);
                                $classeExpiryDate = $classeStartDate->copy()->addMonths(12);
                                $classeExpiryDate = $classeExpiryDate->format('d-M-Y');

                                $codeAirCraft = $qualification_type->code;

                            @endphp
                            <li>IR [{{ $ifrExpiryDate }}]; {{ $qualification_classe->type_moteur }}
                                [{{ $classeExpiryDate }}]</li>
                        @endif

                        <li>TRI (A) (B737 NG) [31-Mas-2027]</li>
                        <li>TRE (A) (B737 NG) [31-Mas-2027]</li>
                    </ul>
                    </p>
                    <p>XIVa Recurent training (B737 NG [31- JUL-2025]; ERJ170 [30- Apr- 2025])</p>
                    <p>XIVb Medical certificat ({{ $class }} [{{ $medicalExpiryDate }}])</p>
                    <p>XIVc Licence updated by: DSV ANAC at {{ $date_mise_a_jour }}</p>
                    <p>XIVd Licence expiry date:{{ $date_expiration }}</p>

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

        var licence = {!! json_encode($licence->id) !!};
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
