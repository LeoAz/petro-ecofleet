@extends('layout.app')
@section('content')
    @include('layout.partials.flash')

    <div class="nk-block nk-block-lg">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    {{ Breadcrumbs::render('maintenance.entretien') }}
                    <h5 class="nk-block-title">
                        <em class="icon ni ni-pen"></em>
                        Modifier les informations de la maintenance
                    </h5>
                </div>
            </div><!-- .nk-block-between -->
        </div>

        <div class="card shadow-sm">
            <div class="card-inner">
                <form id="form-create" action="{{ route('maintenance.entretien.update', $maintenance->uuid) }}" method="post">
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
                                                Veuillez saisir les information concernant la maintenance
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Date maintenance</label>
                                    <div class="form-control-wrap">
                                        <input name="date" type="text" class="form-control date-picker @error('date') error @enderror" id="default-01" placeholder="Date" data-date-format="d/m/yyyy" value="{{ $maintenance->date->format('d/m/Y') }}">
                                        @error('date')
                                        <span class="invalid">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Kilométrage</label>
                                    <div class="form-control-wrap">
                                        <input name="mileage" type="text" class="form-control @error('mileage') error @enderror" id="default-01" placeholder="Le montant" value="{{ $maintenance->mileage }}">
                                        @error('mileage')
                                        <span class="invalid">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Main d'oeuvre</label>
                                    <div class="form-control-wrap">
                                        <input name="amount" type="text" class="form-control @error('amount') error @enderror" id="default-01" placeholder="Le montant" value="{{ $maintenance->amount }}">
                                        @error('amount')
                                        <span class="invalid">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Seuil prochain entretien</label>
                                    <div class="form-control-wrap">
                                        <input name="treshold" type="text" class="form-control @error('treshold') error @enderror" id="default-01" placeholder="Le montant" value="{{ $maintenance->treshold }}">
                                        @error('treshold')
                                        <span class="invalid">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Unité</label>
                                    <div class="form-control-wrap">
                                        <select name="unit" class="form-select" data-placeholder = "selectioner l'unité">
                                            <option value="{{ $maintenance->unit }}">{{ $maintenance->unit }}</option>
                                            <option value="kilometre">Kilometre</option>
                                            <option value="mois">Mois</option>
                                        </select>
                                        @error('unit')
                                        <span class="sub-text-sm text-danger ff-italic">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Description de la maintenance</label>
                                    <div class="form-control-wrap">
                                        <input name="description" type="text" class="form-control @error('description') error @enderror" id="default-01" placeholder="Description de la panne" value="{{ $maintenance->description }}">
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
            <div class="card-footer">
                <button form="form-create" type="submit" class="btn btn-sm btn-primary float-right">
                    <em class="icon ni ni-save"></em>
                    <span>Enregister</span>
                </button>
            </div>
        </div><!-- .card-preview -->
    </div>
@stop
