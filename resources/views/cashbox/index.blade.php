@extends('layout.app')
@section('content')
    @include('layout.partials.flash')
    <div class="nk-block nk-block-lg">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    {{ Breadcrumbs::render('cashbox') }}
                    <h5 class="nk-block-title">
                        <em class="icon ni ni-file-text"></em>
                        Liste des arretés de caisse
                    </h5>
                    <div class="nk-block-des text-soft">
                        <p>Ci-dessous un listing de l'ensemble des arrêtés de caisse disponible dans la base de donnée</p>
                    </div>
                </div>
                @if( $latest_box->isEmpty() )
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                            <div class="toggle-expand-content" data-content="pageMenu">
                                <ul class="nk-block-tools g-3">
                                    <li class="nk-block-tools-opt">
                                        <a href="#" class="btn btn-sm btn-dim btn-primary"
                                           data-toggle="modal" data-target="#create-state">
                                            <em class="icon ni ni-plus"></em>
                                            <span> Ouvrir la caisse du jour</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- .toggle-wrap -->
                    </div><!-- .nk-block-head-content -->
                @endif

            </div><!-- .nk-block-between -->
        </div>
        <div class="card shadow-sm">
            <div class="card-inner">
                <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                    <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col"><span class="sub-text">Date ouverture</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Date Clôture</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Solde départ</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Total appro</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Total dépenses</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Solde arrêt</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Status</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-right">
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $boxes as $box )
                        <tr class="nk-tb-item">
                            <td class="nk-tb-col tb-col-md">
                                <span> {{ $box->start_at->format('d/m/Y') }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span> {{ $box->end_at ? $box->end_at->format('d/m/Y') : '-' }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span> {{ number_format($box->start_solde,0, ' ', ' ')}}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span> {{ $box->total_appros }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span> {{ $box->total_expenses }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span> {{ $box->solde }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                @include('layout.partials.enum.Fleet.CashboxStatus', ['status' => $box->status])
                            </td>
                            <td class=" nk-tb-col tb-odr-action">
                                <div class="tb-odr-btns d-none d-sm-inline">
                                    <a href="{{ route('cashbox.detail', $box->uuid) }}" class="btn btn-dim btn-sm btn-primary">
                                        <em class="icon ni ni-files"></em>
                                        <span>Opérations</span>
                                    </a>
                                </div>
                                <div class="tb-odr-btns d-none d-sm-inline">
                                    <a href="#" class="btn btn-dim btn-sm btn-danger"
                                       onclick="event.preventDefault();
                                               document.getElementById('expense-delete-form{{$box->id}}').submit();"
                                    >
                                        <em class="icon ni ni-trash"></em>
                                    </a>
                                    <form id="expense-delete-form{{$box->id}}"
                                          action="#" method="post" style="display: none;"
                                    >
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr><!-- .nk-tb-item  -->
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div><!-- .card-preview -->
    </div>

    <div class="modal fade" tabindex="-1" id="create-state">
        <div class="modal-dialog modal-dialog-top modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
                <div class="modal-header">
                    <h5 class="modal-title">Ouvrir la caisse du jour</h5>
                </div>
                <div class="modal-body">
                    <form id="form-create" action="{{ route('cashbox.store') }}" method="post">
                        @csrf
                        <div class="preview-block">
                            <div class="row gy-4">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Montant du solde de départ</label>
                                        <div class="form-control-wrap">
                                            <input name="start_solde" type="text" class="form-control @error('start_solde') error @enderror" id="default-01" placeholder="solde de départ"
                                                   value="{{ old('start_solde') }}"
                                            >
                                            @error('start_solde')
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
@stop
