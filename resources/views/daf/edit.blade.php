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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css">
@endpush
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Ajouter une facture</div>
                    <div class="card-body">
                        <!-- Formulaire -->
                        <form action="{{ route('daf.update', $facture) }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="demande_id" value="{{ $facture->demande->id }}">

                            <div class="mb-3">
                                <label class="form-label">Date facture</label>
                                <input type="date" name="date_facture" class="form-control"
                                    value="{{ $facture->date_facture }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Date limite</label>
                                <input type="date" name="date_limite" class="form-control"
                                    value="{{ $facture->date_limite }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Montant</label>
                                <input type="number" name="montant" class="form-control" value="{{ $facture->montant }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Facture signe(PDF)</label>
                                <input type="file" name="facture" class="form-control" accept="application/pdf" required>
                            </div>

                            <button type="submit" class="btn btn-success">Enregistrer</button>
                        </form>
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
