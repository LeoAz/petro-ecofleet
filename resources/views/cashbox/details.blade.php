@extends('layout.app')
@section('content')
    {{ Breadcrumbs::render('driver') }}
    @include('layout.partials.flash')
    <div class="nk-block-head-sub mb-5">
        <a class="back-to" href="{{ route('cashbox.index') }}">
            <em class="icon ni ni-arrow-left"></em>
            <span style="font-size: 25px">Retour Caisse</span>
        </a>
    </div>
    <div class="nk-block-between mb-3">
        <div class="nk-block-head-content">
            <h6 class="title">
                <em class="icon ni ni-file-text"></em>
                Situation des opérations de la caisse du {{ $box->start_at->format('d/m/Y') }}
            </h6>
            <p>Ci-dessous les listes des opérations effectués</p>
        </div>
        <!-- .nk-block-head-content -->
        <div class="nk-block-head-content">
            <div class="toggle-wrap nk-block-tools-toggle">
                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em
                        class="icon ni ni-menu-alt-r"></em></a>
                <div class="toggle-expand-content" data-content="pageMenu">
                    <ul class="nk-block-tools g-3">
                        @if( ! $box->status == \App\Enums\CashboxStatus::Closed)
                            <li class="nk-block-tools-opt">
                                <a href="#" class="btn btn-sm btn-dim btn-primary"
                                   data-toggle="modal" data-target="#create-state"
                                >
                                    <em class="icon ni ni-coin"></em>
                                    <span> Appro caisse</span>
                                </a>
                            </li>
                            <li class="nk-block-tools-opt">
                                <a href="#" class="btn btn-sm btn-info"
                                   data-toggle="modal" data-target="#create-out"
                                >
                                    <em class="icon ni ni-coin"></em>
                                    <span>Autre décaissement</span>
                                </a>
                            </li>
                            <li class="nk-block-tools-opt">
                                <a href="{{ route('cashbox.operation', $box->uuid) }}"
                                   class="btn btn-sm btn-dim btn-primary" target="_blank">
                                    <em class="icon ni ni-coins"></em>
                                    <span> Effectuer des paiements</span>
                                </a>
                            </li>
                            <li class="nk-block-tools-opt">
                                <a href="#" class="btn btn-sm btn-dim btn-danger"
                                   onclick="event.preventDefault();
                                   document.getElementById('closed-form').submit();"
                                >
                                    <em class="icon ni ni-lock"></em>
                                    <span> Clôturer la caisse</span>
                                </a>
                                <form id="closed-form" action="{{ route('cashbox.box-closed', $box->uuid) }}" method="post">
                                    @csrf
                                </form>
                            </li>
                        @endif
                    </ul>
                </div>
            </div><!-- .toggle-wrap -->
        </div><!-- .nk-block-head-content -->
    </div>
    <div class="row g-gs">
        <div class="col-sm-8">
            <div class="card shadow-sm">
                <div class="card-inner">
                    <div class="nk-block">
                        <div class="profile-ud-list">
                            <div class="profile-ud-item">
                                <div class="profile-ud wider">
                                    <span class="profile-ud-label">Date ouverture</span>
                                    <span class="profile-ud-value">
                                    </span>
                                    {{ $box->start_at->format('d/m/Y') }}
                                </div>
                            </div>
                            <div class="profile-ud-item">
                                <div class="profile-ud wider">
                                    <span class="profile-ud-label">Date clôture</span>
                                    <span class="profile-ud-value">
                                    </span>
                                    {{ $box->end_at ? $box->end_at->format('d/m/Y') : '-' }}
                                </div>
                            </div>
                            <div class="profile-ud-item">
                                <div class="profile-ud wider">
                                    <span class="profile-ud-label">Status</span>
                                    <span class="profile-ud-value">
                                    </span>
                                    @include('layout.partials.enum.Fleet.CashboxStatus', ['status' => $box->status])
                                </div>
                            </div>
                            <div class="profile-ud-item">
                                <div class="profile-ud wider">
                                    <span class="profile-ud-label">Nbre d'opérations</span>
                                    <span class="profile-ud-value">
                                    </span>
                                    <span class="badge badge-dim badge-primary">{{ $box->operations->count() }}</span>
                                </div>
                            </div>
                        </div><!-- .profile-ud-list -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="col-sm-12">
                <div class="card shadow-sm">
                    <div class="nk-tb-list is-loose">
                        <div class="nk-tb-item nk-tb-head">
                            <div class="nk-tb-col"><span>Libellé</span></div>
                            <div class="nk-tb-col tb-col-sm text-right"><span>Montant</span></div>
                        </div><!-- .nk-tb-head -->
                        <div class="nk-tb-item">
                            <div class="nk-tb-col">
                                <div class="icon-text">
                                    <span class="tb-lead">Solde départ</span>
                                </div>
                            </div>
                            <div class="nk-tb-col tb-col-sm text-right">
                                <span class="tb-sub fw-bold text-danger">
                                    {{ number_format($box->start_solde,0, ' ', ' ')}} CFA
                                </span>
                            </div>
                        </div><!-- .nk-tb-item -->
                        <div class="nk-tb-item">
                            <div class="nk-tb-col">
                                <div class="icon-text">
                                    <span class="tb-lead">Total Appros</span>
                                </div>
                            </div>
                            <div class="nk-tb-col tb-col-sm text-right">
                                <span class="tb-sub fw-bold text-orange">
                                    {{ number_format($box->total_appros,0, ' ', ' ')}} CFA
                                </span>
                            </div>
                        </div><!-- .nk-tb-item -->
                        <div class="nk-tb-item">
                            <div class="nk-tb-col">
                                <div class="icon-text">
                                    <span class="tb-lead">Total dépenses</span>
                                </div>
                            </div>
                            <div class="nk-tb-col tb-col-sm text-right">
                                <span class="tb-sub fw-bold text-teal">
                                    {{ number_format($box->total_expenses,0, ' ', ' ')}} CFA
                                </span>
                            </div>
                        </div><!-- .nk-tb-item -->
                        <div class="nk-tb-item">
                            <div class="nk-tb-col">
                                <div class="icon-text">
                                    <span class="tb-lead">Solde caisse</span>
                                </div>
                            </div>
                            <div class="nk-tb-col tb-col-sm text-right">
                                <span class="tb-sub fw-bold text-teal">
                                    {{ number_format($box->solde,0, ' ', ' ')}} CFA
                                </span>
                            </div>
                        </div><!-- .nk-tb-item -->
                    </div><!-- .nk-tb-list -->
                </div>
            </div>
        </div>
    </div>

    <div class="nk-block-between mt-5 mb-3">
        <div class="nk-block-head-content">
            <div class="toggle-wrap nk-block-tools-toggle">
                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em
                        class="icon ni ni-menu-alt-r"></em></a>
                <div class="toggle-expand-content" data-content="pageMenu">
                    <ul class="nk-block-tools g-3">
                            <li class="nk-block-tools-opt">
                                <a href="{{ route('cashbox.operation-print', $box->uuid) }}" class="btn btn-sm btn-dim btn-danger" target="_blank">
                                    <em class="icon ni ni-printer"></em>
                                    <span> IMPRIMER LES OPERATIONS DU JOUR</span>
                                </a>
                            </li>
                            <li class="nk-block-tools-opt">
                                <a href="#" class="btn btn-sm btn-dim btn-primary"
                                   data-toggle="modal" data-target="#export-type"
                                >
                                    <em class="icon ni ni-printer"></em>
                                    <span> IMPRIMER LES OPERATIONS PAR TYPE</span>
                                </a>
                            </li>
                            <li class="nk-block-tools-opt">
                                <a href="{{ route('cashbox.operation-export', $box->uuid) }}" class="btn btn-sm btn-success">
                                    <em class="icon ni ni-file-xls"></em>
                                    <span>EXPORTER EN EXCEL</span>
                                </a>
                            </li>
                    </ul>
                </div>
            </div><!-- .toggle-wrap -->
        </div><!-- .nk-block-head-content -->
    </div>
    <div class="card shadow-sm mt-3">
        <div class="card-inner">
            <ul class="nav nav-tabs mt-n3">
                <li class="nav-item ">
                    <a class="nav-link active" data-toggle="tab" href="#tabItem6">
                        <em class="icon ni ni-hot"></em>
                        <span>Liste des opérations</span>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tabItem6">
                    <div class="col-sm-12 mt-5">
                        <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                            <thead>
                            <tr class="nk-tb-item nk-tb-head">
                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">Date</span></th>
                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">Type</span></th>
                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">Vehicule</span></th>
                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">Chauffeur</span></th>
                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">Type dépense</span></th>
                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">Motif</span></th>
                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">Montant</span></th>
                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">Béneficiare</span></th>
                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">Description</span></th>
                                <th class="nk-tb-col nk-tb-col-tools text-right">
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                        @foreach( $box->operations->sortByDesc('created_at') as $op)
                            <tr>
                                <td class="nk-tb-col tb-col-md">
                                    <span>{{ $op->paid_at->format('d/m/Y') }}</span>
                                </td>
                                <td class="nk-tb-col tb-col-md">
                                    @include('layout.partials.enum.Fleet.OpType', ['type' => $op->op_type])
                                </td>
                                <td class="nk-tb-col tb-col-md">
                                    <span>{{ $op->vehicle }}</span>
                                </td>
                                <td class="nk-tb-col tb-col-md">
                                    <span>{{ $op->driver }}</span>
                                </td>
                                <td class="nk-tb-col tb-col-md">
                                    <span>{{ $op->type_expense }}</span>
                                </td>
                                <td class="nk-tb-col tb-col-md">
                                    <span>{{ $op->motif }}</span>
                                </td>
                                <td class="nk-tb-col tb-col-md">
                                    <span>{{ number_format($op->amount,0,'',' ') }}</span>
                                </td>
                                <td class="nk-tb-col tb-col-md">
                                    <span>{{ $op->beneficiary }}</span>
                                </td>
                                <td class="nk-tb-col tb-col-md">
                                    <span>{{ $op->description }}</span>
                                </td>
                                <td class="nk-tb-col nk-tb-col-tools">
                                    <ul class="nk-tb-actions gx-1">
                                        <li>
                                            <div class="dropdown">
                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-left">
                                                    <ul class="link-list-plain sm">
                                                        <li>
                                                            <a href="{{ route('cashbox.operation-edit', [$box->uuid, $op->uuid]) }}"><em class="icon ni ni-file-text"></em>
                                                                <span>Modifier</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('cashbox.op-print', [$box->uuid, $op->uuid]) }}" target="_blank">
                                                                <em class="icon ni ni-printer"></em>
                                                                <span> Imprimer l'operation</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
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
    <div class="modal fade" tabindex="-1" id="create-state">
        <div class="modal-dialog modal-dialog-top modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
                <div class="modal-header">
                    <h5 class="modal-title">Approvisionnement de la caisse </h5>
                </div>
                <div class="modal-body">
                    <form id="form-create" action="{{ route('cashbox.box-appro', $box->uuid) }}" method="post">
                        @csrf
                        <div class="preview-block">
                            <div class="row gy-4">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Le montant</label>
                                        <div class="form-control-wrap">
                                            <input name="amount" type="text" class="form-control @error('amount') error @enderror" id="default-01" placeholder="Le montant"
                                                   value="{{ old('amount') }}"
                                            >
                                            @error('amount')
                                            <span class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Motif</label>
                                        <div class="form-control-wrap">
                                            <input name="motif" type="text" class="form-control @error('motif') error @enderror" id="default-01" placeholder="Le motif"
                                                   value="{{ old('motif') }}"
                                            >
                                            @error('motif')
                                            <span class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">La description</label>
                                        <div class="form-control-wrap">
                                            <input name="description" type="text" class="form-control @error('description') error @enderror" id="default-01" placeholder="La description"
                                                   value="{{ old('description') }}"
                                            >
                                            @error('description')
                                            <span class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <button class="btn btn-sm btn-secondary float-right" data-dismiss="modal">
                        <em class="icon ni ni-cross-circle"></em>
                        <span>Fermer</span>
                    </button>
                    <button form="form-create" type="submit" class="btn btn-sm btn-primary float-right">
                        <em class="icon ni ni-save"></em>
                        <span>Enregister</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="create-out">
        <div class="modal-dialog modal-dialog-top modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
                <div class="modal-header">
                    <h5 class="modal-title">RETRAIT DE CAISSE</h5>
                </div>
                <div class="modal-body">
                    <form id="form-out" action="{{ route('cashbox.box-out', $box->uuid) }}" method="post">
                        @csrf
                        <div class="preview-block">
                            <div class="row gy-4">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Le montant</label>
                                        <div class="form-control-wrap">
                                            <input name="amount" type="text" class="form-control @error('amount') error @enderror" id="default-01" placeholder="Le montant"
                                                   value="{{ old('amount') }}"
                                            >
                                            @error('amount')
                                            <span class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">le bénéficiare</label>
                                        <div class="form-control-wrap">
                                            <input name="beneficiary" type="text" class="form-control @error('beneficiary') error @enderror" id="default-01" placeholder="Le bénéficiaire"
                                                   value="{{ old('beneficiary') }}"
                                            >
                                            @error('beneficiary')
                                            <span class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">La description</label>
                                        <div class="form-control-wrap">
                                            <input name="description" type="text" class="form-control @error('description') error @enderror" id="default-01" placeholder="La description"
                                                   value="{{ old('description') }}"
                                            >
                                            @error('description')
                                            <span class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <button class="btn btn-sm btn-secondary float-right" data-dismiss="modal">
                        <em class="icon ni ni-cross-circle"></em>
                        <span>Fermer</span>
                    </button>
                    <button form="form-out" type="submit" class="btn btn-sm btn-primary float-right">
                        <em class="icon ni ni-save"></em>
                        <span>Enregister</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="export-type">
        <div class="modal-dialog modal-dialog-top modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
                <div class="modal-header">
                    <h5 class="modal-title">IMPRIMER LES OPERATION DE CAISSE</h5>
                </div>
                <div class="modal-body">
                    <form id="exportType" action="{{ route('cashbox.print_exploitation-type', $box->uuid) }}" method="post" target="_blank">
                        @csrf
                        <div class="preview-block">
                            <div class="row gy-4">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Le Type de dépense</label>
                                        <div class="form-control-wrap">
                                            <select name="expense" class="form-select" data-placeholder = "selectioner le type de dépense">
                                                <option></option>
                                                @foreach( $types as $key => $value)
                                                    <option value="{{ $value }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                            @error('usage')
                                            <span class="sub-text-sm text-danger ff-italic">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <button class="btn btn-sm btn-secondary float-right" data-dismiss="modal">
                        <em class="icon ni ni-cross-circle"></em>
                        <span>Fermer</span>
                    </button>
                    <button form="exportType" type="submit" class="btn btn-sm btn-primary float-right">
                        <em class="icon ni ni-printer"></em>
                        <span>Imprimer</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@stop
