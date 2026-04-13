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
                        Liste des accidents
                    </h5>
                    <div class="nk-block-des text-soft">
                        <p>Ci-dessous un listing de l'ensemble des accidents disponible dans la base de donnée</p>
                    </div>
                </div>
                <div class="nk-block-head-content">
                    <div class="toggle-wrap nk-block-tools-toggle">
                        <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                        <div class="toggle-expand-content" data-content="pageMenu">
                            <ul class="nk-block-tools g-3">
                                <li class="nk-block-tools-opt">
                                    <a href="{{ route('fleet.vehicle.index') }}" class="btn btn-sm btn-dim btn-primary">
                                        <em class="icon ni ni-plus"></em>
                                        <span> Déclarer un accident </span>
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
                        <th class="nk-tb-col"><span class="sub-text">Date</span></th>
                        <th class="nk-tb-col"><span class="sub-text">vehicle</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Place</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Gravité</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Montant</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-right">
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $accidents as $accident )
                        <tr class="nk-tb-item">
                            <td class="nk-tb-col nk-tb-col-check">
                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                    <input type="checkbox" class="custom-control-input" id="{{ $accident->id }}">
                                    <label class="custom-control-label" for="{{ $accident->id }}"></label>
                                </div>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span> {{ $accident->date->format('d/m/Y') }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span> {{ $accident->vehicle->registration }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span> {{ $accident->place }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                @include('layout.partials.enum.maintenance.gravity', ['gravity' => $accident->gravity])
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                {{ number_format($accident->amount, 0, ' ', ' ') }}
                            </td>
                            <td class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1">
                                    <li>
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-left">
                                                <ul class="link-list-plain sm">
                                                    <li>
                                                        <a href="{{ route('maintenance.accident.edit', [$accident->vehicle->uuid, $accident->uuid]) }}">
                                                            <em class="icon ni ni-pen"></em>
                                                            <span>Modifier</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('maintenance.accident.print', [$accident->vehicle->uuid, $accident->uuid] ) }}" target="_blank">
                                                            <em class="icon ni ni-printer-fill"></em>
                                                            <span>Imprimer</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#"
                                                           onclick="event.preventDefault();
                                                               document.getElementById('sale-delete-form{{ $accident->id }}').submit();"
                                                        >
                                                            <em class="icon ni ni-cross-circle text-danger"></em>
                                                            <span class="text-danger">Supprimer</span>
                                                        </a>
                                                        <form id="sale-delete-form{{ $accident->id }}"
                                                              action="{{ route('maintenance.accident.delete', $accident->uuid) }}" method="post" style="display: none;"
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
@stop
