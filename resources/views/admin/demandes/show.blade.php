@extends('layouts.admin')
@section('title')
    @lang('admin.dashboard')
@endsection
@section('contentheader')
    @lang('admin.dashboard')
@endsection
@section('contentheaderlink')
    <a href="{{ route('demandes') }}">
        @lang('admin.dashboard') </a>
@endsection
@section('contentheaderactive')
    @lang('admin.dashboard')
@endsection

@push('css')
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
                                                {{-- <th>Actions</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($formation_demandeurs as $formation_demandeur)
                                                <tr>

                                                    <td>{{ $formation_demandeur->date_formation }}</td>
                                                    <td>{{ $formation_demandeur->centre_formation }}</td>
                                                    <td>{{ $formation_demandeur->lieu }}</td>

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
                                                <th>Date de l'Examen</th>
                                                <th>Simulateur</th>
                                                <th>Lieu</th>
                                                {{-- <th>Actions</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($qualification_demandeurs as $qualification_demandeur)
                                                <tr>
                                                    <td>{{ $qualification_demandeur->qualification }}</td>
                                                    <td>{{ $qualification_demandeur->date_examen }}</td>
                                                    <td>{{ $qualification_demandeur->centre_formation }}</td>
                                                    <td>{{ $qualification_demandeur->lieu }}</td>
                                                    {{-- <th>Actions</th> --}}
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endisset

                    </div>

                </div>
                <!----->
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
                                                {{-- <th>Actions</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($medical_examinations as $medical_examination)
                                                <tr>
                                                    <td>{{ $medical_examination->date_examen }}</td>
                                                    <td>{{ $medical_examination->validite }}</td>
                                                    <td>{{ $medical_examination->centre_medical }}</td>

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
                                                {{-- <th>Actions</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($experience_demandeurs as $experience_demandeur)
                                                <tr>
                                                    <td>{{ $experience_demandeur->nature }}</td>
                                                    <td>{{ $experience_demandeur->total }}</td>
                                                    <td>{{ $experience_demandeur->six_mois }}</td>
                                                    <td>{{ $experience_demandeur->trois_mois }}</td>
                                                    {{-- <th>Actions</th> --}}
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
                                                {{-- <th>Actions</th> --}}
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
                                                    {{-- <th>Actions</th> --}}
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
                                                {{-- <th>Actions</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($entrainement_demandeurs as $entrainement_demandeur)
                                                <tr>
                                                    <td>{{ $entrainement_demandeur->type }}</td>
                                                    <td>{{ $entrainement_demandeur->date }}</td>
                                                    <td>{{ $entrainement_demandeur->validite }}</td>
                                                    <td>{{ $entrainement_demandeur->centre_formation }}</td>
                                                    {{-- <th>Actions</th> --}}
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
                                                {{-- <th>Actions</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($interruption_demandeurs as $interruption_demandeur)
                                                <tr>
                                                    <td>{{ $interruption_demandeur->date_debut }}</td>
                                                    <td>{{ $interruption_demandeur->date_fin }}</td>
                                                    <td>{{ $interruption_demandeur->raison }}</td>

                                                    {{-- <th>Actions</th> --}}
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
                                                {{-- <th>Actions</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($experience_maintenance_demandeurs as $experience_maintenance_demandeur)
                                                <tr>
                                                    <td>{{ $experience_maintenance_demandeur->date_debut }}</td>
                                                    <td>{{ $experience_maintenance_demandeur->date_fin }}</td>
                                                    <td>{{ $experience_maintenance_demandeur->description_maintenance }}
                                                    </td>

                                                    {{-- <th>Actions</th> --}}
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
                                                {{-- <th>Actions</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($employeur_demandeurs as $employeur_demandeur)
                                                <tr>
                                                    <td>{{ $employeur_demandeur->employeur }}</td>
                                                    <td>{{ $employeur_demandeur->periode_du }}</td>
                                                    <td>{{ $employeur_demandeur->periode_au }}</td>
                                                    <td>{{ $employeur_demandeur->fonction }}</td>

                                                    {{-- <th>Actions</th> --}}
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
                                                {{-- <th>Actions</th> --}}
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
                                                    {{-- <th>Actions</th> --}}
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endisset
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>



        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Description
                    </div>
                    <div class="card-body">
                        <!-- Formulaire -->
                        @if (empty($demande->description))
                            <form action="{{ route('demandes.update', $demande) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control summernote" rows="3"></textarea>
                                </div>
                                <button type="submit" class="btn btn-success float-right">Enregistrer</button>
                            </form>
                        @else
                            {!! $demande->description !!}
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
@endpush
@push('custom')
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 200, // Set height of the editor
                placeholder: 'Enter your text...',

            });
        });
    </script>
@endpush
