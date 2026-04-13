@extends('layout.app')

@section('content')
    {{ Breadcrumbs::render('vehicle') }}
    @include('layout.partials.flash')
    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-xxl-3 col-sm-4">
                <a href="{{ route('fleet.vehicle.state.available') }}">
                    <div class="card">
                        <div class="card-inner">
                            <div class="card-title-group align-start mb-2">
                                <div class="card-title">
                                    <h6 class="title">Véhicule disponible</h6>
                                </div>
                            </div>
                            <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                <div class="nk-sale-data">
                                <span class="amount">
                                    <em class="text-teal icon icon-circle-xxl ni ni-check-circle-fill mr-5"></em>
                                    {{ $available }}
                                </span>

                                </div>
                            </div>
                        </div>
                    </div><!-- .card -->
                </a>
            </div>
            <div class="col-xxl-3 col-sm-4">
                <a href="{{ route('fleet.vehicle.state.travel') }}">
                    <div class="card">
                        <div class="card-inner">
                            <div class="card-title-group align-start mb-2">
                                <div class="card-title">
                                    <h6 class="title">Véhicule en voyage</h6>
                                </div>
                            </div>
                            <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                <div class="nk-sale-data">
                                <span class="amount">
                                    <em class="text-primary icon icon-circle-xxl ni ni-map-pin-fill mr-5"></em>
                                    {{ $travel}}
                                </span>
                                </div>
                            </div>
                        </div>
                    </div><!-- .card -->
                </a>
            </div>
            <div class="col-xxl-3 col-sm-4">
                <a href="{{ route('fleet.vehicle.state.garage') }}">
                    <div class="card">
                    <div class="card-inner">
                        <div class="card-title-group align-start mb-2">
                            <div class="card-title">
                                <h6 class="title">Véhicule au garage</h6>
                            </div>
                        </div>
                        <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                            <div class="nk-sale-data">
                                <span class="amount">
                                    <em class="text-warning icon icon-circle-xxl ni ni-home-fill mr-5"></em>
                                    {{ $garage }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div><!-- .card -->
                </a>
            </div>
            <div class="col-xxl-3 col-sm-4">
                <a href="{{ route('fleet.vehicle.state.reform') }}">
                    <div class="card">
                        <div class="card-inner">
                            <div class="card-title-group align-start mb-3">
                                <div class="card-title">
                                    <h6 class="title">Véhicule en reforme</h6>
                                </div>
                            </div>
                            <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                <div class="nk-sale-data">
                                <span class="amount">
                                    <em class="text-danger icon icon-circle-xxl ni ni-signout mr-5"></em>
                                    {{ $reform }}
                                </span>
                                </div>
                            </div>
                        </div>
                    </div><!-- .card -->
                </a>
            </div>
        </div>
    </div>
    <div class="nk-block nk-block-lg">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h5 class="nk-block-title">
                        <em class="icon ni ni-file-text"></em>
                        Details sur le parc
                    </h5>
                    <div class="nk-block-des text-soft">
                        <p>Ci-dessous la situation synthétisée du nombre des véhicule attélé, disponible ayant un chauffeur ou sans chauffeur</p>
                    </div>
                </div>
            </div><!-- .nk-block-between -->
        </div>
        <div class="row g-gs">
            <div class="col-xxl-3 col-sm-4">
                <a href="{{ route('fleet.vehicle.state.unlinked-tractor') }}">
                    <div class="card">
                        <div class="card-inner">
                            <div class="card-title-group align-start mb-2">
                                <div class="card-title">
                                    <h6 class="title">Tracteur disponible non attelé</h6>
                                </div>
                            </div>
                            <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                <div class="nk-sale-data">
                                <span class="amount">
                                    <em class="text-danger icon icon-circle-xxl ni ni-unlink-alt mr-5"></em>
                                    {{ $vehicle_unlinked }}
                                </span>
                                </div>
                            </div>
                        </div>
                    </div><!-- .card -->
                </a>
            </div>
            <div class="col-xxl-3 col-sm-4">
                <a href="{{ route('fleet.vehicle.state.linked-tractor') }}">
                    <div class="card">
                        <div class="card-inner">
                            <div class="card-title-group align-start mb-2">
                                <div class="card-title">
                                    <h6 class="title">Tracteur attelé</h6>
                                </div>
                            </div>
                            <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                <div class="nk-sale-data">
                                <span class="amount">
                                    <em class="text-teal icon icon-circle-xxl ni ni-unlink mr-5"></em>
                                    {{ $vehicle_linked}}
                                </span>
                                </div>
                            </div>
                        </div>
                    </div><!-- .card -->
                </a>
            </div>
            <div class="col-xxl-3 col-sm-4">
                <a href="{{ route('fleet.vehicle.state.has-driver') }}">
                    <div class="card">
                        <div class="card-inner">
                            <div class="card-title-group align-start mb-2">
                                <div class="card-title">
                                    <h6 class="title">Véhicule avec chauffeur</h6>
                                </div>
                            </div>
                            <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                <div class="nk-sale-data">
                                <span class="amount">
                                    <em class="text-teal icon icon-circle-xxl ni ni-user-check-fill mr-5"></em>
                                    {{ $vehicle_with_driver}}
                                </span>
                                </div>
                            </div>
                        </div>
                    </div><!-- .card -->
                </a>
            </div>
            <div class="col-xxl-3 col-sm-4">
                <a href="{{ route('fleet.vehicle.state.without-driver') }}">
                    <div class="card">
                        <div class="card-inner">
                            <div class="card-title-group align-start mb-2">
                                <div class="card-title">
                                    <h6 class="title">Véhicule sans chauffeur</h6>
                                </div>
                            </div>
                            <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                <div class="nk-sale-data">
                                <span class="amount">
                                    <em class="text-danger icon icon-circle-xxl ni ni-user-cross-fill mr-5"></em>
                                    {{ $vehicle_without_driver }}
                                </span>
                                </div>
                            </div>
                        </div>
                    </div><!-- .card -->
                </a>
            </div>
        </div>
    </div>
    <div class="nk-block nk-block-lg">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h5 class="nk-block-title">
                        <em class="icon ni ni-file-text"></em>
                        Liste des véhicules
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
                                                    <li>
                                                        <a href="#">
                                                            <em class="icon ni ni-file-xls"></em>
                                                            <span>Exporter en excel</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="nk-block-tools-opt">
                                            <a href="#" class="btn btn-sm btn-dim btn-primary" data-toggle="modal" data-target="#create-state">
                                                <em class="icon ni ni-plus"></em>
                                                <span> Ajouter véhicule</span>
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
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Chassis</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Marque</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Model</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Type</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Attelé</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Status</span></th>
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
                                <span>{{ $vehicle->chassis }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md text-dark">
                                <span>{{ $vehicle->brand ? $vehicle->brand->name : '' }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md text-dark">
                                <span>{{ $vehicle->pattern ? $vehicle->pattern->name : ''}}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md text-dark">
                                {{ \App\Enums\Fleet\VehicleType::getDescription($vehicle->type) }}
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                @if( $vehicle->is_linked )
                                <span>
                                    <em class="icon ni ni-check-circle-fill text-success fs-22px"></em>
                                </span>
                                @else
                                <span>
                                    <em class="icon ni ni-cross-circle-fill text-danger fs-22px"></em>
                                </span>
                                @endif
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                @include('layout.partials.enum.Fleet.vehicleStatus', ['status' => $vehicle->status])
                            </td>
                            <td class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1">
                                    <li>
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-left">
                                                <ul class="link-list-plain sm">
                                                    <li>
                                                        <a href="{{ route('fleet.vehicle.show', $vehicle->uuid) }}"><em class="icon ni ni-file-text"></em><span>Details</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('fleet.vehicle.edit', $vehicle->uuid) }}"><em class="icon ni ni-pen"></em><span>Modifier</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('maintenance.garage.create', $vehicle->uuid) }}"><em class="icon ni ni-home"></em><span>Mettre au garage</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('maintenance.accident.create', $vehicle->uuid) }}">
                                                            <em class="icon ni ni-hot"></em>
                                                            <span>Declarer accident</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('maintenance.reform.create', $vehicle->uuid) }}"><em class="icon ni ni-arrow-from-right"></em><span>Mettre en reforme</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#"><em class="icon ni ni-trash text-danger">
                                                            </em><span class="text-danger">Supprimer</span>
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
    <div class="modal fade" tabindex="-1" id="create-state">
        <div class="modal-dialog modal-dialog-top modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
                <div class="modal-header">
                    <h5 class="modal-title">Saisir un nouveau véhicule</h5>
                </div>
                <div class="modal-body">
                    <form id="form-create" action="{{ route('fleet.vehicle.store') }}" method="post">
                        @csrf
                        <div class="preview-block">
                            <div class="row gy-4">
                                <div class="col-sm-12 mb-3">
                                    <div class="form-group">
                                        <div class="example-alert">
                                            <div class="alert alert-pro alert-primary shadow-sm alert-icon bg-blue-dim">
                                                <em class="icon ni ni-alert-circle"></em>
                                                <strong>Détails du véhicule</strong>
                                                <p>
                                                    Veuillez saisir les détails concernant le vehicule.
                                                    Merci de noter que champs listés ci-dessous sont obligatoire
                                                </p>
                                                <ul class="list-inline">
                                                    <li>
                                                        <em class="icon ni ni-check-circle"></em>
                                                        Plaque d'immatriculation
                                                    </li>
                                                    <li>
                                                        <em class="icon ni ni-check-circle"></em>
                                                        Marque du vehicucle
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
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
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Chassis du vehicle</label>
                                        <div class="form-control-wrap">
                                            <input name="chassis" type="text" class="form-control @error('chassis') error @enderror" id="default-01" placeholder="N° Chassis" value="{{ old('chassis') }}">
                                            @error('chassis')
                                            <span class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Code du vehicule</label>
                                        <div class="form-control-wrap">
                                            <input name="code_vehicle" type="text" class="form-control @error('code_vehicle') error @enderror" id="default-01" placeholder="Code du vehicule" value="{{ old('code_vehicle') }}">
                                            @error('code_vehicle')
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
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Type</label>
                                        <div class="form-control-wrap">
                                            <select name="type" class="form-select" data-placeholder = "selectioner le type">
                                                <option></option>
                                                @foreach( $types as $key => $value)
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                            @error('type')
                                            <span class="sub-text-sm text-danger ff-italic">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Model</label>
                                        <div class="form-control-wrap">
                                            <select name="pattern_id" class="form-select" data-placeholder = "selectioner le model">
                                                <option></option>
                                                @foreach( $patterns as $key => $value)
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                            @error('pattern_id')
                                            <span class="sub-text-sm text-danger ff-italic">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-02">Carburant</label>
                                        <div class="form-control-wrap" data-placeholder = "selectioner le carburant">
                                            <select  name="fuel" class="form-select @error('fuel') error @enderror" id="default-04">
                                                <option value="Diesel">Diesel</option>
                                                <option value="Essence">Essence</option>
                                                <option value="Autre">Autre</option>
                                            </select>
                                            @error('fuel')
                                            <span class="sub-text-sm text-danger ff-italic">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="form-label">Etat du vehicule</label>
                                        <div class="form-control-wrap">
                                            <select name="state" class="form-select" data-placeholder = "selectioner l'etat">
                                                <option></option>
                                                @foreach( $states as $key => $value)
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                            @error('state')
                                            <span class="sub-text-sm text-danger ff-italic">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="form-label">Utilisation du vehicle</label>
                                        <div class="form-control-wrap">
                                            <select name="usage" class="form-select" data-placeholder = "selectioner l'utilisation">
                                                <option></option>
                                                @foreach( $usages as $key => $value)
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                            @error('usage')
                                            <span class="sub-text-sm text-danger ff-italic">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Nombre de place</label>
                                        <div class="form-control-wrap">
                                            <input name="number_places" type="text" class="form-control @error('number_places') error @enderror" id="default-01" placeholder="Nombre de place" value="{{ old('number_places') }}">
                                            @error('number_places')
                                            <span class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 my-3">
                                    <div class="form-group">
                                        <div class="example-alert">
                                            <div class="alert alert-pro alert-primary alert-icon bg-blue-dim shadow-sm">
                                                <em class="icon ni ni-alert-circle"></em> <strong>Information techniques</strong>
                                                <p>
                                                    Veuillez saisir les informations technique concernant le vehicule.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Poids à vide</label>
                                        <div class="form-control-wrap">
                                            <div class="form-text-hint">
                                                <span class="overline-title">Tonne (T)</span>
                                            </div>
                                            <input name="empty_weight" type="text" class="form-control @error('empty_weight') error @enderror" id="default-01" placeholder="Poids à vide" value="{{ old('empty_weight') }}">
                                            @error('empty_weight')
                                            <span class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Capacité</label>
                                        <div class="form-control-wrap">
                                            <input name="capacity" type="text" class="form-control @error('capacity') error @enderror" id="default-01" placeholder="Capacité" value="{{ old('capacity') }}">
                                            @error('capacity')
                                            <span class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Unité</label>
                                        <div class="form-control-wrap" data-placeholder = "selectioner l'unité">
                                            <select  name="unit" class="form-select @error('unit') error @enderror" id="default-03">
                                                <option value="litres">Litres</option>
                                                <option value="tonnes">Tonnes</option>
                                                <option value="kilogramme">Kilogrammes</option>
                                            </select>
                                            @error('fuel')
                                            <span class="sub-text-sm text-danger ff-italic">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Kilometrage</label>
                                        <div class="form-control-wrap">
                                            <div class="form-text-hint">
                                                <span class="overline-title">Km</span>
                                            </div>
                                            <input name="mileage" type="text" class="form-control @error('mileage') error @enderror" id="default-01" placeholder="Kilometrage" value="{{ old('mileage') }}">
                                            @error('mileage')
                                            <span class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Consommation</label>
                                        <div class="form-control-wrap">
                                            <div class="form-text-hint">
                                                <span class="overline-title">L/100 km</span>
                                            </div>
                                            <input name="consumption" type="text" class="form-control @error('consumption') error @enderror" id="default-01" placeholder="Consommation" value="{{ old('consumption') }}">
                                            @error('consumption')
                                            <span class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Puissance</label>
                                        <div class="form-control-wrap">
                                            <div class="form-text-hint">
                                                <span class="overline-title">CH</span>
                                            </div>
                                            <input name="power" type="text" class="form-control @error('power') error @enderror" id="default-01" placeholder="La puissance" value="{{ old('power') }}">
                                            @error('power')
                                            <span class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Mise en circulation</label>
                                        <div class="form-control-wrap">
                                            <input name="commissioning_date" type="text" class="form-control date-picker @error('commissioning_date') error @enderror" id="default-01" placeholder="Date mise en circulation" data-date-format="d/m/yyyy" value="{{ old('commissioning_date') }}">
                                            @error('commissioning_date')
                                            <span class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Prix d'acquisition</label>
                                        <div class="form-control-wrap">
                                            <div class="form-text-hint">
                                                <span class="overline-title">F CFA</span>
                                            </div>
                                            <input name="acquisition_amount" type="text" class="form-control @error('acquisition_amount') error @enderror" id="default-01" placeholder="Prix d'acquisition" value="{{ old('acquisition_amount') }}">
                                            @error('acquisition_amount')
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


