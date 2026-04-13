@extends('layout.app')

@section('content')
    {{ Breadcrumbs::render('trajet') }}
    @include('layout.partials.flash')

    <div class="nk-block nk-block-lg">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h5 class="nk-block-title">
                        <em class="icon ni ni-file-text"></em>
                        Liste des fournisseurs
                    </h5>
                    <div class="nk-block-des text-soft">
                        <p>Ci-dessous un listing de l'ensemble des fournisseurs dans la base de donnée</p>
                    </div>
                </div>
                <!-- .nk-block-head-content -->
                <div class="nk-block-head-content">
                    <div class="toggle-wrap nk-block-tools-toggle">
                        <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                        <div class="toggle-expand-content" data-content="pageMenu">
                            <ul class="nk-block-tools g-3">
                                <li class="nk-block-tools-opt">
                                    <a href="#" class="btn btn-sm btn-dim btn-primary" data-toggle="modal" data-target="#create-state">
                                        <em class="icon ni ni-plus"></em>
                                        <span> Ajouter un fournisseur</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div><!-- .toggle-wrap -->
                </div><!-- .nk-block-head-content -->
            </div><!-- .nk-block-between -->
        </div>
        <div class="card shadow-sm">
            <div class="card-inner">
                <table class="datatable-init-export nk-tb-list nk-tb-ulist" data-export-title="Exporter">
                    <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col nk-tb-col-check">
                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                <input type="checkbox" class="custom-control-input" id="uid">
                                <label class="custom-control-label" for="uid"></label>
                            </div>
                        </th>
                        <th class="nk-tb-col"><span class="sub-text">Nom</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Contact</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Adresse</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-left">
                            Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $providers as $provider)
                        <tr class="nk-tb-item">
                            <td class="nk-tb-col nk-tb-col-check">
                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                    <input type="checkbox" class="custom-control-input" id="{{ $provider->id }}">
                                    <label class="custom-control-label" for="{{ $provider->id }}"></label>
                                </div>
                            </td>
                            <td class="nk-tb-col">
                                <div class="user-card">
                                    <div class="user-info">
                                        <span class="tb-lead">
                                            {{ $provider->name }}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td class="nk-tb-col tb-col-md text-dark">
                                <span>{{ $provider->contact }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md text-dark">
                                <span>{{ $provider->address }}</span>
                            </td>
                            <td class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1">
                                    <li>
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-left">
                                                <ul class="link-list-plain sm">
                                                    <li>
                                                        <a href="#"
                                                           data-toggle="modal"
                                                           data-resource="{{ $provider->id }}"
                                                           data-target="#edit-state"
                                                        ><em class="icon ni ni-pen"></em><span>Modifier</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#"
                                                           onclick="event.preventDefault();
                                                           document.getElementById('delete-customer-form{{ $provider->id }}').submit();"
                                                        >
                                                            <em class="icon ni ni-trash text-danger">
                                                            </em><span class="text-danger">Supprimer</span>
                                                        </a>
                                                        <form id="delete-customer-form{{ $provider->id }}"
                                                              action="{{ route('maintenance.provider.destroy', $provider->id) }}" method="post" style="display: none;"
                                                        >
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
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
        </div><!-- .card-preview -->
    </div>
    <div class="modal fade" tabindex="-1" id="create-state">
        <div class="modal-dialog modal-dialog-top modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
                <div class="modal-header">
                    <h5 class="modal-title">Saisir un nouveau fournisseur</h5>
                </div>
                <div class="modal-body">
                    <form id="form-create" action="{{ route('maintenance.provider.store') }}" method="post">
                        @csrf
                        <div class="preview-block">
                            <div class="row gy-4">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Nom du fournisseur</label>
                                        <div class="form-control-wrap">
                                            <input name="name" type="text" class="form-control @error('name') error @enderror" id="default-01" placeholder="Nom du client">
                                            @error('name')
                                            <span class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Contact</label>
                                        <div class="form-control-wrap">
                                            <input name="contact" type="text" class="form-control @error('contact') error @enderror" id="default-01" placeholder="Contact du client">
                                            @error('contact')
                                            <span class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Addresse du fournisseur</label>
                                        <div class="form-control-wrap">
                                            <input name="address" type="text" class="form-control @error('address') error @enderror" id="default-01" placeholder="Addresse du client">
                                            @error('address')
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
    <div class="modal fade" tabindex="-1" id="edit-state">
        <div class="modal-dialog modal-dialog-top modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
                <div class="modal-header">
                    <h5 class="modal-title">Modifier le fournisseur</h5>
                </div>
                <div class="modal-body">
                    <form id="form-edit" method="post">
                        @csrf
                        @method('PUT')
                        <div class="preview-block">
                            <div class="row gy-4">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Nom du fournisseur</label>
                                        <div class="form-control-wrap">
                                            <input name="name" type="text" class="form-control @error('name') error @enderror" id="default-01" placeholder="Nom du client">
                                            @error('name')
                                            <span class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Contact</label>
                                        <div class="form-control-wrap">
                                            <input name="contact" type="text" class="form-control @error('contact') error @enderror" id="default-01" placeholder="Contact du client">
                                            @error('contact')
                                            <span class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Addresse du fournisseur</label>
                                        <div class="form-control-wrap">
                                            <input name="address" type="text" class="form-control @error('address') error @enderror" id="default-01" placeholder="Addresse du client">
                                            @error('address')
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
                    <button class="btn btn-sm btn-secondary float-right">
                        <em class="icon ni ni-cross-circle"></em>
                        <span>Fermer</span>
                    </button>
                    <button form="form-edit" type="submit" class="btn btn-sm btn-primary float-right">
                        <em class="icon ni ni-save"></em>
                        <span>Enregister</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@stop
@section('add_js')
    <script>
        $(document).ready(function() {
            let form =$('#edit-state form');
            $('a[data-target$=edit-state]').on('click', function(){
                $.ajax({
                    method: "GET",
                    url: "{{ route('maintenance.provider.edit', ['provider' => '#'])  }}".replace('#', $(this).attr('data-resource')),
                    dataType: 'json',
                    success: function(provider){
                        form.attr('action', '{{ route('maintenance.provider.update', ['provider' => '#']) }}'
                            .replace('#', provider.id));
                        $('#edit-state [name=name]').attr('value', provider.name);
                        $('#edit-state [name=contact]').attr('value', provider.contact);
                        $('#edit-state [name=address]').attr('value', provider.address);
                    },
                })
            });

            $('#edit-state').on('hide.bs.modal', function(){
                $('#edit-state [name=name]').attr('value', '');
                $('#edit-state [name=contact]').attr('value', '');
                $('#edit-state [name=address]').attr('value', '');
                $('#edit-state').attr('action', '');
            })
        });
    </script>
@endsection
