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
                <form id="form-create" action="{{ route('tiers.fleet.vehicle.update', $vehicle->uuid) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="preview-block">
                        <input name="unit" type="text" value="0" hidden>
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
                            <div class="col-sm-6">
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
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label" for="default-02">Citerne</label>
                                    <div class="form-control-wrap">
                                        <input name="trailer" type="text" class="form-control @error('trailer') error @enderror" id="default-02" placeholder="Cierne" value="{{ $vehicle->trailer }}">
                                        @error('trailer')
                                        <span class="invalid">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label" for="default-03">Chauffeur</label>
                                    <div class="form-control-wrap">
                                        <input name="driver" type="text" class="form-control @error('driver') error @enderror" id="default-03" placeholder="Chauffeur" value="{{ $vehicle->driver }}">
                                        @error('driver')
                                        <span class="invalid">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label" for="default-05">Marque</label>
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
