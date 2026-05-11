@extends('layout.app')
@section('content')
    @include('layout.partials.flash')
    <div class="nk-block-head">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                {{ Breadcrumbs::render('warehouse') }}
                <h3 class="nk-block-title page-title">Bon de commande <strong class="text-primary small">#{{ $order->code }}</strong></h3>
                <div class="nk-block-des text-soft">
                    <ul class="list-inline">
                        <li>Crée le : <span class="text-base">{{ $order->date->format('d/m/Y') }}</span></li>
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
                                <a href="{{ route('maintenance.warehouse.order.print', $order->uuid)  }}" target="_blank">
                                    <em class="icon ni ni-printer"></em>
                                    <span>Imprimer</span>
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                   onclick="event.preventDefault();
                                   document.getElementById('folder-closed-form').submit();"
                                >
                                    <em class="icon ni ni-check"></em>
                                    <span>Valider</span>
                                </a>
                                <form id="folder-closed-form"
                                      action="{{ route('maintenance.warehouse.order.validated', $order->uuid) }}" method="post" style="display: none;"
                                >
                                    <input type="hidden" name="status" value="{{ \App\Enums\Maintenance\OrderStatus::Validated }}">
                                    @csrf
                                    @method('PUT')
                                </form>
                            </li>
                            <li>
                                <a href="#"
                                   onclick="event.preventDefault();
                                   document.getElementById('folder-canceled-form').submit();"
                                >
                                    <em class="icon ni ni-cross-c"></em>
                                    <span>Annuler</span>
                                </a>
                                <form id="folder-canceled-form"
                                      action="{{ route('maintenance.warehouse.order.canceled', $order->uuid) }}" method="post" style="display: none;"
                                >
                                    <input type="hidden" name="status" value="{{ \App\Enums\Maintenance\OrderStatus::Canceled }}">
                                    @csrf
                                    @method('PUT')
                                </form>
                            </li>
                            <li>
                                <a href="#"
                                   onclick="event.preventDefault();
                                   document.getElementById('folder-received-form').submit();"
                                >
                                    <em class="icon ni ni-package"></em>
                                    <span>Receptioner</span>
                                </a>
                                <form id="folder-received-form"
                                      action="{{ route('maintenance.warehouse.order.received', $order->uuid) }}" method="post" style="display: none;"
                                >
                                    <input type="hidden" name="status" value="{{ \App\Enums\Maintenance\OrderStatus::Received }}">
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
                            <span class="profile-ud-label">N° Bon de commande</span>
                            <span class="profile-ud-value">
                                {{ $order->code }}
                            </span>
                        </div>
                    </div>
                    <div class="profile-ud-item">
                        <div class="profile-ud wider">
                            <span class="profile-ud-label">Date</span>
                            <span class="profile-ud-value">
                                {{ $order->date->format('d/m/Y')}}
                            </span>
                        </div>
                    </div>
                    <div class="profile-ud-item">
                        <div class="profile-ud wider">
                            <span class="profile-ud-label">Fournisseur</span>
                            <span class="profile-ud-value">
                                {{ $order->provider->name }}
                            </span>
                        </div>
                    </div>
                    <div class="profile-ud-item">
                        <div class="profile-ud wider">
                            <span class="profile-ud-label">Status</span>
                            <span class="profile-ud-value">
                                {{ \App\Enums\Maintenance\OrderStatus::getDescription($order->status) }}
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
                            Liste pièces de rechange à commander
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
                                <a href="#" class="btn btn-sm btn-dim btn-primary" data-toggle="modal" data-target="#create-state">
                                    <em class="icon ni ni-reports"></em>
                                    <span>
                                    Ajouter des pièces de rechanges
                                </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div>
    <div class="card shadow-sm mt-3">
        <div class="nk-tb-list">
            <div class="nk-tb-item nk-tb-head">
                <div class="nk-tb-col"><span>N° Code</span></div>
                <div class="nk-tb-col tb-col-lg"><span>Nom</span></div>
                <div class="nk-tb-col tb-col-lg"><span>Reference</span></div>
                <div class="nk-tb-col"><span>Quantité</span></div>
                <div class="nk-tb-col"><span>Prix</span></div>
                <div class="nk-tb-col"><span>Prix Total</span></div>
                <div class="nk-tb-col">
                </div>
            </div>
            @foreach( $order->parts as $detail)
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
                                {{ $detail->part->reference ?? '-' }}
                            </span>
                    </div>
                    <div class="nk-tb-col tb-col-lg">
                            <span class="tb-sub">
                                 {{ $detail->qty }}
                            </span>
                    </div>
                    <div class="nk-tb-col tb-col-lg">
                            <span class="tb-sub">
                                {{ $detail->unit_price }}
                            </span>
                    </div>
                    <div class="nk-tb-col">
                        <span>{{ number_format($detail->amount, 0, ' ', ' ' ) }}</span>
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
                                  action="{{ route('maintenance.warehouse.order.part.delete', $detail->id)}}" method="post" style="display: none;"
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
                    <form id="form-create" action="{{ route('maintenance.warehouse.order.part.store', $order->uuid) }}" method="post">
                        @csrf
                        <div class="preview-block">
                            <div class="row gy-4">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Nom de la pièce</label>
                                        <div class="form-control-wrap" data-placeholder = "selectioner la pièce">
                                            <select  name="part_id" class="form-select @error('part_id') error @enderror" id="default-03" data-search="on">
                                                @foreach( $parts as  $part)
                                                    <option value="{{ $part->id }}">{{ $part->reference }} - {{ $part->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('part_id')
                                            <span class="sub-text-sm text-danger ff-italic">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Quantité utilisé</label>
                                        <div class="form-control-wrap">
                                            <input name="qty" type="text" class="form-control @error('qty') error @enderror" id="default-01" placeholder="Quantité" value="{{ old('qty') }}">
                                            @error('qty')
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
@endsection
