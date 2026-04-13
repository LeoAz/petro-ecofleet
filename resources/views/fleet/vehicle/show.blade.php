@extends('layout.app')
@section('content')
    {{ Breadcrumbs::render('vehicle-show', $vehicle) }}
    @include('layout.partials.flash')
    <div class="nk-block-between">
    <div class="nk-block-head-content mb-3">
        <h6 class="title">
            <em class="icon ni ni-unlink"></em>
            Details du vehicule
        </h6>
        <p>Ci-dessous les informations detaillé du vehicule</p>
    </div>
    <!-- .nk-block-head-content -->
    <div class="nk-block-head-content">
        <div class="toggle-wrap nk-block-tools-toggle">
            <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
            <div class="toggle-expand-content" data-content="pageMenu">
                <ul class="nk-block-tools g-3">
                    <li class="nk-block-tools-opt">
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-opt"></em></a>
                            <div class="dropdown-menu dropdown-menu-left">
                                <ul class="link-list-plain sm">
                                    @if( $vehicle->is_linked == false )
                                    <li>
                                        <a href="#" data-toggle="modal" data-target="#create-state">
                                            <em class="icon ni ni-unlink"></em>
                                            <span>Lier une remorque</span>
                                        </a>
                                    </li>
                                    @else
                                    <li>
                                        <a href="#"
                                           onclick="event.preventDefault();
                                           document.getElementById('revoke-link-form').submit();"
                                        >
                                            <em class="icon ni ni-signout"></em>
                                            <span>Retirer la remorque</span>
                                        </a>
                                        <form id="revoke-link-form" action="{{ route('fleet.link.revoke', $vehicle->uuid) }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                    @endif
                                        <a href="{{ route('fleet.driver.index') }}">
                                            <em class="icon ni ni-user-add"></em>
                                            <span>Lier un chauffeur</span>
                                        </a>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="nk-block-tools-opt">
                        <a href="{{ route('fleet.vehicle.edit', $vehicle->uuid) }}" class="btn btn-sm btn-warning">
                            <em class="icon ni ni-pen2"></em>
                            <span> Modifier le véhicule</span>
                        </a>
                    </li>
                    <li class="nk-block-tools-opt">
                        <a href="#" class="btn btn-sm btn-danger">
                            <em class="icon ni ni-trash"></em>
                            <span> Supprimer le véhicule</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div><!-- .toggle-wrap -->
    </div><!-- .nk-block-head-content -->
