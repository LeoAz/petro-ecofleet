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
                    {{ Breadcrumbs::render('user') }}
                    <h5 class="nk-block-title">
                        <em class="icon ni ni-list"></em>
                        Liste des utilisateurs
                    </h5>
                    <div class="nk-block-des text-soft">
                        <p>Ci-dessous un listing de l'ensemble des utilisateurs dans la base de donnée</p>
                    </div>
                </div>
                <!-- .nk-block-head-content -->
                <div class="nk-block-head-content">
                    <div class="toggle-wrap nk-block-tools-toggle">
                        <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                        <div class="toggle-expand-content" data-content="pageMenu">
                            <ul class="nk-block-tools g-3">
                                <li class="nk-block-tools-opt">
                                    <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#create-user">
                                        <em class="icon ni ni-plus"></em>
                                        <span> Ajouter utilisateur</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div><!-- .toggle-wrap -->
                </div><!-- .nk-block-head-content -->
            </div><!-- .nk-block-between -->
        </div>
        <div class="card">
            <div class="card-inner">
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
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Pseudo</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Poste</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Rôle(s)</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Status</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-right">
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr class="nk-tb-item">
                            <td class="nk-tb-col nk-tb-col-check">
                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                    <input type="checkbox" class="custom-control-input" id="{{ $user->id }}">
                                    <label class="custom-control-label" for="{{ $user->id }}"></label>
                                </div>
                            </td>
                            <td class="nk-tb-col">
                                <div class="user-card">
                                    <div class="user-info">
                                        <span class="tb-lead">{{ $user->name }} <span class="dot dot-success d-md-none ml-1"></span></span>
                                        <span>{{ $user->email }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $user->pseudo }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $user->jobtitle }}</span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                @forelse($user->roles as $role)
                                    <span class="badge badge-pill badge-outline-primary">{{ $role->name }}</span>
                                @empty
                                    <span class="badge badge-pill badge-outline-light">aucun rôle</span>
                                @endforelse
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                @include('layout.partials.enum.maintenance.UserStatus', ['status' => $user->status])
                            </td>
                            <td class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1">
                                    <li>
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="#"><em class="icon ni ni-setting"></em><span>Paramêtres</span></a></li>
                                                    <li><a href="{{ route('admin.user.edit', $user->uuid) }}"><em class="icon ni ni-pen"></em><span>Modifier</span></a></li>
                                                    <li>
                                                        <a href="#" class="text-danger"
                                                           onclick="event.preventDefault();
                                                           document.getElementById('user-delete-form{{ $user->id }}').submit();"
                                                        >
                                                            <em class="icon ni ni-trash">
                                                            </em><span>Supprimer</span>
                                                        </a>
                                                        <form id="user-delete-form{{ $user->id }}"
                                                              action="{{ route('admin.user.delete', $user->uuid) }}" method="post" style="display: none;"
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
    <div class="modal fade" tabindex="-1" id="create-user">
        <div class="modal-dialog modal-dialog-top modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
                <div class="modal-header">
                    <h5 class="modal-title">Saisir un utilisateur</h5>
                </div>
                <div class="modal-body">
                    <form id="form-create" action="{{ route('admin.user.store') }}" method="post">
                        @csrf
                        <div class="preview-block">
                            <div class="row gy-4">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Nom de l'utilisateur</label>
                                        <div class="form-control-wrap">
                                            <input name="name" type="text" class="form-control @error('name') error @enderror" id="default-01" placeholder="Nom de l'utilisateur">
                                            @error('name')
                                            <span class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Pseudo</label>
                                        <div class="form-control-wrap">
                                            <input name="pseudo" type="text" class="form-control @error('pseudo') error @enderror" id="default-01" placeholder="Pseudo de l'utilisateur">
                                            @error('pseudo')
                                            <span class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-01">Poste</label>
                                        <div class="form-control-wrap">
                                            <input name="jobtitle" type="text" class="form-control @error('jobtitle') error @enderror" id="default-01" placeholder="Poste de l'utilisateur">
                                            @error('jobtitle')
                                            <span class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-03">Email</label>
                                        <div class="form-control-wrap">
                                            <input name="email" type="email" class="form-control @error('email') error @enderror" id="default-03" placeholder="Email">
                                            @error('email')
                                            <span class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-03">Mot de passe</label>
                                        <div class="form-control-wrap">
                                            <input name="password" type="password" class="form-control @error('password') error @enderror" id="default-03" placeholder="Mot de passe">
                                            @error('password')
                                            <span class="invalid">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label">rôle(s)</label>
                                        <div class="form-control-wrap">
                                            <select name="roles[]" class="form-select" multiple="multiple" data-placeholder="Selectionner les permissions">
                                                @foreach($roles as $role)
                                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
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
@endsection
