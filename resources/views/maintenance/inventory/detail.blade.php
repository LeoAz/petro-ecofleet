@extends('layout.app')
@section('content')
    {{ Breadcrumbs::render('driver') }}
    @include('layout.partials.flash')
    <div class="nk-block nk-block-lg">
        <div class="nk-block-head-sub mb-5">
            <a class="back-to page-title" href="{{ route('maintenance.inventory.index') }}">
                <em class="icon ni ni-arrow-left"></em>
                <span>Retour inventaire</span>
            </a>
        </div>
        <div class="nk-block-head nk-block-head-sm">
            <div class="card">
                <div class="card-inner">
                    <div class="nk-block">
                        <div class="profile-ud-list">
                            <div class="profile-ud-item">
                                <div class="profile-ud wider">
                                    <span class="profile-ud-label">Date</span>
                                    <span class="profile-ud-value">
                                            {{ $inventory->date_inventory->format('d/m/Y') }}
                                        </span>
                                </div>
                            </div>
                            <div class="profile-ud-item">
                                <div class="profile-ud wider">
                                    <span class="profile-ud-label">Description</span>
                                    <span class="profile-ud-value">
                                            {{ $inventory->description }}
                                        </span>
                                </div>
                            </div>
                            <div class="profile-ud-item">
                                <div class="profile-ud wider">
                                    <span class="profile-ud-label">Status</span>
                                    <span class="profile-ud-value">
                                        @include('layout.partials.enum.maintenance.InventoryStatus', ['status' => $inventory->status])
                                    </span>
                                </div>
                            </div>
                        </div><!-- .profile-ud-list -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-4">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h5 class="nk-block-title">
                                Saisir les détails de l'inventaire
                            </h5>
                            <div class="nk-block-des text-soft">
                                <p>Veuillez saisir la pièce ainsi que la quantité physique</p>
                            </div>
                        </div>
                    </div><!-- .nk-block-between -->
                </div>
                <div class="card shadow-sm">
                    <div class="card-inner">
                        <div class="card-inner">
                            <form id="form-create" action="{{ route('maintenance.inventory.create-detail', $inventory->uuid) }}" method="post">
                                @csrf
                                <div class="preview-block">
                                    <div class="row gy-4">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <div class="form-control-wrap ">
                                                    <label class="form-label" for="default-01">La pièce</label>
                                                    <select name="part_id" class="form-select" data-placeholder = "Séléctionnez la pièce" data-search="on">
                                                        @foreach( $parts as  $part )
                                                            <option value="{{ $part->id }}">{{ $part->reference }} - {{ $part->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('part_id')
                                                    <span class="sub-text-sm text-danger ff-italic">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <label class="form-label" for="default-02">Quantité réelle</label>
                                                    <input name="real_qty" type="text" class="form-control @error('real_qty') error @enderror" id="default-02" placeholder="Quantité réelle">
                                                    @error('real_qty')
                                                    <span class="invalid">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <label class="form-label" for="default-02">Observation</label>
                                                    <textarea name="observation" type="text" class="form-control @error('observation') error @enderror" id="default-03"></textarea>
                                                    @error('observation')
                                                    <span class="invalid">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="mt-2">
                                <button form="form-create" type="submit" class="btn btn-sm btn-primary float-right">
                                    <em class="icon ni ni-save"></em>
                                    <span>Enregister</span>
                                </button>
                            </div>

                        </div>
                    </div>
                </div><!-- .card-preview -->
            </div>
            <div class="col-8">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h5 class="nk-block-title">
                               Details de l'inventaire
                            </h5>
                            <div class="nk-block-des text-soft">
                                <p>Ci-dessous le details des inspections</p>
                            </div>
                        </div><div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a href="{{ route('maintenance.inventory.print-part', $inventory->uuid) }}" class="btn btn-sm btn-dim btn-primary" target="_blank">
                                                <em class="icon ni ni-printer"></em>
                                                <span> Imprimer liste pièces</span>
                                            </a>
                                        </li>
                                        @if($inventory->status != \App\Enums\Maintenance\InventoryStatus::Closed)
                                            <li class="nk-block-tools-opt">
                                                <a href="#" class="btn btn-sm btn-dim btn-secondary"
                                                   onclick="event.preventDefault();
                                               document.getElementById('folder-closed-form').submit();"
                                                >
                                                    <em class="icon ni ni-lock"></em>
                                                    <span> Clôturer inventaire</span>
                                                </a>
                                                <form id="folder-closed-form"
                                                      action="{{ route('maintenance.inventory.closed-inventory', $inventory->uuid) }}" method="post" style="display: none;"
                                                >
                                                    @csrf
                                                    @method('PUT')
                                                </form>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div><!-- .toggle-wrap -->
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div>
                <div class="card shadow-sm">
                    <div class="card-inner">
                        <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                            <thead>
                            <tr class="nk-tb-item nk-tb-head">
                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">Réference</span></th>
                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">Pièce</span></th>
                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">Qté théorique</span></th>
                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">Qté réelle</span></th>
                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">Ecart</span></th>
                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">Observation</span></th>
                                <th class="nk-tb-col tb-col-mb"><span class="sub-text"></span>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $inventory->details->sortByDesc('created_at') as $detail )
                                <tr class="nk-tb-item">
                                    <td class="nk-tb-col">
                                        <div class="user-card">
                                            <div class="user-info">
                                            <span class="tb-lead">
                                                {{ $detail->part->reference ?? '-' }}
                                            </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span>{{ $detail->part->name }}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span>{{ $detail->theoriq_qty }}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span>{{ $detail->real_qty }}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span>{{ $detail->ecart }}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span>{{ $detail->observation }}</span>
                                    </td>
                                    <td class=" nk-tb-col tb-odr-action">
                                        @if($inventory->status != \App\Enums\Maintenance\InventoryStatus::Closed)
                                            <div class="tb-odr-btns d-none d-sm-inline">
                                                <a href="#" class="btn btn-dim btn-sm btn-danger"
                                                   onclick="event.preventDefault();
                                               document.getElementById('detail-delete-form{{ $detail->id }}').submit();"
                                                >
                                                    <em class="icon ni ni-cross"></em>
                                                </a>
                                                <form id="detail-delete-form{{ $detail->id }}"
                                                      action={{ route('maintenance.inventory.detail-delete', [$inventory->uuid, $detail->id]) }} method="post" style="display: none;"
                                                >
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        @endif
                                    </td>
                                </tr><!-- .nk-tb-item  -->
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!-- .card-preview -->
            </div>
        </div>
    </div>
@stop
