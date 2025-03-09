@extends('sec.layouts.app')
@section('title')
    @lang('sec.dashboard')
@endsection
@section('contentheader')
    @lang('sec.dashboard')
@endsection
@section('contentheaderlink')
    @if (auth()->user()->hasRole('sla'))
        <a href="{{ route('sla') }}">
            @lang('sec.dashboard') </a>
    @endif
    @if (auth()->user()->hasRole('sma'))
        <a href="{{ route('sma') }}">
            @lang('sec.dashboard') </a>
    @endif
@endsection
@section('contentheaderactive')
    @lang('sec.dashboard')
@endsection
@push('css')
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
@endpush
@section('content')

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
                        @isset($demandeur)
                            <div class="row justify-content-center">

                                <div class="col-lg-9">
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <th>@lang('user.np')</th>
                                            <td>{{ $demandeur->np ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('user.date_naissance')</th>
                                            <td>{{ $demandeur->date_naissance ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('user.lieu_naissance')</th>
                                            <td>{{ $demandeur->lieu_naissance ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('user.adresse')</th>
                                            <td>{{ $demandeur->adresse ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('user.adresse_employeur')</th>
                                            <td>{{ $demandeur->adresse_employeur ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('user.signature')</th>
                                            <td class="text-center">
                                                @if (isset($demandeur->signature) && $demandeur->signature != '')
                                                    <img src="{{ asset('/uploads/' . $demandeur->signature) }}"
                                                        alt="User Signature" class="img-thumbnail" width="120">
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                <!-- Profile Picture -->
                                <div class="col-lg-3 text-center">
                                    <img src="{{ asset('/uploads/' . ($demandeur->photo ?? 'default.png')) }}"
                                        alt="Profile Picture" class="img-fluid rounded-circle"
                                        style="width: 150px; height: 150px; object-fit: cover;">
                                </div>
                            </div>
                        @endisset
                    </div>
                </div>


                <!----->
                @if (auth()->user()->hasRole('sma'))
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Aptitude Médicale par l'examinateur medical
                        </div>
                        <div class="card-body">

                            @isset($medical_examinations)
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
                                                @foreach ($examens as $examen)
                                                    <tr>
                                                        <td>{{ $examen->date_examen }}</td>
                                                        <td>{{ $examen->validite }}</td>
                                                        <td>{{ $examen->examinateur->np }}</td>
                                                        <td>{{ $examen->examinateur->centreMedical->libelle }}</td>
                                                        <td>
                                                            @if ($examen->valider_examinateur)
                                                                Validé
                                                            @else
                                                                Non Validé
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($examen->valider_evaluateur)
                                                                Validé
                                                            @else
                                                                Non Validé
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endisset
                        </div>

                    </div>
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Aptitude Médicale
                        </div>
                        <div class="card-body">

                            @isset($medical_examinations)
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
                                                @foreach ($medical_examinations as $medical_examination)
                                                    <tr>
                                                        <td>{{ $medical_examination->date_examen }}</td>
                                                        <td>{{ $medical_examination->validite }}</td>
                                                        <td>{{ $medical_examination->centre_medical }}</td>
                                                        <td>
                                                            @if ($medical_examination->document)
                                                                <iframe id="documentViewer"
                                                                    src="{{ asset('/uploads/' . $medical_examination->document) }}"
                                                                    frameborder="0"></iframe>
                                                            @endif

                                                        </td>
                                                        <td>
                                                            <form
                                                                action="{{ route('rejeter', ['table' => 'medical_examinations', 'id' => $medical_examination->id, 'demande' => $demande]) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Confirmer le rejet de cette  informtion ?')">
                                                                    Rejeter
                                                                </button>
                                                            </form>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endisset
                        </div>

                    </div>
                @endif
                @if (auth()->user()->hasRole('sla'))
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Formations , Qualifications et Entraînements periodiques
                        </div>
                        <div class="card-body">

                            @isset($formations)
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
                                                @foreach ($formations as $formation)
                                                    <tr>
                                                        <td>{{ $formation->typeFormation->nom }}</td>
                                                        <td>{{ $formation->centreFormation->libelle }}</td>
                                                        <td>{{ $formation->lieu }}</td>
                                                        <td>{{ $formation->date_formation }}</td>
                                                        <td><iframe id="documentViewer"
                                                                src="{{ asset('/uploads/' . $formation->attestation) }}"></iframe>
                                                        </td>



                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endisset
                        </div>

                    </div>
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Licence
                        </div>

                        <div class="card-body">
                            @isset($licence_demandeurs)
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
                                                @foreach ($licence_demandeurs as $licence_demandeur)
                                                    <tr>
                                                        <td>{{ $licence_demandeur->date_licence }}</td>
                                                        <td>{{ $licence_demandeur->num_licence }}</td>
                                                        <td>{{ $licence_demandeur->autorite->libelle }}</td>
                                                        <td>{{ $licence_demandeur->lieu_delivrance }}</td>
                                                        <td>
                                                            @if ($licence_demandeur->document)
                                                                <iframe id="documentViewer"
                                                                    src="{{ asset('/uploads/' . $licence_demandeur->document) }}"
                                                                    frameborder="0"></iframe>
                                                            @endif

                                                        </td>
                                                        <td>
                                                            <form
                                                                action="{{ route('rejeter', ['table' => 'licence_demandeurs', 'id' => $licence_demandeur->id, 'demande' => $demande]) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Confirmer le rejet de cette  informtion ?')">
                                                                    Rejeter
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endisset
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Formations
                        </div>
                        <div class="card-body">
                            @isset($formation_demandeurs)
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
                                                @foreach ($formation_demandeurs as $formation_demandeur)
                                                    <tr>

                                                        <td>{{ $formation_demandeur->date_formation }}</td>
                                                        <td>{{ $formation_demandeur->centre_formation }}</td>
                                                        <td>{{ $formation_demandeur->lieu }}</td>
                                                        <td>
                                                            @if ($formation_demandeur->document)
                                                                <iframe id="documentViewer"
                                                                    src="{{ asset('/uploads/' . $formation_demandeur->document) }}"
                                                                    frameborder="0"></iframe>
                                                            @endif

                                                        </td>
                                                        <td>

                                                            <form
                                                                action="{{ route('rejeter', ['table' => 'formation_demandeurs', 'id' => $formation_demandeur->id, 'demande' => $demande]) }}"
                                                                method="POST" class="d-inline">

                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Confirmer le rejet de cette  informtion ?')">
                                                                    Rejeter
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endisset

                        </div>

                    </div>
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Qualifications
                        </div>
                        <div class="card-body">
                            <br>
                            @isset($qualification_demandeurs)
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
                                                @foreach ($qualification_demandeurs as $qualification_demandeur)
                                                    <tr>
                                                        <td>{{ $qualification_demandeur->qualification }}</td>
                                                        <td>{{ optional($qualification_demandeur->typeAvion)->code }}</td>
                                                        <td>{{ $qualification_demandeur->type_moteur }}</td>
                                                        <td>{{ $qualification_demandeur->date_examen }}</td>
                                                        <td>{{ $qualification_demandeur->centre_formation }}</td>
                                                        <td>{{ $qualification_demandeur->lieu }}</td>
                                                        <td>
                                                            @if ($qualification_demandeur->document)
                                                                <iframe id="documentViewer"
                                                                    src="{{ asset('/uploads/' . $qualification_demandeur->document) }}"
                                                                    frameborder="0"></iframe>
                                                            @endif

                                                        </td>
                                                        <td>
                                                            <form
                                                                action="{{ route('rejeter', ['table' => 'qualification_demandeurs', 'id' => $qualification_demandeur->id, 'demande' => $demande]) }}"
                                                                method="POST" class="d-inline">

                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Confirmer le rejet de cette  informtion ?')">
                                                                    Rejeter
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endisset

                        </div>

                    </div>
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Expérience en heures de vol
                        </div>

                        <div class="card-body">
                            @isset($experience_demandeurs)
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
                                                @foreach ($experience_demandeurs as $experience_demandeur)
                                                    <tr>
                                                        <td>{{ $experience_demandeur->nature }}</td>
                                                        <td>{{ $experience_demandeur->total }}</td>
                                                        <td>{{ $experience_demandeur->six_mois }}</td>
                                                        <td>{{ $experience_demandeur->trois_mois }}</td>
                                                        <td>
                                                            @if ($experience_demandeur->document)
                                                                <iframe id="documentViewer"
                                                                    src="{{ asset('/uploads/' . $experience_demandeur->document) }}"
                                                                    frameborder="0"></iframe>
                                                            @endif

                                                        </td>
                                                        <td>
                                                            <form
                                                                action="{{ route('rejeter', ['table' => 'experience_demandeurs', 'id' => $experience_demandeur->id, 'demande' => $demande]) }}"
                                                                method="POST" class="d-inline">

                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Confirmer le rejet de cette  informtion ?')">
                                                                    Rejeter
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endisset
                        </div>

                    </div>
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Contrôles de compétence les plus récents
                        </div>
                        <div class="card-body">
                            @isset($competence_demandeurs)
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
                                                @foreach ($competence_demandeurs as $competence_demandeur)
                                                    <tr>
                                                        <td>{{ $competence_demandeur->type }}</td>
                                                        <td>{{ $competence_demandeur->niveau }}</td>
                                                        <td>{{ $competence_demandeur->date }}</td>
                                                        <td>{{ $competence_demandeur->validite }}</td>
                                                        <td>{{ $competence_demandeur->centre_formation }}</td>
                                                        <td>
                                                            @if ($competence_demandeur->document)
                                                                <iframe id="documentViewer"
                                                                    src="{{ asset('/uploads/' . $competence_demandeur->document) }}"
                                                                    frameborder="0"></iframe>
                                                            @endif

                                                        </td>
                                                        <td>
                                                            <form
                                                                action="{{ route('rejeter', ['table' => 'competence_demandeurs', 'id' => $competence_demandeur->id, 'demande' => $demande]) }}"
                                                                method="POST" class="d-inline">

                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Confirmer le rejet de cette  informtion ?')">
                                                                    Rejeter
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endisset

                        </div>

                    </div>
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Entraînements périodiques
                        </div>
                        <div class="card-body">
                            @isset($entrainement_demandeurs)
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
                                                @foreach ($entrainement_demandeurs as $entrainement_demandeur)
                                                    <tr>
                                                        <td>{{ $entrainement_demandeur->type }}</td>
                                                        <td>{{ $entrainement_demandeur->date }}</td>
                                                        <td>{{ $entrainement_demandeur->validite }}</td>
                                                        <td>{{ $entrainement_demandeur->centre_formation }}</td>
                                                        <td>
                                                            @if ($entrainement_demandeur->document)
                                                                <iframe id="documentViewer"
                                                                    src="{{ asset('/uploads/' . $entrainement_demandeur->document) }}"
                                                                    frameborder="0"></iframe>
                                                            @endif

                                                        </td>
                                                        <td>
                                                            <form
                                                                action="{{ route('rejeter', ['table' => 'training_demandeurs', 'id' => $entrainement_demandeur->id, 'demande' => $demande]) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Confirmer le rejet de cette  informtion ?')">
                                                                    Rejeter
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endisset
                        </div>


                    </div>
                    {{-- Interupptions --}}
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Interruptions
                        </div>

                        <div class="card-body">
                            @isset($interruption_demandeurs)
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
                                                @foreach ($interruption_demandeurs as $interruption_demandeur)
                                                    <tr>
                                                        <td>{{ $interruption_demandeur->date_debut }}</td>
                                                        <td>{{ $interruption_demandeur->date_fin }}</td>
                                                        <td>{{ $interruption_demandeur->raison }}</td>
                                                        <td>
                                                            @if ($interruption_demandeur->document)
                                                                <iframe id="documentViewer"
                                                                    src="{{ asset('/uploads/' . $interruption_demandeur->document) }}"
                                                                    frameborder="0"></iframe>
                                                            @endif

                                                        </td>
                                                        <td>
                                                            <form
                                                                action="{{ route('rejeter', ['table' => 'interruption_demandeurs', 'id' => $interruption_demandeur->id, 'demande' => $demande]) }}"
                                                                method="POST" class="d-inline">

                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Confirmer le rejet de cette  informtion ?')">
                                                                    Rejeter
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endisset
                        </div>


                    </div>
                    {{-- Expérience en maintenance d'aéronefs --}}
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Expérience en maintenance d'aéronefs
                        </div>

                        <div class="card-body">
                            @isset($experience_maintenance_demandeurs)
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
                                                @foreach ($experience_maintenance_demandeurs as $experience_maintenance_demandeur)
                                                    <tr>
                                                        <td>{{ $experience_maintenance_demandeur->date_debut }}</td>
                                                        <td>{{ $experience_maintenance_demandeur->date_fin }}</td>
                                                        <td>{{ $experience_maintenance_demandeur->description_maintenance }}
                                                        </td>
                                                        <td>
                                                            @if ($experience_maintenance_demandeur->document)
                                                                <iframe id="documentViewer"
                                                                    src="{{ asset('/uploads/' . $experience_maintenance_demandeur->document) }}"
                                                                    frameborder="0"></iframe>
                                                            @endif

                                                        </td>
                                                        <td>
                                                            <form
                                                                action="{{ route('rejeter', ['table' => 'experience_maintenance_demandeurs', 'id' => $experience_maintenance_demandeur->id, 'demande' => $demande]) }}"
                                                                method="POST" class="d-inline">

                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Confirmer le rejet de cette  informtion ?')">
                                                                    Rejeter
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endisset
                        </div>


                    </div>
                    {{-- Employeurs --}}
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Employeurs
                        </div>

                        <div class="card-body">
                            @isset($employeur_demandeurs)
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
                                                @foreach ($employeur_demandeurs as $employeur_demandeur)
                                                    <tr>
                                                        <td>{{ $employeur_demandeur->employeur }}</td>
                                                        <td>{{ $employeur_demandeur->periode_du }}</td>
                                                        <td>{{ $employeur_demandeur->periode_au }}</td>
                                                        <td>{{ $employeur_demandeur->fonction }}</td>
                                                        <td>
                                                            @if ($experience_maintenance_demandeur->document)
                                                                <iframe id="documentViewer"
                                                                    src="{{ asset('/uploads/' . $experience_maintenance_demandeur->document) }}"
                                                                    frameborder="0"></iframe>
                                                            @endif

                                                        </td>
                                                        <td>

                                                            <form
                                                                action="{{ route('rejeter', ['table' => 'employeur_demandeurs', 'id' => $employeur_demandeur->id, 'demande' => $demande]) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Confirmer le rejet de cette  informtion ?')">
                                                                    Rejeter
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endisset
                        </div>


                    </div>
                    {{-- --}}
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Pièce-jointe
                        </div>

                        <div class="card-body">
                            @isset($documents)
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
                                                @foreach ($documents as $document)
                                                    <tr>
                                                        <td>{{ $document->libelle }}</td>
                                                        <td>
                                                            <iframe id="documentViewer"
                                                                src="{{ asset('/uploads/' . $document->url) }}"
                                                                frameborder="0"></iframe>

                                                        </td>
                                                        <td>

                                                            <form
                                                                action="{{ route('rejeter', ['table' => 'documents', 'id' => $document->id, 'demande' => $demande]) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Confirmer le rejet de cette  informtion ?')">
                                                                    Rejeter
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endisset
                        </div>
                    </div>
                @endif
            </div>
            <!-- /.card-body -->
        </div>
    </div>

@endsection
@push('script')
@endpush
@push('custom')
@endpush
