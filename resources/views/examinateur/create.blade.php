@extends('examinateur.layouts.app')
@section('title')
    @lang('examinateur.dashboard')
@endsection
@section('contentheader')
    @lang('examinateur.dashboard')
@endsection
@section('contentheaderlink')
    <a href="{{ route('examinateur') }}">
        @lang('examinateur.dashboard') </a>
@endsection
@section('contentheaderactive')
    @lang('examinateur.dashboard')
@endsection
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css">
@endpush
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Ajouter un Examen Médical</div>
                    <div class="card-body">
                        <!-- Formulaire -->
                        <form action="{{ route('examinateur.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="examinateur_id" value="{{ $examinateur->id }}">
                            <input type="hidden" name="demandeur_id" value="{{ $demandeur->id }}">

                            <div class="mb-3">
                                <label class="form-label">Date Examen</label>
                                <input type="date" name="date_examen" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Validite</label>
                                <input type="number" name="validite" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Aptitude</label>
                                <select name="aptitude" class="form-control" required>
                                    <option value="Apte">Apte</option>
                                    <option value="Inapte">Inapte</option>
                                </select>
                            </div>


                            <div class="mb-3">
                                <label class="form-label">Rapport Médical</label>
                                <textarea name="rapport" class="form-control summernote" rows="3"></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Attestation Médicale (PDF)</label>
                                <input type="file" name="attestation" class="form-control" accept="application/pdf"
                                    required>
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
