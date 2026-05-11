@extends('layout.app')

@section('sidebar')
    <x-user-menu/>
@stop

@section('content')
    <div class="nk-block nk-block-lg">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    {{ Breadcrumbs::render('permission') }}
                    <h5 class="nk-block-title">
                        <em class="icon ni ni-list"></em>
                        Liste des permissions
                    </h5>
                    <div class="nk-block-des text-soft">
                        <p>Ci-dessous un listing de l'ensemble des permissions du système</p>
                    </div>
                </div>
                <!-- .nk-block-head-content -->
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
                        <th class="nk-tb-col"><span class="sub-text">#</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Designation</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Guard</span></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $permissions as $permission)
                        <tr class="nk-tb-item">
                            <td class="nk-tb-col nk-tb-col-check">
                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                    <input type="checkbox" class="custom-control-input" id="{{ $permission->id }}">
                                    <label class="custom-control-label" for="{{ $permission->id }}"></label>
                                </div>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $permission->id }}</span>
                            </td>
                            <td class="nk-tb-col">
                                <div class="user-card">
                                    <div class="user-info">
                                        <span class="tb-lead">{{ $permission->name }} <span class="dot dot-success d-md-none ml-1"></span></span>
                                    </div>
                                </div>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span>{{ $permission->guard_name }}</span>
                            </td>
                        </tr><!-- .nk-tb-item  -->
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div><!-- .card-preview -->
    </div>
@endsection
