@extends('user.layouts.app')
@section('title')
    @lang('user.dashboard')
@endsection
@section('contentheader')
    @lang('user.dashboard')
@endsection
@section('contentheaderlink')
    <a href="{{ route('user') }}">
        @lang('user.dashboard') </a>
@endsection
@section('contentheaderactive')
    @lang('user.dashboard')
@endsection
@push('css')
@endpush
@section('content')

    <div class="container">
        <h1></h1>
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->

                <h4 class="text-center">{{ $demande->type_licence }} - {{ $demande->objet_licence }}</h4>

                {{-- @if ($demande->objet_licence === 'Renouvellement') --}}
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Licence
                    </div>

                    <div class="card-body">
                        <form action="{{ route('user.store_licences') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $id }}" id="demande_id" name="demande_id">
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
                                            @foreach ($autorites as $autorite)
                                                <option value="{{ $autorite->id }}">{{ $autorite->libelle }}</option>
                                            @endforeach
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
                                                        <a target="_blank"
                                                            href="{{ asset('/uploads/' . $licence_demandeur->document) }}"
                                                            class="btn btn-primary btn-sm">
                                                            <i class="fas fa-download"></i>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        @if (!$licence_demandeur->valider)
                                                            <button class="btn btn-warning btn-sm"
                                                                onclick="toggleEditForm({{ $licence_demandeur->id }}, 'licence')">

                                                                Modifier
                                                            </button>
                                                        @endif
                                                        <form action="{{ route('user.destroy_licences', $licence_demandeur) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Confirmer la suppression ?')">
                                                                Supprimer
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>

                                                {{-- Formulaire de mise à jour --}}
                                                <tr id="edit-form-licence-{{ $licence_demandeur->id }}" style="display: none;">
                                                    <td colspan="6">
                                                        <form action="{{ route('user.update_licences', $licence_demandeur) }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="licence_id"
                                                                value="{{ $licence_demandeur->id }}">
                                                            <div class="row">
                                                                <div class="col-lg-2">
                                                                    <div class="form-group">
                                                                        <label>Numéro de licence</label>
                                                                        <input type="text" class="form-control"
                                                                            name="num_licence"
                                                                            value="{{ $licence_demandeur->num_licence }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-2">
                                                                    <div class="form-group">
                                                                        <label>Date de licence</label>
                                                                        <input type="date" class="form-control"
                                                                            name="date_licence"
                                                                            value="{{ $licence_demandeur->date_licence }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <label>Autorité de délivrance</label>
                                                                        <select class="form-control" name="autorite_id">
                                                                            @foreach ($autorites as $autorite)
                                                                                <option value="{{ $autorite->id }}"
                                                                                    {{ $licence_demandeur->autorite_id == $autorite->id ? 'selected' : '' }}>
                                                                                    {{ $autorite->libelle }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-2">
                                                                    <div class="form-group">
                                                                        <label>Lieu de délivrance</label>
                                                                        <input type="text" class="form-control"
                                                                            name="lieu_delivrance"
                                                                            value="{{ $licence_demandeur->lieu_delivrance }}">
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
                                                                class="btn btn-primary btn-sm">Enregistrer</button>
                                                            <button type="button" class="btn btn-secondary btn-sm"
                                                                onclick="toggleEditForm({{ $licence_demandeur->id }},'licence')">
                                                                Annuler
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


                {{-- @endif --}}

                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Formations
                    </div>

                    <div class="card-body">
                        <form action="{{ route('user.store_formations') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $id }}" id="demande_id" name="demande_id">
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
                                            @foreach ($centre_formations as $centre_formation)
                                                <option value="{{ $centre_formation->id }}">
                                                    {{ $centre_formation->libelle }}
                                                </option>
                                            @endforeach
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
                                                        <a target="_blank"
                                                            href="{{ asset('/uploads/' . $formation_demandeur->document) }}"
                                                            type="button" class="btn btn-primary btn-sm"><i
                                                                class="fas fa-download"></i></a>
                                                    </td>
                                                    <td>
                                                        @if (!$formation_demandeur->valider)
                                                            <button class="btn btn-warning btn-sm"
                                                                onclick="toggleEditForm({{ $formation_demandeur->id }}, 'formation')">

                                                                Modifier
                                                            </button>
                                                        @endif
                                                        <form
                                                            action="{{ route('user.destroy_formations', $formation_demandeur) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                                                        </form>
                                                    </td>
                                                </tr>

                                                {{-- Formulaire de mise à jour (caché par défaut) --}}
                                                <tr id="edit-form-formation-{{ $formation_demandeur->id }}"
                                                    style="display: none;">
                                                    <td colspan="4">
                                                        <form
                                                            action="{{ route('user.update_formations', $formation_demandeur) }}"
                                                            enctype="multipart/form-data" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="formation_id"
                                                                value="{{ $formation_demandeur->id }}">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <label for="edit_date_formation">Date de
                                                                            Formation</label>
                                                                        <input type="date" class="form-control"
                                                                            name="date_formation"
                                                                            value="{{ $formation_demandeur->date_formation }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <label for="edit_centre_formation_id">Centre de
                                                                            formation</label>
                                                                        <select class="form-control"
                                                                            name="centre_formation_id">
                                                                            @foreach ($centre_formations as $centre_formation)
                                                                                <option value="{{ $centre_formation->id }}"
                                                                                    {{ $formation_demandeur->centre_formation_id == $centre_formation->id ? 'selected' : '' }}>
                                                                                    {{ $centre_formation->libelle }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <label for="edit_lieu">Lieu</label>
                                                                        <input type="text" class="form-control"
                                                                            name="lieu"
                                                                            value="{{ $formation_demandeur->lieu }}">
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
                                                                class="btn btn-primary btn-sm">Enregistrer</button>
                                                            <button type="button" class="btn btn-secondary btn-sm"
                                                                onclick="toggleEditForm({{ $formation_demandeur->id }},'formation')">
                                                                Annuler
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
                        <form action="{{ route('user.store_qualifications') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $id }}" id="demande_id" name="demande_id">

                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="qualification_id">Qualifications</label>
                                        <select class="form-control" id="qualification_id" name="qualification_id">
                                            @foreach ($qualifications as $qualification)
                                                <option value="{{ $qualification->id }}"
                                                    data-type="{{ $qualification->libelle }}">
                                                    {{ $qualification->libelle }}
                                                </option>
                                            @endforeach
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
                                            @foreach ($centre_formations as $centre_formation)
                                                <option value="{{ $centre_formation->id }}">
                                                    {{ $centre_formation->libelle }}
                                                </option>
                                            @endforeach
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
                                        @foreach ($type_avions as $type_avion)
                                            <option value="{{ $type_avion->id }}">
                                                {{ $type_avion->code }}
                                            </option>
                                        @endforeach
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


                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-success float-right">
                                        <i class="fas fa-plus"></i> Submit
                                    </button>
                                </div>
                            </div>
                        </form>


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
                                                            <a target="_blank"
                                                                href="{{ asset('/uploads/' . $qualification_demandeur->document) }}"
                                                                class="btn btn-primary btn-sm">
                                                                <i class="fas fa-download"></i>
                                                            </a>
                                                        @else
                                                            Aucun fichier
                                                        @endif

                                                    </td>
                                                    <td>
                                                        @if (!$qualification_demandeur->valider)
                                                            <button class="btn btn-warning btn-sm"
                                                                onclick="toggleEditForm({{ $qualification_demandeur->id }}, 'qualification')">

                                                                Modifier
                                                            </button>
                                                        @endif
                                                        <form
                                                            action="{{ route('user.destroy_qualifications', $qualification_demandeur) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Confirmer la suppression ?')">
                                                                Supprimer
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>

                                                <!-- Formulaire d'édition caché -->
                                                <tr id="edit-form-qualification-{{ $qualification_demandeur->id }}"
                                                    style="display: none;">
                                                    <td colspan="6">
                                                        <form
                                                            action="{{ route('user.update_qualifications', $qualification_demandeur->id) }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')

                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <label>Qualification</label>
                                                                    <select class="form-control" name="qualification_id">
                                                                        @foreach ($qualifications as $qualification)
                                                                            <option value="{{ $qualification->id }}"
                                                                                {{ $qualification_demandeur->qualification_id == $qualification->id ? 'selected' : '' }}>
                                                                                {{ $qualification->libelle }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="col-lg-2">
                                                                    <label>Date de l'Examen</label>
                                                                    <input type="date" class="form-control"
                                                                        name="date_examen"
                                                                        value="{{ $qualification_demandeur->date_examen }}">
                                                                </div>

                                                                <div class="col-lg-2">
                                                                    <label>Simulateur</label>
                                                                    <select class="form-control" name="centre_formation_id">
                                                                        @foreach ($centre_formations as $centre_formation)
                                                                            <option value="{{ $centre_formation->id }}"
                                                                                {{ $qualification_demandeur->centre_formation_id == $centre_formation->id ? 'selected' : '' }}>
                                                                                {{ $centre_formation->libelle }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="col-lg-2">
                                                                    <label>Lieu</label>
                                                                    <input type="text" class="form-control" name="lieu"
                                                                        value="{{ $qualification_demandeur->lieu }}">
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
                                                                onclick="toggleEditForm({{ $qualification_demandeur->id }},'qualification'
                                                                )">Annuler</button>
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

                <!----->

                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Aptitude Médicale
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user.store_aptitudes') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $id }}" id="demande_id" name="demande_id">
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
                                            @foreach ($centre_medicals as $centre_medical)
                                                <option value="{{ $centre_medical->id }}">
                                                    {{ $centre_medical->libelle }}
                                                </option>
                                            @endforeach

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
                        @isset($medical_examinations)
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
                                            @foreach ($medical_examinations as $medical_examination)
                                                <tr>
                                                    <td>{{ $medical_examination->date_examen }}</td>
                                                    <td>{{ $medical_examination->validite }}</td>
                                                    <td>{{ $medical_examination->centre_medical }}</td>
                                                    <td>
                                                        @if ($medical_examination->document)
                                                            <a target="_blank"
                                                                href="{{ asset('/uploads/' . $medical_examination->document) }}"
                                                                class="btn btn-primary btn-sm">
                                                                <i class="fas fa-download"></i>
                                                            </a>
                                                        @else
                                                            Aucun fichier
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (!$medical_examination->valider)
                                                            <button class="btn btn-warning btn-sm"
                                                                onclick="toggleEditForm({{ $medical_examination->id }}, 'medical')">

                                                                Modifier
                                                            </button>
                                                        @endif
                                                        <form
                                                            action="{{ route('user.destroy_aptitudes', $medical_examination) }}"
                                                            method="POST" enctype="multipart/form-data" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Confirmer la suppression ?')">
                                                                Supprimer
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>

                                                <!-- Formulaire d'édition caché -->
                                                <tr id="edit-form-medical-{{ $medical_examination->id }}"
                                                    style="display: none;">
                                                    <td colspan="5">
                                                        <form
                                                            action="{{ route('user.update_aptitudes', $medical_examination->id) }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')

                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <label>Date de l'Examen</label>
                                                                    <input type="date" class="form-control"
                                                                        name="date_examen"
                                                                        value="{{ $medical_examination->date_examen }}">
                                                                </div>

                                                                <div class="col-lg-3">
                                                                    <label>Validité en mois</label>
                                                                    <input type="number" min="0" class="form-control"
                                                                        name="validite"
                                                                        value="{{ $medical_examination->validite }}">
                                                                </div>

                                                                <div class="col-lg-3">
                                                                    <label>Centre Médical</label>
                                                                    <select class="form-control" name="centre_medical_id">
                                                                        @foreach ($centre_medicals as $centre_medical)
                                                                            <option value="{{ $centre_medical->id }}"
                                                                                {{ $medical_examination->centre_medical_id == $centre_medical->id ? 'selected' : '' }}>
                                                                                {{ $centre_medical->libelle }}
                                                                            </option>
                                                                        @endforeach
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
                                                                onclick="toggleEditForm({{ $medical_examination->id }},'medical')">Annuler</button>
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
                        <form action="{{ route('user.store_experiences') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $id }}" name="demande_id">

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


                        @isset($experience_demandeurs)
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
                                    @foreach ($experience_demandeurs as $experience)
                                        <tr>
                                            <td>{{ $experience->nature }}</td>
                                            <td>{{ $experience->total }}</td>
                                            <td>{{ $experience->six_mois }}</td>
                                            <td>{{ $experience->trois_mois }}</td>
                                            <td>
                                                <a target="_blank" href="{{ asset('/uploads/' . $experience->document) }}"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                            </td>
                                            <td>
                                                @if (!$experience->valider)
                                                    <button class="btn btn-warning btn-sm"
                                                        onclick="toggleEditForm({{ $experience->id }}, 'experience')">

                                                        Modifier
                                                    </button>
                                                @endif

                                                <form action="{{ route('user.destroy_experiences', $experience) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Confirmer la suppression ?')">
                                                        Supprimer
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>

                                        {{-- Formulaire de mise à jour (caché par défaut) --}}
                                        <tr id="edit-form-experience-{{ $experience->id }}" style="display: none;">
                                            <td colspan="6">
                                                <form action="{{ route('user.update_experiences', $experience) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="experience_id"
                                                        value="{{ $experience->id }}">

                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label for="edit_nature">Nature</label>
                                                                <select class="form-control" name="nature">
                                                                    <option value="Sur tous types d'aéronefs"
                                                                        {{ $experience->nature == "Sur tous types d'aéronefs" ? 'selected' : '' }}>
                                                                        Sur tous types d'aéronefs</option>
                                                                    <option
                                                                        value="Sur les types d'aéronefs exploités par l'employeur"
                                                                        {{ $experience->nature == "Sur les types d'aéronefs exploités par l'employeur" ? 'selected' : '' }}>
                                                                        Sur les types d'aéronefs exploités par l'employeur
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label>Total</label>
                                                                <input type="number" min="0" class="form-control"
                                                                    name="total" value="{{ $experience->total }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label>Six (6) derniers mois</label>
                                                                <input type="number" min="0" class="form-control"
                                                                    name="six_mois" value="{{ $experience->six_mois }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label>Trois (3) derniers mois</label>
                                                                <input type="number" min="0" class="form-control"
                                                                    name="trois_mois" value="{{ $experience->trois_mois }}">
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
                                                        onclick="toggleEditForm({{ $experience->id }},'experience')">
                                                        Annuler
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endisset
                    </div>
                </div>




                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Contrôles de compétence les plus récents
                    </div>

                    <div class="card-body">

                        <form action="{{ route('user.store_competences') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $id }}" id="demande_id" name="demande_id">
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
                                            @foreach ($centre_formations as $centre_formation)
                                                <option value="{{ $centre_formation->id }}">
                                                    {{ $centre_formation->libelle }}
                                                </option>
                                            @endforeach

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
                                                        <a target="_blank"
                                                            href="{{ asset('/uploads/' . $competence_demandeur->document) }}"
                                                            type="button" class="btn btn-primary btn-sm"><i
                                                                class="fas fa-download"></i></a>
                                                    </td>
                                                    <td>
                                                        @if (!$competence_demandeur->valider)
                                                            <button class="btn btn-warning btn-sm"
                                                                onclick="toggleEditForm({{ $competence_demandeur->id }}, 'competence')">

                                                                Modifier</button>
                                                        @endif
                                                        <form
                                                            action="{{ route('user.destroy_competences', $competence_demandeur) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                                                        </form>
                                                    </td>
                                                </tr>

                                                <!-- Edit form for the competence -->
                                                <tr id="edit-form-competence-{{ $competence_demandeur->id }}"
                                                    style="display: none;">
                                                    <td colspan="7">
                                                        <form
                                                            action="{{ route('user.update_competences', $competence_demandeur) }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="competence_id"
                                                                value="{{ $competence_demandeur->id }}">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <label for="type">Type de compétence</label>
                                                                        <select class="form-control" name="type">
                                                                            <option value="Hors Ligne (SIMU)"
                                                                                {{ $competence_demandeur->type == 'Hors Ligne (SIMU)' ? 'selected' : '' }}>
                                                                                Hors Ligne (SIMU)</option>
                                                                            <option value="Contrôle de compétence linguistique"
                                                                                {{ $competence_demandeur->type == 'Contrôle de compétence linguistique' ? 'selected' : '' }}>
                                                                                Contrôle de compétence linguistique</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-2">
                                                                    <div class="form-group">
                                                                        <label for="niveau">Niveau</label>
                                                                        <select class="form-control" name="niveau">
                                                                            <option value="4"
                                                                                {{ $competence_demandeur->niveau == 4 ? 'selected' : '' }}>
                                                                                4</option>
                                                                            <option value="5"
                                                                                {{ $competence_demandeur->niveau == 5 ? 'selected' : '' }}>
                                                                                5</option>
                                                                            <option value="6"
                                                                                {{ $competence_demandeur->niveau == 6 ? 'selected' : '' }}>
                                                                                6</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-1">
                                                                    <div class="form-group">
                                                                        <label for="date">Date</label>
                                                                        <input type="date" class="form-control"
                                                                            name="date"
                                                                            value="{{ $competence_demandeur->date }}">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-2">
                                                                    <div class="form-group">
                                                                        <label for="validite">Validité en mois</label>
                                                                        <input type="number" min="0"
                                                                            class="form-control" name="validite"
                                                                            value="{{ $competence_demandeur->validite }}">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-2">
                                                                    <div class="form-group">
                                                                        <label for="centre_formation_id">Lieu</label>
                                                                        <select class="form-control"
                                                                            name="centre_formation_id">
                                                                            @foreach ($centre_formations as $centre_formation)
                                                                                <option value="{{ $centre_formation->id }}"
                                                                                    {{ $competence_demandeur->centre_formation_id == $centre_formation->id ? 'selected' : '' }}>
                                                                                    {{ $centre_formation->libelle }}</option>
                                                                            @endforeach
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
                                                                onclick="toggleEditForm({{ $competence_demandeur->id }},
                                                                'competence')">Annuler</button>
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
                        <form action="{{ route('user.store_entrainements') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $id }}" id="demande_id" name="demande_id">
                            <div class="row">

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="type">Type d'entraînement</label>
                                        <select class="form-control" id="type" name="type" placeholder="">
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
                                            @foreach ($centre_formations as $centre_formation)
                                                <option value="{{ $centre_formation->id }}">
                                                    {{ $centre_formation->libelle }}
                                                </option>
                                            @endforeach

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
                                                        <a target="_blank"
                                                            href="{{ asset('/uploads/' . $entrainement_demandeur->document) }}"
                                                            type="button" class="btn btn-primary btn-sm"><i
                                                                class="fas fa-download"></i></a>
                                                    </td>
                                                    <td>
                                                        @if (!$entrainement_demandeur->valider)
                                                            <button class="btn btn-warning btn-sm"
                                                                onclick="toggleEditForm({{ $entrainement_demandeur->id }}, 'entrainement')">

                                                                Modifier</button>
                                                        @endif
                                                        <form
                                                            action="{{ route('user.destroy_entrainements', $entrainement_demandeur) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                                                        </form>
                                                    </td>
                                                </tr>

                                                <!-- Edit Form (Hidden by default) -->
                                                <tr id="edit-form-entrainement-{{ $entrainement_demandeur->id }}"
                                                    style="display: none;">
                                                    <td colspan="4">
                                                        <form
                                                            action="{{ route('user.update_entrainements', $entrainement_demandeur) }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="entrainement_id"
                                                                value="{{ $entrainement_demandeur->id }}">

                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <label for="edit_type">Type d'entraînement</label>
                                                                        <select class="form-control" name="type"
                                                                            id="edit_type">
                                                                            <option value="En Ligne"
                                                                                {{ $entrainement_demandeur->type == 'En Ligne' ? 'selected' : '' }}>
                                                                                En Ligne</option>
                                                                            <option value="Rafraîchissement au sol"
                                                                                {{ $entrainement_demandeur->type == 'Rafraîchissement au sol' ? 'selected' : '' }}>
                                                                                Rafraîchissement du sol</option>
                                                                            <option value="CRM"
                                                                                {{ $entrainement_demandeur->type == 'CRM' ? 'selected' : '' }}>
                                                                                CRM</option>
                                                                            <option value="Sécurité sauvetage"
                                                                                {{ $entrainement_demandeur->type == 'Sécurité sauvetage' ? 'selected' : '' }}>
                                                                                Sécurité sauvetage</option>
                                                                            <option value="Surete"
                                                                                {{ $entrainement_demandeur->type == 'Surete' ? 'selected' : '' }}>
                                                                                Surete</option>
                                                                            <option value="Matière dangereuse"
                                                                                {{ $entrainement_demandeur->type == 'Matière dangereuse' ? 'selected' : '' }}>
                                                                                Matière dangereuse</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-2">
                                                                    <div class="form-group">
                                                                        <label for="edit_date">Date</label>
                                                                        <input type="date" class="form-control"
                                                                            name="date"
                                                                            value="{{ $entrainement_demandeur->date }}">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-2">
                                                                    <div class="form-group">
                                                                        <label for="edit_validite">Validité en mois</label>
                                                                        <input type="number" min="0"
                                                                            class="form-control" name="validite"
                                                                            value="{{ $entrainement_demandeur->validite }}">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-2">
                                                                    <div class="form-group">
                                                                        <label for="edit_centre_formation_id">Lieu</label>
                                                                        <select class="form-control"
                                                                            name="centre_formation_id">
                                                                            @foreach ($centre_formations as $centre_formation)
                                                                                <option value="{{ $centre_formation->id }}"
                                                                                    {{ $entrainement_demandeur->centre_formation_id == $centre_formation->id ? 'selected' : '' }}>
                                                                                    {{ $centre_formation->libelle }}
                                                                                </option>
                                                                            @endforeach
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
                                                                        onclick="toggleEditForm({{ $entrainement_demandeur->id }},'entrainement')">Annuler</button>
                                                                </div>
                                                            </div>
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
                        <form action="{{ route('user.store_interruptions') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $id }}" id="demande_id" name="demande_id">

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
                                                        <a target="_blank"
                                                            href="{{ asset('/uploads/' . $interruption_demandeur->document) }}"
                                                            type="button" class="btn btn-primary btn-sm"><i
                                                                class="fas fa-download"></i></a>
                                                    </td>
                                                    <td>
                                                        @if (!$interruption_demandeur->valider)
                                                            <button class="btn btn-warning btn-sm"
                                                                onclick="toggleEditForm({{ $interruption_demandeur->id }}, 'interruption')">Modifier</button>
                                                        @endif
                                                        <form
                                                            action="{{ route('user.destroy_interruptions', $interruption_demandeur) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                                                        </form>
                                                    </td>
                                                </tr>

                                                {{-- Formulaire de mise à jour (caché par défaut) --}}
                                                <tr id="edit-form-interruption-{{ $interruption_demandeur->id }}"
                                                    style="display: none;">
                                                    <td colspan="6">
                                                        <form
                                                            action="{{ route('user.update_interruptions', $interruption_demandeur) }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="interruption_id"
                                                                value="{{ $interruption_demandeur->id }}">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <label for="edit_date_debut">Date de debut</label>
                                                                        <input type="date" class="form-control"
                                                                            name="date_debut"
                                                                            value="{{ $interruption_demandeur->date_debut }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <label for="edit_date_fin">Date de fin</label>
                                                                        <input type="date" class="form-control"
                                                                            name="date_fin"
                                                                            value="{{ $interruption_demandeur->date_fin }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <label for="edit_raison">Raisons</label>
                                                                        <textarea class="form-control" name="raison">{{ $interruption_demandeur->raison }}</textarea>
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
                                                                onclick="toggleEditForm({{ $interruption_demandeur->id }},'interruption')">Annuler</button>
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
                        <form action="{{ route('user.store_maintenances') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $id }}" id="demande_id" name="demande_id">
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
                                                        <a target="_blank"
                                                            href="{{ asset('/uploads/' . $experience_maintenance_demandeur->document) }}"
                                                            type="button" class="btn btn-primary btn-sm"><i
                                                                class="fas fa-download"></i></a>
                                                    </td>
                                                    <td>
                                                        @if (!$experience_maintenance_demandeur->valider)
                                                            <button class="btn btn-warning btn-sm"
                                                                onclick="toggleEditForm({{ $experience_maintenance_demandeur->id }}, 'maintenance')">
                                                                Modifier
                                                            </button>
                                                        @endif
                                                        <form
                                                            action="{{ route('user.destroy_maintenances', $experience_maintenance_demandeur) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                                                        </form>
                                                    </td>
                                                </tr>

                                                {{-- Formulaire de mise à jour (caché par défaut) --}}
                                                <tr id="edit-form-maintenance-{{ $experience_maintenance_demandeur->id }}"
                                                    style="display: none;">
                                                    <td colspan="4">
                                                        <form
                                                            action="{{ route('user.update_maintenances', $experience_maintenance_demandeur) }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="maintenance_id"
                                                                value="{{ $experience_maintenance_demandeur->id }}">
                                                            <div class="row">
                                                                <div class="col-lg-2">
                                                                    <div class="form-group">
                                                                        <label for="edit_date_debut">Date de debut</label>
                                                                        <input type="date" class="form-control"
                                                                            name="date_debut"
                                                                            value="{{ $experience_maintenance_demandeur->date_debut }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-2">
                                                                    <div class="form-group">
                                                                        <label for="edit_date_fin">Date de fin</label>
                                                                        <input type="date" class="form-control"
                                                                            name="date_fin"
                                                                            value="{{ $experience_maintenance_demandeur->date_fin }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-5">
                                                                    <div class="form-group">
                                                                        <label
                                                                            for="edit_description_maintenance">Descriptions</label>
                                                                        <textarea class="form-control" name="description_maintenance">{{ $experience_maintenance_demandeur->description_maintenance }}</textarea>
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
                                                                onclick="toggleEditForm({{ $experience_maintenance_demandeur->id }},'maintenance')">
                                                                Annuler
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
                        <form action="{{ route('user.store_employeurs') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $id }}" id="demande_id" name="demande_id">
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
                                                        <a target="_blank"
                                                            href="{{ asset('/uploads/' . $employeur_demandeur->document) }}"
                                                            type="button" class="btn btn-primary btn-sm"><i
                                                                class="fas fa-download"></i></a>
                                                    </td>
                                                    <td>
                                                        @if (!$employeur_demandeur->valider)
                                                            <button class="btn btn-warning btn-sm"
                                                                onclick="toggleEditForm({{ $employeur_demandeur->id }}, 'employeur')">
                                                                Modifier</button>
                                                        @endif
                                                        <form
                                                            action="{{ route('user.destroy_employeurs', $employeur_demandeur) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                                                        </form>
                                                    </td>
                                                </tr>

                                                {{-- Formulaire de mise à jour (caché par défaut) --}}
                                                <tr id="edit-form-employeur-{{ $employeur_demandeur->id }}"
                                                    style="display: none;">
                                                    <td colspan="5">
                                                        <form
                                                            action="{{ route('user.update_employeurs', $employeur_demandeur) }}"
                                                            enctype="multipart/form-data" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="employeur_id"
                                                                value="{{ $employeur_demandeur->id }}">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <label for="edit_employeur">Employeur</label>
                                                                        <input type="text" class="form-control"
                                                                            name="employeur"
                                                                            value="{{ $employeur_demandeur->employeur }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-2">
                                                                    <div class="form-group">
                                                                        <label for="edit_periode_du">Date de debut</label>
                                                                        <input type="date" class="form-control"
                                                                            name="periode_du"
                                                                            value="{{ $employeur_demandeur->periode_du }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-2">
                                                                    <div class="form-group">
                                                                        <label for="edit_periode_au">Date de fin</label>
                                                                        <input type="date" class="form-control"
                                                                            name="periode_au"
                                                                            value="{{ $employeur_demandeur->periode_au }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-2">
                                                                    <div class="form-group">
                                                                        <label for="edit_fonction">Fonction</label>
                                                                        <input type="text" class="form-control"
                                                                            name="fonction"
                                                                            value="{{ $employeur_demandeur->fonction }}">
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
                                                                onclick="toggleEditForm({{ $employeur_demandeur->id }},'employeur')">Annuler</button>
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
                        <form action="{{ route('user.store_documents') }}" method="POST"
                            enctype="multipart/form-data" id="documentForm">
                            @csrf
                            <input type="hidden" value="{{ $id }}" id="demande_id" name="demande_id">
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
                        @isset($documents)
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
                                            @foreach ($documents as $document)
                                                <tr id="document-{{ $document->id }}">
                                                    <td>{{ $document->libelle }}</td>
                                                    <td>
                                                        <a target="_blank"
                                                            href="{{ asset('/uploads/' . $document->url) }}"
                                                            type="button" class="btn btn-primary btn-sm"><i
                                                                class="fas fa-download"></i></a>
                                                    </td>
                                                    <td>
                                                        @if (!$document->valider)
                                                            <button class="btn btn-warning btn-sm edit-document"
                                                                data-id="{{ $document->id }}">Modifier</button>
                                                        @endif
                                                        <button class="btn btn-danger btn-sm delete-document"
                                                            data-id="{{ $document->id }}">Supprimer</button>

                                                    </td>
                                                </tr>
                                                <tr id="edit-form-document-{{ $document->id }}" style="display: none;">
                                                    <td colspan="3">
                                                        <form id="updateForm-{{ $document->id }}"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="_method" value="PUT">
                                                            <input type="hidden" name="document_id"
                                                                value="{{ $document->id }}">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label>Libellé</label>
                                                                        <select class="form-control" name="libelle">
                                                                            <option value="La carte nationale d'identité"
                                                                                {{ $document->libelle == 'La carte nationale d\'identité' ? 'selected' : '' }}>
                                                                                La carte nationale d'identité</option>
                                                                            <option
                                                                                value="Les Résultats des examens théoriques et pratiques"
                                                                                {{ $document->libelle == 'Les Résultats des examens théoriques et pratiques' ? 'selected' : '' }}>
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
                                                                data-id="{{ $document->id }}">Enregistrer</button>
                                                            <button type="button" class="btn btn-secondary btn-sm"
                                                                onclick="toggleEditForm({{ $document->id }},'document')">Annuler</button>
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



            </div>
            <!-- /.card-body -->

        </div>
    </div>


@endsection
@push('script')
    <script src="{{ asset('assets/admin/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
@endpush
@push('custom')
    <script>
        $(document).ready(function() {
            $('#qualification_id').on('change', function() {
                let selectedText = $('#qualification_id option:selected').data('type');

                if (selectedText.includes("Qualification Type Machine")) {
                    $('#type_avion_col').show(); // Afficher le champ
                } else {
                    $('#type_avion_col').hide(); // Cacher le champ

                    $('#type_avion_id').val(''); // Réinitialiser la valeur
                }
                if (selectedText.includes("Qualification de Class")) {
                    $('#type_engine_col').show();
                } else {
                    $('#type_engine_col').hide(); // Cacher le champ
                }
            });
            // Soumission du formulaire avec AJAX
            $("#submitDocument").click(function(e) {
                e.preventDefault();
                let formData = new FormData($("#documentForm")[0]);

                $.ajax({
                    url: "{{ route('user.store_documents') }}",
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
                    url: "{{ route('user.update_documents', ':id') }}".replace(':id', documentId),
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
                    console.log(result);

                    if (result) {
                        $.ajax({
                            url: "{{ route('user.destroy_documents', ':id') }}".replace(
                                ':id', documentId),
                            type: "DELETE",
                            data: {
                                _token: "{{ csrf_token() }}"
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
@endpush
