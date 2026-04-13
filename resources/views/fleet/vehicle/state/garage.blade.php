@extends('layout.app')

@section('content')
    {{ Breadcrumbs::render('vehicle-garage') }}

    <div class="nk-block nk-block-lg">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h5 class="nk-block-title">
                        <em class="icon ni ni-file-text"></em>
                        Liste des vehicules
                    </h5>
                    <div class="nk-block-des text-soft">
                        <p>Ci-dessous un listing de l'ensemble des vehicules au garage dans la base de donnée</p>
                    </div>
                </div>
                <!-- .nk-block-head-content -->
            </div><!-- .nk-block-between -->
        </div>
        <div class="card shadow-sm">
            <div class="card-inner">
                <table class="datatable-init nk-tb-list nk-tb-ulist table-responsive-sm" data-export-title="Exporter" >
                    <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col nk-tb-col-check">
                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                <input type="checkbox" class="custom-control-input" id="uid">
                                <label class="custom-control-label" for="uid"></label>
                            </div>
                        </th>
                        <th class="nk-tb-col"><span class="sub-text">N° Plaque</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Chassis</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Marque</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Model</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Type</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Attelé</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Status</span></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $vehicles as $vehicle )
                        <tr class="nk-tb-item">
                            <td class="nk-tb-col nk-tb-col-check">
                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                    <input type="checkbox" class="custom-control-input" id="{{ $vehicle->id }}">
                                    <label class="custom-control-label" for="{{ $vehicle->id }}"></label>
                                </div>
                            </td>
                            <td class="nk-tb-col">
                                <div class="user-card">
                                    <div class="user-info">
                                        <a href="{{ route('fleet.vehicle.show', $vehicle->uuid) }}">
                                            {{ $vehicle->registration }}
                                        </a>
                                    </div>
                                </div>
                            </td>
                            <td class="nk-tb-col tb-col-md text-dark">
                                <span>{{ $vehicle->chassis }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md text-dark">
                                <span>{{ $vehicle->brand ? $vehicle->brand->name : '' }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md text-dark">
                                <span>{{ $vehicle->pattern ? $vehicle->pattern->name : ''}}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md text-dark">
                                {{ \App\Enums\Fleet\VehicleType::getDescription($vehicle->type) }}
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                @if( $vehicle->is_linked )
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
                                @include('layout.partials.enum.Fleet.vehicleStatus', ['status' => $vehicle->status])
                            </td>
                        </tr><!-- .nk-tb-item  -->
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div><!-- .card-preview -->
    </div>
@stop
