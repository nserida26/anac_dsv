@extends('centre.layouts.app')
@section('title')
    @lang('centre.dashboard')
@endsection
@section('contentheader')
    @lang('centre.dashboard')
@endsection
@section('contentheaderlink')
    <a href="{{ route('centre') }}">
        @lang('centre.dashboard') </a>
@endsection
@section('contentheaderactive')
    @lang('centre.dashboard')
@endsection
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css">
@endpush
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Ajouter une formation</div>
                    <div class="card-body">
                        <!-- Formulaire -->
                        <form action="{{ route('centre.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="centre_formation_id" value="{{ $centre->id }}">
                            <input type="hidden" name="demandeur_id" value="{{ $demandeur->id }}">
                            <div class="mb-3">
                                <label class="form-label">Type de formation</label>
                                <select class="form-control" name="type_formation_id">
                                    @foreach ($type_formations as $type_formation)
                                        <option value="{{ $type_formation->id }}">
                                            {{ $type_formation->nom }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="mb-3">
                                <label class="form-label">Date formation</label>
                                <input type="date" name="date_formation" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Lieu</label>
                                <input type="text" class="form-control" id="lieu" name="lieu">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Attestation (PDF)</label>
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