</div>
    <div class="row g-gs">
            <div class="col-sm-6">
                <div class="card shadow-sm">
                    <div class="card-inner">
                        <div class="nk-block">
                            <div class="profile-ud-list">
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">N° Immatriculation</span>
                                        <span class="profile-ud-value">{{ $vehicle->registration ?? '-' }}</span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">N° Chassis</span>
                                        <span class="profile-ud-value">{{ $vehicle->chassis ?? '-' }}</span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Code Véhicle</span>
                                        <span class="profile-ud-value">{{ $vehicle->code_vehicle ?? '-' }}</span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Marque</span>
                                        <span class="profile-ud-value">
                                            {{ $vehicle->brand ? $vehicle->brand->name : '-' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Type</span>
                                        <span class="profile-ud-value">
                                            {{ \App\Enums\Fleet\VehicleType::getDescription($vehicle->type) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Model</span>
                                        <span class="profile-ud-value">{{ $vehicle->pattern ? $vehicle->pattern->name : '-'}}</span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Carburant</span>
                                        <span class="profile-ud-value">{{ $vehicle->fuel ?? '-'}}</span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Etat</span>
                                        <span class="profile-ud-value">
                                            {{ \App\Enums\Fleet\FleetState::getDescription($vehicle->state) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Utilisation</span>
                                        <span class="profile-ud-value">
                                            {{ \App\Enums\Fleet\FleetUsage::getDescription($vehicle->usage) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Nombre place</span>
                                        <span class="profile-ud-value">{{ $vehicle->number_places ?? '-'}}</span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Nom du chauffeur</span>
                                    <span class="profile-ud-value">{{ $vehicle->activeDriver ? $vehicle->activeDriver->driver->name : '-'}}</span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Remorque</span>
                                        <span class="profile-ud-value">{{ $vehicle->activeTrailer->trailer->registration ?? '-'}}</span>
                                    </div>
                                </div>
                            </div><!-- .profile-ud-list -->
                        </div><!-- .nk-block -->
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card shadow-sm">
                    <div class="card-inner">
                        <div class="nk-block">
                            <div class="profile-ud-list">
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Poids à vide (Tonnes)</span>
                                        <span class="profile-ud-value">{{ $vehicle->empty_weight ?? '-' }}</span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Capacité </span>
                                        <span class="profile-ud-value">{{ $vehicle->capacity ?? '-' }}</span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Kilométrage</span>
                                        <span class="profile-ud-value">{{ $vehicle->mileage ?? '-' }}</span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Consommation (L/100km)</span>
                                        <span class="profile-ud-value">{{ $vehicle->consumption ?? '-' }}</span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Puissance (Ch)</span>
                                        <span class="profile-ud-value">{{ $vehicle->power ?? '-'}}</span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Mise en circulation</span>
                                        <span class="profile-ud-value">{{ $vehicle->commissioning_date ? $vehicle->commissioning_date->format('d/m/Y') : '-'}}</span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Prix d'acquisition</span>
                                        <span class="profile-ud-value">{{ $vehicle->acquisition_amount ?? '-'}}</span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Attélé</span>
                                        <span class="profile-ud-value">
                                             @if( $vehicle->is_linked )
                                                <span>
                                                    <em class="icon ni ni-check-circle-fill text-success fs-22px"></em>
                                                </span>
                                            @else
                                                <span>
                                                    <em class="icon ni ni-cross-circle-fill text-danger fs-22px "></em>
                                                </span>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Status</span>
                                        <span class="profile-ud-value">
                                            @include('layout.partials.enum.Fleet.vehicleStatus', ['status' => $vehicle->status])
                                        </span>
                                    </div>
                                </div>
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Chauffeur</span>
                                        <span class="profile-ud-value">
                                            @if( $vehicle->has_driver )
                                                <span>
                                                    <em class="icon ni ni-check-circle-fill text-success fs-22px"></em>
                                                </span>
                                            @else
                                                <span>
                                                    <em class="icon ni ni-cross-circle-fill text-danger fs-22px "></em>
                                                </span>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div><!-- .profile-ud-list -->
                        </div><!-- .nk-block -->
                    </div>
                </div>
            </div>
        </div>
    @if( $vehicle->is_linked == true || $vehicle->activeTrailer != null || $vehicle->has_driver== true || $vehicle->activedriver != null)
    <div class="card shadow-sm mt-5"->
        <div class="card-inner">
            <ul class="nav nav-tabs mt-n3">
                @if( $vehicle->is_linked == true || $vehicle->activeTrailer != null )
                <li class="nav-item ">
                    <a class="nav-link active" data-toggle="tab" href="#tabItem6"><em class="icon ni ni-link"></em><span>Attélage Tracteur - Citernne/Remorque</span></a>
                </li>
                @endif
                @if( $vehicle->has_driver== true || $vehicle->activedriver != null )
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tabItem7"><em class="icon ni ni-users"></em><span>Attribution chauffeur</span></a>
                </li>
                @endif
            </ul>
            <div class="tab-content">
                @if( $vehicle->is_linked == true || $vehicle->activeTrailer != null )
                <div class="tab-pane active" id="tabItem6">
                    <div class="col-sm-12 mt-5">
                        <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                            <thead>
                            <tr class="nk-tb-item nk-tb-head">
                                <th class="nk-tb-col nk-tb-col-check">
                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                        <input type="checkbox" class="custom-control-input" id="uid">
                                        <label class="custom-control-label" for="uid"></label>
                                    </div>
                                </th>
                                <th class="nk-tb-col"><span class="sub-text">N° Plaque</span></th>
                                <th class="nk-tb-col"><span class="sub-text">Type remorque</span></th>
                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">Date attélage</span></th>
                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">Date retrait</span></th>
                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">Status</span></th>
                                <th class="nk-tb-col nk-tb-col-tools text-right">
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $vehicle->trailers->sortByDesc('created_at') as $link)
                                <tr class="nk-tb-item">
                                    <td class="nk-tb-col nk-tb-col-check">
                                        <div class="custom-control custom-control-sm custom-checkbox notext">
                                            <input type="checkbox" class="custom-control-input" id="{{ $link->id }}">
                                            <label class="custom-control-label" for="{{ $link->id }}"></label>
                                        </div>
                                    </td>
                                    <td class="nk-tb-col">
                                        <div class="user-card">
                                            <div class="user-info">
                                                <span class="tb-lead">
                                                    {{ $link->trailer->registration }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span>{{ \App\Enums\Fleet\TrailerType::getDescription($link->trailer->type) }}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span>{{ $link->link_date ? $link->link_date->format('d/m/Y') : '-' }}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span>{{ $link->unlink_date ? $link->unlink_date->format('d/m/Y') : '-' }}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        @include('layout.partials.enum.Fleet.LinkStatus', ['status' => $link->status])
                                    </td>
                                    <td class=" nk-tb-col tb-odr-action">
                                        <div class="tb-odr-btns d-none d-sm-inline">
                                            @if( $link->status === \App\Enums\Fleet\LinkStatus::Active)
                                            <a href="#" class="btn btn-dim btn-sm btn-danger"
                                               data-toggle="modal" data-target="#delete-modal"
                                               data-resource="{{ $link->uuid }}"
                                            >
                                                <em class="icon ni ni-cross"></em>
                                            </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr><!-- .nk-tb-item  -->
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
                @if( $vehicle->has_driver== true || $vehicle->activedriver != null )
                <div class="tab-pane" id="tabItem7">
                    <div class="col-sm-12 mt-5">
                        <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                            <thead>
                            <tr class="nk-tb-item nk-tb-head">
                                <th class="nk-tb-col nk-tb-col-check">
                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                        <input type="checkbox" class="custom-control-input" id="uid">
                                        <label class="custom-control-label" for="uid"></label>
                                    </div>
                                </th>
                                <th class="nk-tb-col"><span class="sub-text">Nom</span></th>
                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">Contact</span></th>
                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">Type permis</span></th>
                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">Date attribution</span></th>
                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">Date retrait</span></th>
                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">Status</span></th>
                                <th class="nk-tb-col nk-tb-col-tools text-right">
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $vehicle->drivers->sortByDesc('created_at') as $assignement)
                                <tr class="nk-tb-item">
                                    <td class="nk-tb-col nk-tb-col-check">
                                        <div class="custom-control custom-control-sm custom-checkbox notext">
                                            <input type="checkbox" class="custom-control-input" id="{{ $assignement->id }}">
                                            <label class="custom-control-label" for="{{ $assignement->id }}"></label>
                                        </div>
                                    </td>
                                    <td class="nk-tb-col">
                                        <div class="user-card">
                                            <div class="user-info">
                                                <span class="tb-lead">
                                                    {{ $assignement->driver->name }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span>{{ $assignement->driver->tel }}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span>{{ $assignement->driver->licence_category }}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span>{{ $assignement->date_attribution ? $assignement->date_attribution->format('d/m/Y') : '-' }}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span>{{ $assignement->cancel_date ? $assignement->cancel_date->format('d/m/Y') : '-' }}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        @include('layout.partials.enum.Fleet.AssignationStatus', ['status' => $assignement->status ])
                                    </td>
                                    <td class=" nk-tb-col tb-odr-action">
                                        <div class="tb-odr-btns d-none d-sm-inline">
                                            <a href="" class="btn btn-dim btn-sm btn-warning">Modifier</a>
                                        </div>
                                    </td>
                                </tr><!-- .nk-tb-item  -->
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            </div>
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
                    <h5 class="modal-title">Affecter une remorque</h5>
                </div>
                <div class="modal-body">
                    <form id="form-create" action="{{ route('fleet.link.store') }}" method="post">
                        @csrf
                        <div class="preview-block">
                            <div class="row gy-4">
                                <div class="col-sm-12 mb-3">
                                    <div class="form-group">
                                        <div class="example-alert">
                                            <div class="alert alert-pro alert-primary shadow-sm alert-icon bg-blue-dim">
                                                <em class="icon ni ni-alert-circle"></em>
                                                <p>
                                                    Veuillez selectionnez la remorque à attribuer au tracteur
                                                </p>
                                                <ul class="list-inline">
                                                    <li>
                                                        <em class="icon ni ni-check-circle"></em>
                                                        Plaque d'immatriculation de la remorque
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <input name="vehicle_id" type="text" class="d-none" value="{{ $vehicle->id }}">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Plaque d'immatriculation</label>
                                        <div class="form-control-wrap ">
                                            <select name="trailer_id" class="form-select" data-search="on" data-placeholder = "Selectioner la remorque">
                                                <option></option>
                                                @foreach( $trailers as $key => $value)
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                            @error('trailer_id')
                                            <span class="sub-text-sm text-danger ff-italic">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">
                                            Date d'affectation
                                        </label>
                                        <div class="form-control-wrap">
                                            <input name="link_date" type="text" class="form-control date-picker @error('link_date') error @enderror" id="default-01" placeholder="Date d'affectation" data-date-format="d/m/yyyy" value="{{ old('link_date') }}">
                                            @error('link_date')
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
    <div class="modal fade" tabindex="-1" id="delete-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body modal-body-lg text-center">
                    <div class="nk-modal">
                        <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-alert-c bg-danger-dim"></em>
                        <h4 class="nk-modal-title">Confirmation de suppression</h4>
                        <div class="nk-modal-text">
                            <p class="text-soft">Voulez-vous supprimer cette information ? <br/>La suppression est totale et irrémédiable
                            </p>
                        </div>
                        <form id="form-edit" method="post">
                            @csrf
                            @method('DELETE')
                        </form>
                        <button class="btn btn-sm btn-secondary" data-dismiss="modal">
                            <em class="icon ni ni-cross-circle"></em>
                            <span>Fermer</span>
                        </button>
                        <button form="form-edit" type="submit" class="btn btn-sm btn-danger">
                            <em class="icon ni ni-check"></em>
                            <span>Confirmer</span>
                        </button>
                    </div>
                </div><!-- .modal-body -->
            </div>
        </div>
    </div>
@stop
@section('add_js')
    <script>
        $(document).ready(function() {
            let form =$('#delete-modal form');
            $('a[data-target$=delete-modal]').on('click', function(){
                $.ajax({
                    method: "GET",
                    url: "{{ route('fleet.link.edit', ['link' => '#'])  }}".replace('#', $(this).attr('data-resource')),
                    dataType: 'json',
                    success: function(link){
                        console.log(link)
                        form.attr('action', '{{ route('fleet.link.delete', ['link' => '#']) }}'
                            .replace('#', link.uuid));
                    },
                })
            });

            $('#delete-modal').on('hide.bs.modal', function(){
                $('#delete-modal').attr('action', '');
            })
        });
    </script>
@endsection
