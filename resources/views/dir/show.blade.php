@extends('dir.layouts.app')
@section('title')
    @lang('trans.dashboard_dir')
@endsection
@section('contentheader')
    @lang('trans.dashboard_dir')
@endsection
@section('contentheaderlink')
    @if (auth()->user()->hasRole('dsv'))
        <a href="{{ route('dsv') }}">
            @lang('trans.dashboard_dir') </a>
    @endif
    @if (auth()->user()->hasRole('dg'))
        <a href="{{ route('dg') }}">
            @lang('trans.dashboard_dir') </a>
    @endif
@endsection
@section('contentheaderactive')
    @lang('trans.dashboard_dir')
@endsection
@push('css')
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
                                            <th>@lang('trans.fl_name')</th>
                                            <td>{{ $demandeur->np ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('trans.dob')</th>
                                            <td>{{ $demandeur->date_naissance ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('trans.lieu_naissance')</th>
                                            <td>{{ $demandeur->lieu_naissance ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('trans.address')</th>
                                            <td>{{ $demandeur->adresse ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('trans.adresse_employeur')</th>
                                            <td>{{ $demandeur->adresse_employeur ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('trans.signature')</th>
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
                        @lang('trans.training')
                    </div>
                    <div class="card-body">
                        @isset($formation_demandeurs)
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>

                                                <th>@lang('trans.training_date')</th>
                                                <th>@lang('trans.training_center')</th>
                                                <th>@lang('trans.location')</th>

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
                        @lang('trans.ratings')
                    </div>
                    <div class="card-body">
                        <br>
                        @isset($qualification_demandeurs)
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>@lang('trans.rating')</th>
                                                <th>@lang('trans.exam_date')</th>
                                                <th>@lang('trans.training_center')</th>
                                                <th>@lang('trans.location')</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($qualification_demandeurs as $qualification_demandeur)
                                                <tr>
                                                    <td>{{ $qualification_demandeur->qualification }}</td>
                                                    <td>{{ $qualification_demandeur->date_examen }}</td>
                                                    <td>{{ $qualification_demandeur->centre_formation }}</td>
                                                    <td>{{ $qualification_demandeur->lieu }}</td>

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

                        @lang('trans.medical_fitness')
                    </div>
                    <div class="card-body">

                        @isset($medical_examinations)
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>

                                                <th>@lang('trans.exam_date')</th>
                                                <th>@lang('trans.validity')</th>
                                                <th>@lang('trans.medical_center')</th>

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
                        @lang('trans.flights')

                    </div>

                    <div class="card-body">
                        @isset($experience_demandeurs)
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>

                                                <th>@lang('trans.flights_type')</th>
                                                <th>@lang('trans.total')</th>
                                                <th>@lang('trans.six')</th>
                                                <th>@lang('trans.three')</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($experience_demandeurs as $experience_demandeur)
                                                <tr>
                                                    <td>{{ $experience_demandeur->nature }}</td>
                                                    <td>{{ $experience_demandeur->total }}</td>
                                                    <td>{{ $experience_demandeur->six_mois }}</td>
                                                    <td>{{ $experience_demandeur->trois_mois }}</td>

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
                        @lang('trans.control')
                    </div>
                    <div class="card-body">
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
                        @lang('trans.periodic_control')
                    </div>
                    <div class="card-body">
                        @isset($entrainement_demandeurs)
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>

                                                <th>@lang('trans.type')</th>

                                                <th>@lang('trans.date')</th>
                                                <th>@lang('trans.validity')</th>
                                                <th>@lang('trans.location')</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($entrainement_demandeurs as $entrainement_demandeur)
                                                <tr>
                                                    <td>{{ $entrainement_demandeur->type }}</td>
                                                    <td>{{ $entrainement_demandeur->date }}</td>
                                                    <td>{{ $entrainement_demandeur->validite }}</td>
                                                    <td>{{ $entrainement_demandeur->centre_formation }}</td>

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
                @if ($interruption_demandeurs->isNotEmpty())
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            @lang('trans.interruptions')
                        </div>

                        <div class="card-body">
                            @isset($interruption_demandeurs)
                                <div class="row">
                                    <div class="col-lg-12">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>



                                                    <th>@lang('trans.start_date')</th>
                                                    <th>@lang('trans.end_date')</th>
                                                    <th>@lang('trans.reason')</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($interruption_demandeurs as $interruption_demandeur)
                                                    <tr>
                                                        <td>{{ $interruption_demandeur->date_debut }}</td>
                                                        <td>{{ $interruption_demandeur->date_fin }}</td>
                                                        <td>{{ $interruption_demandeur->raison }}</td>


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

                {{-- Expérience en maintenance d'aéronefs --}}
                @if ($experience_maintenance_demandeurs->isNotEmpty())
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            @lang('trans.maintenance')
                        </div>

                        <div class="card-body">
                            @isset($experience_maintenance_demandeurs)
                                <div class="row">
                                    <div class="col-lg-12">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>


                                                    <th>@lang('trans.start_date')</th>
                                                    <th>@lang('trans.end_date')</th>
                                                    <th>@lang('trans.description')</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($experience_maintenance_demandeurs as $experience_maintenance_demandeur)
                                                    <tr>
                                                        <td>{{ $experience_maintenance_demandeur->date_debut }}</td>
                                                        <td>{{ $experience_maintenance_demandeur->date_fin }}</td>
                                                        <td>{{ $experience_maintenance_demandeur->description_maintenance }}
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
                @if ($employeur_demandeurs->isNotEmpty())
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            @lang('trans.employers')
                        </div>

                        <div class="card-body">
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

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($employeur_demandeurs as $employeur_demandeur)
                                                    <tr>
                                                        <td>{{ $employeur_demandeur->employeur }}</td>
                                                        <td>{{ $employeur_demandeur->periode_du }}</td>
                                                        <td>{{ $employeur_demandeur->periode_au }}</td>
                                                        <td>{{ $employeur_demandeur->fonction }}</td>


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
                {{-- --}}

                <div class="card">
                    <div class="card-header bg-primary text-white">
                        @lang('trans.attachments')
                    </div>

                    <div class="card-body">
                        @isset($documents)
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>

                                                <th>@lang('trans.title')</th>

                                                <th>@lang('trans.attachment')</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($documents as $document)
                                                <tr>
                                                    <td>{{ LaravelLocalization::getCurrentLocale() == 'fr' ? $document->nom_fr : $document->nom_en }}
                                                    </td>
                                                    <td>
                                                        @if ($document->url)
                                                            <button class="btn btn-primary"
                                                                onclick="openPdfModal('{{ asset('/uploads/' . $document->url) }}')"><i
                                                                    class="fas fa-eye"></i></button>
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



@endsection
@push('script')
    <script>
        function openPdfModal(pdfUrl) {
            $("#pdfViewer").attr("src", pdfUrl);
            $("#pdfModal").modal("show");
        }
    </script>
@endpush
@push('custom')
@endpush
