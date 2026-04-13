@extends('layout.app')
@section('content')
    {{ Breadcrumbs::render('driver') }}
    @include('layout.partials.flash')
    <div class="nk-block-head-sub mb-5">
        <a class="back-to" href="{{ route('cashbox.detail', $box->uuid) }}">
            <em class="icon ni ni-arrow-left"></em>
            <span style="font-size: 25px">Retour détails opération</span>
        </a>
    </div>
    <div class="nk-block-between mb-3">
        <div class="nk-block-head-content">
            <h6 class="title">
                <em class="icon ni ni-file-text"></em>
                Situation des paiements en instances disponible au {{ $box->start_at->format('d/m/Y') }}
            </h6>
            <p>Ci-dessous les listes des opérations en instance de paiement</p>
        </div>
        <!-- .nk-block-head-content -->
    </div>

    <div class="card shadow-sm">
        <div class="card-inner">
            <ul class="nav nav-tabs mt-n3">
                <li class="nav-item ">
                    <a class="nav-link active" data-toggle="tab" href="#tabItem6">
                        <span>Liste des dépenses de voyages</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" data-toggle="tab" href="#tabItem5">
                        <span>Autres dépenses</span>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tabItem6">
                    <div class="col-sm-12 mt-5">
                        <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                            <thead>
                            <tr class="nk-tb-item nk-tb-head">
                                <th class="nk-tb-col nk-tb-col-check">
                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                        <input type="checkbox" class="custom-control-input" id="uid">
                                        <label class="custom-control-label" for="uid"></label>
                                    </div>
                                </th>
                                <th class="nk-tb-col"><span class="sub-text">N° Depense</span></th>
                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">Type</span></th>
                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">Date</span></th>
                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">Montant</span></th>
                                <th class="nk-tb-col nk-tb-col-tools text-right">
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $expenses->sortByDesc('created_at') as $expense)
                                <tr class="nk-tb-item">
                                    <td class="nk-tb-col nk-tb-col-check">
                                        <div class="custom-control custom-control-sm custom-checkbox notext">
                                            <input type="checkbox" class="custom-control-input" id="{{ $expense->id }}">
                                            <label class="custom-control-label" for="{{ $expense->id }}"></label>
                                        </div>
                                    </td>
                                    <td class="nk-tb-col">
                                        <div class="user-card">
                                            <div class="user-info">
                                            <span class="tb-lead">
                                                {{ $expense->code_expense }}
                                            </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span>{{ $expense->type->description }}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span>{{ $expense->date_expense->format('d/m/Y') }}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span>{{ number_format($expense->amount, 0, '', ' ')}}</span>
                                    </td>
                                    <td class=" nk-tb-col tb-odr-action">
                                        <div class="tb-odr-btns d-none d-sm-inline">
                                            <a href="#" class="btn btn-dim btn-sm btn-primary"
                                               onclick="event.preventDefault();
                                               document.getElementById('folder-open-form-{{ $expense->id }}').submit();"
                                            >
                                                <em class="icon ni ni-check"></em>
                                                <span>Payer</span>
                                            </a>
                                            <form id="folder-open-form-{{$expense->id}}"
                                                  action="{{ route('cashbox.pay-expense', [$box->uuid, $expense->uuid]) }}" method="post" style="display: none;"
                                            >
                                                <input type="hidden" name="status" value="{{ \App\Enums\Exploitation\ExpenseStatus::Paid }}">
                                                @csrf
                                            </form>
                                        </div>
                                    </td>
                                </tr><!-- .nk-tb-item  -->
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="tabItem5">
                    <div class="col-sm-12 mt-5">
                        <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                            <thead>
                            <tr class="nk-tb-item nk-tb-head">
                                <th class="nk-tb-col nk-tb-col-check">
                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                        <input type="checkbox" class="custom-control-input" id="uid">
                                        <label class="custom-control-label" for="uid"></label>
                                    </div>
                                </th>
                                <th class="nk-tb-col"><span class="sub-text">N° Depense</span></th>
                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">Date</span></th>
                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">Vehicule</span></th>
                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">Motif</span></th>
                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">Montant</span></th>
                                <th class="nk-tb-col nk-tb-col-tools text-right">
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $others->sortByDesc('created_at') as $other)
                                <tr class="nk-tb-item">
                                    <td class="nk-tb-col nk-tb-col-check">
                                        <div class="custom-control custom-control-sm custom-checkbox notext">
                                            <input type="checkbox" class="custom-control-input" id="{{ $other->id }}">
                                            <label class="custom-control-label" for="{{ $other->id }}"></label>
                                        </div>
                                    </td>
                                    <td class="nk-tb-col">
                                        <div class="user-card">
                                            <div class="user-info">
                                            <span class="tb-lead">
                                                {{ $other->code }}
                                            </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span>{{ $other->date->format('d/m/Y') }}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span>{{ $other->vehicle->registration ?? '-'}}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span>{{ $other->motif }}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span>{{ number_format($other->amount, 0, '', ' ')}}</span>
                                    </td>
                                    <td class=" nk-tb-col tb-odr-action">
                                        <div class="tb-odr-btns d-none d-sm-inline">
                                            <a href="#" class="btn btn-dim btn-sm btn-primary"
                                               onclick="event.preventDefault();
                                               document.getElementById('other-open-form-{{ $other->id }}').submit();"
                                            >
                                                <em class="icon ni ni-check"></em>
                                                <span>Payer</span>
                                            </a>
                                            <form id="other-open-form-{{$other->id}}"
                                                  action="{{ route('cashbox.pay-other',[$box->uuid, $other->uuid] ) }}" method="post" style="display: none;"
                                            >
                                                <input type="hidden" name="status" value="{{ \App\Enums\Exploitation\OtherStatus::Paid}}">
                                                @csrf
                                            </form>
                                        </div>
                                    </td>
                                </tr><!-- .nk-tb-item  -->
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
