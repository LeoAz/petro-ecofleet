@extends('layout.app')
@section('content')
    {{ Breadcrumbs::render('driver') }}
    @include('layout.partials.flash')
    <div class="nk-block nk-block-lg">
        <div class="nk-block-head-sub mb-5">
            <a class="back-to page-title" href="{{ route('maintenance.index') }}">
                <em class="icon ni ni-arrow-left"></em>
                <span>Retour menu</span>
            </a>
        </div>
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h5 class="nk-block-title">
                        <em class="icon ni ni-file-text"></em>
                        Liste des inventaires
                    </h5>
                    <div class="nk-block-des text-soft">
                        <p>Ci-dessous un listing de l'ensemble des inventaires dans la base de donnée</p>
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
                                        <span> créer un inventaire </span>
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
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Date</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Description</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Status</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text"></span>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $inventories as $inventory)
                        <tr class="nk-tb-item">
                            <td class="nk-tb-col nk-tb-col-check">
                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                    <input type="checkbox" class="custom-control-input" id="{{ $inventory->id }}">
                                    <label class="custom-control-label" for="{{ $inventory->id }}"></label>
                                </div>
                            </td>
                            <td class="nk-tb-col">
                                <div class="user-card">
                                    <div class="user-info">
                                            <span class="tb-lead">
                                                {{ $inventory->date_inventory->format('d/m/Y') }}
                                            </span>
                                    </div>
                                </div>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $inventory->description }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                @include('layout.partials.enum.maintenance.InventoryStatus', ['status' => $inventory->status])
                            </td>
                            <td class=" nk-tb-col tb-odr-action">
                                <div class="tb-odr-btns d-none d-sm-inline">
                                    <a href="{{ route('maintenance.inventory.detail', $inventory->uuid) }}" class="btn btn-dim btn-sm btn-primary">
                                        <em class="icon ni ni-file-doc"></em>
                                        <span>Details</span>
                                    </a>
                                    <a href="#" class="btn btn-dim btn-sm btn-danger"
                                       onclick="event.preventDefault();
                                       document.getElementById('inventory-delete-form{{ $inventory->id }}').submit();"
                                    >
                                        <em class="icon ni ni-cross"></em>
                                    </a>
                                    <form id="inventory-delete-form{{ $inventory->id }}"
                                          action={{ route('maintenance.inventory.inventory-delete', $inventory->uuid) }} method="post" style="display: none;"
                                    >
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr><!-- .nk-tb-item  -->
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div><!-- .card-preview -->
    </div>
    <div class="modal fade" id="create-state">
        <div class="modal-dialog modal-dialog-top modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
                <div class="modal-header">
                    <h5 class="modal-title">Faire un inventaire</h5>
                </div>
                <div class="modal-body">
                    <form id="form-create" action="{{ route('maintenance.inventory.store') }}" method="post">
                        @csrf
                        <div class="preview-block">
                            <div class="row gy-4">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Date</label>
                                        <div class="form-control-wrap">
                                            <input name="date_inventory" type="text" class="form-control date-picker @error('date_inventory') error @enderror" id="default-01" placeholder="Date inventaire" data-date-format="d/m/yyyy" value="{{ old('date_inventory')}}">
                                            @error('date_inventory')
                                            <span class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-02">La description</label>
                                        <div class="form-control-wrap" data-placeholder = "selectioner le vehicule">
                                            <input name="description" type="text" class="form-control @error('date_inventory') error @enderror" id="default-02" placeholder="description de l'inventaire" value="{{ old('description')}}">
                                            @error('description')
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
