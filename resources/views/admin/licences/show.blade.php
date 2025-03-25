@extends('layouts.admin')
@section('title')
    @lang('admin.dashboard')
@endsection
@section('contentheader')
    @lang('admin.dashboard')
@endsection
@section('contentheaderlink')
    <a href="{{ route('licences') }}">
        @lang('admin.dashboard') </a>
@endsection
@section('contentheaderactive')
    @lang('admin.dashboard')
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
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Profile
                    </div>
                    <div class="card-body">
                        @isset($licence)
                            <div class="row justify-content-center">

                                <div class="col-lg-9">
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <th>@lang('user.categorie_licence')</th>
                                            <td>{{ $licence->categorie_licence ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('user.machine_licence')</th>
                                            <td>{{ $licence->machine_licence ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('user.type_licence')</th>
                                            <td>{{ $licence->type_licence ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('user.numero_licence')</th>
                                            <td>{{ $licence->numero_licence ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('user.np')</th>
                                            <td>{{ $licence->np ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('user.date_naissance')</th>
                                            <td>{{ !empty($licence->date_naissance) ? date('Y-m-d', strtotime($licence->date_naissance)) : '-' }}
                                            </td>

                                        </tr>
                                        <tr>
                                            <th>@lang('user.adresse')</th>
                                            <td>{{ $licence->adresse ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('user.signature')</th>
                                            <td class="text-center">
                                                @if (isset($licence->signature) && $licence->signature != '')
                                                    <img src="{{ asset('/uploads/' . $licence->signature) }}"
                                                        alt="User Signature" class="img-thumbnail" width="120">
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>@lang('user.date_deliverance')</th>
                                            <td>{{ !empty($licence->date_deliverance) ? date('Y-m-d', strtotime($licence->date_deliverance)) : '-' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>@lang('user.date_mise_a_jour')</th>
                                            <td>{{ !empty($licence->date_mise_a_jour) ? date('Y-m-d', strtotime($licence->date_mise_a_jour)) : '-' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>@lang('user.date_expiration')</th>
                                            <td>{{ !empty($licence->date_expiration) ? date('Y-m-d', strtotime($licence->date_expiration)) : '-' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>@lang('user.cachet')</th>
                                            <td class="text-center">
                                                @if (isset($licence->cachet) && $licence->cachet != '')
                                                    <img src="{{ asset('/uploads/' . $licence->cachet) }}" alt="User Signature"
                                                        class="img-thumbnail" width="120">
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>@lang('user.signature_dg')</th>
                                            <td class="text-center">
                                                @if (isset($licence->signature_dg) && $licence->signature_dg != '')
                                                    <img src="{{ asset('/uploads/' . $licence->signature_dg) }}"
                                                        alt="User Signature" class="img-thumbnail" width="120">
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>@lang('user.signature_dsv')</th>
                                            <td class="text-center">
                                                @if (isset($licence->signature_dsv) && $licence->signature_dsv != '')
                                                    <img src="{{ asset('/uploads/' . $licence->signature_dsv) }}"
                                                        alt="User Signature" class="img-thumbnail" width="120">
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                <!-- Profile Picture -->
                                <div class="col-lg-3 text-center">
                                    <img src="{{ asset('/uploads/' . ($licence->photo ?? 'default.png')) }}"
                                        alt="Profile Picture" class="img-fluid rounded-circle"
                                        style="width: 150px; height: 150px; object-fit: cover;">
                                </div>

                            </div>
                        @endisset
                        {{-- @if ((empty($licence->date_deliverance) && empty($licence->date_expiration)) || (empty($licence->date_mise_a_jour) && empty($licence->date_expiration)))
                            <form action="{{ route('licences.update', $licence) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    @if ($licence->demande->type_demande === 'Delivrance')
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="date_deliverance">Date de delivreance</label>
                                                <input type="date" class="form-control" id="date_deliverance"
                                                    name="date_deliverance" placeholder="">
                                            </div>
                                        </div>
                                    @endif
                                    @if ($licence->demande->type_demande === 'Renouvellement')
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="date_mise_a_jour">Date de mise a jour</label>
                                                <input type="date" class="form-control" id="date_mise_a_jour"
                                                    name="date_mise_a_jour" placeholder="">
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="date_expiration">Date d'expiration</label>
                                            <input type="date" class="form-control" id="date_expiration"
                                                name="date_expiration" placeholder="">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-success float-right"><i
                                                class="fas fa-plus"></i>
                                            Ok</button>
                                    </div>
                                </div>
                            </form>
                        @endif --}}

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
