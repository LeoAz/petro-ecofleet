@extends('layout.app')
@section('content')
    <div class="nk-content-wrap">
        <div class="nk-block-head nk-block-head-lg">
            {{ Breadcrumbs::render('index') }}
            <div class="nk-block-between-md g-4">
                <div class="nk-block-head-content">
                    <h2 class="nk-block-title fw-normal">Bienvenue, {{ auth()->user()->name }}</h2>
                    <div class="nk-block-des">
                        <p>Ce module vous octroyera ue meilleure gestion de la maintenance de vos equipements et ainsi que les stock de pieces.</p>
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
                                    <img src="{{ asset('assets/images/maintenance/maintenance.png') }}" alt="">
                                </div>
                                <div class="nk-wg1-text">
                                    <h5 class="title">Gestion des réparations</h5>
                                    <p>Ce module recapitule l'ensemble de vos reparations sur le parc automobile</p>
                                </div>
                            </div>
                            <div class="nk-wg1-action">
                                <a href="{{ route('maintenance.repair.index') }}" class="link"><span>Gérer le garage</span> <em class="icon ni ni-chevron-right"></em></a>
                            </div>
                        </div>
                    </div>
                </div><!-- .col -->
                <div class="col-md-4">
                    <div class="card card-full shadow-sm">
                        <div class="nk-wg1">
                            <div class="nk-wg1-block">
                                <div class="nk-wg1-img">
                                    <img src="{{ asset('assets/images/maintenance/warehouse.png') }}" alt="">
                                </div>
                                <div class="nk-wg1-text">
                                    <h5 class="title">Gestion du magasin</h5>
                                    <p>Ce module recapitule l'ensemble des equipements du magasin</p>
                                </div>
                            </div>
                            <div class="nk-wg1-action">
                                <a href="{{ route('maintenance.warehouse.index') }}" class="link"><span>Gérer le magasin</span> <em class="icon ni ni-chevron-right"></em></a>
                            </div>
                        </div>
                    </div>
                </div><!-- .col -->
                <div class="col-md-4">
                    <div class="card card-full shadow-sm">
                        <div class="nk-wg1">
                            <div class="nk-wg1-block">
                                <div class="nk-wg1-img">
                                    <img src="{{ asset('assets/images/maintenance/fender-bender.png') }}" alt="">
                                </div>
                                <div class="nk-wg1-text">
                                    <h5 class="title">Gestion des accidents</h5>
                                    <p>Ce module regroupe l'ensemble des declarations d'accidents des véhicules de votre parc</p>
                                </div>
                            </div>
                            <div class="nk-wg1-action">
                                <a href="{{ route('maintenance.accident.index') }}" class="link"><span>Gérer les accidents</span> <em class="icon ni ni-chevron-right"></em></a>
                            </div>
                        </div>
                    </div>
                </div><!-- .col -->
                <div class="col-md-4">
                    <div class="card card-full shadow-sm">
                        <div class="nk-wg1">
                            <div class="nk-wg1-block">
                                <div class="nk-wg1-img">
                                    <img src="{{ asset('assets/images/maintenance/mechanic1.png') }}" alt="">
                                </div>
                                <div class="nk-wg1-text">
                                    <h5 class="title">Gestion du garage</h5>
                                    <p>Ce module fait l'état des véhicules present dans le garages pour prise en charge</p>
                                </div>
                            </div>
                            <div class="nk-wg1-action">
                                <a href="{{ route('maintenance.garage.index') }}" class="link"><span>Gerer les entretiens</span> <em class="icon ni ni-chevron-right"></em></a>
                            </div>
                        </div>
                    </div>
                </div><!-- .col -->
                <div class="col-md-4">
                    <div class="card card-full shadow-sm">
                        <div class="nk-wg1">
                            <div class="nk-wg1-block">
                                <div class="nk-wg1-img">
                                    <img src="{{ asset('assets/images/maintenance/inventory.png') }}" alt="">
                                </div>
                                <div class="nk-wg1-text">
                                    <h5 class="title">Inventaire</h5>
                                    <p>Ce module fait l'état des inventaires des pièces de rechanges</p>
                                </div>
                            </div>
                            <div class="nk-wg1-action">
                                <a href="{{ route('maintenance.inventory.index') }}" class="link"><span>Gerer les inventaires</span> <em class="icon ni ni-chevron-right"></em></a>
                            </div>
                        </div>
                    </div>
                </div><!-- .col -->
                <div class="col-md-4">
                    <div class="card card-full shadow-sm">
                        <div class="nk-wg1">
                            <div class="nk-wg1-block">
                                <div class="nk-wg1-img">
                                    <img src="{{ asset('assets/images/maintenance/car-check.png') }}" alt="">
                                </div>
                                <div class="nk-wg1-text">
                                    <h5 class="title">Bon de commande</h5>
                                    <p>Vous trouverez dans ce module l'ensemble des bon de commande sur les pièces de rechange.</p>
                                </div>
                            </div>
                            <div class="nk-wg1-action">
                                <a href="{{ route('maintenance.warehouse.order.index') }}" class="link"><span>Gérer les devis</span> <em class="icon ni ni-chevron-right"></em></a>
                            </div>
                        </div>
                    </div>
                </div><!-- .col -->
                <div class="col-md-4">
                    <div class="card card-full shadow-sm">
                        <div class="nk-wg1">
                            <div class="nk-wg1-block">
                                <div class="nk-wg1-img">
                                    <img src="{{ asset('assets/images/maintenance/car.png') }}" alt="">
                                </div>
                                <div class="nk-wg1-text">
                                    <h5 class="title">Gestion des vehicule reformés</h5>
                                    <p>Ce module recapitule l'ensemble des véhicules mise en reforme dans votre parc roulant</p>
                                </div>
                            </div>
                            <div class="nk-wg1-action">
                                <a href="#" class="link"><span>Gérer les reformes</span> <em class="icon ni ni-chevron-right"></em></a>
                            </div>
                        </div>
                    </div>
                </div><!-- .col -->
                <div class="col-md-4">
                    <div class="card card-full shadow-sm">
                        <div class="nk-wg1">
                            <div class="nk-wg1-block">
                                <div class="nk-wg1-img">
                                    <img src="{{ asset('assets/images/maintenance/workshop.png') }}" alt="">
                                </div>
                                <div class="nk-wg1-text">
                                    <h5 class="title">Gestion des fournisseurs</h5>
                                    <p>Ce module recapitule l'ensemble des affectations chauffeur - vehicule ainsi que l'historique des affectations..</p>
                                </div>
                            </div>
                            <div class="nk-wg1-action">
                                <a href="{{ route('maintenance.provider.index') }}" class="link"><span>Gérer les fournisseurs</span> <em class="icon ni ni-chevron-right"></em></a>
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
                                <a href="{{ route('maintenance.setting.category.index') }}" class="link"><span>Gérer les configurations</span> <em class="icon ni ni-chevron-right"></em></a>
                            </div>
                        </div>
                    </div>
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .nk-block -->
    </div>
@endsection
