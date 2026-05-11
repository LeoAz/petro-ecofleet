@extends('layout.app')
@section('content')
    <div class="nk-block nk-block-lg">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    {{ Breadcrumbs::render('warehouse') }}
                    <h5 class="nk-block-title">
                        <em class="icon ni ni-file-text"></em>
                        Liste des Pieces de rechange
                    </h5>
                    <div class="nk-block-des text-soft">
                        <p>Ci-dessous un listing de l'ensemble des pièces de rechange disponible dans la base de donnée</p>
                    </div>
                </div>
                <div class="nk-block-head-content">
                    <div class="toggle-wrap nk-block-tools-toggle">
                        <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                        <div class="toggle-expand-content" data-content="pageMenu">
                            <ul class="nk-block-tools g-3">
                                <li class="nk-block-tools-opt">
                                    <a href="#" class="btn btn-sm btn-dim btn-primary" data-toggle="modal" data-target="#create-state">
                                        <em class="icon ni ni-plus"></em>
                                        <span> Ajouter une pièce de rechange </span>
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
                        <th class="nk-tb-col"><span class="sub-text">N° code</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Reference</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Nom</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Categorie</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Prix</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Quantité</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Appartenance</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Status</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-right">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $parts as $part )
                        <tr class="nk-tb-item">
                            <td class="nk-tb-col nk-tb-col-check">
                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                    <input type="checkbox" class="custom-control-input" id="{{ $part->id }}">
                                    <label class="custom-control-label" for="{{ $part->id }}"></label>
                                </div>
                            </td>
                            <td class="nk-tb-col">
                                <div class="user-card">
                                    <div class="user-info">
                                        <span class="tb-lead">
                                            <a href="#">{{ $part->code }}</a>
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span> {{ $part->reference }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span> {{ $part->name }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span> {{ $part->category->name ?? '-' }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span> {{ $part->price }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span> {{ $part->qty }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span> {{ $part->buyer->name ?? '-' }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                @include('layout.partials.enum.maintenance.PartState', ['state' => $part->state])
                            </td>
                            <td class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1">
                                    <li>
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-left">
                                                <ul class="link-list-plain sm">
                                                    <li>
                                                        <a href="{{ route('maintenance.warehouse.part.edit', $part->uuid) }}">
                                                            <em class="icon ni ni-pen"></em>
                                                            <span>Modifier</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#"
                                                           onclick="event.preventDefault();
                                                               document.getElementById('sale-delete-form{{ $part->id }}').submit();"
                                                        >
                                                            <em class="icon ni ni-cross-circle text-danger"></em>
                                                            <span class="text-danger">Supprimer</span>
                                                        </a>
                                                        <form id="sale-delete-form{{ $part->id }}"
                                                              action="#" method="post" style="display: none;"
                                                        >
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
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
        <div class="modal-dialog modal-dialog-top modal-xl" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
                <div class="modal-header">
                    <h5 class="modal-title">Saisir une nouvelle pièce de rechange</h5>
                </div>
                <div class="modal-body">
                    <form id="form-create" action="{{ route('maintenance.warehouse.part.store') }}" method="post">
                        @csrf
                        <div class="preview-block">
                            <div class="row gy-4">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Nom de la pièce</label>
                                        <div class="form-control-wrap">
                                            <input name="name" type="text" class="form-control @error('name') error @enderror" id="default-01" placeholder="Nom de la categorie"
                                                   value="{{ old('name') }}"
                                            >
                                            @error('name')
                                            <span class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">La reference</label>
                                        <div class="form-control-wrap">
                                            <input name="reference" type="text" class="form-control @error('reference') error @enderror" id="default-01" placeholder="La reference"
                                                   value="{{ old('reference') }}"
                                            >
                                            @error('reference')
                                            <span class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Catégorie</label>
                                        <div class="form-control-wrap" data-placeholder = "selectioner la catégorie">
                                            <select  name="category_id" class="form-select @error('category_id') error @enderror" id="default-03">
                                                @foreach( $categories as $key => $value)
                                                    <option value="{{ $key}}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                            <span class="sub-text-sm text-danger ff-italic">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Prix de la pièce</label>
                                        <div class="form-control-wrap">
                                            <input name="price" type="text" class="form-control @error('price') error @enderror" id="default-01" placeholder="Prix de la pièce"
                                                   value="{{ old('price') }}">
                                            @error('price')
                                            <span class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Quantité</label>
                                        <div class="form-control-wrap">
                                            <input name="qty" type="text" class="form-control @error('qty') error @enderror" id="default-01" placeholder="Quantité"
                                                   value="{{ old('qty') }}">
                                            @error('qty')
                                            <span class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="form-label" for="default-07">L'appartenance</label>
                                        <div class="form-control-wrap" data-placeholder = "selectioner l'appartenant">
                                            <select  name="buyer_id" class="form-select @error('buyer_id') error @enderror" id="default-07">
                                                @foreach( $buyers as $key => $value)
                                                    <option value="{{ $key}}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                            @error('buyer_id')
                                            <span class="sub-text-sm text-danger ff-italic">{{ $message }}</span>
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
