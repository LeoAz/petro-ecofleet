@extends('layout.app')
@section('content')
    {{ Breadcrumbs::render('trailer-show', $trailer) }}
    @include('layout.partials.flash')
    <div class="nk-block-between mb-3">
        <div class="nk-block-head-content">

        </div>
        <!-- .nk-block-head-content -->
        <div class="nk-block-head-content">
            <div class="toggle-wrap nk-block-tools-toggle">
                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                <div class="toggle-expand-content" data-content="pageMenu">
                    <ul class="nk-block-tools g-3">
                        <li class="nk-block-tools-opt">
                            <a href="{{ route('fleet.trailer.edit', $trailer->uuid) }}" class="btn btn-sm btn-warning">
                                <em class="icon ni ni-pen2"></em>
                                <span> Modifier la remorque</span>
                            </a>
                        </li>
                        <li class="nk-block-tools-opt">
                            <a href="#" class="btn btn-sm btn-danger">
                                <em class="icon ni ni-trash"></em>
                                <span> Supprimer la remorque</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div><!-- .toggle-wrap -->
        </div><!-- .nk-block-head-content -->
    </div>
    <div class="card shadow-sm">
        <div class="card-inner">
            <div class="nk-block">
                <div class="nk-block-head">
                    <h6 class="title">Details de la remorque</h6>
                    <p>Ci-dessous les informations detaillé de la remorque</p>
                </div><!-- .nk-block-head -->
                <div class="profile-ud-list">
                    <div class="profile-ud-item">
                        <div class="profile-ud wider">
                            <span class="profile-ud-label">N° Immatriculation</span>
                            <span class="profile-ud-value">{{ $trailer->registration ?? '-' }}</span>
                        </div>
                    </div>
                    <div class="profile-ud-item">
                        <div class="profile-ud wider">
                            <span class="profile-ud-label">Code remorque</span>
                            <span class="profile-ud-value">{{ $trailer->code_trailer ?? '-' }}</span>
                        </div>
                    </div>
                    <div class="profile-ud-item">
                        <div class="profile-ud wider">
                            <span class="profile-ud-label">Marque</span>
                            <span class="profile-ud-value">
                                {{ $trailer->brand ? $trailer->brand->name : '-' }}
                            </span>
                        </div>
                    </div>
                    <div class="profile-ud-item">
                        <div class="profile-ud wider">
                            <span class="profile-ud-label">Model</span>
                            <span class="profile-ud-value">
                                {{ $trailer->pattern ? $trailer->pattern->name : '-' }}
                            </span>
                        </div>
                    </div>
                    <div class="profile-ud-item">
                        <div class="profile-ud wider">
                            <span class="profile-ud-label">Type</span>
                            <span class="profile-ud-value">
                                {{ \App\Enums\Fleet\TrailerType::getDescription($trailer->type)}}
                            </span>
                        </div>
                    </div>

                    <div class="profile-ud-item">
                        <div class="profile-ud wider">
                            <span class="profile-ud-label">Etat</span>
                            <span class="profile-ud-value">{{ \App\Enums\Fleet\FleetState::getDescription($trailer->state)}}</span>
                        </div>
                    </div>
                    <div class="profile-ud-item">
                        <div class="profile-ud wider">
                            <span class="profile-ud-label">Utilisation</span>
                            <span class="profile-ud-value">{{ \App\Enums\Fleet\FleetUsage::getDescription($trailer->usage)}}</span>
                        </div>
                    </div>
                    <div class="profile-ud-item">
                        <div class="profile-ud wider">
                            <span class="profile-ud-label">Nombre d'essieux</span>
                            <span class="profile-ud-value">{{ $trailer->axels}}</span>
                        </div>
                    </div>
                </div><!-- .profile-ud-list -->
            </div><!-- .nk-block -->
            <idv class="nk-divider divider md"></idv>
            <div class="nk-block">
                <div class="nk-block-head mt-3">
                    <h6 class="title">Informations supplémentaires</h6>
                    <p>Ci-dessous les informations supplémentaires concernant le vehicule</p>
                </div><!-- .nk-block-head -->
                <div class="profile-ud-list">
                    <div class="profile-ud-item">
                        <div class="profile-ud wider">
                            <span class="profile-ud-label">Poids à vide (Kilogrammes)</span>
                            <span class="profile-ud-value">{{ $trailer->empty_weight ?? '-' }} </span>
                        </div>
                    </div>
                    <div class="profile-ud-item">
                        <div class="profile-ud wider">
                            <span class="profile-ud-label">Capacité (Kilogrammes)</span>
                            <span class="profile-ud-value">{{ $trailer->capacity ?? '-' }} </span>
                        </div>
                    </div>
                    <div class="profile-ud-item">
                        <div class="profile-ud wider">
                            <span class="profile-ud-label">Prix d'acquisition</span>
                            <span class="profile-ud-value">{{ $trailer->acquisition_amount ?? '-'}}</span>
                        </div>
                    </div>
                    <div class="profile-ud-item">
                        <div class="profile-ud wider">
                            <span class="profile-ud-label">Attélé</span>
                            <span class="profile-ud-value">
                                @if( $trailer->is_linked )
                                    <span>
                                        <em class="icon ni ni-check-circle-fill text-success fs-22px"></em>
                                    </span>
                                @else
                                    <em class="icon ni ni-cross-circle-fill text-danger fs-22px"></em>
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="profile-ud-item">
                        <div class="profile-ud wider">
                            <span class="profile-ud-label">Status</span>
                            <span class="profile-ud-value">
                                @include('layout.partials.enum.Fleet.trailerStatus', ['status' => $trailer->status])
                            </span>
                        </div>
                    </div>
                    <div class="profile-ud-item">
                        <div class="profile-ud wider">
                            <span class="profile-ud-label">Unité</span>
                            <span class="profile-ud-value">
                                {{ $trailer->unit }}
                            </span>
                        </div>
                    </div>
                </div><!-- .profile-ud-list -->
            </div><!-- .nk-block -->
        </div>
    </div>
    @if( $trailer->is_linked === true || $trailer->activeVehicle != null)
    <div class="card shadow-sm">
        <div class="card-inner">
            <div class="col-sm-12 mt-5">
                <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                    <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col nk-tb-col-check">
                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                <input type="checkbox" class="custom-control-input" id="uid">
                                <label class="custom-control-label" for="uid"></label>
                            </div>
                        </th>
                        <th class="nk-tb-col"><span class="sub-text">N° Plaque</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Marque</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Date attélage</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Date retrait</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Status</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-right">
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $trailer->vehicles->sortByDesc('created_at') as $link)
                        <tr class="nk-tb-item">
                            <td class="nk-tb-col nk-tb-col-check">
                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                    <input type="checkbox" class="custom-control-input" id="{{ $link->id }}">
                                    <label class="custom-control-label" for="{{ $link->id }}"></label>
                                </div>
                            </td>
                            <td class="nk-tb-col">
                                <div class="user-card">
                                    <div class="user-info">
                                        <span class="tb-lead">
                                            {{ $link->vehicle->registration }}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ \App\Enums\Fleet\TrailerType::getDescription($link->vehicle->type) }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $link->link_date ? $link->link_date->format('d/m/Y') : '-' }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $link->unlink_date ? $link->unlink_date->format('d/m/Y') : '-' }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                @include('layout.partials.enum.Fleet.LinkStatus', ['status' => $link->status])
                            </td>
                            <td class=" nk-tb-col tb-odr-action">
                                <div class="tb-odr-btns d-none d-sm-inline">
                                    <a href="#" class="btn btn-dim btn-sm btn-danger"
                                       data-toggle="modal" data-target="#delete-modal"
                                       data-resource="{{ $link->uuid }}"
                                    >
                                        <em class="icon ni ni-cross"></em>
                                    </a>
                                </div>
                            </td>
                        </tr><!-- .nk-tb-item  -->
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
@stop
