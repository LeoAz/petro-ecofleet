@extends('layout.app')
@section('content')
    {{ Breadcrumbs::render('driver') }}
    @include('layout.partials.flash')
    <div class="nk-block nk-block-lg">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h5 class="nk-block-title">
                        <em class="icon ni ni-file-text"></em>
                        Liste des réparations
                    </h5>
                    <div class="nk-block-des text-soft">
                        <p>Ci-dessous un listing de l'ensemble des réparations disponible dans la base de donnée</p>
                    </div>
                </div>
                <div class="nk-block-head-content">
                    <div class="toggle-wrap nk-block-tools-toggle">
                        <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                        <div class="toggle-expand-content" data-content="pageMenu">
                            <ul class="nk-block-tools g-3">
                                <li class="nk-block-tools-opt">
                                    <a href="#" class="btn btn-sm btn-dim btn-primary" data-toggle="modal" data-target="#create-state">
                                        <em class="icon ni ni-plus"></em>
                                        <span> Ajouter une reparation </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div><!-- .toggle-wrap -->
                </div><!-- .nk-block-head-content -->
            </div><!-- .nk-block-between -->
        </div>
        <div class="card shadow-sm">
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
                        <th class="nk-tb-col"><span class="sub-text">N° Réparation</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Date</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Véhicule</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Kilometrage</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Motif</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Montant</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Montant Total</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-right">
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $repairs as $repair )
                        <tr class="nk-tb-item">
                            <td class="nk-tb-col nk-tb-col-check">
                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                    <input type="checkbox" class="custom-control-input" id="{{ $repair->id }}">
                                    <label class="custom-control-label" for="{{ $repair->id }}"></label>
                                </div>
                            </td>
                            <td class="nk-tb-col">
                                <div class="user-card">
                                    <div class="user-info">
                                        <span class="tb-lead">
                                            <a href="#">{{ $repair->code }}</a>
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span> {{ $repair->date->format('d/m/Y') }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span> {{ $repair->vehicle->registration ?? '-' }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span> {{ $repair->current_mileage ?? '-' }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span> {{ $repair->motif->description ?? '-' }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                {{ number_format($repair->amount, 0,',', ' ') }}
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                {{ number_format($repair->total_amount, 0, ' ', ' ') }}
                            </td>
                            <td class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1">
                                    <li>
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-left">
                                                <ul class="link-list-plain sm">
                                                    <li>
                                                        <a href="{{ route('maintenance.repair.detail', $repair->uuid) }}">
                                                            <em class="icon ni ni-file-text"></em>
                                                            <span>Details</span>
                                                        </a></li>
                                                    <li>
                                                        <a href="#" target="_blank">
                                                            <em class="icon ni ni-printer-fill"></em>
                                                            <span>Imprimer</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#"
                                                           onclick="event.preventDefault();
                                                               document.getElementById('repair-delete-form{{ $repair->id }}').submit();"
                                                        >
                                                            <em class="icon ni ni-cross-circle text-danger"></em>
                                                            <span class="text-danger">Supprimer</span>
                                                        </a>
                                                        <form id="repair-delete-form{{ $repair->id }}"
                                                              action="{{ route('maintenance.repair.delete', $repair->uuid) }}" method="post" style="display: none;"
                                                        >
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
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

    <div class="modal fade" id="create-state">
        <div class="modal-dialog modal-dialog-top modal-xl" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
                <div class="modal-header">
                    <h5 class="modal-title">Saisir une nouvelle réparation</h5>
                </div>
                <div class="modal-body">
                    <form id="form-create" action="{{ route('maintenance.repair.store') }}" method="post">
                        @csrf
                        <div class="preview-block">
                            <div class="row gy-4">
                                <div class="col-sm-12 mb-3">
                                    <div class="form-group">
                                        <div class="example-alert">
                                            <div class="alert alert-pro alert-primary bg-blue-dim alert-icon shadow-sm">
                                                <em class="icon ni ni-alert-circle"></em>
                                                <p>
                                                    Veuillez saisir les information concernant la reparation
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Date réparation</label>
                                        <div class="form-control-wrap">
                                            <input name="date" type="text" class="form-control date-picker @error('date') error @enderror" id="default-01" placeholder="Date" data-date-format="d/m/yyyy" value="{{ old('date')}}">
                                            @error('date')
                                            <span class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Montant réparation</label>
                                        <div class="form-control-wrap">
                                            <input name="amount" type="text" class="form-control @error('amount') error @enderror" id="default-01" placeholder="Le montant" value="{{ old('amount') }}">
                                            @error('amount')
                                            <span class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Le vehicule</label>
                                        <div class="form-control-wrap">
                                            <select name="vehicle_id" class="form-select" data-placeholder = "selectioner le vehicle" data-search="on">
                                                <option></option>
                                                @foreach( $vehicles as $key => $value)
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                            @error('vehicle_id')
                                            <span class="sub-text-sm text-danger ff-italic">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Kilométrage courant</label>
                                        <div class="form-control-wrap">
                                            <input name="current_mileage" type="text" class="form-control @error('current_mileage') error @enderror" id="default-01" placeholder="Kilométrage courant" value="{{ old('current_mileage') }}">
                                            @error('current_mileage')
                                            <span class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Motif de la réparation</label>
                                        <div class="form-control-wrap">
                                            <select name="motif_id" class="form-select" data-placeholder = "selectioner le motif">
                                                <option></option>
                                                @foreach( $motifs as $key => $value)
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                            @error('motif_id')
                                            <span class="sub-text-sm text-danger ff-italic">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Description de la reparation</label>
                                        <div class="form-control-wrap">
                                            <input name="description" type="text" class="form-control @error('description') error @enderror" id="default-01" placeholder="Description de la panne" value="{{ old('description') }}">
                                            @error('description')
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
@stop
