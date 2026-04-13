@extends('layout.app')
@section('content')
    {{ Breadcrumbs::render('vehicle-edit', $vehicle) }}
    @include('layout.partials.flash')
    <div class="nk-block nk-block-lg">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h5 class="nk-block-title">
                        <em class="icon ni ni-pen"></em>
                        Modifier le vehicule - <strong> {{ $vehicle->registration }}</strong>
                    </h5>
                </div>
            </div><!-- .nk-block-between -->
        </div>
        <div class="card shadow-sm">
            <div class="card-inner">
                <form id="form-create" action="{{ route('fleet.vehicle.update', $vehicle->uuid) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="preview-block">
                        <div class="row gy-4">
                            <div class="col-sm-12 mb-3">
                                <div class="form-group">
                                    <div class="example-alert">
                                        <div class="alert alert-pro alert-primary bg-blue-dim alert-icon shadow-sm">
                                            <em class="icon ni ni-alert-circle"></em>
                                            <p>
                                                Veuillez saisir les informations à modifier concernant le vehicule.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Plate d'immatriculation</label>
                                    <div class="form-control-wrap">
                                        <input name="registration" type="text" class="form-control @error('registration') error @enderror" id="default-01" placeholder="Plaque d'immatriculation" value="{{ $vehicle->registration }}">
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
                                        <input name="chassis" type="text" class="form-control @error('chassis') error @enderror" id="default-01" placeholder="N° Chassis" value="{{ $vehicle->chassis }}">
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
                                        <input name="code_vehicle" type="text" class="form-control @error('code_vehicle') error @enderror" id="default-01" placeholder="Code du vehicule" value="{{ $vehicle->code_vehicle }}">
                                        @error('code_vehicle')
                                        <span class="invalid">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Marque</label>
                                    <div class="form-control-wrap ">
                                        <select name="brand_id" class="form-select" data-placeholder = "selectioner la marque">
                                            <option value="{{ $vehicle->brand_id ?? '' }}">{{ $vehicle->brand->name ?? '' }}</option>
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
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Type</label>
                                    <div class="form-control-wrap">
                                        <select name="type" class="form-select" data-placeholder = "selectioner le type">
                                            <option value="{{ $vehicle->type ?? '' }}">{{ \App\Enums\Fleet\VehicleType::getDescription($vehicle->type) }}</option>
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
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Model</label>
                                    <div class="form-control-wrap">
                                        <select name="pattern_id" class="form-select" data-placeholder = "selectioner le model">
                                            <option value="{{ $vehicle->pattern_id ?? '' }}">{{ $vehicle->pattern->name ?? '' }}</option>
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
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Carburant</label>
                                    <div class="form-control-wrap" data-placeholder = "selectioner le carburant">
                                        <select  name="fuel" class="form-select @error('fuel') error @enderror" id="default-03">
                                            <option value="{{ $vehicle->fuel }}">{{ $vehicle->fuel }}</option>
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
                                            <option value="{{ $vehicle->state ?? '' }}">{{ \App\Enums\Fleet\FleetState::getDescription($vehicle->state) }}</option>
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
                                            <option value="{{ $vehicle->usage ?? '' }}">{{ \App\Enums\Fleet\FleetUsage::getDescription($vehicle->usage)  }}</option>
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
                                        <input name="number_places" type="text" class="form-control @error('number_places') error @enderror" id="default-01" placeholder="Nombre de place" value="{{ $vehicle->number_places }}">
                                        @error('number_places')
                                        <span class="invalid">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 my-3">
                                <div class="form-group">
                                    <div class="example-alert">
                                        <div class="alert alert-pro alert-primary shadow-sm bg-blue-dim alert-icon">
                                            <em class="icon ni ni-alert-circle"></em> <strong>Information techniques</strong>
                                            <p>
                                                Veuillez saisir les informations technique concernant le vehicule.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Poids à vide</label>
                                    <div class="form-control-wrap">
                                        <div class="form-text-hint">
                                            <span class="overline-title">Tonne (T)</span>
                                        </div>
                                        <input name="empty_weight" type="text" class="form-control @error('empty_weight') error @enderror" id="default-01" placeholder="Poids à vide" value="{{ $vehicle->empty_weight }}">
                                        @error('empty_weight')
                                        <span class="invalid">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Capacité</label>
                                    <div class="form-control-wrap">
                                        <input name="capacity" type="text" class="form-control @error('capacity') error @enderror" id="default-01" placeholder="Capacité" value="{{ $vehicle->capacity }}">
                                        @error('capacity')
                                        <span class="invalid">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="form-label" for="default-02">Unité</label>
                                    <div class="form-control-wrap" data-placeholder = "selectioner l'unité">
                                        <select  name="unit" class="form-select @error('fuel') error @enderror" id="default-04">
                                            <option value="{{ $vehicle->unit }}">{{ $vehicle->unit }}</option>
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
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Kilometrage</label>
                                    <div class="form-control-wrap">
                                        <div class="form-text-hint">
                                            <span class="overline-title">Km</span>
                                        </div>
                                        <input name="mileage" type="text" class="form-control @error('mileage') error @enderror" id="default-01" placeholder="Kilometrage" value="{{ $vehicle->mileage }}">
                                        @error('mileage')
                                        <span class="invalid">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Consommation</label>
                                    <div class="form-control-wrap">
                                        <div class="form-text-hint">
                                            <span class="overline-title">L/100 km</span>
                                        </div>
                                        <input name="liters_100" type="text" class="form-control @error('liters_100') error @enderror" id="default-01" placeholder="Reservoir" value="{{ $vehicle->liters_100 }}">
                                        @error('liters_100')
                                        <span class="invalid">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Puissance</label>
                                    <div class="form-control-wrap">
                                        <div class="form-text-hint">
                                            <span class="overline-title">CH</span>
                                        </div>
                                        <input name="power" type="text" class="form-control @error('power') error @enderror" id="default-01" placeholder="La puissance" value="{{ $vehicle->power }}">
                                        @error('power')
                                        <span class="invalid">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Mise en circulation</label>
                                    <div class="form-control-wrap">
                                        <input name="commissioning_date" type="text" class="form-control date-picker @error('commissioning_date') error @enderror" id="default-01" placeholder="Date mise en circulation" data-date-format="d/m/yyyy" value="{{ $vehicle->commissioning_date ? $vehicle->commissioning_date->format('d/m/Y'): '' }}">
                                        @error('commissioning_date')
                                        <span class="invalid">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Prix d'acquisition</label>
                                    <div class="form-control-wrap">
                                        <div class="form-text-hint">
                                            <span class="overline-title">F CFA</span>
                                        </div>
                                        <input name="acquisition_amount" type="text" class="form-control @error('acquisition_amount') error @enderror" id="default-01" placeholder="Prix d'acquisition" value="{{ $vehicle->acquisition_amount }}">
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
            <div class="card-footer">
                <button form="form-create" type="submit" class="btn btn-sm btn-primary float-right">
                    <em class="icon ni ni-save"></em>
                    <span>Enregister</span>
                </button>
            </div>
        </div><!-- .card-preview -->
    </div>
@stop
