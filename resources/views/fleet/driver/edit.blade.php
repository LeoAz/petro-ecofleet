@extends('layout.app')
@section('content')
    {{ Breadcrumbs::render('driver-edit', $driver) }}
    @include('layout.partials.flash')
    <div class="nk-block nk-block-lg">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h5 class="nk-block-title">
                        <em class="icon ni ni-pen"></em>
                        Modifier le chauffeur - <strong> {{ $driver->name }}</strong>
                    </h5>
                </div>
            </div><!-- .nk-block-between -->
        </div>
        <div class="card shadow-sm">
            <div class="card-inner">
                <form id="form-create" action="{{ route('fleet.driver.update', $driver->uuid) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="preview-block">
                        <div class="row gy-4">
                            <div class="col-sm-12 mb-3">
                                <div class="form-group">
                                    <div class="example-alert">
                                        <div class="alert alert-pro alert-primary shadow-sm alert-icon bg-blue-dim">
                                            <p>
                                                Veuillez saisir les détails concernant le chauffeur.
                                                Merci de noter que champs listés ci-dessous sont obligatoire
                                            </p>
                                            <ul class="list-inline">
                                                <li>
                                                    <em class="icon ni ni-check-circle"></em>
                                                    Nom du chauffeur
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Nom du chauffeur</label>
                                    <div class="form-control-wrap">
                                        <input name="name" type="text" class="form-control @error('name') error @enderror" id="default-01" placeholder="Nom du chauffeur" value="{{ $driver->name}}">
                                        @error('name')
                                        <span class="invalid">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">matricule</label>
                                    <div class="form-control-wrap">
                                        <input name="matricule" type="text" class="form-control @error('matricule') error @enderror" id="default-01" placeholder="N° Matricule" value="{{ $driver->matricule }}">
                                        @error('matricule')
                                        <span class="invalid">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Date de naissance</label>
                                    <div class="form-control-wrap">
                                        <input name="birth_date" type="text" class="form-control date-picker @error('birth_date') error @enderror" id="default-01" placeholder="Date de naissance" data-date-format="d/m/yyyy" value="{{ $driver->birth_date ? $driver->birth_date->format('d/m/Y') : '' }}">
                                        @error('birth_date')
                                        <span class="invalid">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Permis de conduire</label>
                                    <div class="form-control-wrap">
                                        <input name="driver_licence" type="text" class="form-control @error('driver_licence') error @enderror" id="default-01" placeholder="N° Permis de conduire" value="{{ $driver->driver_licence }}">
                                        @error('driver_licence')
                                        <span class="invalid">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Date d'expiration</label>
                                    <div class="form-control-wrap">
                                        <input name="exp_date" type="text" class="form-control date-picker @error('exp_date') error @enderror" id="default-01" placeholder="Date de naissance" data-date-format="d/m/yyyy" value="{{ $driver->exp_date ? $driver->exp_date->format('d/m/Y') : '' }}">
                                        @error('exp_date')
                                        <span class="invalid">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Cateorie Permis</label>
                                    <div class="form-control-wrap">
                                        <input name="licence_category" type="text" class="form-control @error('licence_category') error @enderror" id="default-01" placeholder="Catégorie du permis" value="{{ $driver->licence_category }}">
                                        @error('licence_category')
                                        <span class="invalid">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Contact</label>
                                    <div class="form-control-wrap">
                                        <input name="tel" type="text" class="form-control @error('tel') error @enderror" id="default-01" placeholder="N° Téléphone" value="{{ $driver->tel }}">
                                        @error('tel')
                                        <span class="invalid">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Addresse</label>
                                    <div class="form-control-wrap">
                                        <input name="address" type="text" class="form-control @error('address') error @enderror" id="default-01" placeholder="Addresse du chauffeur" value="{{ $driver->address }}">
                                        @error('address')
                                        <span class="invalid">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Observation</label>
                                    <div class="form-control-wrap">
                                        <textarea name="observation" class="form-control @error('observation') error @enderror" id="default-01">
                                            {{ $driver->observation }}
                                        </textarea>
                                        @error('observation')
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
