@extends('layouts.admin')
@section('title')
    @lang('sidebar.reporting')
@endsection
@section('contentheader')
    @lang('sidebar.reporting')
@endsection
@section('contentheaderlink')
    <a href="{{ route('admin.reports.localites') }}"> @lang('sidebar.reporting') </a>
@endsection
@section('contentheaderactive')

@endsection
@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title card_title_center">Filtring
                    </h2>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">

                                <select name="wilaya" id="wilaya" class="form-control wilaya">
                                    <option value="">-- Select Wilaya --</option>
                                    @foreach ($wilayas as $item)
                                        <option value="{{ $item->id }}">{{ $item->intitule }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">

                                <select name="moughata" id="moughata" class="form-control moughata">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">

                                <select name="commune" id="commune" class="form-control commune">

                                </select>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title card_title_center">DONNEES GENERALES</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <tbody>
                        <tr>
                            <td>Wilaya</td>
                            <td>Date</td>
                            <td>Population estimée à la date de la requête</td>
                            <td>Nb de moughataas</td>
                            <td>Nb de communes</td>
                            <td>Nb de localites</td>
                            <td>Nb total de localités recensées ANSADE</td>
                        </tr>
                        <tr>
                            <td>Wilaya</td>
                            <td>{{now()}}</td>
                            <td>{{$report['donnees_generales']['population']}}</td>
                            <td>{{$report['donnees_generales']['nb_moughatas']}}</td>
                            <td>{{$report['donnees_generales']['nb_communes']}}</td>
                            <td>{{$report['donnees_generales']['nb_localites']}}</td>
                            <td>{{$report['donnees_generales']['nb_localites_codifiees']}}</td>


                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title card_title_center">ACCES A L’ASSAINISSEMENT FAMILIAL</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered table-striped mb-4">
                        <tbody>
                        <tr>
                            <td>Projet ayant mis en œuvre l’ATPC</td>
                            <td>Opérateur</td>
                            <td>Période</td>
                            <td>Nb de localités ciblées</td>

                        </tr>
                        @foreach($report['access_assainisement_familial']['projets'] as $projet)
                            <tr>
                                <td>{{$projet->intitule_resume}}</td>
                                <td>{{$projet->intitule}}</td>
                                <td></td>
                                <td>{{$projet->localites}}</td>


                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <table class="table table-bordered table-striped mb-4">
                        <tbody>
                        <tr>
                            <td>Mise en œuvre de l’ATPC</td>
                            <td>Nombre</td>
                            <td>Taux</td>


                        </tr>

                        <tr>
                            <td>Villages déclenchés une première fois (codifiés ANSADE)</td>
                            <td>{{$report['access_assainisement_familial']['mise_atcp']['villages_declenches_cod']}}</td>
                            <td>{{ intval($report['access_assainisement_familial']['mise_atcp']['villages_declenches_cod'] * 100/ $report['donnees_generales']['nb_localites_codifiees'])}}</td>
                        </tr>
                        <tr>
                            <td>Villages déclenchés une première fois (non codifiés ANSADE)</td>
                            <td>{{$report['access_assainisement_familial']['mise_atcp']['villages_declenches_noncod']}}</td>
                            <td>{{ intval($report['access_assainisement_familial']['mise_atcp']['villages_declenches_noncod'] * 100/ $report['donnees_generales']['nb_localites_codifiees'])}}</td>
                        </tr>
                        <tr>
                            <td>Villages redéclenchés (codifiés ANSADE)</td>
                            <td>{{$report['access_assainisement_familial']['mise_atcp']['villages_redeclenches_cod']}}</td>
                            <td>{{ intval($report['access_assainisement_familial']['mise_atcp']['villages_redeclenches_cod'] * 100 / $report['donnees_generales']['nb_localites_codifiees'])}}</td>
                        </tr>
                        <tr>
                            <td>Villages redéclenchés (non codifiés ANSADE)</td>
                            <td>{{$report['access_assainisement_familial']['mise_atcp']['villages_redeclenches_noncod']}}</td>
                            <td>{{ intval($report['access_assainisement_familial']['mise_atcp']['villages_redeclenches_noncod'] * 100/ $report['donnees_generales']['nb_localites_codifiees'])}}</td>
                        </tr>
                        <tr>
                            <td>Villages bénéficiaires d’un appui-suivi</td>
                            <td>{{$report['access_assainisement_familial']['mise_atcp']['villages_appui_suivi']}}</td>
                            <td>{{ intval($report['access_assainisement_familial']['mise_atcp']['villages_appui_suivi'] * 100/ $report['donnees_generales']['nb_localites_codifiees'])}}</td>
                        </tr>
                        <tr>
                            <td>Villages jamais déclenchés</td>
                            <td>{{$report['donnees_generales']['nb_localites_codifiees'] - $report['access_assainisement_familial']['mise_atcp']['villages_declenches_cod'] }}</td>
                            <td>{{ intval(($report['donnees_generales']['nb_localites_codifiees'] - $report['access_assainisement_familial']['mise_atcp']['villages_declenches_cod'] ) * 100/ $report['donnees_generales']['nb_localites_codifiees'])}}</td>
                        </tr>


                        </tbody>
                    </table>
                    <table class="table table-bordered table-striped mb-4">
                        <tbody>
                        <tr>
                            <td>Population totale ciblée par l’ATPC</td>
                            <td></td>

                            <td>Nb total de ménages ciblés par l’ATPC</td>


                        </tr>
                        @foreach($report['access_assainisement_familial']['pm'] as $pm)
                            <tr>
                                <td>{{$pm->population}}</td>
                                <td></td>
                                <td>{{$pm->menages}}</td>
                                @php
                                    $nbr = $pm->menages;
                                @endphp
                            </tr>
                        @endforeach


                        </tbody>
                    </table>
                    <table class="table table-bordered table-striped mb-4">
                        <tbody>
                        <tr>
                            <td>Certification FDA</td>
                            <td>Nb de localités déclenchées</td>

                            <td>Nb de localités certifiées FDAL</td>
                            <td>Taux de certification</td>
                            <td>Nb de villages déclenchés et jamais certifiés FDAL</td>


                        </tr>
                        @foreach($report['access_assainisement_familial']['fdal']  as $key => $fdal)
                            <tr>
                                <td>{{$key}}</td>
                                <td>{{isset($fdal[1]) ? $fdal[1] : 0 }}</td>
                                <td>{{isset($fdal[3]) ? $fdal[3] : 0 }}</td>

                                <td>@if( isset($fdal[1]) && isset($fdal[3]) && $fdal[1] != 0)
                                        {{  intval($fdal[3] * 100 / $fdal[1])}}
                                    @else
                                        0
                                    @endif</td>
                                <td> @if(isset($fdal[3]) && isset($fdal[1]) && $fdal[1] > $fdal[3] )
                                        {{ $fdal[1] - $fdal[3] }}
                                    @else
                                        0
                                    @endif</td>

                            </tr>
                        @endforeach


                        </tbody>
                    </table>
                    <table class="table table-bordered table-striped mb-4">
                        <tbody>
                        <tr>
                            <td></td>
                            <td>Taux</td>
                            <td>Nb localités prises en compte</td>

                        </tr>

                        @foreach($report['access_assainisement_familial']['couvertures'] as $co)
                            <tr>
                                <td>Couverture initiale en latrines ({{$co->intitule}})</td>
                                <td>{{ $co->nb_latrine_amelior + $co->nb_latrine_non_amelior}}</td>
                                <td>{{intval(($co->nb_latrine_amelior + $co->nb_latrine_non_amelior) * 100 / $nbr) }}</td>
                            </tr>
                        @endforeach
                        @foreach($report['access_assainisement_familial']['securise'] as $securise)
                            <tr>
                                <td>Accès à un service d'assainissement sécurisé ({{$securise->intitule}})</td>
                                <td>{{$securise->nam}}</td>
                                <td>{{intval($securise->nam* 100 / $nbr) }}</td>
                            </tr>
                        @endforeach

                        @foreach($report['access_assainisement_familial']['base'] as $base)
                            <tr>
                                <td>Accès à un service d'assainissement basique (latrines améliorées)
                                    ({{$base->intitule}})
                                </td>
                                <td>{{$base->nam}}</td>
                                <td>{{intval($base->nam* 100 / $nbr) }}</td>
                            </tr>
                        @endforeach


                        @foreach($report['access_assainisement_familial']['limite'] as $limite)
                            <tr>
                                <td>Accès à un service d'assainissement limité (latrines partagées)
                                    ({{$limite->intitule}})
                                </td>
                                <td>{{$limite->nam}}</td>
                                <td>{{intval($limite->nam* 100 / $nbr) }}</td>
                            </tr>
                        @endforeach

                        @foreach($report['access_assainisement_familial']['non_ameliores'] as $non_ameliores)
                            <tr>
                                <td>Accès à un service d'assainissement non amélioré
                                    ({{$non_ameliores->intitule}}
                                    )
                                </td>
                                <td>{{$non_ameliores->nb_latrine_non_amelior}}</td>
                                <td>{{intval($non_ameliores->nb_latrine_non_amelior* 100 / $nbr) }}</td>
                            </tr>
                        @endforeach
                        @foreach($report['access_assainisement_familial']['men_dal'] as $men_dal)
                            <tr>
                                <td>Taux de ménages déféquant à l'air libre (résultats du dernier suivi)
                                    ({{$men_dal->intitule}})
                                </td>
                                <td>{{$men_dal->nbr_menages_dal}}</td>
                                <td>{{intval($men_dal->nbr_menages_dal* 100 / $nbr) }}</td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title card_title_center">ACCES A l’HYGIENE</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <tbody>
                        <tr>
                            <td></td>
                            <td>Taux</td>
                            <td>Nb localités prises en compte</td>
                        </tr>


                        @foreach($report['access_assainisement_familial']['dlm'] as $dlm)
                            <tr>
                                <td>Latrines associées à un DLM fonctionnel ({{$dlm->intitule}})</td>
                                <td>{{$dlm->nbr_menages_dlm}}</td>
                                <td>{{$dlm->nbr_localites}}</td>
                            </tr>

                        @endforeach
                        @foreach($report['access_assainisement_familial']['dlm'] as $dlm)
                            <tr>
                                <td>Accès à un service d'hygiène de base ({{$dlm->intitule}})</td>
                                <td>{{$dlm->nbr_menages_dlm_complet}}</td>
                                <td>{{$dlm->nbr_localites}}</td>
                            </tr>

                        @endforeach
                        @foreach($report['access_assainisement_familial']['dlm'] as $dlm)
                            <tr>
                                <td>Accès à un service d'hygiène limité ({{$dlm->intitule}})</td>
                                <td>{{$dlm->nbr_menages_dlm_incomplet}}</td>
                                <td>{{$dlm->nbr_localites}}</td>
                            </tr>

                        @endforeach
                        @foreach($report['access_assainisement_familial']['dlm'] as $dlm)
                            <tr>
                                <td>Aucun service ({{$dlm->intitule}})</td>
                                <td>{{$dlm->nbr_menages_sans_dlm}}</td>
                                <td>{{$dlm->nbr_localites}}</td>
                            </tr>

                        @endforeach


                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>

@endsection


@push('script')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script
        src="{{ asset('assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script
        src="{{ asset('assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('assets/admin/plugins/select2/js/select2.min.js') }}"></script>
@endpush
@push('custom')
    <script>
        $(document).ready(function () {
            //Initialize Select2 Elements
            $('.wilaya').select2()
            $('.moughata').select2()
            $('.commune').select2()

        })
    </script>
    <script>
        $(document).ready(function () {

            $('#wilaya').on('change', function () {

                var idWilaya = this.value;

                $("#moughata").html('');

                $.ajax({

                    url: "{{ url('admin/api/fetch-moughatas') }}",

                    type: "POST",

                    data: {

                        wilaya_id: idWilaya,

                        _token: '{{ csrf_token() }}'

                    },

                    dataType: 'json',

                    success: function (result) {


                        $('#moughata').html(
                            '<option value="">-- Select Moughata --</option>');

                        $.each(result.moughatas, function (key, value) {

                            $("#moughata").append('<option value="' + value

                                .id + '">' + value.intitule_fr + '</option>');

                        });

                        $('#commune').html('<option value="">-- Select Commune --</option>');

                    }

                });
                $.ajax({

                    url: "{{ url('admin/reporting/fetch-wilaya-report') }}",

                    type: "POST",

                    data: {

                        wilaya_id: idWilaya,

                        _token: '{{ csrf_token() }}'

                    },

                    dataType: 'json',

                    success: function (result) {
                        $.each(result.access_assainisement_familial.fdal, function (key, value) {
                            var p = result.access_assainisement_familial.fdal;
                            console.log(p);
                        });
                        //$.each(result.donnees_generales, function(key, value) {


                        //});
                        /*$.each(result.access_assainisement_familial, function(key, value) {
                            $.each(result.access_assainisement_familial.mise_atcp, function(key, value) {

                                $.each(result.access_assainisement_familial.mise_atcp.villages_appui_suivi, function(key, value) {
                                    var p = result.access_assainisement_familial.mise_atcp.villages_appui_suivi;


                                });
                            });



                        });

                         */

                    }

                });

            });

            $('#moughata').on('change', function () {

                var idMoughata = this.value;

                $("#commune").html('');

                $.ajax({

                    url: "{{ url('admin/api/fetch-communes') }}",

                    type: "POST",

                    data: {

                        moughata_id: idMoughata,

                        _token: '{{ csrf_token() }}'

                    },

                    dataType: 'json',

                    success: function (res) {

                        $('#commune').html('<option value="">-- Select Commune --</option>');

                        $.each(res.communes, function (key, value) {

                            $("#commune").append('<option value="' + value

                                .id + '">' + value.intitule_fr + '</option>');

                        });

                    }

                });

            });


        });
    </script>
@endpush
