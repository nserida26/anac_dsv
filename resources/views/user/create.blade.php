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
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Créer un Demande</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('user.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="type_demande_id">Type de demande</label>
                                        <select class="form-control" id="type_demande_id" name="type_demande_id"
                                            placeholder="">
                                            @foreach ($type_demandes as $type_demande)
                                                <option value="{{ $type_demande->id }}">{{ $type_demande->nom_fr }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="type_licence_id">Type de licence</label>
                                        <select class="form-control" id="type_licence_id" name="type_licence_id"
                                            placeholder="">
                                            @foreach ($type_licences as $type_licence)
                                                <option value="{{ $type_licence->id }}">
                                                    {{ $type_licence->nom }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!--<div class="col-lg-4">
                                                                                                <div class="form-group">
                                                                                                    <label for="specialite">Machine</label>
                                                                                                    <select class="form-control" id="specialite" name="specialite" placeholder="">
                                                                                                        <option value="Avion">Avion</option>
                                                                                                        <option value="Helicoptere">Hélicoptère</option>
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>-->
                            </div>
                            <div class="row">

                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-success float-right">Créer</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->


                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection
@push('script')
@endpush
@push('custom')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const typeDemandeSelect = document.getElementById('type_demande_id');
            const typeLicenceSelect = document.getElementById('type_licence_id');

            // Options à cacher (ATE et ATC)
            const optionsToHide = ['ATE', 'ATC'];

            function updateLicenceOptions() {
                const selectedDemande = typeDemandeSelect.value;

                // Activer toutes les options
                Array.from(typeLicenceSelect.options).forEach(option => {
                    option.disabled = false;
                });


                if (selectedDemande === '7') {
                    Array.from(typeLicenceSelect.options).forEach(option => {
                        if (optionsToHide.includes(option.text)) {
                            option.disabled = true;
                        }
                    });
                }
            }
            typeDemandeSelect.addEventListener('change', updateLicenceOptions);
            updateLicenceOptions();
        });
    </script>
@endpush
