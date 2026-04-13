@extends('layout.app')

@section('sidebar')
    <x-warehouse-report/>
@stop

@section('content')
    {{ Breadcrumbs::render('trajet') }}
    @include('layout.partials.flash')

    <div class="nk-block nk-block-lg">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h5 class="nk-block-title">
                        Etat des sorties de pièces
                    </h5>
                </div>
                <!-- .nk-block-head-content -->
                <div class="nk-block-head-content">
                    <div class="toggle-wrap nk-block-tools-toggle">
                        <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                        <div class="toggle-expand-content" data-content="pageMenu">
                            <ul class="nk-block-tools g-3">
                                <li class="nk-block-tools-opt">
                                    <a href="{{ route('maintenance.warehouse.warehouse-report.print-exit-voucher', [
                                                'start_date' => request()->get('start_date'),
                                                'end_date' => request()->get('end_date'),
                                                'vehicle' => request()->get('vehicle'),
                                                'part' => request()->get('part')
                                                ])
                                                }}" class="btn btn-sm btn-dim btn-danger" target="_blank">
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
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <select name="vehicle" type="text" class="form-select mb-2" id="inlineFormInput3" data-placeholder = "Sélectioner le vehicule" data-search="on">
                                            <option></option>
                                            @foreach( $vehicles as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <select name="part" type="text" class="form-select mb-2" id="inlineFormInput4" data-placeholder = "Sélectioner la pièce" data-search="on">
                                            <option></option>
                                            @foreach( $parts as $part)
                                                <option value="{{ $part->id }}">{{ $part->reference }} - {{ $part->name }}</option>
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
                <table class="table table-bordered table-condensed table-sm table" data-auto-responsive="false">
                    <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col"><span class="sub-text">Date</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Véhicule</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Réference</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Nom</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Quantité</span></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $exitVouchers as $exitVoucher)
                        <tr class="nk-tb-item">
                            <td class="nk-tb-col">
                                <div class="user-card">
                                    <div class="user-info">
                                        <span class="tb-lead">
                                            {{ $exitVoucher->date->format('d/m/Y') }}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $exitVoucher->vehicle->registration }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $exitVoucher->reference }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $exitVoucher->name }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $exitVoucher->qty }}</span>
                            </td>
                        </tr><!-- .nk-tb-item  -->
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-right fs-14px">TOTAL </td>
                            <td class="text-center fs-14px"> {{ $exitVouchers ? number_format($exitVouchers->sum('qty'),0,'',' ') : 0 }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div><!-- .card-preview -->
    </div>

@endsection
