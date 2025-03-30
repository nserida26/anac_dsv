@extends('dir.layouts.app')
@section('title')
    @lang('trans.dashboard_dir')
@endsection
@section('contentheader')
    @lang('trans.dashboard_dir')
@endsection
@section('contentheaderlink')
    @if (auth()->user()->hasRole('dsv'))
        <a href="{{ route('dsv') }}">
            @lang('trans.dashboard_dir') </a>
    @endif
    @if (auth()->user()->hasRole('dg'))
        <a href="{{ route('dg') }}">
            @lang('trans.dashboard_dir') </a>
    @endif
@endsection
@section('contentheaderactive')
    @lang('trans.dashboard_dir')
@endsection
@push('css')
@endpush
@section('content')
    <div class="row">
        <!-- Bloc "profile" -->
        @if (isset($signature) && isset($cachet))
            <div class="col-lg-12 order-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-12">

                                <div class="mt-4">
                                    <h6 class="heading-small text-muted mb-4">User Profile Information</h6>
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <th>@lang('trans.signature')</th>
                                            <td>
                                                @if (isset($signature->signature))
                                                    <img src="{{ asset('/uploads/' . $signature->signature) }}"
                                                        alt="User Signature" width="100">
                                                @else
                                                    -
                                                @endif
                                            </td>

                                        </tr>
                                        <tr>
                                            <th>@lang('trans.stamp')</th>
                                            <td>
                                                @if (isset($cachet->cachet))
                                                    <img src="{{ asset('/uploads/' . $cachet->cachet) }}" alt="User cachet"
                                                        width="100">
                                                @else
                                                    -
                                                @endif
                                            </td>

                                        </tr>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- Bloc pour le formulaire "My Account" -->
        @if (!isset($signature) || !isset($cachet))
            <div class="col-lg-12 order-lg-1">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">@lang('trans.signature') + @lang('trans.stamp')</h6>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('dir.store') }}" autocomplete="off"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="signature">@lang('trans.signature')</label>
                                            <input type="file" class="form-control" id="signature" name="signature"
                                                accept="image/*" onchange="previewSignature(event)">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="cachet">@lang('trans.stamp')</label>
                                            <input type="file" class="form-control" id="cachet" name="cachet"
                                                accept="image/*" onchange="previewCachet(event)">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-lg-4">
                                        <img id="signaturePreview" src="" alt="Signature Preview"
                                            style="display: none; max-width: 100%; height: auto; border: 1px solid #ddd; padding: 5px;">
                                    </div>
                                    <div class="col-lg-4">
                                        <img id="cachetPreview" src="" alt="Cachet Preview"
                                            style="display: none; max-width: 100%; height: auto; border: 1px solid #ddd; padding: 5px;">
                                    </div>
                                </div>
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col text-center">
                                            <button type="submit" class="btn btn-primary float-right">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection


@push('script')
    <script>
        function previewSignature(event) {
            const input = event.target;
            const preview = document.getElementById('signaturePreview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function previewCachet(event) {
            const input = event.target;
            const preview = document.getElementById('cachetPreview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
@push('custom')
@endpush
