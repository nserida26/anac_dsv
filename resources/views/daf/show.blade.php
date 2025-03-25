@extends('daf.layouts.app')
@section('title')
    @lang('daf.dashboard')
@endsection
@section('contentheader')
    @lang('daf.dashboard')
@endsection
@section('contentheaderlink')
    <a href="{{ route('daf') }}">
        @lang('daf.dashboard') </a>
@endsection
@section('contentheaderactive')
    @lang('daf.dashboard')
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
                        @lang('daf.paiement')
                    </div>
                    <div class="card-body">
                        @isset($paiement)
                            <div class="row justify-content-center">

                                <div class="col-lg-9">
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <th>@lang('daf.reference')</th>
                                            <td>{{ $paiement->reference ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('daf.demande')</th>
                                            <td>{{ $paiement->demande->code ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('daf.demandeur')</th>
                                            <td>{{ $paiement->demande->demandeur->np ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('daf.montant')</th>
                                            <td>{{ $paiement->montant ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('daf.statut')</th>
                                            <td>{{ $paiement->statut ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('daf.date_paiement')</th>
                                            <td>{{ $paiement->date_paiement ?? '-' }}</td>
                                        </tr>


                                        <tr>
                                            <th>@lang('daf.quittance')</th>
                                            <td class="text-center">
                                                @if (isset($paiement->quittance) && $paiement->quittance != '')
                                                    <button class="btn btn-primary"
                                                        onclick="openPdfModal('{{ asset('/uploads/' . $paiement->quittance) }}')"><i
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
