@extends('layout.app')
@section('sidebar')
    <x-user-menu/>
@stop
@section('content')
    <div class="nk-block nk-block-lg">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    {{ Breadcrumbs::render('user') }}
                    <h5 class="nk-block-title">
                        <em class="icon ni ni-pen"></em>
                        Modifier le chauffeur - <strong> {{ $user->name }}</strong>
                    </h5>
                </div>
            </div><!-- .nk-block-between -->
        </div>
        <div class="card shadow-sm">
            <div class="card-inner">
                <form id="form-edit"  method="post" action="{{ route('admin.user.update', $user->uuid) }}">
                    @csrf
                    @method('PUT')
                    <div class="preview-block">
                        <div class="row gy-4">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Nom de l'utilisateur</label>
                                    <div class="form-control-wrap">
                                        <input name="name" type="text" class="form-control @error('name') error @enderror" id="default-01" placeholder="Nom de l'utilisateur" value="{{ $user->name }}">
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
                                        <input name="pseudo" type="text" class="form-control @error('pseudo') error @enderror" id="default-01" placeholder="Pseudo de l'utilisateur" value="{{ $user->pseudo }}">
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
                                        <input name="jobtitle" type="text" class="form-control @error('jobtitle') error @enderror" id="default-01" placeholder="Le poste" value="{{ $user->pseudo }}">
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
                                        <input name="email" type="email" class="form-control @error('email') error @enderror" id="default-03" placeholder="Email" value="{{ $user->email }}">
                                        @error('email')
                                        <span class="invalid">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label">rôle(s)</label>
                                    <div class="form-control-wrap">
                                        <select name="roles[]" class="form-select" multiple="multiple" data-placeholder="Selectionner les rôle">
                                            @foreach( $roles as $role )
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
            <div class="card-footer">
                <button form="form-edit" type="submit" class="btn btn-sm btn-primary float-right">
                    <em class="icon ni ni-save"></em>
                    <span>Enregister</span>
                </button>
            </div>
        </div><!-- .card-preview -->
    </div>
@stop
