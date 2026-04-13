@extends('layout.app')

@section('sidebar')
    <x-report-transport-menu/>
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
                        Rapport sur les bons de carburants
                    </h5>
                </div>
                <!-- .nk-block-head-content -->
                <div class="nk-block-head-content">
                    <div class="toggle-wrap nk-block-tools-toggle">
                        <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                        <div class="toggle-expand-content" data-content="pageMenu">
                            <ul class="nk-block-tools g-3">
                                <li class="nk-block-tools-opt">
                                    <a href="{{ route('reporting.print_fuels', [
                                                'start_date' => request()->get('start_date'),
                                                'end_date' => request()->get('end_date'),
                                                'vehicle' => request()->get('vehicle')
                                                ])}}"
                                       class="btn btn-sm btn-dim btn-danger" target="_blank">
                                        <em class="icon ni ni-file-pdf"></em>
                                        <span> Imprimer le rapport</span>
                                    </a>
                                </li>
                                <li class="nk-block-tools-opt">
                                    <input type="button" value="Exporter en EXCEL" class="btn btn-sm btn-success" onclick="saveAsExcel('fuels', 'Rapport-de-bon-de-carburant.xls')">
                                </li>
                            </ul>
                        </div>
                    </div><!-- .toggle-wrap -->
                </div>
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
                                        <select name="vehicle" type="text" class="form-select mb-2" id="inlineFormInput3" data-placeholder = "Sélectioner le vehicule" data-search="on">
                                            <option></option>
                                            @foreach( $vehicles as $key => $value)
                                                <option value="{{ $value }}">{{ $value }}</option>
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
                <table id="fuels" class="table table-bordered" data-auto-responsive="false">
                    <thead>
                    <th class="nk-tb-col"><span class="sub-text">N° Bon</span></th>
                    <th class="nk-tb-col"><span class="sub-text">Vehicule</span></th>
                    <th class="nk-tb-col"><span class="sub-text">Place</span></th>
                    <th class="nk-tb-col tb-col-mb"><span class="sub-text">Date</span></th>
                    <th class="nk-tb-col tb-col-mb"><span class="sub-text">Quantité</span></th>
                    <th class="nk-tb-col tb-col-mb"><span class="sub-text">Prix Unitaire</span></th>
                    <th class="nk-tb-col tb-col-mb"><span class="sub-text">Prix Total</span></th>
                    <th class="nk-tb-col tb-col-mb"><span class="sub-text">Fournisseur</span></th>

                    </thead>
                    <tbody>
                    @foreach( $fuels as $fuel)
                        <tr>
                            <td class="nk-tb-col">
                                <span class="tb-lead">
                                    {{ $fuel->code_order }}
                                </span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $fuel->trip->vehicle->registration }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $fuel->place }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $fuel->date_order->format('d/m/Y')}}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $fuel->quantity }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $fuel->unit_price }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ number_format($fuel->total_price, 0, '', ' ') }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $fuel->provider->name ?? '-' }}</span>
                            </td>
                        </tr><!-- .nk-tb-item  -->
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="bg-danger-dim">
                            <td colspan="6" class="text-right fs-14px">TOTAL</td>
                            <td colspan="2" class="text-center fs-14px">
                                {{ $fuels ? number_format($fuels?->sum('total_price'),0,'',' ') : 0 }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div><!-- .card-preview -->
    </div>
@endsection
@section('add_js')
    <script src="{{ asset('assets/js/saveAsExcel.js') }}"></script>
@endsection
