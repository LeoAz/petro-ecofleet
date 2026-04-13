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
                        Etat des déchargements
                    </h5>
                </div>
                <!-- .nk-block-head-content -->
                <div class="nk-block-head-content">
                    <div class="toggle-wrap nk-block-tools-toggle">
                        <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                        <div class="toggle-expand-content" data-content="pageMenu">
                            <ul class="nk-block-tools g-3">
                                <li class="nk-block-tools-opt">
                                    <a href="{{ route('reporting.print-unloads',  [
                                                'start_date' => request()->get('start_date'),
                                                'end_date' => request()->get('end_date')]) }}" class="btn btn-sm btn-dim btn-danger" target="_blank">
                                        <em class="icon ni ni-file-pdf"></em>
                                        <span> Imprimer le rapport</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div><!-- .toggle-wrap -->
                </div><!-- .nk-block-head-content -->
            </div><!-- .nk-block-between -->
        </div>
        <div class="card mb-5 mt-3">
            <div class="card-inner">
                <div class="preview-block">
                    <form action="" method="GET">
                        <div class="row gy-4 align-center">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input name="start_date" type="text" class="form-control date-picker" id="inlineFormInput1"  data-date-format="d/m/yyyy" placeholder="Date debut">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input name="end_date" type="text" class="form-control date-picker" id="inlineFormInput2"  data-date-format="d/m/yyyy" placeholder="Date fin">
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
                <button onclick="exportXls()" class="btn btn-success mb-3">Exporter en Excel</button>
                <table class="table table-bordered table-condensed table-sm table" data-auto-responsive="false" id="unloads">
                    <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col"><span class="sub-text">Date</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Vehicule</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Citerne</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Depot</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Produit</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Qte chargé</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Bon chrgmt</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Qte décharger</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Manquant</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Lieu</span></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $unloads as $unload)
                        <tr class="nk-tb-item">
                            <td class="nk-tb-col">
                                <div class="user-card">
                                    <div class="user-info">
                                        <span class="tb-lead">
                                            {{ $unload->date->format('d/m/Y') }}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $unload->trip->vehicle->registration }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $unload->trip->trailer }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $unload->trip->loads->deposit->name }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $unload->product->name }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $unload->trip->loads->load_qty ?? '-'}}</span>
                            </td>
                            <td>
                                <span>{{ $unload->trip->loads->num_bordereau?? '-'}}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $unload->unload_qty }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $unload->trip->loads->load_qty - $unload->unload_qty  }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $unload->place }}</span>
                            </td>
                        </tr><!-- .nk-tb-item  -->
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div><!-- .card-preview -->
    </div>

@endsection
@section('add_js')
    <script src="{{ asset('assets/js/table2excel.js') }}"></script>
    <script>
        function exportXls() {
            let t2e = new Table2Excel('#unloads', {
                exclude: "",
                filename: "Etat des dechargements"
            });
            t2e.export();
        }
    </script>
@endsection
