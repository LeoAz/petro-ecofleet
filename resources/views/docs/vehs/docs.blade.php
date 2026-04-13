@extends('layout.app')

@section('sidebar')
    <x-docs-menu/>
@stop

@section('content')
    {{ Breadcrumbs::render('trajet') }}
    @include('layout.partials.flash')

    <div class="nk-block nk-block-lg">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h5 class="nk-block-title">
                        <em class="icon ni ni-list"></em>
                        Liste des documents du véhicule - {{ $vehicle->registration }}
                    </h5>
                    <div class="nk-block-des text-soft">
                        <p>Ci-dessous un listing de l'ensemble des documents du véhicule - {{ $vehicle->registration }} dans la base de donnée</p>
                    </div>
                </div>
            </div><!-- .nk-block-between -->
        </div>
        <div class="card">
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
                        <th class="nk-tb-col"><span class="sub-text">Document</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Type</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Montant</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Date delivrance</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Date Expiration</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Fournisseur</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Status</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-right">
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $vehicle->documents->sortByDesc('created_at') as $docs )
                        <tr class="nk-tb-item">
                            <td class="nk-tb-col nk-tb-col-check">
                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                    <input type="checkbox" class="custom-control-input" id="{{ $docs->id }}">
                                    <label class="custom-control-label" for="{{ $docs->id }}"></label>
                                </div>
                            </td>
                            <td class="nk-tb-col">
                                <div class="user-card">
                                    <div class="user-info">
                                        <span class="tb-lead">{{ $docs->label }} <span class="dot dot-success d-md-none ml-1"></span></span>
                                    </div>
                                </div>
                            </td>
                            <td class="nk-tb-col tb-col-md text-dark">
                                <span>{{ $docs->type }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md text-dark">
                                {{ $docs->amount }}
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $docs->delivery_date->format('d/m/Y') }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $docs->exp_date->format('d/m/Y') }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                {{ $docs->provider }}
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                @include('layout.partials.enum.docs.DocsStatus', ['status' => $docs->status])
                            </td>
                            <td class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1">
                                    <li>
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <ul class="link-list-opt no-bdr">
                                                    <li>
                                                        <a href="#"
                                                           onclick="event.preventDefault();
                                                               document.getElementById('sale-delete-form{{ $docs->id }}').submit();"
                                                        >
                                                            <em class="icon ni ni-cross-circle text-danger"></em>
                                                            <span class="text-danger">Supprimer</span>
                                                        </a>
                                                        <form id="sale-delete-form{{ $docs->id }}"
                                                              action="{{ route('docs.vehs.delete', $docs->uuid) }}" method="post" style="display: none;"
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
@endsection
