@extends('user.layouts.app')
@section('title')
    @lang('trans.dashboard')
@endsection
@section('contentheader')
    @lang('trans.dashboard')
@endsection
@section('contentheaderlink')
    <a href="{{ route('user') }}">
        @lang('trans.dashboard')
    </a>
@endsection
@section('contentheaderactive')
    @lang('trans.dashboard')
@endsection
@push('css')
    <link href="{{ asset('assets/admin/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
@endpush
@section('content')

    <div class="container">
        <h1></h1>
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->

                <h4 class="text-center">
                    {{ LaravelLocalization::getCurrentLocale() == 'fr' ? $demande->typeDemande->nom_fr : $demande->typeDemande->nom_en }}
                    - {{ $demande->typeLicence->nom }}</h4>
                @if ($demande->mise_a_jour)
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Tous les motifs de rejet
                        </div>
                        <div class="card-body">
                            <ul>
                                @foreach ($demande->qualifications as $qualification)
                                    @if (isset($qualification->motif))
                                        <li>{{ $qualification->motif }}</li>
                                    @endif
                                @endforeach
                                @foreach ($demande->trainings as $training)
                                    @if (isset($training->motif))
                                        <li>{{ $training->motif }}</li>
                                    @endif
                                @endforeach
                                @foreach ($demande->competences as $competence)
                                    @if (isset($competence->motif))
                                        <li>{{ $competence->motif }}</li>
                                    @endif
                                @endforeach
                                @foreach ($demande->experiences as $experience)
                                    @if (isset($experience->motif))
                                        <li>{{ $experience->motif }}</li>
                                    @endif
                                @endforeach
                                @foreach ($demande->medicalExamination as $medicalExamination)
                                    @if (isset($medicalExamination->motif))
                                        <li>{{ $medicalExamination->motif }}</li>
                                    @endif
                                @endforeach
                                @foreach ($demande->documents as $document)
                                    @if (isset($document->motif))
                                        <li>{{ $document->motif }}</li>
                                    @endif
                                @endforeach

                            </ul>
                        </div>
                    </div>
                @endif

                @if ($demande->typeDemande->id !== 1)
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            @lang('trans.license')
                        </div>

                        <div class="card-body">
                            <form id="licenceForm" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{ $id }}" id="demande_id" name="demande_id">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="num_licence">@lang('trans.license_number')</label>
                                            <input type="text" class="form-control" id="num_licence" name="num_licence">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="date_licence">@lang('trans.license_date')</label>
                                            <input type="date" class="form-control" id="date_licence"
                                                name="date_licence">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="autorite_id">@lang('trans.authority')</label>
                                            <select class="form-control" id="autorite_id" name="autorite_id">
                                                @foreach ($autorites as $autorite)
                                                    <option value="{{ $autorite->id }}">{{ $autorite->libelle }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="lieu_delivrance">@lang('trans.location')</label>
                                            <input type="text" class="form-control" id="lieu_delivrance"
                                                name="lieu_delivrance">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="document">@lang('trans.proof')</label>
                                            <input type="file" class="form-control" id="document" name="document"
                                                accept="application/pdf">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-success float-right">
                                            <i class="fas fa-plus"></i> @lang('trans.send')
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <br>

                            @isset($licence_demandeurs)
                                <div class="row">
                                    <div class="col-lg-12">
                                        <table class="table table-striped table-bordered" id="licenceTable">
                                            <thead>
                                                <tr>
                                                    <th>@lang('trans.license_date')</th>
                                                    <th>@lang('trans.license_number')</th>
                                                    <th>@lang('trans.authority')</th>
                                                    <th>@lang('trans.location')</th>
                                                    <th>@lang('trans.proof')</th>

                                                    <th>@lang('trans.actions')</th>
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
                                                                <button class="btn btn-primary"
                                                                    onclick="openPdfModal('{{ asset('/uploads/' . $licence_demandeur->document) }}')"><i
                                                                        class="fas fa-eye"></i></button>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if (!$licence_demandeur->valider)
                                                                <button class="btn btn-warning btn-sm edit-licence"
                                                                    data-id="{{ $licence_demandeur->id }}">@lang('trans.edit')</button>
                                                            @endif
                                                            <button class="btn btn-danger btn-sm delete-licence"
                                                                data-id="{{ $licence_demandeur->id }}">@lang('trans.destroy')</button>
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
                @if (!in_array($demande->typeDemande->id, [5, 6, 8, 9]))
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            @lang('trans.ratings')
                        </div>

                        <div class="card-body">
                            <form id="qualificationForm" enctype="multipart/form-data" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $id }}" id="demande_id" name="demande_id">

                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="qualification_id">@lang('trans.ratings')</label>
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
                                            <label for="date_examen">@lang('trans.exam_date')</label>
                                            <input type="date" class="form-control" id="date_examen" name="date_examen">
                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="centre_formation_id">@lang('trans.training_center')</label>
                                            <select class="form-control" id="centre_formation_id"
                                                name="centre_formation_id">
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
                                            <label for="lieu">@lang('trans.location')</label>
                                            <input type="text" class="form-control" id="lieu" name="lieu">
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="document">@lang('trans.proof')</label>
                                            <input type="file" class="form-control" id="document" name="document"
                                                accept="application/pdf">
                                        </div>
                                    </div>
                                </div>

                                <!-- Champ "Type d'Avion" caché par défaut -->

                                <div class="col-lg-3" id="type_avion_col" style="display: none;">
                                    @if (in_array($demande->typeLicence->id, [27, 28, 29, 30, 31, 32, 36, 39]))
                                        <div class="form-group">
                                            <label for="type_avion_id">@lang('trans.plane_type')</label>
                                            <select class="form-control" id="type_avion_id" name="type_avion_id">
                                                @foreach ($type_avions as $type_avion)
                                                    <option value="{{ $type_avion->id }}">
                                                        {{ $type_avion->code }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                    @if ($demande->typeLicence->id === 34)
                                        <div class="form-group">
                                            <label for="rpa">@lang('trans.rpa')</label>
                                            <select class="form-control" id="rpa" name="rpa">
                                                <option value="type1">RPA type 1</option>
                                                <option value="type2">RPA type 2</option>
                                                <option value="type3">RPA type 3</option>
                                            </select>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-3" id="type_engine_col" style="display: none;">
                                    @if ($demande->typeLicence->id === 33)
                                        <div class="form-group">
                                            <label for="ulm">@lang('trans.ulm')</label>
                                            <select class="form-control" id="ulm" name="ulm">
                                                <option value="Paramotor">Paramotor</option>
                                                <option value="Glider type aircraft">Glider type aircraft</option>
                                                <option value="Multi Axes">Multi Axes</option>
                                                <option value="Ultra light airplane">Ultra light airplane</option>
                                                <option value="Ultralight oetostats">Ultralight oetostats</option>
                                                <option value="Ultra light helicopter">Ultra light helicopter</option>
                                            </select>
                                        </div>
                                    @endif
                                    @if (in_array($demande->typeLicence->id, [27, 28, 29, 30, 31, 32]))
                                        <div class="form-group">
                                            <label for="type_moteur">@lang('trans.engine_type')</label>

                                            <select class="form-control" id="type_moteur" name="type_moteur">

                                                <option value="SE">
                                                    SE
                                                </option>
                                                <option value="ME">
                                                    ME
                                                </option>

                                            </select>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-3" id="instructeur_privilege_col" style="display: none;">
                                    <div class="form-group">
                                        <label for="type_privilege">@lang('trans.privilege')</label>
                                        <select class="form-control" id="type_privilege" name="type_privilege">
                                            @if (in_array($demande->typeLicence->id, [27, 28, 29, 30, 31, 32, 33]))
                                                <option value="TRI">TRI</option>
                                                <option value="IRI">IRI</option>
                                                <option value="FI">FI</option>
                                                <option value="CRI">CRI</option>
                                                <option value="SFI">SFI</option>
                                                <option value="GI">GI</option>
                                            @endif

                                            @if ($demande->typeLicence->id === 35)
                                                <option value="ICQ">ICQ</option>
                                            @endif
                                            @if (in_array($demande->typeLicence->id, [37, 38]))
                                                <option value="AMT Instructor">AMT Instructor</option>
                                            @endif
                                            @if ($demande->typeLicence->id === 39)
                                                <option value="PNC Instructor">PNC Instructor</option>
                                            @endif
                                            @if ($demande->typeLicence->id === 36)
                                                <option value="ATE Instructor">ATE Instructor</option>
                                            @endif
                                            @if ($demande->typeLicence->id === 34)
                                                <option value="RPA Instructor">RPA Instructor</option>
                                            @endif

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="machine">@lang('trans.machine')</label>
                                        <select class="form-control" id="machine" name="machine">
                                            <option value="A">A</option>
                                            <option value="H">H</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="type_avion_id">@lang('trans.plane_type')</label>
                                        <select class="form-control" id="type_avion_id" name="type_avion_id">
                                            @foreach ($type_avions as $type_avion)
                                                <option value="{{ $type_avion->id }}">
                                                    {{ $type_avion->code }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3" id="examinateur_privilege_col" style="display: none;">
                                    <div class="form-group">
                                        <label for="type_privilege">@lang('trans.privilege')</label>
                                        <select class="form-control" id="type_privilege" name="type_privilege">
                                            @if (in_array($demande->typeLicence->id, [27, 28, 29, 30, 31, 32, 33]))
                                                <option value="TRE">TRE</option>
                                                <option value="IRE">IRE</option>
                                                <option value="FE">FE</option>
                                                <option value="CRE">CRE</option>
                                                <option value="SFE">SFE</option>
                                                <option value="FIE">FIE</option>
                                            @endif
                                            @if ($demande->typeLicence->id === 35)
                                                <option value="ATC Examiner">ATC Examiner</option>
                                            @endif
                                            @if (in_array($demande->typeLicence->id, [37, 38]))
                                                <option value="AMT Examiner">AMT Examiner</option>
                                            @endif
                                            @if ($demande->typeLicence->id === 39)
                                                <option value="PNC Examiner">PNC Examiner</option>
                                            @endif
                                            @if ($demande->typeLicence->id === 36)
                                                <option value="ATE Examiner">ATE Examiner</option>
                                            @endif
                                            @if ($demande->typeLicence->id === 34)
                                                <option value="RPA Examiner">RPA Examiner</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="machine">@lang('trans.machine')</label>
                                        <select class="form-control" id="machine" name="machine">
                                            <option value="A">A</option>
                                            <option value="H">H</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="type_avion_id">@lang('trans.machine')</label>
                                        <select class="form-control" id="type_avion_id" name="type_avion_id">
                                            @foreach ($type_avions as $type_avion)
                                                <option value="{{ $type_avion->id }}">
                                                    {{ $type_avion->code }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3" id="atc_qualifications_col" style="display: none;">
                                    <div class="form-group">
                                        <label for="atc">@lang('trans.atc')</label>
                                        <select class="form-control" id="atc" name="atc">
                                            <option value="ADC">ADC</option>
                                            <option value="APP">APP</option>
                                            <option value="APS">APS</option>
                                            <option value="APRC">APRC</option>
                                            <option value="ACP">ACP</option>
                                            <option value="ACS">ACS</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-3" id="amt_qualifications_col" style="display: none;">
                                    <div class="form-group">
                                        <label for="amt">@lang('trans.amt')</label>
                                        <select class="form-control" id="amt" name="amt">
                                            <option value="A(A)">A(A)</option>
                                            <option value="A(H)">A(H)</option>
                                            <option value="B1(A)">B1(A)</option>
                                            <option value="B1(H)">B1(H)</option>
                                            <option value="B2(A)">B2(A)</option>
                                            <option value="B2(H)">B2(H)</option>
                                            <option value="B3(A)">B3(A)</option>
                                            <option value="B3(H)">B3(H)</option>
                                            <option value="C(A)">C(A)</option>
                                            <option value="C(H)">C(H)</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-success float-right">
                                            <i class="fas fa-plus"></i> @lang('trans.send')
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
                                                    <th>@lang('trans.ratings')</th>
                                                    @if (in_array($demande->typeLicence->id, [27, 28, 29, 30, 31, 32, 37, 38, 39]))
                                                        <th>@lang('trans.plane_type')</th>
                                                        <th>@lang('trans.machine')</th>
                                                    @endif
                                                    @if (in_array($demande->typeLicence->id, [27, 28, 29, 30, 31, 32]))
                                                        <th>@lang('trans.engine_type')</th>
                                                    @endif
                                                    @if ($demande->typeLicence->id !== 33)
                                                        <th>@lang('trans.privilege')</th>
                                                    @endif
                                                    @if ($demande->typeLicence->id === 11)
                                                        <th>@lang('trans.amt')</th>
                                                    @endif
                                                    @if (in_array($demande->typeLicence->id, [37, 38]))
                                                        <th>@lang('trans.atc')</th>
                                                    @endif
                                                    @if ($demande->typeLicence->id === 34)
                                                        <th>@lang('trans.rpa')</th>
                                                    @endif
                                                    @if ($demande->typeLicence->id === 33)
                                                        <th>@lang('trans.ulm')</th>
                                                    @endif
                                                    <th>@lang('trans.exam_date')</th>
                                                    <th>@lang('trans.training_center')</th>
                                                    <th>@lang('trans.location')</th>
                                                    <th>@lang('trans.proof')</th>
                                                    <th>@lang('trans.actions')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($qualification_demandeurs as $qualification_demandeur)
                                                    <tr>
                                                        <td>{{ $qualification_demandeur->qualification }}</td>
                                                        @if (in_array($demande->typeLicence->id, [27, 28, 29, 30, 31, 32, 37, 38, 39]))
                                                            <td>{{ optional($qualification_demandeur->typeAvion)->code }}</td>
                                                            <td>{{ $qualification_demandeur->machine }}</td>
                                                        @endif
                                                        @if (in_array($demande->typeLicence->id, [27, 28, 29, 30, 31, 32]))
                                                            <td>{{ $qualification_demandeur->type_moteur }}</td>
                                                        @endif
                                                        @if ($demande->typeLicence->id !== 33)
                                                            <td>{{ $qualification_demandeur->type_privilege }}</td>
                                                        @endif
                                                        @if (in_array($demande->typeLicence->id, [37, 38]))
                                                            <td>{{ $qualification_demandeur->amt }}</td>
                                                        @endif
                                                        @if ($demande->typeLicence->id === 35)
                                                            <td>{{ $qualification_demandeur->atc }}</td>
                                                        @endif
                                                        @if ($demande->typeLicence->id === 34)
                                                            <td>{{ $qualification_demandeur->rpa }}</td>
                                                        @endif
                                                        @if ($demande->typeLicence->id === 33)
                                                            <td>{{ $qualification_demandeur->ulm }}</td>
                                                        @endif
                                                        <td>{{ $qualification_demandeur->date_examen }}</td>
                                                        <td>{{ $qualification_demandeur->centre_formation }}</td>
                                                        <td>{{ $qualification_demandeur->lieu }}</td>
                                                        <td>
                                                            @if ($qualification_demandeur->document)
                                                                <button class="btn btn-primary"
                                                                    onclick="openPdfModal('{{ asset('/uploads/' . $qualification_demandeur->document) }}')"><i
                                                                        class="fas fa-eye"></i></button>
                                                            @endif

                                                        </td>
                                                        <td>
                                                            @if (!$qualification_demandeur->valider)
                                                                <button class="btn btn-warning btn-sm edit-qualification"
                                                                    data-id="{{ $qualification_demandeur->id }}">@lang('trans.update')</button>
                                                            @endif
                                                            <button class="btn btn-danger btn-sm delete-qualification"
                                                                data-id="{{ $qualification_demandeur->id }}">@lang('trans.destroy')</button>

                                                        </td>
                                                    </tr>

                                                    <!-- Formulaire d'édition caché -->
                                                    <tr id="edit-form-qualification-{{ $qualification_demandeur->id }}"
                                                        style="display: none;">
                                                        <td colspan="6">
                                                            <form
                                                                id="updateQualificationForm-{{ $qualification_demandeur->id }}"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')

                                                                <div class="row">
                                                                    <div class="col-lg-3">
                                                                        <label>Qualification</label>
                                                                        <select class="form-control"
                                                                            id="qualification_update_id"
                                                                            name="qualification_id">
                                                                            @foreach ($qualifications as $qualification)
                                                                                <option value="{{ $qualification->id }}"
                                                                                    {{ $qualification_demandeur->qualification_id == $qualification->id ? 'selected' : '' }}
                                                                                    data-type="{{ $qualification->libelle }}"
                                                                                    data-qualification-id="{{ $qualification->id }}">
                                                                                    {{ $qualification->libelle }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <div class="col-lg-2">
                                                                        <label>@lang('trans.exam_date')</label>
                                                                        <input type="date" class="form-control"
                                                                            name="date_examen"
                                                                            value="{{ $qualification_demandeur->date_examen }}">
                                                                    </div>

                                                                    <div class="col-lg-2">
                                                                        <label>Simulateur</label>
                                                                        <select class="form-control"
                                                                            name="centre_formation_id">
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
                                                                        <input type="text" class="form-control"
                                                                            name="lieu"
                                                                            value="{{ $qualification_demandeur->lieu }}">
                                                                    </div>

                                                                    <div class="col-lg-3">
                                                                        <label>@lang('trans.proof')</label>
                                                                        <input type="file" class="form-control"
                                                                            name="document" accept="application/pdf">
                                                                    </div>
                                                                </div>
                                                                <!-- Champ "Type d'Avion" caché par défaut -->
                                                                <div class="col-lg-3"
                                                                    id="type_avion_col_update_{{ $qualification_demandeur->id }}"
                                                                    style="display: none;">
                                                                    @if (in_array($demande->typeLicence->id, [27, 28, 29, 30, 31, 32, 36, 39]))
                                                                        <div class="form-group">
                                                                            <label for="type_avion_id">Type d'Avion</label>
                                                                            <select class="form-control" id="type_avion_id"
                                                                                name="type_avion_id">
                                                                                @foreach ($type_avions as $type_avion)
                                                                                    <option value="{{ $type_avion->id }}"
                                                                                        {{ $qualification_demandeur->type_avion_id == $type_avion->id ? 'selected' : '' }}>
                                                                                        {{ $type_avion->code }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    @endif
                                                                    @if ($demande->typeLicence->id === 34)
                                                                        <div class="form-group">
                                                                            <label for="rpa">Qualifications
                                                                                RPA</label>
                                                                            <select class="form-control" id="rpa"
                                                                                name="rpa">
                                                                                <option value="type1"
                                                                                    {{ $qualification_demandeur->rpa == 'type1' ? 'selected' : '' }}>
                                                                                    RPA type 1</option>
                                                                                <option value="type2"
                                                                                    {{ $qualification_demandeur->rpa == 'type2' ? 'selected' : '' }}>
                                                                                    RPA type 2</option>
                                                                                <option value="type3"
                                                                                    {{ $qualification_demandeur->rpa == 'type3' ? 'selected' : '' }}>
                                                                                    RPA type 3</option>
                                                                            </select>
                                                                        </div>
                                                                    @endif
                                                                </div>

                                                                <div class="col-lg-3"
                                                                    id="type_engine_col_update_{{ $qualification_demandeur->id }}"
                                                                    style="display: none;">
                                                                    @if ($demande->typeLicence->id === 33)
                                                                        <div class="form-group">
                                                                            <label for="ulm">Qualifications
                                                                                ULM</label>
                                                                            <select class="form-control" id="ulm"
                                                                                name="ulm">
                                                                                <option value="Paramotor"
                                                                                    {{ $qualification_demandeur->ulm == 'Paramotor' ? 'selected' : '' }}>
                                                                                    Paramotor</option>
                                                                                <option value="Glider type aircraft"
                                                                                    {{ $qualification_demandeur->ulm == 'Glider type aircraft' ? 'selected' : '' }}>
                                                                                    Glider type aircraft</option>
                                                                                <option value="Multi Axes"
                                                                                    {{ $qualification_demandeur->ulm == 'Multi Axes' ? 'selected' : '' }}>
                                                                                    Multi Axes</option>
                                                                                <option value="Ultra light airplane"
                                                                                    {{ $qualification_demandeur->ulm == 'Ultra light airplane' ? 'selected' : '' }}>
                                                                                    Ultra light airplane</option>
                                                                                <option value="Ultralight oetostats"
                                                                                    {{ $qualification_demandeur->ulm == 'Ultralight oetostats' ? 'selected' : '' }}>
                                                                                    Ultralight oetostats</option>
                                                                                <option value="Ultra light helicopter"
                                                                                    {{ $qualification_demandeur->ulm == 'Ultra light helicopter' ? 'selected' : '' }}>
                                                                                    Ultra light helicopter</option>
                                                                            </select>
                                                                        </div>
                                                                    @endif
                                                                    @if (in_array($demande->typeLicence->id, [27, 28, 29, 30, 31, 32]))
                                                                        <div class="form-group">
                                                                            <label for="type_moteur">Type d'engins</label>
                                                                            <select class="form-control" id="type_moteur"
                                                                                name="type_moteur">
                                                                                <option value="SE"
                                                                                    {{ $qualification_demandeur->type_moteur == 'SE' ? 'selected' : '' }}>
                                                                                    SE</option>
                                                                                <option value="ME"
                                                                                    {{ $qualification_demandeur->type_moteur == 'ME' ? 'selected' : '' }}>
                                                                                    ME</option>
                                                                            </select>
                                                                        </div>
                                                                    @endif
                                                                </div>

                                                                <div class="col-lg-3"
                                                                    id="instructeur_privilege_col_update_{{ $qualification_demandeur->id }}"
                                                                    style="display: none;">
                                                                    <div class="form-group">
                                                                        <label for="type_privilege">Privilege</label>
                                                                        <select class="form-control" id="type_privilege"
                                                                            name="type_privilege">
                                                                            @if (in_array($demande->typeLicence->id, [27, 28, 29, 30, 31, 32, 33]))
                                                                                <option value="TRI"
                                                                                    {{ $qualification_demandeur->type_privilege == 'TRI' ? 'selected' : '' }}>
                                                                                    TRI</option>
                                                                                <option value="IRI"
                                                                                    {{ $qualification_demandeur->type_privilege == 'IRI' ? 'selected' : '' }}>
                                                                                    IRI</option>
                                                                                <option value="FI"
                                                                                    {{ $qualification_demandeur->type_privilege == 'FI' ? 'selected' : '' }}>
                                                                                    FI</option>
                                                                                <option value="CRI"
                                                                                    {{ $qualification_demandeur->type_privilege == 'CRI' ? 'selected' : '' }}>
                                                                                    CRI</option>
                                                                                <option value="SFI"
                                                                                    {{ $qualification_demandeur->type_privilege == 'SFI' ? 'selected' : '' }}>
                                                                                    SFI</option>
                                                                                <option value="GI"
                                                                                    {{ $qualification_demandeur->type_privilege == 'GI' ? 'selected' : '' }}>
                                                                                    GI</option>
                                                                            @endif
                                                                            @if ($demande->typeLicence->id === 35)
                                                                                <option value="ICQ"
                                                                                    {{ $qualification_demandeur->type_privilege == 'ICQ' ? 'selected' : '' }}>
                                                                                    ICQ</option>
                                                                            @endif
                                                                            @if (in_array($demande->typeLicence->id, [37, 38]))
                                                                                <option value="AMT Instructor"
                                                                                    {{ $qualification_demandeur->type_privilege == 'AMT Instructor' ? 'selected' : '' }}>
                                                                                    AMT Instructor</option>
                                                                            @endif
                                                                            @if ($demande->typeLicence->id === 39)
                                                                                <option value="PNC Instructor"
                                                                                    {{ $qualification_demandeur->type_privilege == 'PNC Instructor' ? 'selected' : '' }}>
                                                                                    PNC Instructor</option>
                                                                            @endif
                                                                            @if ($demande->typeLicence->id === 36)
                                                                                <option value="ATE Instructor"
                                                                                    {{ $qualification_demandeur->type_privilege == 'ATE Instructor' ? 'selected' : '' }}>
                                                                                    ATE Instructor</option>
                                                                            @endif
                                                                            @if ($demande->typeLicence->id === 34)
                                                                                <option value="RPA Instructor"
                                                                                    {{ $qualification_demandeur->type_privilege == 'RPA Instructor' ? 'selected' : '' }}>
                                                                                    RPA Instructor</option>
                                                                            @endif
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="machine">Machine</label>
                                                                        <select class="form-control" id="machine"
                                                                            name="machine">
                                                                            <option value="A"
                                                                                {{ $qualification_demandeur->machine == 'A' ? 'selected' : '' }}>
                                                                                A</option>
                                                                            <option value="H"
                                                                                {{ $qualification_demandeur->machine == 'H' ? 'selected' : '' }}>
                                                                                H</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="type_avion_id">Type d'Avion</label>
                                                                        <select class="form-control" id="type_avion_id"
                                                                            name="type_avion_id">
                                                                            @foreach ($type_avions as $type_avion)
                                                                                <option value="{{ $type_avion->id }}"
                                                                                    {{ $qualification_demandeur->type_avion_id == $type_avion->id ? 'selected' : '' }}>
                                                                                    {{ $type_avion->code }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-3"
                                                                    id="examinateur_privilege_col_update_{{ $qualification_demandeur->id }}"
                                                                    style="display: none;">
                                                                    <div class="form-group">
                                                                        <label for="type_privilege">Privilege</label>
                                                                        <select class="form-control" id="type_privilege"
                                                                            name="type_privilege">
                                                                            @if (in_array($demande->typeLicence->id, [27, 28, 29, 30, 31, 32, 33]))
                                                                                <option value="TRE"
                                                                                    {{ $qualification_demandeur->type_privilege == 'TRE' ? 'selected' : '' }}>
                                                                                    TRE</option>
                                                                                <option value="IRE"
                                                                                    {{ $qualification_demandeur->type_privilege == 'IRE' ? 'selected' : '' }}>
                                                                                    IRE</option>
                                                                                <option value="FE"
                                                                                    {{ $qualification_demandeur->type_privilege == 'FE' ? 'selected' : '' }}>
                                                                                    FE</option>
                                                                                <option value="CRE"
                                                                                    {{ $qualification_demandeur->type_privilege == 'CRE' ? 'selected' : '' }}>
                                                                                    CRE</option>
                                                                                <option value="SFE"
                                                                                    {{ $qualification_demandeur->type_privilege == 'SFE' ? 'selected' : '' }}>
                                                                                    SFE</option>
                                                                                <option value="FIE"
                                                                                    {{ $qualification_demandeur->type_privilege == 'FIE' ? 'selected' : '' }}>
                                                                                    FIE</option>
                                                                            @endif
                                                                            @if ($demande->typeLicence->id === 35)
                                                                                <option value="ATC Examiner"
                                                                                    {{ $qualification_demandeur->type_privilege == 'ATC Examiner' ? 'selected' : '' }}>
                                                                                    ATC Examiner</option>
                                                                            @endif
                                                                            @if (in_array($demande->typeLicence->id, [37, 38]))
                                                                                <option value="AMT Examiner"
                                                                                    {{ $qualification_demandeur->type_privilege == 'AMT Examiner' ? 'selected' : '' }}>
                                                                                    AMT Examiner</option>
                                                                            @endif
                                                                            @if ($demande->typeLicence->id === 39)
                                                                                <option value="PNC Examiner"
                                                                                    {{ $qualification_demandeur->type_privilege == 'PNC Examiner' ? 'selected' : '' }}>
                                                                                    PNC Examiner</option>
                                                                            @endif
                                                                            @if ($demande->typeLicence->id === 36)
                                                                                <option value="ATE Examiner"
                                                                                    {{ $qualification_demandeur->type_privilege == 'ATE Examiner' ? 'selected' : '' }}>
                                                                                    ATE Examiner</option>
                                                                            @endif
                                                                            @if ($demande->typeLicence->id === 34)
                                                                                <option value="RPA Examiner"
                                                                                    {{ $qualification_demandeur->type_privilege == 'RPA Examiner' ? 'selected' : '' }}>
                                                                                    RPA Examiner</option>
                                                                            @endif
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="machine">Machine</label>
                                                                        <select class="form-control" id="machine"
                                                                            name="machine">
                                                                            <option value="A"
                                                                                {{ $qualification_demandeur->machine == 'A' ? 'selected' : '' }}>
                                                                                A</option>
                                                                            <option value="H"
                                                                                {{ $qualification_demandeur->machine == 'H' ? 'selected' : '' }}>
                                                                                H</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="type_avion_id">Type d'Avion</label>
                                                                        <select class="form-control" id="type_avion_id"
                                                                            name="type_avion_id">
                                                                            @foreach ($type_avions as $type_avion)
                                                                                <option value="{{ $type_avion->id }}"
                                                                                    {{ $qualification_demandeur->type_avion_id == $type_avion->id ? 'selected' : '' }}>
                                                                                    {{ $type_avion->code }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-3"
                                                                    id="atc_qualifications_col_update_{{ $qualification_demandeur->id }}"
                                                                    style="display: none;">
                                                                    <div class="form-group">
                                                                        <label for="atc">Qualifications ATC</label>
                                                                        <select class="form-control" id="atc"
                                                                            name="atc">
                                                                            <option value="ADC"
                                                                                {{ $qualification_demandeur->atc == 'ADC' ? 'selected' : '' }}>
                                                                                ADC</option>
                                                                            <option value="APP"
                                                                                {{ $qualification_demandeur->atc == 'APP' ? 'selected' : '' }}>
                                                                                APP</option>
                                                                            <option value="APS"
                                                                                {{ $qualification_demandeur->atc == 'APS' ? 'selected' : '' }}>
                                                                                APS</option>
                                                                            <option value="APRC"
                                                                                {{ $qualification_demandeur->atc == 'APRC' ? 'selected' : '' }}>
                                                                                APRC</option>
                                                                            <option value="ACP"
                                                                                {{ $qualification_demandeur->atc == 'ACP' ? 'selected' : '' }}>
                                                                                ACP</option>
                                                                            <option value="ACS"
                                                                                {{ $qualification_demandeur->atc == 'ACS' ? 'selected' : '' }}>
                                                                                ACS</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-3"
                                                                    id="amt_qualifications_col_update_{{ $qualification_demandeur->id }}"
                                                                    style="display: none;">
                                                                    <div class="form-group">
                                                                        <label for="amt">Qualifications AMT</label>
                                                                        <select class="form-control" id="amt"
                                                                            name="amt">
                                                                            <option value="A(A)"
                                                                                {{ $qualification_demandeur->amt == 'A(A)' ? 'selected' : '' }}>
                                                                                A(A)</option>
                                                                            <option value="A(H)"
                                                                                {{ $qualification_demandeur->amt == 'A(H)' ? 'selected' : '' }}>
                                                                                A(H)</option>
                                                                            <option value="B1(A)"
                                                                                {{ $qualification_demandeur->amt == 'B1(A)' ? 'selected' : '' }}>
                                                                                B1(A)</option>
                                                                            <option value="B1(H)"
                                                                                {{ $qualification_demandeur->amt == 'B1(H)' ? 'selected' : '' }}>
                                                                                B1(H)</option>
                                                                            <option value="B2(A)"
                                                                                {{ $qualification_demandeur->amt == 'B2(A)' ? 'selected' : '' }}>
                                                                                B2(A)</option>
                                                                            <option value="B2(H)"
                                                                                {{ $qualification_demandeur->amt == 'B2(H)' ? 'selected' : '' }}>
                                                                                B2(H)</option>
                                                                            <option value="B3(A)"
                                                                                {{ $qualification_demandeur->amt == 'B3(A)' ? 'selected' : '' }}>
                                                                                B3(A)</option>
                                                                            <option value="B3(H)"
                                                                                {{ $qualification_demandeur->amt == 'B3(H)' ? 'selected' : '' }}>
                                                                                B3(H)</option>
                                                                            <option value="C(A)"
                                                                                {{ $qualification_demandeur->amt == 'C(A)' ? 'selected' : '' }}>
                                                                                C(A)</option>
                                                                            <option value="C(H)"
                                                                                {{ $qualification_demandeur->amt == 'C(H)' ? 'selected' : '' }}>
                                                                                C(H)</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <br>
                                                                <button type="submit"
                                                                    class="btn btn-primary btn-sm update-qualification"
                                                                    data-id="{{ $qualification_demandeur->id }}">Enregistrer</button>
                                                                <button type="button" class="btn btn-secondary btn-sm"
                                                                    onclick="toggleEditForm({{ $qualification_demandeur->id }}, 'qualification')">Annuler</button>
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
                <!----->
                @if (!in_array($demande->typeDemande->id, [2, 4, 6, 8, 9]))
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            @lang('trans.medical_fitness')
                        </div>
                        <div class="card-body">
                            <form id="aptitudeForm" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{ $id }}" id="demande_id" name="demande_id">
                                <div class="row">

                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="date_examen">@lang('trans.exam_date')</label>
                                            <input type="date" class="form-control" id="date_examen"
                                                name="date_examen" placeholder="">

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="validite">@lang('trans.validity')</label>
                                            <input type="number" min="0" class="form-control" id="validite"
                                                name="validite" placeholder="">

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="centre_medical_id">@lang('trans.medical_center')</label>
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
                                            <label for="document">@lang('trans.proof')</label>
                                            <input type="file" class="form-control" id="document" name="document"
                                                placeholder="" accept="application/pdf">

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-success float-right"><i
                                                class="fas fa-plus"></i>
                                            @lang('trans.send')

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

                                                    <th>@lang('trans.exam_date')</th>
                                                    <th>@lang('trans.validity')</th>
                                                    <th>@lang('trans.medical_center')</th>
                                                    <th>@lang('trans.proof')</th>
                                                    <th>@lang('trans.actions')</th>
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
                                                                <button class="btn btn-primary"
                                                                    onclick="openPdfModal('{{ asset('/uploads/' . $medical_examination->document) }}')"><i
                                                                        class="fas fa-eye"></i></button>
                                                            @endif
                                                        </td>
                                                        <td>

                                                            @if (!$medical_examination->valider)
                                                                <button class="btn btn-warning btn-sm edit-aptitude"
                                                                    data-id="{{ $medical_examination->id }}">@lang('trans.update')</button>
                                                            @endif
                                                            <button class="btn btn-danger btn-sm delete-aptitude"
                                                                data-id="{{ $medical_examination->id }}">@lang('trans.destroy')</button>

                                                        </td>
                                                    </tr>

                                                    <!-- Formulaire d'édition caché -->
                                                    <tr id="edit-form-medical-{{ $medical_examination->id }}"
                                                        style="display: none;">
                                                        <td colspan="5">
                                                            <form id="updateAptitudeForm-{{ $medical_examination->id }}"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')

                                                                <div class="row">
                                                                    <div class="col-lg-3">
                                                                        <label>@lang('trans.exam_date')</label>
                                                                        <input type="date" class="form-control"
                                                                            name="date_examen"
                                                                            value="{{ $medical_examination->date_examen }}">
                                                                    </div>

                                                                    <div class="col-lg-3">
                                                                        <label>@lang('trans.validity')</label>
                                                                        <input type="number" min="0"
                                                                            class="form-control" name="validite"
                                                                            value="{{ $medical_examination->validite }}">
                                                                    </div>

                                                                    <div class="col-lg-3">
                                                                        <label>@lang('trans.medical_center')</label>
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
                                                                        <label>@lang('trans.proof')</label>
                                                                        <input type="file" class="form-control"
                                                                            name="document" accept="application/pdf">
                                                                    </div>
                                                                </div>

                                                                <br>
                                                                <button type="submit"
                                                                    class="btn btn-primary btn-sm update-medical"
                                                                    data-id="{{ $medical_examination->id }}">Enregistrer</button>
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
                @endif

                @if (
                    !in_array($demande->typeDemande->id, [5, 6, 8, 9]) &&
                        in_array($demande->typeLicence->id, [27, 28, 29, 30, 31, 32, 32, 39]))
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            @lang('trans.flights')
                        </div>

                        <div class="card-body">
                            <form id="experienceForm" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{ $id }}" name="demande_id">

                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="nature">@lang('trans.flights_type')</label>
                                            <select class="form-control" id="nature" name="nature">
                                                <option value="Sur tous types d'aéronefs">@lang('trans.all_types')
                                                </option>
                                                <option value="Sur les types d'aéronefs exploités par l'employeur">@lang('trans.employer_operated_types')</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="total">@lang('trans.total')</label>
                                            <input type="number" min="0" class="form-control" id="total"
                                                name="total">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="six_mois">@lang('trans.six')</label>
                                            <input type="number" min="0" class="form-control" id="six_mois"
                                                name="six_mois">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="trois_mois">@lang('trans.three')</label>
                                            <input type="number" min="0" class="form-control" id="trois_mois"
                                                name="trois_mois">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="document">@lang('trans.proof')</label>
                                            <input type="file" class="form-control" id="document" name="document"
                                                accept="application/pdf">
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success float-right"><i class="fas fa-plus"></i>
                                    @lang('trans.send')</button>
                            </form>


                            @isset($experience_demandeurs)
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>@lang('trans.flights_type')</th>
                                            <th>@lang('trans.total')</th>
                                            <th>@lang('trans.six')</th>
                                            <th>@lang('trans.three')</th>
                                            <th>@lang('trans.proof')</th>
                                            <th>@lang('trans.actions')</th>
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
                                                    <a target="_blank"
                                                        href="{{ asset('/uploads/' . $experience->document) }}"
                                                        class="btn btn-primary btn-sm">
                                                        <i class="fas fa-download"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    @if (!$experience->valider)
                                                        <button class="btn btn-warning btn-sm"
                                                            onclick="toggleEditForm({{ $experience->id }}, 'experience')">

                                                            @lang('trans.update')
                                                        </button>
                                                    @endif
                                                    <button class="btn btn-danger btn-sm delete-experience"
                                                        data-id="{{ $experience->id }}">@lang('trans.destroy')</button>
                                                </td>
                                            </tr>

                                            {{-- Formulaire de mise à jour (caché par défaut) --}}
                                            <tr id="edit-form-experience-{{ $experience->id }}" style="display: none;">
                                                <td colspan="6">
                                                    <form id="updateExperienceForm-{{ $experience->id }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="experience_id"
                                                            value="{{ $experience->id }}">

                                                        <div class="row">
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label for="edit_nature">@lang('trans.flights_type')</label>
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
                                                                    <label>@lang('trans.total')</label>
                                                                    <input type="number" min="0" class="form-control"
                                                                        name="total" value="{{ $experience->total }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <label>@lang('trans.six')</label>
                                                                    <input type="number" min="0" class="form-control"
                                                                        name="six_mois" value="{{ $experience->six_mois }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label>@lang('trans.three')</label>
                                                                    <input type="number" min="0" class="form-control"
                                                                        name="trois_mois"
                                                                        value="{{ $experience->trois_mois }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <label>@lang('trans.proof')</label>
                                                                    <input type="file" class="form-control"
                                                                        name="document" accept="application/pdf">
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <button type="submit"
                                                            class="btn btn-primary btn-sm update-experience"
                                                            data-id="{{ $experience->id }}">Enregistrer</button>
                                                        <button type="button" class="btn btn-secondary"
                                                            onclick="toggleEditForm({{ $experience->id }},'experience')">Annuler</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endisset
                        </div>
                    </div>
                @endif
                @if (!in_array($demande->typeDemande->id, [2, 4, 5, 8, 9]))
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            @lang('trans.control')
                        </div>

                        <div class="card-body">

                            <form id="competenceForm" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{ $id }}" id="demande_id" name="demande_id">
                                <div class="row">

                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="type">@lang('trans.type')</label>
                                            <select class="form-control" name="type" placeholder="">

                                                <option value="Contrôle de compétence linguistique">
                                                    Contrôle de compétence linguistique
                                                </option>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="niveau">@lang('trans.level')</label>
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
                                            <label for="date">@lang('trans.date')</label>
                                            <input type="date" class="form-control" id="date" name="date"
                                                placeholder="">

                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="validite">@lang('trans.validity')</label>
                                            <input type="number" min="0" class="form-control" id="validite"
                                                name="validite" placeholder="">

                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="centre_formation_id">@lang('trans.location')</label>
                                            <select class="form-control" id="centre_formation_id"
                                                name="centre_formation_id" placeholder="">
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
                                            <label for="document">@lang('trans.proof')</label>
                                            <input type="file" class="form-control" id="document" name="document"
                                                placeholder="" accept="application/pdf">

                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-success float-right"><i
                                                class="fas fa-plus"></i>
                                            @lang('trans.send')

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

                                                    <th>@lang('trans.type')</th>
                                                    <th>@lang('trans.level')</th>

                                                    <th>@lang('trans.date')</th>
                                                    <th>@lang('trans.validity')</th>
                                                    <th>@lang('trans.location')</th>
                                                    <th>@lang('trans.proof')</th>
                                                    <th>@lang('trans.actions')</th>
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
                                                                <button class="btn btn-primary"
                                                                    onclick="openPdfModal('{{ asset('/uploads/' . $competence_demandeur->document) }}')"><i
                                                                        class="fas fa-eye"></i></button>
                                                            @endif
                                                        </td>
                                                        <td>

                                                            @if (!$competence_demandeur->valider)
                                                                <button class="btn btn-warning btn-sm edit-competence"
                                                                    data-id="{{ $competence_demandeur->id }}">@lang('trans.update')</button>
                                                            @endif
                                                            <button class="btn btn-danger btn-sm delete-competence"
                                                                data-id="{{ $competence_demandeur->id }}">@lang('trans.destroy')</button>

                                                        </td>
                                                    </tr>

                                                    <!-- Edit form for the competence -->
                                                    <tr id="edit-form-competence-{{ $competence_demandeur->id }}"
                                                        style="display: none;">
                                                        <td colspan="7">
                                                            <form id="updateCompetenceForm-{{ $competence_demandeur->id }}"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="competence_id"
                                                                    value="{{ $competence_demandeur->id }}">
                                                                <div class="row">
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label for="type">Type de compétence</label>
                                                                            <select class="form-control" name="type">

                                                                                <option
                                                                                    value="Contrôle de compétence linguistique"
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
                                                                            <label for="validite">@lang('trans.validity')</label>
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
                                                                                    <option
                                                                                        value="{{ $centre_formation->id }}"
                                                                                        {{ $competence_demandeur->centre_formation_id == $centre_formation->id ? 'selected' : '' }}>
                                                                                        {{ $centre_formation->libelle }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-2">
                                                                        <div class="form-group">
                                                                            <label for="document">@lang('trans.proof')
                                                                                (Nouveau)
                                                                            </label>
                                                                            <input type="file" class="form-control"
                                                                                name="document" accept="application/pdf">
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                                <button type="submit"
                                                                    class="btn btn-primary btn-sm update-competence"
                                                                    data-id="{{ $competence_demandeur->id }}">Enregistrer</button>
                                                                <button type="button" class="btn btn-secondary"
                                                                    onclick="toggleEditForm({{ $competence_demandeur->id }},'competence')">Annuler</button>
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
                @if (!in_array($demande->typeDemande->id, [2, 4, 5, 6, 9]))
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            @lang('trans.periodic_control')
                        </div>

                        <div class="card-body">
                            <form id="entrainementForm" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{ $id }}" id="demande_id" name="demande_id">
                                <div class="row">

                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="type">@lang('trans.type')</label>
                                            <select class="form-control" id="type" name="type" placeholder="">
                                                @if (in_array($demande->typeLicence->id, [27, 28, 29, 30, 31, 32, 32]))
                                                    <option value="Hors Ligne (SIMU)">Hors Ligne (SIMU)
                                                    </option>
                                                @endif
                                                @if (in_array($demande->typeDemande->id, [1, 3]))
                                                    @if (in_array($demande->typeLicence->id, [27, 28, 29, 30, 31, 32, 32, 39]))
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
                                                    @endif
                                                    <option value="Instructor Refresher">Instructor Refresher</option>
                                                    @if ($demande->typeLicence->id === 35)
                                                        <option value="ATC Refresher">ATC Refresher</option>
                                                    @endif
                                                    @if ($demande->typeLicence->id === 36)
                                                        <option value="ATE Refresher">ATE Refresher</option>
                                                    @endif
                                                    @if ($demande->typeLicence->id === 35)
                                                        <option value="AME Refresher">AME Refresher</option>
                                                    @endif
                                                    @if ($demande->typeLicence->id === 39)
                                                        <option value="PNC Refresher">PNC Refresher</option>
                                                    @endif
                                                    @if ($demande->typeLicence->id === 34)
                                                        <option value="RPA Refresher">RPA Refresher</option>
                                                    @endif
                                                @endif

                                            </select>

                                        </div>
                                    </div>


                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="date">@lang('trans.date')</label>
                                            <input type="date" class="form-control" id="date" name="date"
                                                placeholder="">

                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="validite">@lang('trans.validity')</label>
                                            <input type="number" min="0" class="form-control" id="validite"
                                                name="validite" placeholder="">

                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="centre_formation_id">@lang('trans.location')</label>
                                            <select class="form-control" id="centre_formation_id"
                                                name="centre_formation_id" placeholder="">
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
                                            <label for="document">@lang('trans.proof')</label>
                                            <input type="file" class="form-control" id="document" name="document"
                                                placeholder="" accept="application/pdf">

                                        </div>
                                    </div>
                                    <div class="col-lg-2" id="simulateur_col" style="display: none;">
                                        <div class="form-group">
                                            <label for="simulateur_id">@lang('trans.simulators')</label>
                                            <select class="form-control" id="simulateur_id" name="simulateur_id">
                                                @foreach ($simulateurs as $simulateur)
                                                    <option value="{{ $simulateur->id }}">{{ $simulateur->libelle }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-success float-right"><i
                                                class="fas fa-plus"></i>
                                            @lang('trans.send')

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

                                                    <th>@lang('trans.type')</th>
                                                    <th>@lang('trans.simulators')</th>
                                                    <th>@lang('trans.date')</th>
                                                    <th>@lang('trans.validity')</th>
                                                    <th>@lang('trans.location')</th>
                                                    <th>@lang('trans.proof')</th>
                                                    <th>@lang('trans.actions')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($entrainement_demandeurs as $entrainement_demandeur)
                                                    <tr>
                                                        <td>{{ $entrainement_demandeur->type }}</td>
                                                        <td>{{ optional($entrainement_demandeur->simulateur)->libelle }}</td>
                                                        <td>{{ $entrainement_demandeur->date }}</td>
                                                        <td>{{ $entrainement_demandeur->validite }}</td>
                                                        <td>{{ $entrainement_demandeur->centre_formation }}</td>

                                                        <td>
                                                            @if ($entrainement_demandeur->document)
                                                                <button class="btn btn-primary"
                                                                    onclick="openPdfModal('{{ asset('/uploads/' . $entrainement_demandeur->document) }}')"><i
                                                                        class="fas fa-eye"></i></button>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if (!$entrainement_demandeur->valider)
                                                                <button class="btn btn-warning btn-sm edit-entrainement"
                                                                    data-id="{{ $entrainement_demandeur->id }}">@lang('trans.update')</button>
                                                            @endif
                                                            <button class="btn btn-danger btn-sm delete-entrainement"
                                                                data-id="{{ $entrainement_demandeur->id }}">@lang('trans.destroy')</button>
                                                        </td>
                                                    </tr>

                                                    <!-- Edit Form (Hidden by default) -->
                                                    <tr id="edit-form-entrainement-{{ $entrainement_demandeur->id }}"
                                                        style="display: none;">
                                                        <td colspan="4">
                                                            <form
                                                                id="updateEntrainementForm-{{ $entrainement_demandeur->id }}"
                                                                enctype="multipart/form-data">
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
                                                                                <option value="Hors Ligne (SIMU)"
                                                                                    {{ $entrainement_demandeur->type == 'Hors Ligne (SIMU)' ? 'selected' : '' }}>
                                                                                    Hors Ligne (SIMU)</option>
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
                                                                            <label
                                                                                for="edit_validite">@lang('trans.validity')</label>
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
                                                                                    <option
                                                                                        value="{{ $centre_formation->id }}"
                                                                                        {{ $entrainement_demandeur->centre_formation_id == $centre_formation->id ? 'selected' : '' }}>
                                                                                        {{ $centre_formation->libelle }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="edit_justificatif">@lang('trans.proof')</label>
                                                                            <input type="file" class="form-control"
                                                                                name="document" accept="application/pdf">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-2" id="edit_simulateur_col"
                                                                        style="{{ $entrainement_demandeur->type == 'Hors Ligne (SIMU)' ? '' : 'display: none;' }}">
                                                                        <div class="form-group">
                                                                            <label for="simulateur_id">Simulateur</label>
                                                                            <select class="form-control" name="simulateur_id">
                                                                                @foreach ($simulateurs as $simulateur)
                                                                                    <option value="{{ $simulateur->id }}"
                                                                                        {{ $entrainement_demandeur->simulateur_id == $simulateur->id ? 'selected' : '' }}>
                                                                                        {{ $simulateur->libelle }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-lg-12">

                                                                        <button type="submit"
                                                                            class="btn btn-primary btn-sm update-entrainement"
                                                                            data-id="{{ $entrainement_demandeur->id }}">Enregistrer</button>
                                                                        <button type="button" class="btn btn-secondary"
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
                @endif


                @if (in_array($demande->typeDemande->id, [1, 3]))
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            @lang('trans.training')
                        </div>

                        <div class="card-body">
                            <form id="formationForm" enctype="multipart/form-data" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $id }}" id="demande_id" name="demande_id">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="date_formation">@lang('trans.training_date')</label>
                                            <input type="date" class="form-control" id="date_formation"
                                                name="date_formation" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="centre_formation_id">@lang('trans.training_center')</label>
                                            <select class="form-control" id="centre_formation_id"
                                                name="centre_formation_id">
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
                                            <label for="lieu">@lang('trans.training_location')</label>
                                            <input type="text" class="form-control" id="lieu" name="lieu"
                                                placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="document">@lang('trans.proof')</label>
                                            <input type="file" class="form-control" id="document" name="document"
                                                placeholder="" accept="application/pdf">

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-success float-right"><i
                                                class="fas fa-plus"></i>
                                            @lang('trans.send')</button>
                                    </div>
                                </div>
                            </form>
                            <br>

                            @isset($formation_demandeurs)
                                <div class="row">
                                    <div class="col-lg-12">
                                        <table class="table table-striped table-bordered" id="formationTable">
                                            <thead>
                                                <tr>
                                                    <th>@lang('trans.training_date')</th>
                                                    <th>@lang('trans.training_center')</th>
                                                    <th>@lang('trans.location')</th>
                                                    <th>@lang('trans.proof')</th>
                                                    <th>@lang('trans.actions')</th>
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
                                                                <button class="btn btn-primary"
                                                                    onclick="openPdfModal('{{ asset('/uploads/' . $formation_demandeur->document) }}')"><i
                                                                        class="fas fa-eye"></i></button>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if (!$formation_demandeur->valider)
                                                                <button class="btn btn-warning btn-sm edit-formation"
                                                                    data-id="{{ $formation_demandeur->id }}">@lang('trans.update')</button>
                                                            @endif
                                                            <button class="btn btn-danger btn-sm delete-formation"
                                                                data-id="{{ $formation_demandeur->id }}">@lang('trans.destroy')</button>

                                                        </td>
                                                    </tr>

                                                    {{-- Formulaire de mise à jour (caché par défaut) --}}
                                                    <tr id="edit-form-formation-{{ $formation_demandeur->id }}"
                                                        style="display: none;">
                                                        <td colspan="4">
                                                            <form id="updateFormationForm-{{ $formation_demandeur->id }}"
                                                                enctype="multipart/form-data">
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
                                                                                    <option
                                                                                        value="{{ $centre_formation->id }}"
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
                                                                            <label for="document">@lang('trans.proof')</label>
                                                                            <input type="file" accept="application/pdf"
                                                                                class="form-control" id="document"
                                                                                name="document" placeholder="">

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <button type="submit"
                                                                    class="btn btn-primary btn-sm update-formation"
                                                                    data-id="{{ $formation_demandeur->id }}">Enregistrer</button>
                                                                <button type="button" class="btn btn-secondary btn-sm"
                                                                    onclick="toggleEditForm({{ $formation_demandeur->id }}, 'formation')">Annuler</button>
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
                            @lang('trans.interruptions')
                        </div>

                        <div class="card-body">
                            <form id="interruptionForm" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{ $id }}" id="demande_id"
                                    name="demande_id">

                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="date_debut">@lang('trans.start_date')</label>
                                            <input type="date" class="form-control" id="date_debut"
                                                name="date_debut" placeholder="">

                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="date_fin">@lang('trans.end_date')</label>
                                            <input type="date" class="form-control" id="date_fin"
                                                name="date_fin" placeholder="">

                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label for="raison">@lang('trans.reason')</label>
                                            <textarea type="text" class="form-control" id="raison" name="raison" placeholder=""></textarea>

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="document">@lang('trans.proof')</label>
                                            <input type="file" class="form-control" id="document"
                                                name="document" placeholder="" accept="application/pdf">

                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-success float-right"><i
                                                class="fas fa-plus"></i>
                                            @lang('trans.send')

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

                                                    <th>@lang('trans.start_date')</th>
                                                    <th>@lang('trans.end_date')</th>
                                                    <th>@lang('trans.reason')</th>
                                                    <th>@lang('trans.proof')</th>
                                                    <th>@lang('trans.actions')</th>
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
                                                                <button class="btn btn-primary"
                                                                    onclick="openPdfModal('{{ asset('/uploads/' . $interruption_demandeur->document) }}')"><i
                                                                        class="fas fa-eye"></i></button>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if (!$interruption_demandeur->valider)
                                                                <button class="btn btn-warning btn-sm edit-interruption"
                                                                    data-id="{{ $interruption_demandeur->id }}">@lang('trans.update')</button>
                                                            @endif
                                                            <button class="btn btn-danger btn-sm delete-interruption"
                                                                data-id="{{ $interruption_demandeur->id }}">@lang('trans.destroy')</button>
                                                        </td>
                                                    </tr>

                                                    {{-- Formulaire de mise à jour (caché par défaut) --}}
                                                    <tr id="edit-form-interruption-{{ $interruption_demandeur->id }}"
                                                        style="display: none;">
                                                        <td colspan="6">
                                                            <form
                                                                id="updateInterruptionForm-{{ $interruption_demandeur->id }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="interruption_id"
                                                                    value="{{ $interruption_demandeur->id }}">
                                                                <div class="row">
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="edit_date_debut">@lang('trans.start_date')</label>
                                                                            <input type="date" class="form-control"
                                                                                name="date_debut"
                                                                                value="{{ $interruption_demandeur->date_debut }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="edit_date_fin">@lang('trans.end_date')</label>
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
                                                                            <label
                                                                                for="edit_justificatif">@lang('trans.proof')</label>
                                                                            <input type="file" class="form-control"
                                                                                name="document" accept="application/pdf">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <button type="submit"
                                                                    class="btn btn-primary btn-sm update-interruption"
                                                                    data-id="{{ $interruption_demandeur->id }}">Enregistrer</button>
                                                                <button type="button" class="btn btn-secondary"
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

                    @if (in_array($demande->typeLicence->id, [37, 38]))
                        {{-- Expérience en maintenance d'aéronefs --}}
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                @lang('trans.maintenance')
                            </div>

                            <div class="card-body">
                                <form id="maintenanceForm" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" value="{{ $id }}" id="demande_id"
                                        name="demande_id">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label for="date_debut">@lang('trans.start_date')</label>
                                                <input type="date" class="form-control" id="date_debut"
                                                    name="date_debut" placeholder="">

                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label for="date_fin">@lang('trans.end_date')</label>
                                                <input type="date" class="form-control" id="date_fin"
                                                    name="date_fin" placeholder="">

                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label for="description_maintenance"> @lang('trans.description')</label>
                                                <textarea type="text" class="form-control" id="description_maintenance" name="description_maintenance"
                                                    placeholder=""></textarea>

                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="document">@lang('trans.proof')</label>
                                                <input type="file" class="form-control" id="document"
                                                    name="document" placeholder="" accept="application/pdf">

                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <button type="submit" class="btn btn-success float-right"><i
                                                    class="fas fa-plus"></i>
                                                @lang('trans.send')

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



                                                        <th>@lang('trans.start_date')</th>
                                                        <th>@lang('trans.end_date')</th>
                                                        <th> @lang('trans.description')</th>

                                                        <th>@lang('trans.proof')</th>
                                                        <th>@lang('trans.actions')</th>
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
                                                                    <button class="btn btn-warning btn-sm edit-maintenance"
                                                                        data-id="{{ $experience_maintenance_demandeur->id }}"> @lang('trans.update')</button>
                                                                @endif
                                                                <button class="btn btn-danger btn-sm delete-maintenance"
                                                                    data-id="{{ $experience_maintenance_demandeur->id }}">@lang('trans.destroy')</button>
                                                            </td>
                                                        </tr>

                                                        {{-- Formulaire de mise à jour (caché par défaut) --}}
                                                        <tr id="edit-form-maintenance-{{ $experience_maintenance_demandeur->id }}"
                                                            style="display: none;">
                                                            <td colspan="4">
                                                                <form
                                                                    id="updateMaintenanceForm-{{ $experience_maintenance_demandeur->id }}"
                                                                    method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <input type="hidden" name="maintenance_id"
                                                                        value="{{ $experience_maintenance_demandeur->id }}">
                                                                    <div class="row">
                                                                        <div class="col-lg-2">
                                                                            <div class="form-group">
                                                                                <label for="edit_date_debut">Date de
                                                                                    debut</label>
                                                                                <input type="date" class="form-control"
                                                                                    name="date_debut"
                                                                                    value="{{ $experience_maintenance_demandeur->date_debut }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-2">
                                                                            <div class="form-group">
                                                                                <label
                                                                                    for="edit_date_fin">@lang('trans.end_date')</label>
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
                                                                                <label
                                                                                    for="edit_justificatif">@lang('trans.proof')</label>
                                                                                <input type="file" class="form-control"
                                                                                    name="document"
                                                                                    accept="application/pdf">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <button type="submit"
                                                                        class="btn btn-primary btn-sm update-maintenance"
                                                                        data-id="{{ $experience_maintenance_demandeur->id }}">Enregistrer</button>
                                                                    <button type="button" class="btn btn-secondary"
                                                                        onclick="toggleEditForm({{ $experience_maintenance_demandeur->id }},'maintenance')">Annuler</button>
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

                    {{-- Employeurs --}}

                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            @lang('trans.employers')
                        </div>

                        <div class="card-body">
                            <form id="employeurForm" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{ $id }}" id="demande_id"
                                    name="demande_id">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="employeur">@lang('trans.employer')</label>
                                            <input type="text" class="form-control" id="employeur"
                                                name="employeur" placeholder="">

                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="periode_du">@lang('trans.start_date')</label>
                                            <input type="date" class="form-control" id="periode_du"
                                                name="periode_du" placeholder="">

                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="periode_au">@lang('trans.end_date')</label>
                                            <input type="date" class="form-control" id="periode_au"
                                                name="periode_au" placeholder="">

                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="fonction">@lang('trans.role')</label>
                                            <input type="text" class="form-control" id="fonction"
                                                name="fonction" placeholder="">

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="document">@lang('trans.proof')</label>
                                            <input type="file" class="form-control" id="document"
                                                name="document" placeholder="" accept="application/pdf">

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-success float-right"><i
                                                class="fas fa-plus"></i>
                                            @lang('trans.send')

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


                                                    <th>@lang('trans.employer')</th>
                                                    <th>@lang('trans.start_date')</th>
                                                    <th>@lang('trans.end_date')</th>
                                                    <th>@lang('trans.role')</th>
                                                    <th>@lang('trans.proof')</th>
                                                    <th>@lang('trans.actions')</th>
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
                                                            @if ($employeur_demandeur->document)
                                                                <button class="btn btn-primary"
                                                                    onclick="openPdfModal('{{ asset('/uploads/' . $employeur_demandeur->document) }}')"><i
                                                                        class="fas fa-eye"></i></button>
                                                            @endif
                                                        </td>
                                                        <td>

                                                            @if (!$employeur_demandeur->valider)
                                                                <button class="btn btn-warning btn-sm edit-employeur"
                                                                    data-id="{{ $employeur_demandeur->id }}">@lang('trans.update')</button>
                                                            @endif
                                                            <button class="btn btn-danger btn-sm delete-employeur"
                                                                data-id="{{ $employeur_demandeur->id }}">@lang('trans.destroy')</button>
                                                        </td>
                                                    </tr>

                                                    {{-- Formulaire de mise à jour (caché par défaut) --}}
                                                    <tr id="edit-form-employeur-{{ $employeur_demandeur->id }}"
                                                        style="display: none;">
                                                        <td colspan="5">
                                                            <form id="updateEmployeurForm-{{ $employeur_demandeur->id }}"
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
                                                                            <label
                                                                                for="edit_periode_du">@lang('trans.start_date')</label>
                                                                            <input type="date" class="form-control"
                                                                                name="periode_du"
                                                                                value="{{ $employeur_demandeur->periode_du }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-2">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="edit_periode_au">@lang('trans.end_date')</label>
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
                                                                            <label
                                                                                for="edit_justificatif">@lang('trans.proof')</label>
                                                                            <input type="file" class="form-control"
                                                                                name="document" accept="application/pdf">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <button type="submit"
                                                                    class="btn btn-primary btn-sm update-employeur"
                                                                    data-id="{{ $employeur_demandeur->id }}">Enregistrer</button>
                                                                <button type="button" class="btn btn-secondary"
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
                @endif

                <div class="card">
                    <div class="card-header bg-primary text-white">
                        @lang('trans.attachments')
                    </div>

                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" id="documentForm">
                            @csrf
                            <input type="hidden" value="{{ $id }}" id="demande_id" name="demande_id">
                            <div class="row justify-content-center">

                                <div class="col-lg-6">
                                    <div class="form-group">

                                        <ol>
                                            @foreach ($type_documents as $index => $type_document)
                                                <li>
                                                    <input type="hidden" value="{{ $type_document->id }}"
                                                        id="type_document_id_{{ $index }}"
                                                        name="type_document_id[]">
                                                    {{ $type_document->nom_fr }}

                                                    <input type="file" class="form-control"
                                                        id="piece_{{ $index }}" name="pieces[]"
                                                        accept="application/pdf">
                                                </li>
                                            @endforeach
                                        </ol>



                                    </div>
                                </div>
                            </div>
                            @if ($type_documents->isNotEmpty())
                                <div class="row">

                                    <div class="col-lg-12">
                                        <button id="submitDocument" type="submit"
                                            class="btn btn-success float-right"><i class="fas fa-plus"></i>
                                            @lang('trans.send')

                                        </button>
                                    </div>
                                </div>
                            @endif

                        </form>
                        <br>
                        @isset($documents)
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-striped table-bordered" id="documentTable">
                                        <thead>
                                            <tr>

                                                <th>@lang('trans.title')</th>

                                                <th>@lang('trans.attachment')</th>
                                                <th>@lang('trans.actions')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($documents as $document)
                                                <tr id="document-{{ $document->id }}">
                                                    <td>{{ LaravelLocalization::getCurrentLocale() == 'fr' ? $document->nom_fr : $document->nom_en }}
                                                    </td>
                                                    <td>
                                                        <a target="_blank"
                                                            href="{{ asset('/uploads/' . $document->url) }}"
                                                            type="button" class="btn btn-primary btn-sm"><i
                                                                class="fas fa-download"></i></a>
                                                    </td>
                                                    <td>
                                                        @if (!$document->valider)
                                                            <button class="btn btn-warning btn-sm edit-document"
                                                                data-id="{{ $document->id }}">@lang('trans.update')</button>
                                                        @endif
                                                        <button class="btn btn-danger btn-sm delete-document"
                                                            data-id="{{ $document->id }}">@lang('trans.destroy')</button>

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
                                                                        <label>Pièce</label>
                                                                        <input type="file" class="form-control"
                                                                            name="piece" accept="application/pdf">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <button type="submit"
                                                                class="btn btn-primary btn-sm update-document"
                                                                data-id="{{ $document->id }}">@lang('trans.')</button>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
@push('custom')
    <script>
        $(document).ready(function() {
            function toggleEditSimulateurField(editFormId) {
                let typeField = $(`#updateEntrainementForm-${editFormId} select[name="type"]`).val();
                const simulateurOptions = [
                    "Hors Ligne (SIMU)",
                    "Instructor Refresher",
                    "ATC Refresher",
                    "ATE Refresher",
                    "AME Refresher",
                    "PNC Refresher",
                    "RPA Refresher"
                ];
                if (simulateurOptions.includes(typeField)) {
                    $(`#edit_simulateur_col`).show();
                } else {
                    $(`#edit_simulateur_col`).hide();
                    $(`#updateEntrainementForm-${editFormId} select[name="simulateur_id"]`).val(
                        '');
                }
            }


            $(document).on('change', `#updateEntrainementForm select[name="type"]`, function() {
                let editFormId = $(this).closest('form').attr('id').replace('updateEntrainementForm-', '');
                toggleEditSimulateurField(editFormId);
            });
        });
        $(document).ready(function() {
            // Function to toggle the simulator dropdown
            function toggleSimulateurField() {
                let typeField = $("#type").val();
                const simulateurOptions = [
                    "Hors Ligne (SIMU)",
                    "Instructor Refresher",
                    "ATC Refresher",
                    "ATE Refresher",
                    "AME Refresher",
                    "PNC Refresher",
                    "RPA Refresher"
                ];
                if (simulateurOptions.includes(typeField)) {
                    $("#simulateur_col").show(); // Show the simulator dropdown
                } else {
                    $("#simulateur_col").hide(); // Hide the simulator dropdown
                    $("#simulateur_id").val(''); // Reset the selected value
                }
            }

            // Initial check on page load
            toggleSimulateurField();

            // Event listener for the "Type de compétence" dropdown
            $("#type").change(function() {
                toggleSimulateurField();
            });
        });
        $(document).ready(function() {
            // Soumission du formulaire avec AJAX
            $("#licenceForm").submit(function(e) {

                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    url: "{{ route('user.store_licences') }}",
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
                                <button class="btn btn-danger btn-sm delete-licence" data-id="${response.licence.id}">@lang('trans.destroy')</button>
                            </td>
                        </tr>
                    `;
                            $("#licenceTable tbody").append(newRow);
                            $("#licenceForm")[0].reset();
                            Swal.fire({
                                title: 'Succès',
                                icon: 'success',
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
                            icon: 'error',
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
                    url: "{{ route('user.update_licences', ':id') }}".replace(':id', licenceId),
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
                            <button class="btn btn-danger btn-sm delete-licence" data-id="${response.licence.id}">@lang('trans.destroy')</button>
                        </td>
                    `);
                            Swal.fire({
                                title: 'Succès',
                                icon: 'success',
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
                            icon: 'error',
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
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('user.destroy_licences', ':id') }}".replace(
                                ':id', licenceId),
                            type: "DELETE",
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function() {
                                row.remove();
                                Swal.fire({
                                    title: 'Succès',
                                    icon: 'success',
                                    text: 'Licence supprimée !',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    location.reload();
                                });
                            },
                            error: function() {
                                Swal.fire({
                                    title: 'Erreur',
                                    icon: 'error',
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
                    url: "{{ route('user.store_formations') }}",
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
                                <button class="btn btn-danger btn-sm delete-formation" data-id="${response.formation.id}">@lang('trans.destroy')</button>
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
                    url: "{{ route('user.update_formations', ':id') }}".replace(':id',
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
                            <button class="btn btn-danger btn-sm delete-formation" data-id="${response.formation.id}">@lang('trans.destroy')</button>
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
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('user.destroy_formations', ':id') }}".replace(
                                ':id', formationId),
                            type: "DELETE",
                            data: {
                                _token: "{{ csrf_token() }}"
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


            $('#qualification_update_id').on('change click', function() {
                let selectedText = $('#qualification_update_id option:selected').data('type');

                const qualificationId = $('#qualification_update_id option:selected').attr(
                    'data-qualification-id');


                const toggleField = (selector, condition) => {
                    if (selectedText.includes(condition)) {
                        $(selector).show();
                    } else {
                        $(selector).hide().find('input, select').val('');
                    }
                };


                toggleField('#type_avion_col_update_' + qualificationId, "Qualification Type Machine");
                toggleField('#type_engine_col_update_' + qualificationId, "Qualification de Class");
                toggleField('#instructeur_privilege_col_update_' + qualificationId,
                    "Qualification instructeur");
                toggleField('#examinateur_privilege_col_update_' + qualificationId,
                    "Autorisation examinateur");
                toggleField('#atc_qualifications_col_update_' + qualificationId, "Qualifications ATC");
                toggleField('#amt_qualifications_col_update_' + qualificationId, "Qualifications AMT");

            });
            $('#qualification_id').on('change click', function() {
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
                toggleField('#atc_qualifications_col', "Qualifications ATC");
                toggleField('#amt_qualifications_col', "Qualifications AMT");
                //toggleField('#ulm_qualifications_col', "Qualifications ULM");



            });


            $("#qualificationForm").submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    url: "{{ route('user.store_qualifications') }}",
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
                                <button class="btn btn-danger btn-sm delete-qualification" data-id="${response.qualification.id}">@lang('trans.destroy')</button>
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
                    url: "{{ route('user.update_qualifications', ':id') }}".replace(':id',
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
                        <button class="btn btn-danger btn-sm delete-qualification" data-id="${response.qualification.id}">@lang('trans.destroy')</button>
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
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('user.destroy_qualifications', ':id') }}"
                                .replace(':id', qualificationId),
                            type: "DELETE",
                            data: {
                                _token: "{{ csrf_token() }}"
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
                    url: "{{ route('user.store_aptitudes') }}",
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
                                <button class="btn btn-danger btn-sm delete-aptitude" data-id="${response.aptitude.id}">@lang('trans.destroy')</button>
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
                    url: "{{ route('user.update_aptitudes', ':id') }}".replace(':id', aptitudeId),
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
                        <button class="btn btn-danger btn-sm delete-aptitude" data-id="${response.aptitude.id}">@lang('trans.destroy')</button>
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
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('user.destroy_aptitudes', ':id') }}".replace(
                                ':id', aptitudeId),
                            type: "DELETE",
                            data: {
                                _token: "{{ csrf_token() }}"
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
            $("#competenceForm").submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    url: "{{ route('user.store_competences') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            // Ajouter la nouvelle ligne dans le tableau
                            let newRow = `
                        <tr id="competence-${response.competence.id}">
                            <td>${response.competence.type}</td>
                            <td>${response.competence.niveau}</td>
                            <td>
                                <button class="btn btn-warning btn-sm edit-competence" data-id="${response.competence.id}">Modifier</button>
                                <button class="btn btn-danger btn-sm delete-competence" data-id="${response.competence.id}">@lang('trans.destroy')</button>
                            </td>
                        </tr>
                    `;
                            $("#competenceTable tbody").append(newRow);
                            $("#competenceForm")[0].reset();
                            Swal.fire({
                                title: 'Succès',
                                text: 'Compétence créée avec succès !',
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
            $(".edit-competence").click(function() {
                let competenceId = $(this).data("id");
                $("#edit-form-competence-" + competenceId).toggle();
            });

            $(".update-competence").click(function(e) {
                e.preventDefault();
                let competenceId = $(this).data("id");
                let formData = new FormData($("#updateCompetenceForm-" + competenceId)[0]);

                $.ajax({
                    url: "{{ route('user.update_competences', ':id') }}".replace(':id',
                        competenceId),
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            $(`#competence-${competenceId}`).html(`
                    <td>${response.competence.type}</td>
                    <td>${response.competence.niveau}</td>
                    <td>
                        <button class="btn btn-warning btn-sm edit-competence" data-id="${response.competence.id}">Modifier</button>
                        <button class="btn btn-danger btn-sm delete-competence" data-id="${response.competence.id}">@lang('trans.destroy')</button>
                    </td>
                `);
                            Swal.fire({
                                title: 'Succès',
                                text: 'Compétence mise à jour avec succès !',
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
            $(document).on("click", ".delete-competence", function() {
                let competenceId = $(this).data("id");
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
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('user.destroy_competences', ':id') }}".replace(
                                ':id', competenceId),
                            type: "DELETE",
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function() {
                                row.remove();
                                Swal.fire({
                                    title: 'Succès',
                                    text: 'Compétence supprimée !',
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
            $("#entrainementForm").submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    url: "{{ route('user.store_entrainements') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            let newRow = `
                        <tr id="entrainement-${response.entrainement.id}">
                            <td>${response.entrainement.type}</td>
                            <td>${response.entrainement.date}</td>
                            <td>${response.entrainement.validite}</td>
                            <td>${response.entrainement.centre_formation}</td>
                            <td>
                                <a target="_blank" href="/storage/${response.entrainement.document}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-download"></i>
                                </a>
                            </td>
                            <td>
                                <button class="btn btn-warning btn-sm edit-entrainement" data-id="${response.entrainement.id}">Modifier</button>
                                <button class="btn btn-danger btn-sm delete-entrainement" data-id="${response.entrainement.id}">@lang('trans.destroy')</button>
                            </td>
                        </tr>
                    `;
                            $("#entrainementTable tbody").append(newRow);
                            $("#entrainementForm")[0].reset();
                            Swal.fire({
                                title: 'Succès',
                                text: 'Entraînement créé avec succès !',
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

            // Modification de l'entraînement avec AJAX
            $(".edit-entrainement").click(function() {
                let entrainementId = $(this).data("id");
                $("#edit-form-entrainement-" + entrainementId).toggle();
            });

            $(".update-entrainement").click(function(e) {
                e.preventDefault();
                let entrainementId = $(this).data("id");
                let formData = new FormData($("#updateEntrainementForm-" + entrainementId)[0]);

                $.ajax({
                    url: "{{ route('user.update_entrainements', ':id') }}".replace(':id',
                        entrainementId),
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            $(`#entrainement-${entrainementId}`).html(`
                        <td>${response.entrainement.type}</td>
                        <td>${response.entrainement.date}</td>
                        <td>${response.entrainement.validite}</td>
                        <td>${response.entrainement.centre_formation}</td>
                        <td>
                            <a target="_blank" href="/storage/${response.entrainement.document}" class="btn btn-primary btn-sm">
                                <i class="fas fa-download"></i>
                            </a>
                        </td>
                        <td>
                            <button class="btn btn-warning btn-sm edit-entrainement" data-id="${response.entrainement.id}">Modifier</button>
                            <button class="btn btn-danger btn-sm delete-entrainement" data-id="${response.entrainement.id}">@lang('trans.destroy')</button>
                        </td>
                    `);
                            Swal.fire({
                                title: 'Succès',
                                text: 'Entraînement mis à jour avec succès !',
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

            // Suppression de l'entraînement avec AJAX
            $(document).on("click", ".delete-entrainement", function() {
                let entrainementId = $(this).data("id");
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
                    if (result.isConfirmed) {
                        
                        $.ajax({
                            url: "{{ route('user.destroy_entrainements', ':id') }}"
                                .replace(':id', entrainementId),
                            type: "DELETE",
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function() {
                                row.remove();
                               
                                Swal.fire({
                                    title: 'Succès',
                                    text: 'Entraînement supprimé !',
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
            $("#experienceForm").submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    url: "{{ route('user.store_experiences') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            let newRow = `
                        <tr id="experience-${response.experience.id}">
                            <td>${response.experience.nature}</td>
                            <td>${response.experience.total}</td>
                            <td>${response.experience.six_mois}</td>
                            <td>${response.experience.trois_mois}</td>
                            <td>
                                <a target="_blank" href="/storage/${response.experience.document}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-download"></i>
                                </a>
                            </td>
                            <td>
                                <button class="btn btn-warning btn-sm edit-experience" data-id="${response.experience.id}">Modifier</button>
                                <button class="btn btn-danger btn-sm delete-experience" data-id="${response.experience.id}">@lang('trans.destroy')</button>
                            </td>
                        </tr>
                    `;
                            $("#experienceTable tbody").append(newRow);
                            $("#experienceForm")[0].reset();
                            Swal.fire({
                                title: 'Succès',
                                text: 'Expérience créée avec succès !',
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

            // Modification de l'expérience avec AJAX
            $(".edit-experience").click(function() {
                let experienceId = $(this).data("id");
                $("#edit-form-experience-" + experienceId).toggle();
            });

            $(".update-experience").click(function(e) {
                e.preventDefault();
                let experienceId = $(this).data("id");
                let formData = new FormData($("#updateExperienceForm-" + experienceId)[0]);

                $.ajax({
                    url: "{{ route('user.update_experiences', ':id') }}".replace(':id',
                        experienceId),
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            $(`#experience-${experienceId}`).html(`
                        <td>${response.experience.nature}</td>
                        <td>${response.experience.total}</td>
                        <td>${response.experience.six_mois}</td>
                        <td>${response.experience.trois_mois}</td>
                        <td>
                            <a target="_blank" href="/storage/${response.experience.document}" class="btn btn-primary btn-sm">
                                <i class="fas fa-download"></i>
                            </a>
                        </td>
                        <td>
                            <button class="btn btn-warning btn-sm edit-experience" data-id="${response.experience.id}">Modifier</button>
                            <button class="btn btn-danger btn-sm delete-experience" data-id="${response.experience.id}">@lang('trans.destroy')</button>
                        </td>
                    `);
                            Swal.fire({
                                title: 'Succès',
                                text: 'Expérience mise à jour avec succès !',
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


            // Suppression de l'expérience avec AJAX
            $(document).on("click", ".delete-experience", function() {
                let experienceId = $(this).data("id");
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
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('user.destroy_experiences', ':id') }}".replace(
                                ':id', experienceId),
                            type: "DELETE",
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function() {
                                row.remove();
                                Swal.fire({
                                    title: 'Succès',
                                    text: 'Expérience supprimée !',
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
            $("#employeurForm").submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    url: "{{ route('user.store_employeurs') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            let newRow = `
                        <tr id="employeur-${response.employeur.id}">
                            <td>${response.employeur.employeur}</td>
                            <td>${response.employeur.periode_du}</td>
                            <td>${response.employeur.periode_au}</td>
                            <td>${response.employeur.fonction}</td>
                            <td>
                                <a target="_blank" href="/storage/${response.employeur.document}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-download"></i>
                                </a>
                            </td>
                            <td>
                                <button class="btn btn-warning btn-sm edit-employeur" data-id="${response.employeur.id}">Modifier</button>
                                <button class="btn btn-danger btn-sm delete-employeur" data-id="${response.employeur.id}">@lang('trans.destroy')</button>
                            </td>
                        </tr>
                    `;
                            $("#employeurTable tbody").append(newRow);
                            $("#employeurForm")[0].reset();
                            Swal.fire({
                                title: 'Succès',
                                text: 'Employeur créé avec succès !',
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

            // Modification de l'employeur avec AJAX
            $(".edit-employeur").click(function() {
                let employeurId = $(this).data("id");
                $("#edit-form-employeur-" + employeurId).toggle();
            });

            $(".update-employeur").click(function(e) {
                e.preventDefault();
                let employeurId = $(this).data("id");
                let formData = new FormData($("#updateEmployeurForm-" + employeurId)[0]);

                $.ajax({
                    url: "{{ route('user.update_employeurs', ':id') }}".replace(':id',
                        employeurId),
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            $(`#employeur-${employeurId}`).html(`
                        <td>${response.employeur.employeur}</td>
                        <td>${response.employeur.periode_du}</td>
                        <td>${response.employeur.periode_au}</td>
                        <td>${response.employeur.fonction}</td>
                        <td>
                            <a target="_blank" href="/storage/${response.employeur.document}" class="btn btn-primary btn-sm">
                                <i class="fas fa-download"></i>
                            </a>
                        </td>
                        <td>
                            <button class="btn btn-warning btn-sm edit-employeur" data-id="${response.employeur.id}">Modifier</button>
                            <button class="btn btn-danger btn-sm delete-employeur" data-id="${response.employeur.id}">@lang('trans.destroy')</button>
                        </td>
                    `);
                            Swal.fire({
                                title: 'Succès',
                                text: 'Employeur mis à jour avec succès !',
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

            // Suppression de l'employeur avec AJAX
            $(document).on("click", ".delete-employeur", function() {
                let employeurId = $(this).data("id");
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
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('user.destroy_employeurs', ':id') }}"
                                .replace(':id', employeurId),
                            type: "DELETE",
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function() {
                                row.remove();
                                Swal.fire({
                                    title: 'Succès',
                                    text: 'Employeur supprimé !',
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
            $("#maintenanceForm").submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    url: "{{ route('user.store_maintenances') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            let newRow = `
                        <tr id="maintenance-${response.maintenance.id}">
                            <td>${response.maintenance.date_debut}</td>
                            <td>${response.maintenance.date_fin}</td>
                            <td>${response.maintenance.description_maintenance}</td>
                            <td>
                                <a target="_blank" href="/storage/${response.maintenance.document}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-download"></i>
                                </a>
                            </td>
                            <td>
                                <button class="btn btn-warning btn-sm edit-maintenance" data-id="${response.maintenance.id}">Modifier</button>
                                <button class="btn btn-danger btn-sm delete-maintenance" data-id="${response.maintenance.id}">@lang('trans.destroy')</button>
                            </td>
                        </tr>
                    `;
                            $("#maintenanceTable tbody").append(newRow);
                            $("#maintenanceForm")[0].reset();
                            Swal.fire({
                                title: 'Succès',
                                text: 'Expérience en maintenance créée avec succès !',
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

            // Modification de l'expérience en maintenance avec AJAX
            $(".edit-maintenance").click(function() {
                let maintenanceId = $(this).data("id");
                $("#edit-form-maintenance-" + maintenanceId).toggle();
            });

            $(".update-maintenance").click(function(e) {
                e.preventDefault();
                let maintenanceId = $(this).data("id");
                let formData = new FormData($("#updateMaintenanceForm-" + maintenanceId)[0]);

                $.ajax({
                    url: "{{ route('user.update_maintenances', ':id') }}".replace(':id',
                        maintenanceId),
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            $(`#maintenance-${maintenanceId}`).html(`
                        <td>${response.maintenance.date_debut}</td>
                        <td>${response.maintenance.date_fin}</td>
                        <td>${response.maintenance.description_maintenance}</td>
                        <td>
                            <a target="_blank" href="/storage/${response.maintenance.document}" class="btn btn-primary btn-sm">
                                <i class="fas fa-download"></i>
                            </a>
                        </td>
                        <td>
                            <button class="btn btn-warning btn-sm edit-maintenance" data-id="${response.maintenance.id}">Modifier</button>
                            <button class="btn btn-danger btn-sm delete-maintenance" data-id="${response.maintenance.id}">@lang('trans.destroy')</button>
                        </td>
                    `);
                            Swal.fire({
                                title: 'Succès',
                                text: 'Expérience en maintenance mise à jour avec succès !',
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

            // Suppression de l'expérience en maintenance avec AJAX
            $(document).on("click", ".delete-maintenance", function() {
                let maintenanceId = $(this).data("id");
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
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('user.destroy_maintenances', ':id') }}"
                                .replace(':id', maintenanceId),
                            type: "DELETE",
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function() {
                                row.remove();
                                Swal.fire({
                                    title: 'Succès',
                                    text: 'Expérience en maintenance supprimée !',
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
            $("#interruptionForm").submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    url: "{{ route('user.store_interruptions') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            let newRow = `
                        <tr id="interruption-${response.interruption.id}">
                            <td>${response.interruption.date_debut}</td>
                            <td>${response.interruption.date_fin}</td>
                            <td>${response.interruption.raison}</td>
                            <td>
                                <a target="_blank" href="/storage/${response.interruption.document}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-download"></i>
                                </a>
                            </td>
                            <td>
                                <button class="btn btn-warning btn-sm edit-interruption" data-id="${response.interruption.id}">Modifier</button>
                                <button class="btn btn-danger btn-sm delete-interruption" data-id="${response.interruption.id}">@lang('trans.destroy')</button>
                            </td>
                        </tr>
                    `;
                            $("#interruptionTable tbody").append(newRow);
                            $("#interruptionForm")[0].reset();
                            Swal.fire({
                                title: 'Succès',
                                text: 'Interruption créée avec succès !',
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

            // Modification de l'interruption avec AJAX
            $(".edit-interruption").click(function() {
                let interruptionId = $(this).data("id");
                $("#edit-form-interruption-" + interruptionId).toggle();
            });

            $(".update-interruption").click(function(e) {
                e.preventDefault();
                let interruptionId = $(this).data("id");
                let formData = new FormData($("#updateInterruptionForm-" + interruptionId)[0]);

                $.ajax({
                    url: "{{ route('user.update_interruptions', ':id') }}".replace(':id',
                        interruptionId),
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            $(`#interruption-${interruptionId}`).html(`
                        <td>${response.interruption.date_debut}</td>
                        <td>${response.interruption.date_fin}</td>
                        <td>${response.interruption.raison}</td>
                        <td>
                            <a target="_blank" href="/storage/${response.interruption.document}" class="btn btn-primary btn-sm">
                                <i class="fas fa-download"></i>
                            </a>
                        </td>
                        <td>
                            <button class="btn btn-warning btn-sm edit-interruption" data-id="${response.interruption.id}">Modifier</button>
                            <button class="btn btn-danger btn-sm delete-interruption" data-id="${response.interruption.id}">@lang('trans.destroy')</button>
                        </td>
                    `);
                            Swal.fire({
                                title: 'Succès',
                                text: 'Interruption mise à jour avec succès !',
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

            // Suppression de l'interruption avec AJAX
            $(document).on("click", ".delete-interruption", function() {
                let interruptionId = $(this).data("id");
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
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('user.destroy_interruptions', ':id') }}"
                                .replace(':id', interruptionId),
                            type: "DELETE",
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function() {
                                row.remove();
                                Swal.fire({
                                    title: 'Succès',
                                    text: 'Interruption supprimée !',
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
                $(this).prop("disabled", true);
                $.ajax({
                    url: "{{ route('user.store_documents') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {

                        if (response.success) {
                            response.documents.forEach(function(document) {
                                let newRow = `
                                <tr id="document-${document.id}">
                                    <td>${document.nom_fr}</td>
                                    <td>
                                        <a target="_blank" href="/storage/${document.url}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <button class="btn btn-warning btn-sm edit-document" data-id="${document.id}">Modifier</button>
                                        <button class="btn btn-danger btn-sm delete-document" data-id="${document.id}">@lang('trans.destroy')</button>
                                    </td>
                                </tr>
                            `;
                                $("#documentTable tbody").append(newRow);
                            });
                            $("#documentForm")[0].reset();
                            // SweetAlert pour confirmer la mise à jour et recharger la page
                            Swal.fire({

                                title: 'Succès',
                                text: 'Document cree avec succès !',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                $(this).prop("disabled", false);
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
                        $(this).prop("disabled", false);
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
                        <td>${response.document.nom_fr}</td>
                        <td>
                            <a target="_blank" href="/storage/${response.document.url}" class="btn btn-primary btn-sm">
                                <i class="fas fa-download"></i>
                            </a>
                        </td>
                        <td>
                            <button class="btn btn-warning btn-sm edit-document" data-id="${response.document.id}" data-libelle="${response.document.nom_fr}">Modifier</button>
                            <button class="btn btn-danger btn-sm delete-document" data-id="${response.document.id}">@lang('trans.destroy')</button>
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


                    if (result.isConfirmed) {
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
    </script>
@endpush
