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
                       Rapport sur la marge bénéficiaire
                    </h5>
                </div>
            </div><!-- .nk-block-between -->
        </div>
        <div class="card">
            <div class="card-inner">
            </div>
        </div><!-- .card-preview -->
    </div>

@endsection
