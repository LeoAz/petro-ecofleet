@extends('layout.app')

@section('content')
    {{ Breadcrumbs::render('trailer') }}
    @include('layout.partials.flash')

    <div class="nk-block nk-block-lg">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h5 class="nk-block-title">
                        <em class="icon ni ni-file-text"></em>
                        Liste des remorques
                    </h5>
                    <div class="nk-block-des text-soft">
                        <p>Ci-dessous un listing de l'ensemble des remorques dans la base de donnée</p>
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
                                                    <a href="{{ route('fleet.trailer.garage') }}">
                                                        <em class="icon ni ni-home"></em>
                                                        <span>Présence garage</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('fleet.trailer.reform')}}">
                                                        <em class="icon ni ni-arrow-from-right"></em>
                                                        <span>Remorque reformé</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <em class="icon ni ni-hot"></em>
                                                        <span>Declarer accident</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="nk-block-tools-opt">
                                    <a href="#" class="btn btn-sm btn-dim btn-primary" data-toggle="modal" data-target="#create-trailer">
                                        <em class="icon ni ni-plus"></em>
                                        <span> Ajouter remorque</span>
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
                <table class="datatable-init-export nk-tb-list nk-tb-ulist table-responsive-sm" data-export-title="Exporter" >
                    <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col nk-tb-col-check">
                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                <input type="checkbox" class="custom-control-input" id="uid">
                                <label class="custom-control-label" for="uid"></label>
                            </div>
                        </th>
                        <th class="nk-tb-col"><span class="sub-text">N° Plaque</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">code</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Type</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Marque</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Capacité</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Attelé</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Status</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-left">
                            Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $trailers as $trailer )
                        <tr class="nk-tb-item">
                            <td class="nk-tb-col nk-tb-col-check">
                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                    <input type="checkbox" class="custom-control-input" id="{{ $trailer->id }}">
                                    <label class="custom-control-label" for="{{ $trailer->id }}"></label>
                                </div>
                            </td>
                            <td class="nk-tb-col">
                                <div class="user-card">
                                    <div class="user-info">
                                        <a href="{{ route('fleet.trailer.show', $trailer->uuid) }}">
                                            <span class="tb-lead">
                                            {{ $trailer->registration }}
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </td>
                            <td class="nk-tb-col tb-col-md text-dark">
                                <span>{{ $trailer->code_trailer }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md text-dark">
                                <span>{{ \App\Enums\Fleet\TrailerType::getDescription($trailer->type) }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md text-dark">
                                <span>{{ $trailer->brand->name }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md text-dark">
                                <span>{{ $trailer->capacity }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                @if( $trailer->is_linked )
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
                                @include('layout.partials.enum.Fleet.trailerStatus', ['status' => $trailer->status])
                            </td>
                            <td class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1">
                                    <li>
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-left">
                                                <ul class="link-list-plain sm">
                                                    <li>
                                                        <a href="{{ route('fleet.trailer.show', $trailer->uuid) }}"><em class="icon ni ni-file-text"></em><span>Details</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('fleet.trailer.edit', $trailer->uuid) }}"><em class="icon ni ni-pen"></em><span>Modifier</span>
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
    <div class="modal fade" tabindex="-1" id="create-trailer">
        <div class="modal-dialog modal-dialog-top modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
                <div class="modal-header">
                    <h5 class="modal-title">Saisir une nouvelle remorque</h5>
                </div>
                <div class="modal-body">
                    <form id="form-create" action="{{ route('fleet.trailer.store') }}" method="post">
                        @csrf
                        <div class="preview-block">
                            <div class="row gy-4">
                                <div class="col-sm-12 mb-3">
                                    <div class="form-group">
                                        <div class="example-alert">
                                            <div class="alert alert-pro alert-primary shadow-sm alert-icon bg-blue-dim">
                                                <em class="icon ni ni-alert-circle"></em> <strong>Détails de la remorque</strong>
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
                                            <input name="registration" type="text" class="form-control @error('registration') error @enderror" id="default-01" placeholder="Plaque d'immatriculation" value="{{ old('registration') }}">
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
                                            <input name="code_trailer" type="text" class="form-control @error('code_trailer') error @enderror" id="default-01" placeholder="Le code" value="{{ old('code_trailer') }}">
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
                                            <input name="capacity" type="text" class="form-control @error('capacity') error @enderror" id="default-01" placeholder="Capacité de la remorque" value="{{ old('capacity') }}">
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
                                <div class="col-sm-4">
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
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="form-label">Etat de la remorque</label>
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
                                        <label class="form-label" for="default-01">Le model</label>
                                        <div class="form-control-wrap ">
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
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Nombre d'essieux</label>
                                        <div class="form-control-wrap ">
                                            <select name="axels" class="form-select" data-placeholder = "le nombre d'essieux">
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                            @error('axels')
                                            <span class="sub-text-sm text-danger ff-italic">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">L'unité</label>
                                        <div class="form-control-wrap ">
                                            <select name="unit" class="form-select" data-placeholder = "L'unite">
                                                <option value="Litres">Litres</option>
                                                <option value="Kilogramme">Kilgramme</option>
                                            </select>
                                            @error('unit')
                                            <span class="sub-text-sm text-danger ff-italic">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="form-label">Utilisation de la remorque</label>
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
                                        <label class="form-label" for="default-01">Prix d'acquisition</label>
                                        <div class="form-control-wrap">
                                            <input name="acquisition_amount" type="text" class="form-control @error('acquisition_amount') error @enderror" id="default-01" placeholder="Prix d'acquisition" value="{{ old('acquisition_amount') }}">
                                            @error('acquisition_amount')
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
