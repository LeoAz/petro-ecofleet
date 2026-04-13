@extends('layout.app')
@section('content')
    {{ Breadcrumbs::render('driver-show', $driver) }}
    @include('layout.partials.flash')
    <div class="nk-block-between mb-3">
        <div class="nk-block-head-content">
            <h6 class="title">
                <em class="icon ni ni-file-text"></em>
                Details du chauffeur
            </h6>
            <p>Ci-dessous les informations detaillés sur chauffeur</p>
        </div>
    <!-- .nk-block-head-content -->
        <div class="nk-block-head-content">
        <div class="toggle-wrap nk-block-tools-toggle">
            <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
            <div class="toggle-expand-content" data-content="pageMenu">
                <ul class="nk-block-tools g-3"  >
                    <li class="nk-block-tools-opt">
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-opt"></em></a>
                            <div class="dropdown-menu dropdown-menu-left">
                                <ul class="link-list-plain sm">
                                    @if( $driver->status === \App\Enums\Fleet\DriverStatus::Assign )
                                        <li>
                                            <a href="#"
                                               onclick="event.preventDefault();
                                               document.getElementById('revoke-form').submit();">
                                                <em class="icon ni ni-user-cross"></em>
                                                <span>Désaffecter</span>
                                            </a>
                                            <form id="revoke-form" action="{{ route('fleet.assignation.revoke', $driver->uuid) }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </li>
                                    @else

                                    <li>
                                        <a href="#" data-toggle="modal" data-target="#create-state">
                                            <em class="icon ni ni-truck"></em>
                                            <span>Lier vehicule</span>
                                        </a>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="nk-block-tools-opt">
                        <a href="{{ route('fleet.driver.edit', $driver->uuid) }}" class="btn btn-sm btn-warning">
                            <em class="icon ni ni-pen2"></em>
                            <span> Modifier le chauffeur</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div><!-- .toggle-wrap -->
    </div><!-- .nk-block-head-content -->
    </div>
    <div class="card shadow-sm">
        <div class="card-inner">
            <div class="nk-block">
            <div class="profile-ud-list">
                <div class="profile-ud-item">
                    <div class="profile-ud wider">
                        <span class="profile-ud-label">Nom</span>
                        <span class="profile-ud-value">{{ $driver->name ?? '-' }}</span>
                    </div>
                </div>
                <div class="profile-ud-item">
                    <div class="profile-ud wider">
                        <span class="profile-ud-label">Matricule</span>
                        <span class="profile-ud-value">{{ $driver->matricule ?? '-' }}</span>
                    </div>
                </div>
                <div class="profile-ud-item">
                    <div class="profile-ud wider">
                        <span class="profile-ud-label">Contact</span>
                        <span class="profile-ud-value">{{ $driver->tel }}</span>
                    </div>
                </div>
                <div class="profile-ud-item">
                    <div class="profile-ud wider">
                        <span class="profile-ud-label">Date de naissance</span>
                        <span class="profile-ud-value">
                            {{ $driver->birth_date ? $driver->birth_date->format('d/m/Y') : '-' }}
                        </span>
                    </div>
                </div>
                <div class="profile-ud-item">
                    <div class="profile-ud wider">
                        <span class="profile-ud-label">Addresse</span>
                        <span class="profile-ud-value">
                            {{ $driver->address ?? '-' }}
                        </span>
                    </div>
                </div>
                <div class="profile-ud-item">
                    <div class="profile-ud wider">
                        <span class="profile-ud-label">Permis de conduire</span>
                        <span class="profile-ud-value">
                            {{ $driver->driver_licence}}
                        </span>
                    </div>
                </div>

                <div class="profile-ud-item">
                    <div class="profile-ud wider">
                        <span class="profile-ud-label">Category du permis</span>
                        <span class="profile-ud-value">{{ $driver->licence_category }}</span>
                    </div>
                </div>
                <div class="profile-ud-item">
                    <div class="profile-ud wider">
                        <span class="profile-ud-label">Date d'expiration</span>
                        <span class="profile-ud-value">{{ $driver->exp_date ? $driver->exp_date->format('d/m/Y') : '-' }}</span>
                    </div>
                </div>
                <div class="profile-ud-item">
                    <div class="profile-ud wider">
                        <span class="profile-ud-label">Observation</span>
                        <span class="profile-ud-value">{{ $driver->observation }}</span>
                    </div>
                </div>
                <div class="profile-ud-item">
                    <div class="profile-ud wider">
                        <span class="profile-ud-label">Status</span>
                        <span class="profile-ud-value">@include('layout.partials.enum.Fleet.driverStatus', ['status' => $driver->status])</span>
                    </div>
                </div>
            </div><!-- .profile-ud-list -->
        </div><!-- .nk-block -->
        </div>
    </div>
    @if( $driver->status == \App\Enums\Fleet\DriverStatus::Assign || $driver->activeVehicle != null)
        <div class="nk-block-between mt-5 mb-3">
            <div class="nk-block-head-content">
                <h6 class="title">
                    <em class="icon ni ni-file-text"></em>
                    Historique des affectations de remorques
                </h6>
                <p>Ci-dessous les différents affectations de remorques au vehicule</p>
            </div>
            <!-- .nk-block-head-content -->
        </div>
        <div class="card shadow-sm">
            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th scope="col" class="text-soft">Immatriculation</th>
                    <th scope="col" class="text-soft">Marque</th>
                    <th scope="col" class="text-soft">Type</th>
                    <th scope="col" class="text-soft">Date attribution</th>
                    <th scope="col" class="text-soft">Date retrait</th>
                    <th scope="col" class="text-soft">Status</th>
                    <th scope="col" class="text-soft"></th>
                </tr>
                </thead>
                <tbody>
                @foreach( $driver->vehicles->sortByDesc('created_at') as $assignement)
                <tr>
                    <th scope="row">
                        <span class="tb-lead">
                            {{ $assignement->vehicle->registration }}
                        </span>
                    </th>
                    <td><span>{{ $assignement->vehicle->brand->name }}</span></td>
                    <td><span>{{ \App\Enums\Fleet\VehicleType::getDescription($assignement->vehicle->type) }}</span></td>
                    <td><span>{{ $assignement->date_attribution ? $assignement->date_attribution->format('d/m/Y') : '-'}}</span></td>
                    <td><span>{{ $assignement->cancel_date ? $assignement->cancel_date->format('d/m/Y') : '-'}}</span></td>
                    <td>@include('layout.partials.enum.Fleet.AssignationStatus', ['status' => $assignement->status ])</td>
                    <td>
                        @if( $assignement->status == \App\Enums\Fleet\AssignationStatus::Active)
                            <div class="tb-odr-btns d-none d-sm-inline">
                                <a href="#"
                                   class="btn btn-dim btn-sm btn-danger"
                                   data-toggle="modal" data-target="#delete-modal"
                                   data-resource="{{ $assignement->uuid }}"
                                >
                                    <em class="icon ni ni-trash"></em>
                                </a>
                            </div>
                        @endif
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
    <div class="modal fade" id="create-state">
        <div class="modal-dialog modal-dialog-top modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
                <div class="modal-header">
                    <h5 class="modal-title">Affecter véhicule</h5>
                </div>
                <div class="modal-body">
                    <form id="form-create" action="{{ route('fleet.assignation.store') }}" method="post">
                        @csrf
                        <div class="preview-block">
                            <div class="row gy-4">
                                <div class="col-sm-12 mb-3">
                                    <div class="form-group">
                                        <div class="example-alert">
                                            <div class="alert alert-pro alert-primary shadow-sm alert-icon bg-blue-dim">
                                                <em class="icon ni ni-alert-circle"></em>
                                                <p>
                                                    Veuillez selectionnez le vehicule à attribuer au chauffeur
                                                </p>
                                                <ul class="list-inline">
                                                    <li>
                                                        <em class="icon ni ni-check-circle"></em>
                                                        Plaque d'immatriculation du vehicule
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <input name="driver_id" type="text" class="d-none" value="{{ $driver->id }}">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Plaque d'immatriculation</label>
                                        <div class="form-control-wrap ">
                                            <select name="vehicle_id" class="form-select" data-search="on" data-placeholder = "Selectioner le vehicule">
                                                <option></option>
                                                @foreach( $vehicles as $key => $value)
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                            @error('vehicle_id')
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
                                            <input name="date_attribution" type="text" class="form-control date-picker @error('date_attribution') error @enderror" id="default-01" placeholder="Date d'affectation" data-date-format="d/m/yyyy" value="{{ old('date_attribution') }}">
                                            @error('date_attribution')
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
                    url: "{{ route('fleet.assignation.edit', ['assignation' => '#'])  }}".replace('#', $(this).attr('data-resource')),
                    dataType: 'json',
                    success: function(assignation){
                        form.attr('action', '{{ route('fleet.assignation.delete', ['assignation' => '#']) }}'
                            .replace('#', assignation.uuid));
                    },
                })
            });

            $('#delete-modal').on('hide.bs.modal', function(){
                $('#delete-modal').attr('action', '');
            })
        });
    </script>
@endsection
