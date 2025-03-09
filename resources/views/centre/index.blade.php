@extends('examinateur.layouts.app')
@section('title')
    @lang('examinateur.dashboard')
@endsection
@section('contentheader')
    @lang('examinateur.dashboard')
@endsection
@section('contentheaderlink')
    <a href="">
        @lang('examinateur.dashboard') </a>
@endsection
@section('contentheaderactive')
    @lang('examinateur.dashboard')
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endpush
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">@lang('examinateur.demandes')</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="demandes">
                                <thead>
                                    <tr>
                                        <th>ID</th>

                                        <th>Photo</th>
                                        <th>Nom et Prenom</th>
                                        <th>Date de naissance </th>
                                        <th>Adresse</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($demandeurs as $demandeur)
                                        <tr>
                                            <td>{{ $demandeur->id }}</td>
                                            <td><img src="{{ asset('/uploads/' . $demandeur->photo) }}" width="64"
                                                    height="64" class="card-img-top img-cover" alt=""></td>
                                            <td>{{ $demandeur->np }}</td>

                                            <td>{{ $demandeur->date_naissance }}</td>
                                            <td>{{ $demandeur->adresse }}</td>
                                            <td>


                                                <a href="{{ route('centre.create', $demandeur) }}"
                                                    class="btn btn-primary btn-sm">Create</a>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        @if ($formations)
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">@lang('examinateur.formations')</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Type de formation</th>
                                            <th>Demandeur</th>

                                            <th>Centre</th>
                                            <th>Lieu</th>
                                            <th>Date</th>
                                            <th>Attestation</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($formations as $formation)
                                            <tr>
                                                <td>{{ $formation->id }}</td>
                                                <td>{{ $formation->typeFormation->nom }}</td>
                                                <td>{{ $formation->demandeur->np }}</td>
                                                <td>{{ $formation->centreFormation->libelle }}</td>
                                                <td>{{ $formation->lieu }}</td>
                                                <td>{{ $formation->date_formation }}</td>
                                                <td>
                                                    <a target="_blank"
                                                        href="{{ asset('/uploads/' . $formation->attestation) }}"
                                                        class="btn btn-primary btn-sm">
                                                        <i class="fas fa-download"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-warning btn-sm toggle-edit"
                                                        data-id="{{ $formation->id }}">
                                                        Modifier
                                                    </button>
                                                    <form action="{{ route('centre.destroy', $formation) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <!-- Formulaire caché pour modifier la formation -->
                                            <tr id="edit-form-{{ $formation->id }}" class="edit-form-row"
                                                style="display: none;">
                                                <td colspan="7">
                                                    <form action="{{ route('centre.update', $formation->id) }}"
                                                        method="POST" class="edit-form" enctype="multipart/form-data">
                                                        @csrf @method('PUT')
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label>Type de Formation </label>
                                                                <select name="type_formation_id" class="form-control">
                                                                    @foreach ($type_formations as $type)
                                                                        <option value="{{ $type->id }}"
                                                                            {{ $type->id == $formation->type_formation_id ? 'selected' : '' }}>
                                                                            {{ $type->nom }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="col-md-2">
                                                                <label>Lieu </label>
                                                                <input type="text" name="lieu" class="form-control"
                                                                    value="{{ $formation->lieu }}" required>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label>Date </label>
                                                                <input type="date" name="date_formation"
                                                                    class="form-control"
                                                                    value="{{ $formation->date_formation }}" required>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label>Attestation (PDF)</label>
                                                                <input type="file" name="attestation"
                                                                    class="form-control" accept="application/pdf" required>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <br>
                                                                <button type="submit"
                                                                    class="btn btn-success btn-sm">Enregistrer</button>
                                                                <button type="button"
                                                                    class="btn btn-secondary btn-sm cancel-edit"
                                                                    data-id="{{ $formation->id }}">
                                                                    Annuler
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
@endsection
@push('script')
    <script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
@endpush
@push('custom')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.toggle-edit').forEach(button => {
                button.addEventListener('click', function() {
                    let id = this.getAttribute('data-id');
                    let row = document.getElementById("edit-form-" + id);
                    row.style.display = row.style.display === "none" ? "table-row" : "none";
                });
            });

            document.querySelectorAll('.cancel-edit').forEach(button => {
                button.addEventListener('click', function() {
                    let id = this.getAttribute('data-id');
                    document.getElementById("edit-form-" + id).style.display = "none";
                });
            });
        });
    </script>
    <script>
        $(function() {
            $('#demandes').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "columnDefs": [{
                        "targets": 5,
                        "orderable": false
                    },
                    {
                        "targets": 3,
                        "searchable": true
                    }
                ]

            });
            $('#formations').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "columnDefs": [{
                        "targets": 5,
                        "orderable": false
                    },
                    {
                        "targets": 3,
                        "searchable": true
                    }
                ]

            });
        });
    </script>
@endpush
