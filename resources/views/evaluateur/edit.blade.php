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
                        <form action="{{ route('evaluateur.update', $examen) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Validite par l'evaluateur medical</label>
                                <input type="number" name="validite_evaluateur" class="form-control" value="{{$examen->validite}}"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Rapport Médical par l'evaluateur medical</label>
                                <textarea name="rapport_evaluateur" class="form-control summernote"></textarea>
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
        $(document).ready(function () {
            $('.summernote').summernote({
                height: 200, // Set height of the editor
                placeholder: 'Enter your text...',

            });
        });
    </script>
@endpush