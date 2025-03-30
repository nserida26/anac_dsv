@extends('examinateur.layouts.app')
@section('title')
    @lang('trans.dashboard_examiner')
@endsection
@section('contentheader')
    @lang('trans.dashboard_examiner')
@endsection
@section('contentheaderlink')
    <a href="{{ route('examinateur') }}">
        @lang('trans.dashboard_examiner') </a>
@endsection
@section('contentheaderactive')
    @lang('trans.dashboard_examiner')
@endsection
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css">
@endpush
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">@lang('trans.add_medical_fitness')</div>
                    <div class="card-body">
                        <!-- Formulaire -->
                        <form action="{{ route('examinateur.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="examinateur_id" value="{{ $examinateur->id }}">
                            <input type="hidden" name="demandeur_id" value="{{ $demandeur->id }}">

                            <div class="mb-3">
                                <label class="form-label">@lang('trans.exam_date')</label>
                                <input type="date" name="date_examen" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">@lang('trans.validity')</label>
                                <input type="number" min="0" name="validite" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">@lang('trans.medical_fitness')</label>
                                <select name="aptitude" class="form-control" required>
                                    <option value="Apte">@lang('trans.fit')</option>
                                    <option value="Inapte">@lang('trans.unfit')</option>
                                </select>
                            </div>


                            <div class="mb-3">
                                <label class="form-label">@lang('trans.report')</label>
                                <textarea name="rapport" class="form-control summernote" rows="3"></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">@lang('trans.certificate')</label>
                                <input type="file" name="attestation" class="form-control" accept="application/pdf"
                                    required>
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
