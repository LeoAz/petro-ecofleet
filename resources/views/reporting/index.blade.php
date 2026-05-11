@extends('layout.app')

@section('sidebar')
    <x-report-transport-menu/>
@stop

@section('content')
    @include('layout.partials.flash')
    <div class="nk-block nk-block-lg">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    {{ Breadcrumbs::render('reporting') }}
                    <h5 class="nk-block-title">
                        <em class="icon ni ni-list"></em>
                        Liste des utilisateurs
                    </h5>
                    <div class="nk-block-des text-soft">
                        <p>Ci-dessous un listing de l'ensemble des utilisateurs dans la base de donnée</p>
                    </div>
                </div>
                <!-- .nk-block-head-content -->
                <div class="nk-block-head-content">
                    <div class="toggle-wrap nk-block-tools-toggle">
                        <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                        <div class="toggle-expand-content" data-content="pageMenu">
                            <ul class="nk-block-tools g-3">
                                <li class="nk-block-tools-opt">
                                    <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#create-user">
                                        <em class="icon ni ni-plus"></em>
                                        <span> Ajouter Utilisateur</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div><!-- .toggle-wrap -->
                </div><!-- .nk-block-head-content -->
            </div><!-- .nk-block-between -->
        </div>
        <div class="card">
            <div class="card-inner">
            </div>
        </div><!-- .card-preview -->
    </div>

@endsection
