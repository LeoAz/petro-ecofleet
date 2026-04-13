@extends('layout.app')
@section('content')
    <div class="nk-content-wrap">
        <div class="nk-block-head nk-block-head-lg">
            {{ Breadcrumbs::render('index') }}
            <div class="nk-block-between-md g-4">
                <div class="nk-block-head-content">
                    <h2 class="nk-block-title fw-normal">Bienvenue, {{ auth()->user()->name }}</h2>
                    <div class="nk-block-des">
                        <p>Ce module vous octroyera ue meilleure gestion de vos equipements, chauffeurs, et différents affectations.</p>
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
                                    <img src="{{ asset('assets/images/fleet/truck.png') }}" alt="">
                                </div>
                                <div class="nk-wg1-text">
                                    <h5 class="title">Gestion des véhicules</h5>
                                    <p>Ce module regroupe vos equipements (tracteur, vehicule personnel, utilitaire ou autre engins).</p>
                                </div>
                            </div>
                            <div class="nk-wg1-action">
                                <a href="{{ route('fleet.vehicle.index') }}" class="link"><span>Gérer les véhicules</span> <em class="icon ni ni-chevron-right"></em></a>
                            </div>
                        </div>
                    </div>
                </div><!-- .col -->
                <div class="col-md-4">
                    <div class="card card-full shadow-sm">
                        <div class="nk-wg1">
                            <div class="nk-wg1-block">
                                <div class="nk-wg1-img">
                                    <img src="{{ asset('assets/images/fleet/trailer.png') }}" alt="">
                                </div>
                                <div class="nk-wg1-text">
                                    <h5 class="title">Gestion des remorques</h5>
                                    <p>Vous trouverez l'ensemble des remorques (citernes, plateaux ou carosseries).</p>
                                </div>
                            </div>
                            <div class="nk-wg1-action">
                                <a href="{{ route('fleet.trailer.index') }}" class="link"><span>Gérer les remorques</span> <em class="icon ni ni-chevron-right"></em></a>
                            </div>
                        </div>
                    </div>
                </div><!-- .col -->
                <div class="col-md-4">
                    <div class="card card-full shadow-sm">
                        <div class="nk-wg1">
                            <div class="nk-wg1-block">
                                <div class="nk-wg1-img">
                                    <img src="{{ asset('assets/images/fleet/driver.png') }}" alt="">
                                </div>
                                <div class="nk-wg1-text">
                                    <h5 class="title">Gestion des chauffeurs</h5>
                                    <p>Ce module regroupe l'ensemble des chauffeurs/apprentis appartenant à l'entreprise.</p>
                                </div>
                            </div>
                            <div class="nk-wg1-action">
                                <a href="{{ route('fleet.driver.index') }}" class="link"><span>Gérer les chauffeurs</span> <em class="icon ni ni-chevron-right"></em></a>
                            </div>
                        </div>
                    </div>
                </div><!-- .col -->
                <div class="col-md-4">
                    <div class="card card-full shadow-sm">
                        <div class="nk-wg1">
                            <div class="nk-wg1-block">
                                <div class="nk-wg1-img">
                                    <img src="{{ asset('assets/images/fleet/link.png') }}" alt="">
                                </div>
                                <div class="nk-wg1-text">
                                    <h5 class="title">Attelage</h5>
                                    <p>Ce module recapitule l'ensemble des affectations tracteur -  remorque ainsi que l'historique des attelages.</p>
                                </div>
                            </div>
                            <div class="nk-wg1-action">
                                <a href="{{ route('fleet.link.index') }}" class="link"><span>Historique les associations</span> <em class="icon ni ni-chevron-right"></em></a>
                            </div>
                        </div>
                    </div>
                </div><!-- .col -->
                <div class="col-md-4">
                    <div class="card card-full shadow-sm">
                        <div class="nk-wg1">
                            <div class="nk-wg1-block">
                                <div class="nk-wg1-img">
                                    <img src="{{ asset('assets/images/fleet/bus-driver.png') }}" alt="">
                                </div>
                                <div class="nk-wg1-text">
                                    <h5 class="title">Véhicule - Chauffeur</h5>
                                    <p>Ce module recapitule l'ensemble des affectations chauffeur - vehicule ainsi que l'historique des affectations..</p>
                                </div>
                            </div>
                            <div class="nk-wg1-action">
                                <a href="{{ route('fleet.assignation.index') }}" class="link"><span>Historique les afféctations</span> <em class="icon ni ni-chevron-right"></em></a>
                            </div>
                        </div>
                    </div>
                </div><!-- .col -->
                <div class="col-md-4">
                    <div class="card card-full shadow-sm">
                        <div class="nk-wg1">
                            <div class="nk-wg1-block">
                                <div class="nk-wg1-img">
                                    <img src="{{ asset('assets/images/fleet/gear.png') }}" alt="">
                                </div>
                                <div class="nk-wg1-text">
                                    <h5 class="title">Paramêtres</h5>
                                    <p>Les paremêtres necessaire au bon fonctionnement de ce module sont regroupés ici.</p>
                                </div>
                            </div>
                            <div class="nk-wg1-action">
                                <a href="{{ route('fleet.setting.brand.index') }}" class="link"><span>Gérer les configurations</span> <em class="icon ni ni-chevron-right"></em></a>
                            </div>
                        </div>
                    </div>
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .nk-block -->
    </div>
@endsection
