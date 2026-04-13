@extends('layout.app')

@section('content')
    {{ Breadcrumbs::render('brand') }}
    @include('layout.partials.flash')
    <div class="example-alert mb-5">
        <div class="alert alert-pro alert-primary bg-primary-dim">
            <div class="alert-text">
                <h6>information filtrage du tableau de bord</h6>
                <p>Veuiller saisir la date pour laquelle vous voulez filter les données du tableau de bord. le mois de la date selectionné sera automatiquement prise en compte</p>
            </div>
        </div>
    </div>
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">
                    Tableau de bord du mois de
                    @if(request()->get('date_filter'))
                    {{ \Carbon\Carbon::createFromFormat('d/m/Y', request()->get('date_filter'))->translatedFormat('F') }}
                    @else
                    {{ now()->translatedFormat('F') }}
                    @endif
                    {{ now()->year }}
                </h3>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <form action="" method="GET">
                        <div class="form-row align-items-center">
                            <div class="col-auto">
                                <label class="sr-only" for="inlineFormInput">Name</label>
                                <input name="date_filter" type="text" class="form-control date-picker mb-2" id="inlineFormInput"  data-date-format="d/m/yyyy" placeholder="Saisir la date">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-sm btn-primary mb-2">
                                    <em class="icon ni ni-filter"></em>
                                    <span>Filter</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- .nk-block-between -->
        <div class="nk-block">
            <div class="row g-gs">
                <div class="col-xxl-3 col-sm-6 mt-5">
                    <div class="card">
                        <div class="card-inner">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">Chiffre d'affaire</h6>
                                </div>
                            </div>
                            <div class="data mt-3">
                                <div class="data-group">
                                    <div class="amount fs-22px">{{ number_format($sales->sum('total_amount'),0, ' ', ' ') }} CFA</div>
                                </div>
                            </div>
                        </div><!-- .card-inner -->
                    </div><!-- .card -->
                </div><!-- .col -->
                <div class="col-xxl-3 col-sm-6 mt-5">
                    <div class="card">
                        <div class="card-inner">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">Dépenses carburant</h6>
                                </div>
                            </div>
                            <div class="data mt-3">
                                <div class="data-group">
                                    <div class="amount fs-22px">{{ number_format($fuelOrders->sum('total_price'),0, ' ', ' ') }} CFA</div>
                                </div>
                            </div>
                        </div><!-- .card-inner -->
                    </div><!-- .card -->
                </div><!-- .col -->
                <div class="col-xxl-3 col-sm-6 mt-5">
                    <div class="card">
                        <div class="card-inner">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">Frais de voyage</h6>
                                </div>
                            </div>
                            <div class="data mt-3">
                                <div class="data-group">
                                    <div class="amount fs-22px">{{ number_format($expenses->sum('amount'),0, ' ', ' ') }} CFA</div>
                                </div>
                            </div>
                        </div><!-- .card-inner -->
                    </div><!-- .card -->
                </div><!-- .col -->
                <div class="col-xxl-3 col-sm-6 mt-5">
                    <div class="card">
                        <div class="card-inner">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">Dépenses entretiens</h6>
                                </div>
                            </div>
                            <div class="data mt-3">
                                <div class="data-group">
                                    <div class="amount fs-22px">{{ number_format($repairs->sum('total_amount'),0, ' ', ' ') }} CFA</div>
                                </div>
                            </div>
                        </div><!-- .card-inner -->
                    </div><!-- .card -->
                </div><!-- .col -->
                <div class="col-xxl-3 col-sm-6">
                    <div class="card">
                        <div class="card-inner">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">Dépenses garage</h6>
                                </div>
                            </div>
                            <div class="data mt-3">
                                <div class="data-group">
                                    <div class="amount fs-22px">{{ number_format($garages->sum('total_amount'),0, ' ', ' ') }} CFA</div>
                                </div>
                            </div>
                        </div><!-- .card-inner -->
                    </div><!-- .card -->
                </div><!-- .col -->
                <div class="col-xxl-3 col-sm-6">
                    <div class="card">
                        <div class="card-inner">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">Docs Admininstrative</h6>
                                </div>
                            </div>
                            <div class="data mt-3">
                                <div class="data-group">
                                    <div class="amount fs-22px">{{ number_format($docs->sum('amount'),0, ' ', ' ') }} CFA</div>
                                </div>
                            </div>
                        </div><!-- .card-inner -->
                    </div><!-- .card -->
                </div><!-- .col -->
                <div class="col-xxl-3 col-sm-6">
                    <div class="card">
                        <div class="card-inner">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">Autres dépenses</h6>
                                </div>
                            </div>
                            <div class="data mt-3">
                                <div class="data-group">
                                    <div class="amount fs-22px">0 CFA</div>
                                </div>
                            </div>
                        </div><!-- .card-inner -->
                    </div><!-- .card -->
                </div><!-- .col -->
            </div>
        </div>
    </div>
@stop
