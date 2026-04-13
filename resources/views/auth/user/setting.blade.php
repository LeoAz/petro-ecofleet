@extends('layouts.admin.app')
@section('content')
    {{ Breadcrumbs::render('setting') }}
    <div class="nk-block nk-block-lg">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h4 class="nk-block-title">
                        <em class="icon ni ni-setting"></em>
                        Paramêtre de l'utilisateur - <u>{{ $user->name }}</u>
                    </h4>
                    <div class="nk-block-des text-soft">
                        <p>Ci-dessous un listing de l'ensemble des utilisateurs dans la base de donnée</p>
                    </div>
                </div>
                <!-- .nk-block-head-content -->
            </div><!-- .nk-block-between -->
        </div>
        <div class="card">
            <div class="card-inner">
                <ul class="nav nav-tabs mt-n3">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#tabItem5"><em class="icon ni ni-user"></em><span>Profil utilisateur</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tabItem6"><em class="icon ni ni-setting"></em><span>Paramêtres</span></a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tabItem5">
                        <div class="card-inner">
                            <div class="nk-data data-list data-list-s2">
                                <div class="data-head">
                                    <h6 class="overline-title">Informations</h6>
                                </div>
                                <div class="data-item">
                                    <div class="data-col">
                                        <span class="data-label">
                                            <strong><u>Nom utilisateur :</u></strong>
                                        </span>
                                        <span class="data-value">{{ $user->name }}</span>
                                    </div>
                                    <div class="data-col data-col-end"><span class="data-more disable"><em class="icon ni ni-lock-alt"></em></span></div>
                                </div><!-- data-item -->
                                <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                    <div class="data-col">
                                        <span class="data-label">
                                            <strong><u>Pseudo :</u></strong>
                                        </span>
                                        <span class="data-value">{{ $user->pseudo }}</span>
                                    </div>
                                    <div class="data-col data-col-end"><span class="data-more disable"><em class="icon ni ni-lock-alt"></em></span></div>
                                </div><!-- data-item -->
                                <div class="data-item">
                                    <div class="data-col">
                                        <span class="data-label">
                                            <strong><u>Email :</u></strong>
                                        </span>
                                        <span class="data-value">{{ $user->email }}</span>
                                    </div>
                                    <div class="data-col data-col-end"><span class="data-more disable"><em class="icon ni ni-lock-alt"></em></span></div>
                                </div><!-- data-item -->
                                <div class="data-item">
                                    <div class="data-col">
                                        <span class="data-label">
                                            <strong><u>Contact :</u></strong>
                                        </span>
                                        <span class="data-value text-soft">{{ $user->contact }}</span>
                                    </div>
                                    <div class="data-col data-col-end"><span class="data-more disable"><em class="icon ni ni-lock-alt"></em></span></div>
                                </div><!-- data-item -->
                                <div class="data-item">
                                    <div class="data-col">
                                        <span class="data-label">
                                            <strong><u>Client :</u></strong>
                                        </span>
                                        <span class="text-indigo fs-15px">{{ $user->compagny->name }}</span>
                                    </div>
                                    <div class="data-col data-col-end"><span class="data-more disable"><em class="icon ni ni-lock-alt"></em></span></div>
                                </div><!-- data-item -->
                                <div class="data-item">
                                    <div class="data-col">
                                        <span class="data-label">
                                            <strong><u>Status :</u></strong>
                                        </span>
                                        <span class="data-value">
                                            @include('layouts.admin.partials.action._user-status', ['status' => $user->status])
                                        </span>
                                    </div>
                                    <div class="data-col data-col-end"><span class="data-more disable"><em class="icon ni ni-lock-alt"></em></span></div>
                                </div><!-- data-item -->
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tabItem6">
                        <div class="car-inner">
                            <div class="row mt-5">
                                <div class="col-sm-6">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title">Modifier mot de passe utilisateur</h5>
                                        <div class="nk-block-des text-soft mt-3">
                                            <p>Vous pouver modifier le mot de passe de l'utilisateur,<br/> Pour cela vous devez saisir son ancien mot de passe, le nouveau et le reconfirmer</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card card-preview card-bordered">
                                        <div class="card-inner">
                                            <form id="form-client" action="{{ route('auth.user.passwordUpdate', $user->id) }}" method="post">
                                                @csrf
                                                <div class="preview-block">
                                                    <div class="row gy-4">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="default-01">Nouveau mot de passe</label>
                                                                <input name="password" type="password" class="form-control @error('password') error @enderror" id="default-03" placeholder="Nouveau Mot de passe">
                                                                <div class="form-control-wrap">
                                                                    @error('password')
                                                                    <span class="invalid">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="default-01">confirmer mot de passe</label>
                                                                <input name="confirm_password" type="password" class="form-control @error('confirm_password') error @enderror" id="default-03" placeholder="Nouveau Mot de passe">
                                                                <div class="form-control-wrap">
                                                                    @error('confirm_password')
                                                                    <span class="invalid">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="card-footer">
                                            <button form="form-client" type="submit" class="btn btn-sm btn-primary float-right">
                                                <em class="icon ni ni-save"></em>
                                                <span>Enregister</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-sm-6">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title">Affecter un client à l'utilisateur</h5>
                                        <div class="nk-block-des text-soft mt-3">
                                            <p>Vous pouver affecter un client a cet utilisateur,<br/> lors de sa nouvelle connection il pourra gérer les informations de ce client</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card card-preview card-bordered">
                                        <div class="card-inner">
                                            <form id="form-client" action="{{ route('auth.user.compagnyUpdate', $user->id) }}" method="post">
                                                @csrf
                                                <div class="preview-block">
                                                    <div class="row gy-4">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="default-01">Nom du client</label>
                                                                <div class="form-control-wrap">
                                                                    <select name="compagny_id" class="form-select" data-placeholder="Selectionner un client" data-search="on">
                                                                        @foreach($compagnies as $id => $name)
                                                                            <option value="{{ $id}}">{{ $name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('compagny_id')
                                                                    <span class="invalid">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="card-footer">
                                            <button form="form-client" type="submit" class="btn btn-sm btn-primary float-right">
                                                <em class="icon ni ni-save"></em>
                                                <span>Enregister</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-sm-6">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title">
                                            Actions sur le status de l'utilisateur
                                        </h5>
                                        <div class="nk-block-des text-soft mt-3">
                                            <p>Vous pourriez chaanger l'état du compte de cet utilisateur,<br/>
                                                Desactiver, verrouiller, ou activer cet utilisateur
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="card card-preview card-bordered">
                                        <div class="card-inner">
                                            <form id="form-create" action="{{ route('auth.user.updateStatus', $user->id) }}" method="post">
                                                @csrf
                                                <div class="preview-block">
                                                    <div class="row gy-4">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="default-01">Status utilisateur</label>
                                                                <div class="form-control-wrap">
                                                                    <select name="status" class="form-select" data-placeholder="Status de l'utilisateur">
                                                                        @foreach( $status as $key => $value )
                                                                            <option value="{{ $key}}">{{ $value }}</option>
                                                                        @endforeach
                                                                    </select>
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
                                        <div class="card-footer">
                                            <button form="form-create" type="submit" class="btn btn-sm btn-primary float-right">
                                                <em class="icon ni ni-save"></em>
                                                <span>Enregister</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-sm-6">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title">Modifier les rôles de l'utilisateur</h5>
                                        <div class="nk-block-des text-soft mt-3">
                                            <p>Affecter ou modifier les rôles de l'utilisateur,<br/> Son rôle lui permetra d'avoir accés à plus de fonctionnalités</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card card-preview card-bordered">
                                        <div class="card-inner">
                                            <form id="role-update" action="{{ route('auth.user.updateRole', $user->id) }}" method="post">
                                                @csrf
                                                <div class="preview-block">
                                                    <div class="row gy-4">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="default-01">Rôles</label>
                                                                <div class="form-control-wrap">
                                                                    <select name="roles[]" class="form-select" multiple="multiple" data-placeholder="Selectionner les roles">
                                                                        @foreach( $roles as $role)
                                                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('roles')
                                                                    <span class="invalid">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="card-footer">
                                            <button form="role-update" type="submit" class="btn btn-sm btn-primary float-right">
                                                <em class="icon ni ni-save"></em>
                                                <span>Enregister</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
