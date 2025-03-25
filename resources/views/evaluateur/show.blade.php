@extends('evaluateur.layouts.app')
@section('title')
    @lang('evaluateur.dashboard')
@endsection
@section('contentheader')
    @lang('evaluateur.dashboard')
@endsection
@section('contentheaderlink')
    <a href="{{ route('evaluateur') }}">
        @lang('evaluateur.dashboard') </a>
@endsection
@section('contentheaderactive')
    @lang('evaluateur.dashboard')
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
                        @lang('evaluateur.examen')
                    </div>
                    <div class="card-body">
                        @isset($examen)
                            <div class="row justify-content-center">

                                <div class="col-lg-9">
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <th>@lang('evaluateur.np')</th>
                                            <td>{{ $examen->demandeur->np ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('evaluateur.date_naissance')</th>
                                            <td>{{ $examen->demandeur->date_naissance ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('evaluateur.lieu_naissance')</th>
                                            <td>{{ $examen->demandeur->lieu_naissance ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('evaluateur.adresse')</th>
                                            <td>{{ $examen->demandeur->adresse ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('evaluateur.date_examen')</th>
                                            <td>{{ $examen->date_examen ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('evaluateur.aptitude')</th>
                                            <td>{{ $examen->aptitude ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('evaluateur.rapport')</th>
                                            <td>{!! $examen->rapport ?? '-' !!}</td>
                                        </tr>

                                        <tr>
                                            <th>@lang('evaluateur.attestation')</th>
                                            <td class="text-center">
                                                @if (isset($examen->attestation) && $examen->attestation != '')
                                                    <button class="btn btn-primary"
                                                        onclick="openPdfModal('{{ asset('/uploads/' . $examen->attestation) }}')"><i
                                                            class="fas fa-eye"></i></button>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>



                            </div>
                        @endisset
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
@push('script')
@endpush
@push('custom')
@endpush
