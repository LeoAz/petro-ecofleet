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
                        Rapport sur les dépenses de voyage
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
                @if( ! empty($expenses))
                    <table class="datatable-init-export nk-tb-list nk-tb-ulist table-responsive-sm">
                        <thead>
                        <tr class="nk-tb-item nk-tb-head">
                            <th class="nk-tb-col"><span class="sub-text">N° Dossier</span></th>
                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Date</span></th>
                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Vehicule</span></th>
                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Chauffeur</span></th>
                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Type dépense</span></th>
                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Montant</span></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $expenses as $expense )
                            <tr>
                                <td class="nk-tb-col">
                                    <div class="user-card">
                                        <div class="user-info">
                                            <a href="#">
                                            <span class="tb-lead">
                                            {{ $expense->trip->code_trip }}
                                            </span>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                                <td class="nk-tb-col tb-col-md text-dark">
                                    <span>{{ $expense->date_expense->format('d/m/Y') }}</span>
                                </td>
                                <td class="nk-tb-col tb-col-md text-dark">
                                    <span>{{ $expense->trip->vehicle ? $expense->trip->vehicle->registration : '' }}</span>
                                </td>
                                <td class="nk-tb-col tb-col-md text-dark">
                                <span>{{ $expense->trip->vehicle ? $expense->trip->vehicle?->activeDriver?->driver?->name : '' }}</span>
                                </td>
                                <td class="nk-tb-col tb-col-md text-dark">
                                    {{ $expense->type->description  }}
                                </td>
                                <td class="nk-tb-col tb-col-md">
                                    <span>{{ number_format($expense->amount,0,' ', ' ') }}</span>
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
