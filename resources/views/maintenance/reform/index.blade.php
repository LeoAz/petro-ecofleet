@extends('layout.app')
@section('content')
    <div class="nk-block nk-block-lg">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    {{ Breadcrumbs::render('maintenance') }}
                    <h5 class="nk-block-title">
                        <em class="icon ni ni-file-text"></em>
                        Liste des vehicules en reforme
                    </h5>
                    <div class="nk-block-des text-soft">
                        <p>Ci-dessous un listing de l'ensemble des vehicules en reforme disponible dans la base de donnée</p>
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
                        <th class="nk-tb-col"><span class="sub-text">Date</span></th>
                        <th class="nk-tb-col"><span class="sub-text">vehicle</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Raison de la reforme</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-right">
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $reforms as $reform )
                        <tr class="nk-tb-item">
                            <td class="nk-tb-col nk-tb-col-check">
                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                    <input type="checkbox" class="custom-control-input" id="{{ $reform->id }}">
                                    <label class="custom-control-label" for="{{ $reform->id }}"></label>
                                </div>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span> {{ $reform->date->format('d/m/Y') }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span> {{ $reform->vehicle->registration }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span> {{ $reform->reason }}</span>
                            </td>
                            <td class="nk-tb-col nk-tb-col-tools">
                                <div class="tb-odr-btns d-none d-sm-inline">
                                    <a href="#" class="btn btn-dim btn-sm btn-danger"
                                       onclick="event.preventDefault();
                                               document.getElementById('delete-form').submit();"
                                    >
                                        <em class="icon ni ni-trash"></em>
                                        <span>Supprimer</span>
                                    </a>
                                    <form id="delete-form"
                                          action="{{ route('maintenance.reform.delete', $reform->id) }}" method="post" style="display: none;"
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
@stop
