@extends('layout.app')
@section('content')
    {{ Breadcrumbs::render('driver') }}
    @include('layout.partials.flash')
    <div class="nk-block nk-block-lg">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h5 class="nk-block-title">
                        <em class="icon ni ni-file-text"></em>
                        Liste des chauffeurs
                    </h5>
                    <div class="nk-block-des text-soft">
                        <p>Ci-dessous un listing de l'ensemble des chauffeurs dans la base de donnée</p>
                    </div>
                </div>
                <!-- .nk-block-head-content -->
                <div class="nk-block-head-content">
                    <div class="toggle-wrap nk-block-tools-toggle">
                        <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                        <div class="toggle-expand-content" data-content="pageMenu">
                            <ul class="nk-block-tools g-3">
                                <li class="nk-block-tools-opt">
                                    <a href="#" class="btn btn-sm btn-dim btn-primary" data-toggle="modal" data-target="#create-state">
                                        <em class="icon ni ni-plus"></em>
                                        <span> Ajouter chauffeurs</span>
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
                <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                    <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col nk-tb-col-check">
                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                <input type="checkbox" class="custom-control-input" id="uid">
                                <label class="custom-control-label" for="uid"></label>
                            </div>
                        </th>
                        <th class="nk-tb-col"><span class="sub-text">Nom</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Matricule</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Contact</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Type permis</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Date Exp</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Status</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-right">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $drivers as $driver)
                        <tr class="nk-tb-item">
                            <td class="nk-tb-col nk-tb-col-check">
                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                    <input type="checkbox" class="custom-control-input" id="{{ $driver->id }}">
                                    <label class="custom-control-label" for="{{ $driver->id }}"></label>
                                </div>
                            </td>
                            <td class="nk-tb-col">
                                <div class="user-card">
                                    <div class="user-info">
                                        <span class="tb-lead">
                                            <a href="{{ route('fleet.driver.show', $driver->uuid) }}">{{ $driver->name }}</a>

                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $driver->matricule }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $driver->tel }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $driver->licence_category }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $driver->exp_date ? $driver->exp_date ->format('d/m/Y') : '-' }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                @include('layout.partials.enum.Fleet.driverStatus', ['status' => $driver->status])
                            </td>
                            <td class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1">
                                    <li>
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-left">
                                                <ul class="link-list-plain sm">
                                                    <li><a href="{{ route('fleet.driver.show', $driver->uuid) }}"><em class="icon ni ni-file-text"></em><span>Details</span></a></li>
                                                    <li>
                                                        <a href="{{ route('fleet.driver.edit', $driver->uuid) }}"><em class="icon ni ni-pen">
                                                            </em><span>Modifier</span>
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
                    <h5 class="modal-title">Saisir un nouveau chauffeur</h5>
                </div>
                <div class="modal-body">
                    <form id="form-create" action="{{ route('fleet.driver.store') }}" method="post">
                        @csrf
                        <div class="preview-block">
                            <div class="row gy-4">
                                <div class="col-sm-12 mb-3">
                                    <div class="form-group">
                                        <div class="example-alert">
                                            <div class="alert alert-pro alert-primary shadow-sm alert-icon bg-blue-dim">
                                                <em class="icon ni ni-alert-circle"></em>
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
                                            <input name="name" type="text" class="form-control @error('name') error @enderror" id="default-01" placeholder="Nom du chauffeur" value="{{ old('name') }}">
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
                                            <input name="matricule" type="text" class="form-control @error('matricule') error @enderror" id="default-01" placeholder="N° Matricule" value="{{ old('matricule') }}">
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
                                            <input name="birth_date" type="text" class="form-control date-picker @error('birth_date') error @enderror" id="default-01" placeholder="Date de naissance" data-date-format="d/m/yyyy" value="{{ old('birth_date') }}">
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
                                            <input name="driver_licence" type="text" class="form-control @error('driver_licence') error @enderror" id="default-01" placeholder="N° Permis de conduire" value="{{ old('driver_licence') }}">
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
                                            <input name="exp_date" type="text" class="form-control date-picker @error('exp_date') error @enderror" id="default-01" placeholder="Date de naissance" data-date-format="d/m/yyyy" value="{{ old('exp_date') }}">
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
                                            <input name="licence_category" type="text" class="form-control @error('licence_category') error @enderror" id="default-01" placeholder="Catégorie du permis" value="{{ old('licence_category') }}">
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
                                            <input name="tel" type="text" class="form-control @error('tel') error @enderror" id="default-01" placeholder="N° Téléphone" value="{{ old('tel') }}">
                                            @error('tel')
                                            <span class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Addresse</label>
                                        <div class="form-control-wrap">
                                            <input name="address" type="text" class="form-control @error('address') error @enderror" id="default-01" placeholder="Addresse du chauffeur" value="{{ old('address') }}">
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
                                                {{ old('observation') }}
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
