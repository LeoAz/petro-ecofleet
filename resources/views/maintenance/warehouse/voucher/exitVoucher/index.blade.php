@extends('layout.app')
@section('content')
    {{ Breadcrumbs::render('driver') }}
    <div class="nk-block nk-block-lg">
        <div class="nk-block-head-sub mb-5">
            <a class="back-to page-title" href="{{ route('maintenance.warehouse.index') }}">
                <em class="icon ni ni-arrow-left"></em>
                <span>Retour Magasin</span>
            </a>
        </div>
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h5 class="nk-block-title">
                        <em class="icon ni ni-file-text"></em>
                        Liste des bons de sortie en stock
                    </h5>
                    <div class="nk-block-des text-soft">
                        <p>Ci-dessous un listing de l'ensemble des bons de sortie dans la base de donnée</p>
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
                                        <span> créer un bon de sortie </span>
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
                        <th class="nk-tb-col"><span class="sub-text">N° Bon</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Date</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Vehicule</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Marque</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Chauffeur</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Status</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Etat</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text"></span>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $exits as $exit)
                        <tr class="nk-tb-item">
                            <td class="nk-tb-col nk-tb-col-check">
                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                    <input type="checkbox" class="custom-control-input" id="{{ $exit->id }}">
                                    <label class="custom-control-label" for="{{ $exit->id }}"></label>
                                </div>
                            </td>
                            <td class="nk-tb-col">
                                <div class="user-card">
                                    <div class="user-info">
                                            <span class="tb-lead">
                                                {{ $exit->code }}
                                            </span>
                                    </div>
                                </div>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $exit->date->format('d/m/Y')}}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $exit->vehicle->registration ?? '-' }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $exit->vehicle->brand->name ?? '-' }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $exit->vehicle->activeDriver->driver->name ?? '-' }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                @include('layout.partials.enum.maintenance.ExitVoucherStatus', ['status' => $exit->status_exit])
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                @include('layout.partials.enum.maintenance.ExitVoucherState', ['state' => $exit->state_voucher])
                            </td>
                            <td class=" nk-tb-col tb-odr-action">
                                <div class="tb-odr-btns d-none d-sm-inline">
                                    <a href="{{ route('maintenance.warehouse.exit.detail', $exit->uuid) }}" class="btn btn-dim btn-sm btn-primary">
                                        <em class="icon ni ni-file-doc"></em>
                                        <span>Details</span>
                                    </a>
                                    <a href="{{ route('maintenance.warehouse.exit.print', $exit->uuid) }}" class="btn btn-dim btn-sm btn-lighter">
                                        <em class="icon ni ni-file-pdf text-danger"></em>
                                        <span class="text-danger">Imprimer</span>
                                    </a>
                                    <a href="#" class="btn btn-dim btn-sm btn-danger" target="_blank">
                                        <em class="icon ni ni-cross"></em>
                                    </a>
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
        <div class="modal-dialog modal-dialog-top modal-xl" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
                <div class="modal-header">
                    <h5 class="modal-title">Saisir un nouveau bon de sortie</h5>
                </div>
                <div class="modal-body">
                    <form id="form-create" action="{{ route('maintenance.warehouse.exit.store') }}" method="post">
                        @csrf
                        <div class="preview-block">
                            <div class="row gy-4">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Date</label>
                                        <div class="form-control-wrap">
                                            <input name="date" type="text" class="form-control date-picker @error('date') error @enderror" id="default-01" placeholder="Date du bon" data-date-format="d/m/yyyy" value="{{ old('date')}}">
                                            @error('date')
                                            <span class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Le véhicule</label>
                                        <div class="form-control-wrap" data-placeholder = "selectioner le vehicule">
                                            <select  name="vehicle_id" class="form-select @error('vehicle_id') error @enderror" id="default-03" data-search="on">
                                                @foreach( $vehicles as $key => $value)
                                                    <option value="{{ $key}}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                            @error('vehicle_id')
                                            <span class="sub-text-sm text-danger ff-italic">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Observation</label>
                                        <div class="form-control-wrap">
                                            <input name="observation" type="text" class="form-control @error('observation') error @enderror" id="default-01" placeholder="Observation" value="{{ old('observation')}}">
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
