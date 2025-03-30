@extends('daf.layouts.app')
@section('title')
    @lang('trans.dashboard_dir')
@endsection
@section('contentheader')
    @lang('trans.dashboard_dir')
@endsection
@section('contentheaderlink')
    <a href="{{ route('dsv') }}">
        @lang('trans.dashboard_dir') </a>
@endsection
@section('contentheaderactive')
    @lang('trans.dashboard_dir')
@endsection
@push('css')
@endpush
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">@lang('trans.add_invoice')</div>
                    <div class="card-body">
                        <!-- Formulaire -->
                        <form action="{{ route('daf.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="demande_id" value="{{ $ordre->demande->id }}">

                            <div class="mb-3">
                                <label class="form-label">@lang('trans.date')</label>
                                <input type="date" name="date_facture" class="form-control"
                                    value="{{ $ordre->date_ordre }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">@lang('trans.end_date')</label>
                                <input type="date" name="date_limite" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">@lang('trans.amount')</label>
                                <input type="number" name="montant" class="form-control" value="{{ $ordre->montant }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">@lang('trans.invoice_signed')</label>
                                <input type="file" name="facture" class="form-control" accept="application/pdf" required>
                            </div>

                            <button type="submit" class="btn btn-success">@lang('trans.send')</button>
                        </form>
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
