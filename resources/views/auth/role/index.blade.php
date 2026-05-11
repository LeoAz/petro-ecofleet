@extends('layout.app')

@section('sidebar')
    <x-user-menu/>
@stop

@section('content')
    @include('layout.partials.flash')

    <div class="nk-block nk-block-lg">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    {{ Breadcrumbs::render('role') }}
                    <h5 class="nk-block-title">
                        <em class="icon ni ni-file-text"></em>
                        Liste des rôles
                    </h5>
                    <div class="nk-block-des text-soft">
                        <p>Ci-dessous un listing de l'ensemble des rôles dans la base de donnée</p>
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
                                        <span> Ajouter un rôle</span>
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
                        <th class="nk-tb-col"><span class="sub-text">#</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Nom</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Permission(s)</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-left">
                            Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                        <tr class="nk-tb-item">
                            <td class="nk-tb-col nk-tb-col-check">
                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                    <input type="checkbox" class="custom-control-input" id="{{ $role->id }}">
                                    <label class="custom-control-label" for="{{ $role->id }}"></label>
                                </div>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $role->id }}</span>
                            </td>
                            <td class="nk-tb-col">
                                <div class="user-card">
                                    <div class="user-info">
                                        <span class="tb-lead">{{ $role->name }} <span class="dot dot-success d-md-none ml-1"></span></span>
                                    </div>
                                </div>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                @forelse($role->permissions as $permission)
                                    <span class="badge badge-pill badge-dim badge-primary">{{ $permission->name }}</span>
                                @empty
                                    <span class="badge badge-pill badge-dim badge-secondary">aucune permission</span>
                                @endforelse
                            </td>
                            <td class="nk-tb-col nk-tb-col-tools">
                                <div class="d-none d-md-inline">
                                    <a href="#"
                                       class="btn btn-sm btn-dim btn-secondary"
                                       data-toggle="modal"
                                       data-resource="{{ $role->id }}"
                                       data-target="#edit-state"
                                    >
                                        <em class="icon ni ni-pen2"></em>
                                    </a>
                                    <a href="#"
                                       class="btn btn-sm btn-dim btn-danger"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       title="Supprimer"
                                    >
                                        <em class="icon ni ni-trash"></em>
                                    </a>
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
                    <h5 class="modal-title">Saisir un nouveau rôle</h5>
                </div>
                <div class="modal-body">
                    <form id="form-create" action="{{ route('admin.role.store') }}" method="post">
                        @csrf
                        <div class="preview-block">
                            <div class="row gy-4">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Description</label>
                                        <div class="form-control-wrap">
                                            <input name="name" type="text" class="form-control @error('name') error @enderror" id="default-01" placeholder="Le rôle">
                                            @error('name')
                                            <span class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">permission(s)</label>
                                        <div class="form-control-wrap">
                                            <select name="permissions[]" class="form-select" multiple="multiple" data-placeholder="Selectionner les permissions">
                                                @foreach($permissions as $permission)
                                                    <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('permissions[]')
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
                    <h5 class="modal-title">Modifier le rôle</h5>
                </div>
                <div class="modal-body">
                    <form id="form-edit" method="post">
                        @csrf
                        @method('PUT')
                        <div class="preview-block">
                            <div class="row gy-4">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Le nom</label>
                                        <div class="form-control-wrap">
                                            <input name="name" type="text" class="form-control @error('name') error @enderror" id="default-01">
                                            @error('name')
                                            <span class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">permission(s)</label>
                                        <div class="form-control-wrap">
                                            <select name="permissions[]" class="form-select" multiple="multiple" data-placeholder="Selectionner les permissions">
                                                @foreach($permissions as $permission)
                                                    <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('permissions[]')
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
                    url: "{{ route('admin.role.edit', ['role' => '#'])  }}".replace('#', $(this).attr('data-resource')),
                    dataType: 'json',
                    success: function(role){
                        form.attr('action', '{{ route('admin.role.update', ['role' => '#']) }}'
                            .replace('#', role.id));
                        $('#edit-state [name=name]').attr('value', role.name);
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
