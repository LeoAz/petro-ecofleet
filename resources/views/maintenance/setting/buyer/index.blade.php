@extends('layout.app')

@section('sidebar')
    <x-maintenance-setting-menu/>
@stop
@section('content')
    {{ Breadcrumbs::render('trajet') }}
    @include('layout.partials.flash')
    <div class="nk-block nk-block-lg">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h5 class="nk-block-title">
                        <em class="icon ni ni-file-text"></em>
                        Liste des appartenances
                    </h5>
                    <div class="nk-block-des text-soft">
                        <p>Ci-dessous un listing de l'ensemble des appartenances dans la base de donnée</p>
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
                                        <span> Ajouter un appartenant </span>
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
                <table class="datatable-init nk-tb-list nk-tb-ulist">
                    <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col nk-tb-col-check">
                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                <input type="checkbox" class="custom-control-input" id="uid">
                                <label class="custom-control-label" for="uid"></label>
                            </div>
                        </th>
                        <th class="nk-tb-col"><span class="sub-text">nom de l'appartenance</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-left">
                            Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $buyers as $buyer)
                        <tr class="nk-tb-item">
                            <td class="nk-tb-col nk-tb-col-check">
                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                    <input type="checkbox" class="custom-control-input" id="{{ $buyer->id }}">
                                    <label class="custom-control-label" for="{{ $buyer->id }}"></label>
                                </div>
                            </td>
                            <td class="nk-tb-col">
                                <div class="user-card">
                                    <div class="user-info">
                                <span class="tb-lead">
                                    {{ $buyer->name }}
                                </span>
                                    </div>
                                </div>
                            </td>
                            <td class=" nk-tb-col tb-odr-action">
                                <div class="tb-odr-btns d-none d-sm-inline">
                                    <a href="#"
                                       class="btn btn-dim btn-sm btn-warning"
                                       data-toggle="modal"
                                       data-resource="{{ $buyer->id }}"
                                       data-target="#edit-state"
                                    >
                                        <em class="icon ni ni-pen"></em>
                                    </a>
                                </div>
                                <div class="tb-odr-btns d-none d-sm-inline">
                                    <a href="#"
                                       class="btn btn-dim btn-danger"
                                       onclick="event.preventDefault();
                                       document.getElementById('delete-customer-form{{ $buyer->id }}').submit();"
                                    >
                                        <em class="icon ni ni-trash">
                                        </em><span>Supprimer</span>
                                    </a>
                                    <form id="delete-customer-form{{ $buyer->id }}"
                                          action="{{ route('maintenance.setting.buyer.destroy', $buyer->id) }}" method="post" style="display: none;"
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
                    <h5 class="modal-title">Saisir un appartenant</h5>
                </div>
                <div class="modal-body">
                    <form id="form-create" action="{{ route('maintenance.setting.buyer.store') }}" method="post">
                        @csrf
                        <div class="preview-block">
                            <div class="row gy-4">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Nom de l'appartenant</label>
                                        <div class="form-control-wrap">
                                            <input name="name" type="text" class="form-control @error('name') error @enderror" id="default-01" placeholder="Nom de l'appartenant">
                                            @error('name')
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
                    <h5 class="modal-title">Modifier l'appartenant</h5>
                </div>
                <div class="modal-body">
                    <form id="form-edit" method="post">
                        @csrf
                        @method('PUT')
                        <div class="preview-block">
                            <div class="row gy-4">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Nom de l'appartenant</label>
                                        <div class="form-control-wrap">
                                            <input name="name" type="text" class="form-control @error('name') error @enderror" id="default-01" placeholder="Nom de la categorie">
                                            @error('name')
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
                    url: "{{ route('maintenance.setting.buyer.edit', ['buyer' => '#'])  }}".replace('#', $(this).attr('data-resource')),
                    dataType: 'json',
                    success: function(buyer){
                        form.attr('action', '{{ route('maintenance.setting.buyer.update', ['buyer' => '#']) }}'
                            .replace('#', buyer.id));
                        $('#edit-state [name=name]').attr('value', buyer.name);
                    },
                })
            });

            $('#edit-state').on('hide.bs.modal', function(){
                $('#edit-state [name=name]').attr('value', '');
                $('#edit-state').attr('action', '');
                //window.location.reload()
            })
        });
    </script>
@endsection


