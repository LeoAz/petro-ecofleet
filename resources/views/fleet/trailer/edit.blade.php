@extends('layout.app')
@section('content')
    {{ Breadcrumbs::render('trailer-edit', $trailer) }}
    @include('layout.partials.flash')
    <div class="nk-block nk-block-lg">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h5 class="nk-block-title">
                        <em class="icon ni ni-pen"></em>
                        Modifier la remorque - <strong> {{ $trailer->registration }}</strong>
                    </h5>
                </div>
            </div><!-- .nk-block-between -->
        </div>
        <div class="card shadow-sm">
            <div class="card-inner">
                <form id="form-create" action="{{ route('fleet.trailer.update', $trailer->uuid) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="preview-block">
                        <div class="row gy-4">
                            <div class="col-sm-12 mb-3">
                                <div class="form-group">
                                    <div class="example-alert">
                                        <div class="alert alert-pro alert-primary shadow-sm alert-icon bg-blue-dim">
                                            <em class="icon ni ni-alert-circle"></em>
                                            <p>
                                                Veuillez saisir les détails concernant la remorque.
                                                Merci de noter que champs listés ci-dessous sont obligatoire:
                                            </p>
                                            <ul class="list-inline">
                                                <li>
                                                    <em class="icon ni ni-check-circle"></em>
                                                    Plaque d'immatriculation
                                                </li>
                                                <li>
                                                    <em class="icon ni ni-check-circle"></em>
                                                    Marque de la remorque
                                                </li>
                                                <li>
                                                    <em class="icon ni ni-check-circle"></em>
                                                    Type de la remorque
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
                                        <input name="registration" type="text" class="form-control @error('registration') error @enderror" id="default-01" placeholder="Plaque d'immatriculation" value="{{ $trailer->registration }}">
                                        @error('registration')
                                        <span class="invalid">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Code de la remorque</label>
                                    <div class="form-control-wrap">
                                        <input name="code_trailer" type="text" class="form-control @error('code_trailer') error @enderror" id="default-01" placeholder="Le code" value="{{ $trailer->code_trailer }}">
                                        @error('code_trailer')
                                        <span class="invalid">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Capacité</label>
                                    <div class="form-control-wrap">
                                        <input name="capacity" type="text" class="form-control @error('capacity') error @enderror" id="default-01" placeholder="Code du vehicule" value="{{ $trailer->capacity }}">
                                        @error('capacity')
                                        <span class="invalid">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">La marque</label>
                                    <div class="form-control-wrap ">
                                        <select name="brand_id" class="form-select" data-placeholder = "selectioner la marque">
                                            <option value="{{ $trailer->brand_id ?? '' }}">{{ $trailer->brand->name ?? '' }}</option>
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
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Type</label>
                                    <div class="form-control-wrap">
                                        <select name="type" class="form-select" data-placeholder = "selectioner le type">
                                            <option value="{{ $trailer->type ?? '' }}">{{ \App\Enums\Fleet\VehicleType::getDescription($trailer->type) }}</option>
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
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label">Etat de la remorque</label>
                                    <div class="form-control-wrap">
                                        <select name="state" class="form-select" data-placeholder = "selectioner l'etat">
                                            <option value="{{ $trailer->state ?? '' }}">{{ \App\Enums\Fleet\FleetState::getDescription($trailer->state) }}</option>
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
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Le model</label>
                                    <div class="form-control-wrap ">
                                        <select name="pattern_id" class="form-select" data-placeholder = "selectioner le model">
                                            <option value="{{ $trailer->pattern_id ?? '' }}">{{ $trailer->pattern->name ?? '' }}</option>
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
                                    <label class="form-label">Utilisation de la remorque</label>
                                    <div class="form-control-wrap">
                                        <select name="usage" class="form-select" data-placeholder = "selectioner l'utilisation">
                                            <option value="{{ $trailer->usage ?? '' }}">{{ \App\Enums\Fleet\FleetUsage::getDescription($trailer->usage) }}</option>
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
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Prix d'acquisition</label>
                                    <div class="form-control-wrap">
                                        <input name="acquisition_amount" type="text" class="form-control @error('acquisition_amount') error @enderror" id="default-01" placeholder="Prix d'acquisition" value="{{ $trailer->acquisition_amount }}">
                                        @error('acquisition_amount')
                                        <span class="invalid">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Mise en circulation</label>
                                    <div class="form-control-wrap">
                                        <input name="commissioning_date" type="text" class="form-control date-picker @error('commissioning_date') error @enderror" id="default-01" placeholder="Date mise en circulation" data-date-format="d/m/yyyy" value="{{ $trailer->commissioning_date ? $trailer->commissioning_date->format('d/m/Y') : '' }}">
                                        @error('commissioning_date')
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
