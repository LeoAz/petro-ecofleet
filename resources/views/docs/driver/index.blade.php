@extends('layout.app')

@section('sidebar')
    <x-docs-menu/>
@stop

@section('content')
    {{ Breadcrumbs::render('trajet') }}
    @include('layout.partials.flash')

    <div class="nk-block nk-block-lg">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h5 class="nk-block-title">
                        <em class="icon ni ni-list"></em>
                        Liste des chauffeurs possédant des documents
                    </h5>
                    <div class="nk-block-des text-soft">
                        <p>Ci-dessous un listing de l'ensemble des chauffeurs possédant des documents dans la base de donnée</p>
                    </div>
                </div>
                <!-- .nk-block-head-content -->
                <div class="nk-block-head-content">
                    <div class="toggle-wrap nk-block-tools-toggle">
                        <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                        <div class="toggle-expand-content" data-content="pageMenu">
                            <ul class="nk-block-tools g-3">
                                <li class="nk-block-tools-opt">
                                    <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#create-user">
                                        <em class="icon ni ni-plus"></em>
                                        <span> Ajouter un document</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div><!-- .toggle-wrap -->
                </div><!-- .nk-block-head-content -->
            </div><!-- .nk-block-between -->
        </div>
        <div class="card">
            <div class="card-inner">
                <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                    <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col nk-tb-col-check">
                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                <input type="checkbox" class="custom-control-input" id="uid">
                                <label class="custom-control-label" for="uid"></label>
                            </div>
                        </th>
                        <th class="nk-tb-col"><span class="sub-text">Nom</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Matricule</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Nombre document</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Docs active</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Docs expiré</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-right">
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $drivers as $driver )
                        <tr class="nk-tb-item">
                            <td class="nk-tb-col nk-tb-col-check">
                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                    <input type="checkbox" class="custom-control-input" id="{{ $driver->id }}">
                                    <label class="custom-control-label" for="{{ $driver->id }}"></label>
                                </div>
                            </td>
                            <td class="nk-tb-col">
                                <div class="user-card">
                                    <div class="user-info">
                                        <span class="tb-lead">{{ $driver->name }} <span class="dot dot-success d-md-none ml-1"></span></span>
                                    </div>
                                </div>
                            </td>
                            <td class="nk-tb-col tb-col-md text-dark">
                                <span>{{ $driver->matricule }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span class="badge badge-pill badge-dim badge-primary">{{ $driver->documents->count() }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span class="badge badge-pill badge-dim badge-success">
                                    {{ $driver->documents->where('status', \App\Enums\Fleet\DocumentStatus::Active)->count() }}
                                </span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span class="badge badge-pill badge-dim badge-danger">
                                     {{ $driver->documents->where('status', \App\Enums\Fleet\DocumentStatus::Expired)->count() }}
                                </span>
                            </td>
                            <td class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1">
                                    <li>
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <ul class="link-list-opt no-bdr">
                                                    <li>
                                                        <a href="{{ route('docs.driver.document', $driver->uuid) }}">
                                                            <em class="icon ni ni-files"></em><span>Voir Documents</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </td>
                        </tr><!-- .nk-tb-item  -->
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div><!-- .card-preview -->
    </div>
    <div class="modal fade" id="create-user">
        <div class="modal-dialog modal-dialog-top modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
                <div class="modal-header">
                    <h5 class="modal-title">Saisir un document</h5>
                </div>
                <div class="modal-body">
                    <form id="form-create" action="{{ route('docs.driver.store') }}" method="post">
                        @csrf
                        <div class="preview-block">
                            <div class="row gy-4">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Nom du document</label>
                                        <div class="form-control-wrap">
                                            <input name="label" type="text" class="form-control @error('label') error @enderror" id="default-01" placeholder="Nom du document">
                                            @error('label')
                                            <span class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label">Type</label>
                                        <div class="form-control-wrap">
                                            <select name="type" class="form-select" data-placeholder="Type de document">
                                                <option value="Carte grise">carte grise</option>
                                                <option value="Assurance">Assurance</option>
                                                <option value="Carte de transport">Carte de transport</option>
                                                <option value="Autre document">Autre document</option>
                                            </select>
                                            @error('type')
                                            <span class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Fournisseur</label>
                                        <div class="form-control-wrap">
                                            <input name="provider" type="text" class="form-control @error('provider') error @enderror" id="default-01" placeholder="Le fournisseur du document">
                                            @error('provider')
                                            <span class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-03">Le montant</label>
                                        <div class="form-control-wrap">
                                            <input name="amount" type="text" class="form-control @error('amount') error @enderror" id="default-03" placeholder="amount">
                                            @error('amount')
                                            <span class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-03">Véhicule</label>
                                        <div class="form-control-wrap">
                                            <select name="vehicle_id" class="form-select js-select2" data-search="on" data-placeholder = "selectioner le vehicule">
                                                <option></option>
                                                @foreach( $drivs as $key => $value)
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                            @error('vehicle_id')
                                            <span class="sub-text-sm text-danger ff-italic">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-07">Date de delivrance</label>
                                        <div class="form-control-wrap">
                                            <input name="delivery_date" type="text" class="form-control date-picker @error('delivery_date') error @enderror" id="default-01" placeholder="Date de delivrance" data-date-format="d/m/yyyy" value="{{ old('delivery_date') }}">
                                            @error('delivery_date')
                                            <span class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-06">Date d'expiration</label>
                                        <div class="form-control-wrap">
                                            <input name="exp_date" type="text" class="form-control date-picker @error('exp_date') error @enderror" id="default-01" placeholder="Date d'expiration" data-date-format="d/m/yyyy" value="{{ old('exp_date') }}">
                                            @error('exp_date')
                                            <span class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <button class="btn btn-sm btn-secondary float-right" data-dismiss="modal">
                        <em class="icon ni ni-cross-circle"></em>
                        <span>Fermer</span>
                    </button>
                    <button form="form-create" type="submit" class="btn btn-sm btn-primary float-right">
                        <em class="icon ni ni-save"></em>
                        <span>Enregister</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
