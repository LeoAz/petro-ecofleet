@extends('layout.app')
@section('content')
    {{ Breadcrumbs::render('trajet') }}
    @include('layout.partials.flash')

    <div class="nk-block nk-block-lg">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h5 class="nk-block-title">
                        <em class="icon ni ni-list"></em>
                        Rapport sur le chiffre d'affaire
                    </h5>
                </div>
                <!-- .nk-block-head-content -->
                <div class="nk-block-head-content">

                </div><!-- .nk-block-head-content -->
            </div><!-- .nk-block-between -->
        </div>
        <div class="card mb-5 mt-3">
            <div class="card-inner">
                <div class="preview-block">
                    <form action="" method="GET">
                        <div class="row gy-4 align-center">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <input name="start_date" type="text" class="form-control date-picker" id="inlineFormInput1"  data-date-format="d/m/yyyy" placeholder="Date debut">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <input name="end_date" type="text" class="form-control date-picker" id="inlineFormInput2"  data-date-format="d/m/yyyy" placeholder="Date fin">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <select name="vehicle" type="text" class="form-select mb-2" id="inlineFormInput3" data-placeholder = "Sélectioner le vehicule">
                                        <option></option>
                                        @foreach( $vehicles as $key => $value)

                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-sm btn-primary ml-2">
                                <em class="icon ni ni-filter"></em>
                                <span>Filter</span>
                            </button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div><!-- .card-preview -->
        <div class="card">
            <div class="card-inner">
                @if( ! empty($folders))
                <table class="datatable-init-export nk-tb-list nk-tb-ulist table-responsive-sm">
                    <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col"><span class="sub-text">N° Dossier</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Date</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Vehicule</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Trajet</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">chargement</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">dechargement</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Produit</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Manquant</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">P.Unitaire</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Montant</span></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $folders as $folder )
                        <tr>
                            <td class="nk-tb-col">
                                <div class="user-card">
                                    <div class="user-info">
                                        <a href="#">
                                            <span class="tb-lead">
                                            {{ $folder->code_trip }}
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </td>
                            <td class="nk-tb-col tb-col-md text-dark">
                                <span>{{ $folder->date->format('d/m/Y') }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md text-dark">
                                <span>{{ $folder->vehicle ? $folder->vehicle->registration : '' }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md text-dark">
                                {{ $folder->start_point }} - {{ $folder->end_point }}
                            </td>
                            <td class="nk-tb-col tb-col-md text-dark">
                                <span>{{ $folder->loads ? $folder->loads->date->format('d/m/Y') : '-' }}</span><br />
                                <span>{{ $folder->loads ? $folder->loads->load_qty : '-'}}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $folder->unloads ? $folder->unloads->date->format('d/m/Y') : '-' }}</span><br />
                                <span>{{ $folder->unloads ? $folder->unloads->unload_qty : '-' }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $folder->unloads?->product->name }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $folder->unloads?->missing }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $folder?->sale?->unit_price }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $folder?->sale?->total_price }}</span>
                            </td>
                        </tr><!-- .nk-tb-item  -->
                    @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div><!-- .card-preview -->
    </div>

@endsection
@section('add_js')
    <script src="{{ asset('assets/js/libs/datatable-btns.js') }}"></script>
@endsection
