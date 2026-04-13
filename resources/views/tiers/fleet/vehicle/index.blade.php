@extends('layout.app')

@section('content')
    {{ Breadcrumbs::render('vehicle') }}
    @include('layout.partials.flash')
    <div class="nk-block nk-block-lg">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h5 class="nk-block-title">
                        <em class="icon ni ni-file-text"></em>
                        Liste des véhicules tiers
                    </h5>
                    <div class="nk-block-des text-soft">
                        <p>Ci-dessous un listing de l'ensemble des vehicules dans la base de donnée</p>
                    </div>
                </div>
                <!-- .nk-block-head-content -->
                <div class="nk-block-head-content">
                    <div class="toggle-wrap nk-block-tools-toggle">
                        <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                        <div class="toggle-expand-content" data-content="pageMenu">
                            <ul class="nk-block-tools g-3">
                                <li class="nk-block-tools-opt">
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-opt"></em></a>
                                        <div class="dropdown-menu dropdown-menu-left">
                                            <ul class="link-list-plain sm">
                                                <li>
                                                    <a href="{{ route('fleet.vehicle.printable') }}">
                                                        <em class="icon ni ni-printer"></em>
                                                        <span>Imprimer vehicules</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="nk-block-tools-opt">
                                    <a href="#" class="btn btn-sm btn-dim btn-primary" data-toggle="modal" data-target="#create-state">
                                        <em class="icon ni ni-plus"></em>
                                        <span> Ajouter véhicule tier</span>
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
                <table class="datatable-init nk-tb-list nk-tb-ulist table-responsive-sm">
                    <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col nk-tb-col-check">
                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                <input type="checkbox" class="custom-control-input" id="uid">
                                <label class="custom-control-label" for="uid"></label>
                            </div>
                        </th>
                        <th class="nk-tb-col"><span class="sub-text">N° Plaque</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Citerne</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Marque</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Chauffeur</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-left">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $vehicles as $vehicle )
                        <tr class="nk-tb-item @if($vehicle->status === \App\Enums\Fleet\VehicleStatus::Reform) table-secondary @endif">
                            <td class="nk-tb-col nk-tb-col-check">
                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                    <input type="checkbox" class="custom-control-input" id="{{ $vehicle->id }}">
                                    <label class="custom-control-label" for="{{ $vehicle->id }}"></label>
                                </div>
                            </td>
                            <td class="nk-tb-col">
                                <div class="user-card">
                                    <div class="user-info">
                                        <a href="{{ route('fleet.vehicle.show', $vehicle->uuid) }}">
                                            <span class="tb-lead">
                                            {{ $vehicle->registration }}
                                            </span>
                                        </a>

                                    </div>
                                </div>
                            </td>
                            <td class="nk-tb-col tb-col-md text-dark">
                                <span>{{ $vehicle->trailer }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md text-dark">
                                <span>{{ $vehicle->brand ? $vehicle->brand->name : '' }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md text-dark">
                                <span>{{ $vehicle->driver }}</span>
                            </td>
                            <td class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1">
                                    <li>
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-left">
                                                <ul class="link-list-plain sm">
                                                    @can('fleet modifier vehicule')
                                                        <li>
                                                            <a href="{{ route('tiers.fleet.vehicle.edit', $vehicle->uuid) }}"><em class="icon ni ni-pen"></em><span>Modifier</span>
                                                            </a>
                                                        </li>
                                                    @endcan
                                                    @can('fleet supprimer vehicule')
                                                        <li>
                                                            <a href="#"><em class="icon ni ni-trash text-danger">
                                                                </em><span class="text-danger">Supprimer</span>
                                                            </a>
                                                        </li>
                                                    @endcan
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
    <div class="modal fade" tabindex="-1" id="create-state">
        <div class="modal-dialog modal-dialog-top modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
                <div class="modal-header">
                    <h5 class="modal-title">Saisir un nouveau véhicule tier</h5>
                </div>
                <div class="modal-body">
                    <form id="form-create" action="{{ route('tiers.fleet.vehicle.tiers.store') }}" method="post">
                        @csrf
                        <div class="preview-block">
                            <input name="unit" type="text" value="0" hidden>
                            <div class="row gy-4">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Plaque d'immatriculation</label>
                                        <div class="form-control-wrap">
                                            <input name="registration" type="text" class="form-control @error('registration') error @enderror" id="default-01" placeholder="Plaque d'immatriculation" value="{{ old('registration') }}">
                                            @error('registration')
                                            <span class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Citerne</label>
                                        <div class="form-control-wrap">
                                            <input name="trailer" type="text" class="form-control @error('trailer') error @enderror" id="default-01" placeholder="La citerne" value="{{ old('trailer') }}">
                                            @error('trailer')
                                            <span class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Chauffeur</label>
                                        <div class="form-control-wrap">
                                            <input name="driver" type="text" class="form-control @error('driver') error @enderror" id="default-01" placeholder="driver" value="{{ old('driver') }}">
                                            @error('driver')
                                            <span class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Marque</label>
                                        <div class="form-control-wrap ">
                                            <select name="brand_id" class="form-select" data-placeholder = "selectioner la marque">
                                                <option></option>
                                                @foreach( $brands as $key => $value)
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                            @error('brand_id')
                                            <span class="sub-text-sm text-danger ff-italic">{{ $message }}</span>
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


