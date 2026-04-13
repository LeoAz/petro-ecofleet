@extends('layout.app')
@section('content')
    {{ Breadcrumbs::render('assignation') }}
    <div class="nk-block nk-block-lg">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h5 class="nk-block-title">
                        <em class="icon ni ni-file-text"></em>
                        Liste des affectations chauffeurs - Vehicules
                    </h5>
                    <div class="nk-block-des text-soft">
                        <p>Ci-dessous un listing de l'historique des affectations chauffeur - véhicule dans la base de donnée</p>
                    </div>
                </div>
                <!-- .nk-block-head-content -->
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
                        <th class="nk-tb-col"><span class="sub-text">Chauffeur</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Vehicule</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Marque</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Date affactation</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Date Retrait</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Status</span></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $assignations as $assignation )
                        <tr class="nk-tb-item">
                            <td class="nk-tb-col nk-tb-col-check">
                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                    <input type="checkbox" class="custom-control-input" id="{{ $assignation->id }}">
                                    <label class="custom-control-label" for="{{ $assignation->id }}"></label>
                                </div>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <a href="{{ route('fleet.driver.show', $assignation->driver->uuid) }}">
                                    <span>{{ $assignation->driver->name }}</span>
                                </a>

                            </td>
                            <td class="nk-tb-col">
                                <div class="user-card">
                                    <div class="user-info">
                                        <span class="tb-lead">
                                            <a href="{{ route('fleet.vehicle.show', $assignation->vehicle->uuid) }}"><span>
                                                    {{ $assignation->vehicle->registration}}
                                                </span>
                                            </a>

                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ \App\Enums\Fleet\VehicleType::getDescription($assignation->vehicle->type) }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $assignation->date_attribution ? $assignation->date_attribution->format('d/m/Y'): '-' }}</span>
                            </td>

                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $assignation->cancel_date ? $assignation->cancel_date->format('d/m/Y'): '-' }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                @include('layout.partials.enum.Fleet.AssignationStatus', ['status' => $assignation->status])
                            </td>
                        </tr><!-- .nk-tb-item  -->
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div><!-- .card-preview -->
    </div>
@stop
