@extends('layout.app')
@section('content')
    <div class="nk-content-wrap">
        <div class="nk-block-head nk-block-head-lg">
            {{ Breadcrumbs::render('index') }}
            <div class="nk-block-between-md g-4">
                <div class="nk-block-head-content">
                    <h2 class="nk-block-title fw-normal">Bienvenue, {{ auth()->user()->name }}</h2>
                    <div class="nk-block-des">
                        <p>Ce module vous octroyera une meilleure gestion de vos equipements et ainsi que les stock de pieces.</p>
                    </div>
                </div>
            </div>
        </div><!-- .nk-block-head -->
        <div class="nk-block">
            <div class="row g-gs">
                <div class="col-md-4">
                    <div class="card card-full shadow-sm">
                        <div class="nk-wg1">
                            <div class="nk-wg1-block">
                                <div class="nk-wg1-img">
                                    <img src="{{ asset('assets/images/maintenance/construction.png') }}" alt="">
                                </div>
                                <div class="nk-wg1-text">
                                    <h5 class="title">Gestion des pièces</h5>
                                    <p>Vous trouverez l'ensemble de vos pièces de rechanges. Ce module incorpore aussi une gestion des stocks des pièces.</p>
                                </div>
                            </div>
                            <div class="nk-wg1-action">
                                <a href="{{ route('maintenance.warehouse.part.index') }}" class="link"><span>Gérer les pièces de rechange</span> <em class="icon ni ni-chevron-right"></em></a>
                            </div>
                        </div>
                    </div>
                </div><!-- .col -->
                <div class="col-md-4">
                    <div class="card card-full shadow-sm">
                        <div class="nk-wg1">
                            <div class="nk-wg1-block">
                                <div class="nk-wg1-img">
                                    <img src="{{ asset('assets/images/maintenance/delete-file.png') }}" alt="">
                                </div>
                                <div class="nk-wg1-text">
                                    <h5 class="title">Bon de sortie</h5>
                                    <p>Vous trouverez dans ce module l'ensemble des bons de commande en stock des pièces de rechange.</p>
                                </div>
                            </div>
                            <div class="nk-wg1-action">
                                <a href="{{ route('maintenance.warehouse.exit.index') }}" class="link"><span>Gérer les devis</span> <em class="icon ni ni-chevron-right"></em></a>
                            </div>
                        </div>
                    </div>
                </div><!-- .col -->
                <div class="col-md-4">
                    <div class="card card-full shadow-sm">
                        <div class="nk-wg1">
                            <div class="nk-wg1-block">
                                <div class="nk-wg1-img">
                                    <img src="{{ asset('assets/images/maintenance/search.png') }}" alt="">
                                </div>
                                <div class="nk-wg1-text">
                                    <h5 class="title">Bon d'entré</h5>
                                    <p>Vous trouverez dans ce module l'ensemble des bons d'entré en stock des pièces de rechange.</p>
                                </div>
                            </div>
                            <div class="nk-wg1-action">
                                <a href="{{ route('maintenance.warehouse.entrance.index') }}" class="link"><span>Gérer les devis</span> <em class="icon ni ni-chevron-right"></em></a>
                            </div>
                        </div>
                    </div>
                </div><!-- .col -->
                <div class="col-md-4">
                    <div class="card card-full shadow-sm">
                        <div class="nk-wg1">
                            <div class="nk-wg1-block">
                                <div class="nk-wg1-img">
                                    <img src="{{ asset('assets/images/maintenance/report.png') }}" alt="">
                                </div>
                                <div class="nk-wg1-text">
                                    <h5 class="title">Reporting</h5>
                                    <p>Vous trouverez dans ce module l'ensemble des rapports sur les pieces de rechanges.</p>
                                </div>
                            </div>
                            <div class="nk-wg1-action">
                                <a href="{{ route('maintenance.warehouse.warehouse-report.exit-voucher') }}" class="link"><span>Voir les rapports</span> <em class="icon ni ni-chevron-right"></em></a>
                            </div>
                        </div>
                    </div>
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .nk-block -->
    </div>
@endsection
