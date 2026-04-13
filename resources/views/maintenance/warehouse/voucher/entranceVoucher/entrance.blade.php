@extends('layout.app')
@section('content')
    {{ Breadcrumbs::render('driver') }}
    <div class="nk-block nk-block-lg">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h5 class="nk-block-title">
                        <em class="icon ni ni-file-text"></em>
                        Liste des bons d'entrée en stock
                    </h5>
                    <div class="nk-block-des text-soft">
                        <p>Ci-dessous un listing de l'ensemble des bons d'entrée dans la base de donnée</p>
                    </div>
                </div>
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
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">N° Bon de commande</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">N° Bon d'achat</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text"></span>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $entrances->sortByDesc('created_at') as $entrance)
                        <tr class="nk-tb-item">
                            <td class="nk-tb-col nk-tb-col-check">
                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                    <input type="checkbox" class="custom-control-input" id="{{ $entrance->id }}">
                                    <label class="custom-control-label" for="{{ $entrance->id }}"></label>
                                </div>
                            </td>
                            <td class="nk-tb-col">
                                <div class="user-card">
                                    <div class="user-info">
                                            <span class="tb-lead">
                                                {{ $entrance->code }}
                                            </span>
                                    </div>
                                </div>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $entrance->date->format('d/m/Y')}}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $entrance->order->code ?? '-' }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $entrance->purchase->code ?? '-' }}</span>
                            </td>
                            <td class=" nk-tb-col tb-odr-action">
                                <div class="tb-odr-btns d-none d-sm-inline">
                                    <a href="{{ route('maintenance.warehouse.entrance.print', $entrance->uuid) }}" class="btn btn-dim btn-sm btn-lighter" target="_blank">
                                        <em class="icon ni ni-file-pdf text-danger"></em>
                                        <span class="text-danger">Imprimer</span>
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
@stop
