@extends('layout.app')
@section('content')
    {{ Breadcrumbs::render('vehicle') }}
    @include('layout.partials.flash')
    <div class="nk-block nk-block-lg">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h5 class="nk-block-title">
                        <em class="icon ni ni-pen"></em>
                        Saisir une nouvelle réparation
                    </h5>
                </div>
            </div><!-- .nk-block-between -->
        </div>

        <div class="card shadow-sm">
            <div class="card-inner">
                <form id="form-create" action="{{ route('maintenance.repair.store', $vehicle->uuid) }}" method="post">
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
                            <div class="col-sm-4">
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
                            <div class="col-sm-4">
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
            <div class="card-footer">
                <button form="form-create" type="submit" class="btn btn-sm btn-primary float-right">
                    <em class="icon ni ni-save"></em>
                    <span>Enregister</span>
                </button>
            </div>
        </div><!-- .card-preview -->
    </div>
@stop
