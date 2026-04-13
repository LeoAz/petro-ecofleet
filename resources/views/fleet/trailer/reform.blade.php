@extends('layout.app')

@section('content')
    {{ Breadcrumbs::render('trailer-garage') }}
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
                        <p>Ci-dessous un listing de l'ensemble des remorques en reforme dans la base de donnée</p>
                    </div>
                </div>
                <!-- .nk-block-head-content -->
                <div class="nk-block-head-content">
                    <div class="toggle-wrap nk-block-tools-toggle">
                        <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                        <div class="toggle-expand-content" data-content="pageMenu">
                            <ul class="nk-block-tools g-3">
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
                        </tr><!-- .nk-tb-item  -->
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div><!-- .card-preview -->
    </div>
@stop
