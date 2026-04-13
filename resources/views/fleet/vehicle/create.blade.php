@extends('layout.app')

@section('content')
    {{ Breadcrumbs::render('vehicle-create') }}
    @include('layout.partials.flash')
    <div class="nk-block nk-block-lg">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h5 class="nk-block-title">
                        <em class="icon ni ni-pen"></em>
                        Saisir un nouveau vehicule
                    </h5>
                </div>
            </div><!-- .nk-block-between -->
        </div>
        <div class="card shadow-sm">
            <div class="card-inner">
                <form id="form-create" action="{{ route('fleet.vehicle.store') }}" method="post">
                    @csrf
                    <div class="preview-block">
                        <div class="row gy-4">
                            <div class="col-sm-12 mb-3">
                                <div class="form-group">
                                    <div class="example-alert">
                                        <div class="alert alert-pro alert-primary shadow-sm alert-icon bg-blue-dim">
                                            <em class="icon ni ni-alert-circle"></em> <strong>Détails du véhicule</strong>
                                            <p>
                                                Veuillez saisir les détails concernant le vehicule.
                                                Merci de noter que champs listés ci-dessous sont obligatoire
                                            </p>
                                            <ul>
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
                            <div class="col-sm-3">
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
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Type</label>
                                    <div class="form-control-wrap">
                                        <select name="type_id" class="form-select" data-placeholder = "selectioner le type">
                                            <option></option>
                                            @foreach( $types as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        @error('type_id')
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
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Carburant</label>
                                    <div class="form-control-wrap" data-placeholder = "selectioner le carburant">
                                        <select  name="fuel" class="form-select @error('fuel') error @enderror" id="default-03">
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
                                        <select name="state_id" class="form-select" data-placeholder = "selectioner l'etat">
                                            <option></option>
                                            @foreach( $states as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        @error('state_id')
                                        <span class="sub-text-sm text-danger ff-italic">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label">Utilisation du vehicle</label>
                                    <div class="form-control-wrap">
                                        <select name="usage_id" class="form-select" data-placeholder = "selectioner l'utilisation">
                                            <option></option>
                                            @foreach( $usages as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        @error('usage_id')
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
                            <div class="col-sm-3">
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
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Capacité</label>
                                    <div class="form-control-wrap">
                                        <div class="form-text-hint">
                                            <span class="overline-title">Tonne (T)</span>
                                        </div>
                                        <input name="capacity" type="text" class="form-control @error('capacity') error @enderror" id="default-01" placeholder="Capacité" value="{{ old('capacity') }}">
                                        @error('capacity')
                                        <span class="invalid">{{ $message }}</span>
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
                                        <input name="mileage" type="text" class="form-control @error('mileage') error @enderror" id="default-01" placeholder="Kilometrage" value="{{ old('mileage') }}">
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
                                        <input name="liters_100" type="text" class="form-control @error('liters_100') error @enderror" id="default-01" placeholder="Reservoir" value="{{ old('liters_100') }}">
                                        @error('liters_100')
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
            <div class="card-footer">
                <button form="form-create" type="submit" class="btn btn-sm btn-primary float-right">
                    <em class="icon ni ni-save"></em>
                    <span>Enregister</span>
                </button>
            </div>
        </div><!-- .card-preview -->
    </div>
@stop
