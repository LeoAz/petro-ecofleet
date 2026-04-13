@extends('layout.app')
@section('content')
    {{ Breadcrumbs::render('driver') }}
    @include('layout.partials.flash')
    <div class="nk-block-head">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Réparation <strong class="text-primary small">#{{ $repair->code }}</strong></h3>
                <div class="nk-block-des text-soft">
                    <ul class="list-inline">
                        <li>Crée le : <span class="text-base">{{ $repair->date->format('d/m/Y') }}</span></li>
                    </ul>
                </div>
            </div>
            <li class="nk-block-tools-opt">
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle btn btn-sm btn-dim btn-secondary" data-toggle="dropdown">
                        <em class="icon ni ni-opt"></em>
                        <span>Actions</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-left">
                        <ul class="link-list-plain sm">
                            <li>
                                <a href="#">
                                    <em class="icon ni ni-pen"></em>
                                    <span>Modifier</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('maintenance.repair.print', $repair->uuid) }}" target="_blank">
                                    <em class="icon ni ni-printer"></em>
                                    <span>Imprimer</span>
                                </a>
                            </li>
                                <li>
                                    <a href="#"
                                       onclick="event.preventDefault();
                                                   document.getElementById('folder-opened-form').submit();"
                                    >
                                        <em class="icon ni ni-unlock"></em>
                                        <span>Reouvir</span>
                                    </a>
                                    <form id="folder-opened-form"
                                          action="{{ route('maintenance.repair.opened', $repair->uuid) }}" method="post" style="display: none;"
                                    >
                                        <input type="hidden" name="status" value="{{ \App\Enums\Maintenance\RepairStatus::Pending}}">
                                        @csrf
                                        @method('PUT')
                                    </form>
                                </li>
                                <li>
                                    <a href="#"
                                       onclick="event.preventDefault();
                                                   document.getElementById('folder-closed-form').submit();"
                                    >
                                        <em class="icon ni ni-lock"></em>
                                        <span>Clôturer</span>
                                    </a>
                                    <form id="folder-closed-form"
                                          action="{{ route('maintenance.repair.closed', $repair->uuid) }}" method="post" style="display: none;"
                                    >
                                        <input type="hidden" name="status" value="{{ \App\Enums\Maintenance\RepairStatus::Closed }}">
                                        @csrf
                                        @method('PUT')
                                    </form>
                                </li>
                        </ul>
                    </div>
                </div>
            </li>
        </div>
    </div>
    <div class="card">
        <div class="card-inner">
            <div class="nk-block">
                <div class="profile-ud-list">
                    <div class="profile-ud-item">
                        <div class="profile-ud wider">
                            <span class="profile-ud-label">N° Réparation</span>
                            <span class="profile-ud-value">
                                {{ $repair->code }}
                            </span>
                        </div>
                    </div>
                    <div class="profile-ud-item">
                        <div class="profile-ud wider">
                            <span class="profile-ud-label">Date reparation</span>
                            <span class="profile-ud-value">
                                {{ $repair->date->format('d/m/Y')}}
                            </span>
                        </div>
                    </div>
                    <div class="profile-ud-item">
                        <div class="profile-ud wider">
                            <span class="profile-ud-label">Vehicule</span>
                            <span class="profile-ud-value">
                                {{ $repair->vehicle->registration }}
                            </span>
                        </div>
                    </div>
                    <div class="profile-ud-item">
                        <div class="profile-ud wider">
                            <span class="profile-ud-label">Motif de la reparation</span>
                            <span class="profile-ud-value">
                                {{ $repair->motif->description }}
                            </span>
                        </div>
                    </div>
                </div><!-- .profile-ud-list -->
            </div><!-- .nk-block -->
        </div>
    </div>
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h6 class="nk-block-title">
                            <em class="icon ni ni-file-text"></em>
                            Liste pièces de rechange utilisées
                        </h6>
                        <div class="nk-block-des text-soft">
                            <p>Ci-dessous la liste des pièces de rechanges utilisées lors de cette réparation</p>
                        </div>
                    </div>
                </div>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li class="nk-block-tools-opt">
                                <a href="#" class="btn btn-sm btn-sm btn-dim btn-primary" data-toggle="modal" data-target="#create-state">
                                    <em class="icon ni ni-reports"></em>
                                    <span>
                                    Bon de sortie à utiliser
                                </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div>
    @if( $repair->parts->isNotEmpty())
    <div class="card shadow-sm mt-3">
        <div class="nk-tb-list">
            <div class="nk-tb-item nk-tb-head">
                <div class="nk-tb-col"><span>N° Code</span></div>
                <div class="nk-tb-col tb-col-lg"><span>Nom</span></div>
                <div class="nk-tb-col"><span>Quantité</span></div>
                <div class="nk-tb-col"><span>Prix</span></div>
                <div class="nk-tb-col"><span>Prix Total</span></div>
                <div class="nk-tb-col">
                </div>
            </div>
            @foreach( $repair->parts as $detail)
                <div class="nk-tb-item">
                    <div class="nk-tb-col">
                        <div class="align-center">
                                <span class="tb-sub">
                                    <a href="#">
                                        {{ $detail->part->code }}
                                    </a>
                                </span>
                        </div>
                    </div>
                    <div class="nk-tb-col tb-col-lg">
                            <span class="tb-sub">
                                  {{ $detail->part->name }}
                            </span>
                    </div>
                    <div class="nk-tb-col tb-col-lg">
                            <span class="tb-sub">
                                 {{ $detail->qty}}
                            </span>
                    </div>
                    <div class="nk-tb-col tb-col-lg">
                            <span class="tb-sub">
                                  {{ number_format($detail->part->price, 0, ' ', ' ') }}
                            </span>
                    </div>
                    <div class="nk-tb-col">
                        <span>{{ number_format($detail->part->price *  $detail->qty, 0, ' ', ' ' ) }}</span>
                    </div>

                    <div class="nk-tb-col">
                        <div class="tb-odr-btns d-none d-sm-inline">
                            <a href="#" class="btn btn-dim btn-sm btn-danger"
                               onclick="event.preventDefault();
                                   document.getElementById('detail-delete-form{{ $detail->id }}').submit();"
                            >
                                <em class="icon ni ni-trash"></em>
                            </a>
                            <form id="detail-delete-form{{ $detail->id }}"
                                  action="{{ route('maintenance.repair.part.delete', $detail->id) }}" method="post" style="display: none;"
                            >
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endif
    <div class="modal fade" id="create-state">
        <div class="modal-dialog modal-dialog-top modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter des pièces de rechange</h5>
                </div>
                <div class="modal-body">
                    <form id="form-create" action="{{ route('maintenance.repair.part.store', $repair->uuid) }}" method="post">
                        @csrf
                        <div class="preview-block">
                            <div class="row gy-4">
                                <div class="col-sm-12 mb-3">
                                    <div class="form-group">
                                        <div class="example-alert">
                                            <div class="alert alert-pro alert-primary shadow-sm alert-icon bg-blue-dim">
                                                <em class="icon ni ni-alert-circle"></em>
                                                <p>
                                                    Veuillez selectionner le bon de sortie à utiliser, les pieces de ce bon seront directement ajouter à la reparation
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Nom de la pièce</label>
                                        <div class="form-control-wrap" data-placeholder = "selectioner la pièce">
                                            <select  name="exit_voucher_id" class="form-select @error('exit_voucher_id') error @enderror" id="default-03" data-search="on">
                                                @foreach( $exits as  $exit)
                                                    <option value="{{ $exit->id }}">{{ $exit->code }} - {{ $exit ? $exit->date->format('d/m/Y'): '-' }}</option>
                                                @endforeach
                                            </select>
                                            @error('exit_voucher_id')
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
                    <button form="form-create" type="submit" class="btn btn-sm btn-primary float-right">
                        <em class="icon ni ni-save"></em>
                        <span>Enregister</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
