@extends('layout.app')
@section('content')
    {{ Breadcrumbs::render('vehicle') }}
    <div class="nk-content-wrap">
        <div class="nk-block-head">
            <div class="nk-block-between g-3">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">Liste des vehicules</h3>
                    <div class="nk-block-des text-soft">
                        <ul class="list-inline">
                            <li>generer le: <span class="text-base">{{ now()->format('d/m/Y') }}</span></li>
                        </ul>
                    </div>
                </div>
                <div class="nk-block-head-content">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em><span>Retour</span></a>
                    <a href="{{ url()->previous()}}" class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none"><em class="icon ni ni-arrow-left"></em></a>
                </div>
            </div>
        </div><!-- .nk-block-head -->
        <div class="nk-block">
            <div class="invoice">
                <div class="invoice-action">
                    <a class="btn btn-icon btn-lg btn-white btn-dim btn-outline-primary" href="{{ route('fleet.vehicle.print-fleet') }}" target="_blank">
                        <em class="icon ni ni-printer-fill"></em>
                    </a>
                </div><!-- .invoice-actions -->
                <div class="invoice-wrap">
                    <div class="text-center text-uppercase fs-22px fw-bold ff-mono mt-5">
                        <h5 class="mb-5"><ins>Liste des vehicules au {{ now()->format('d/m/Y') }}</ins></h5>
                    </div>
                    <div class="invoice-bills">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th >#</th>
                                    <th >N°Plaque</th>
                                    <th>chassis</th>
                                    <th>remorque</th>
                                    <th>chauffeur</th>
                                    <th>marque</th>
                                    <th>Model</th>
                                    <th>type</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach( $vehicles as $vehicle )
                                <tr>
                                    <td>{{ $vehicle->id }}</td>
                                    <td>{{ $vehicle->registration }}</td>
                                    <td>{{ $vehicle->chassis }}</td>
                                    <td>
                                        {{ $vehicle->activeTrailer->trailer->registration ?? '-'}}
                                    </td>
                                    <td>
                                        {{ $vehicle->activeDriver->driver->name ?? '-'}}
                                    </td>
                                    <td>{{ $vehicle->brand ? $vehicle->brand->name : '' }}</td>
                                    <td>{{ $vehicle->pattern ? $vehicle->pattern->name : ''}}</td>
                                    <td>
                                        {{ \App\Enums\Fleet\VehicleType::getDescription($vehicle->type) }}
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div><!-- .invoice-bills -->
                </div><!-- .invoice-wrap -->
            </div><!-- .invoice -->
        </div><!-- .nk-block -->
    </div>
@stop
