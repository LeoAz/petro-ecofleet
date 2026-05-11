@extends('layout.app')
@section('content')
    @include('layout.partials.flash')

    <div class="nk-block nk-block-lg">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    {{ Breadcrumbs::render('maintenance.accident') }}
                    <h5 class="nk-block-title">
                        <em class="icon ni ni-pen"></em>
                        Modifier l'accident
                    </h5>
                </div>
            </div><!-- .nk-block-between -->
        </div>

        <div class="card shadow-sm">
            <div class="card-inner">
                <form id="form-create" action="{{ route('maintenance.accident.update', $accident->uuid) }}" method="post">
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
                                                Veuillez saisir les information concernant l'accident
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Date </label>
                                    <div class="form-control-wrap">
                                        <input name="date" type="text" class="form-control date-picker @error('date') error @enderror" id="default-01" placeholder="Date" data-date-format="d/m/yyyy" value="{{ $accident->date->format('d/m/Y') }}">
                                        @error('date')
                                        <span class="invalid">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Lieu</label>
                                    <div class="form-control-wrap">
                                        <input name="place" type="text" class="form-control @error('place') error @enderror" id="default-01" placeholder="Le montant" value="{{ $accident->place }}">
                                        @error('place')
                                        <span class="invalid">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Gravité de l'accident</label>
                                    <div class="form-control-wrap">
                                        <select name="gravity" class="form-select" data-placeholder = "Gravité de l'accident">
                                            <option value="{{ $accident->gravity }}">{{ \App\Enums\Maintenance\Gravity::getDescription($accident->gravity) }}</option>
                                            @foreach( $gravities as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        @error('gravity')
                                        <span class="sub-text-sm text-danger ff-italic">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Montant</label>
                                    <div class="form-control-wrap">
                                        <input name="amount" type="text" class="form-control @error('amount') error @enderror" id="default-01" placeholder="Le montant" value="{{ $accident->amount }}">
                                        @error('amount')
                                        <span class="invalid">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Description de l'accident</label>
                                    <div class="form-control-wrap">
                                        <input name="description" type="text" class="form-control @error('description') error @enderror" id="default-01" placeholder="Description de l'accident" value="{{ $accident->description }}">
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
