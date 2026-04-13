@extends('layout.app')

@section('sidebar')
    <x-report-transport-menu/>
@stop

@section('content')
    {{ Breadcrumbs::render('trajet') }}
    @include('layout.partials.flash')
    <div class="card mb-5 mt-3">
        <div class="card-inner">
            <div class="preview-block">
                <form action="" method="GET">
                    <div class="row gy-4 align-center">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <select name="month" class="form-select" data-placeholder = "Mois">
                                        <option value="January">Janvier</option>
                                        <option value="February">Fevrier</option>
                                        <option value="March">Mars</option>
                                        <option value="April">Avril</option>
                                        <option value="May">Mai</option>
                                        <option value="June">Juin</option>
                                        <option value="July">Juillet</option>
                                        <option value="August">Aout</option>
                                        <option value="September">Septembre</option>
                                        <option value="October">Octobre</option>
                                        <option value="November">Novembre</option>
                                        <option value="December">Decembre</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <input name="year" type="text" class="form-control @error('year') error @enderror" id="default-01" placeholder="Année">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-sm btn-primary ml-2">
                                <em class="icon ni ni-filter"></em>
                                <span>Filter</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- .card-preview -->
    <div class="nk-block nk-block-lg">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h5 class="nk-block-title">
                        <em class="icon ni ni-list"></em>
                        Etat des salaires du mois - {{ request()->get('month') }} {{ request()->get('year') }}
                    </h5>
                </div>
                <!-- .nk-block-head-content -->
                <div class="nk-block-head-content">
                    <div class="toggle-wrap nk-block-tools-toggle">
                        <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                        <div class="toggle-expand-content" data-content="pageMenu">
                            <ul class="nk-block-tools g-3">
                                <li class="nk-block-tools-opt">
                                    <a href="{{ route('reporting.print_salary', [
                                        'month' => request()->get('month'),
                                        'year' => request()->get('year')
                                        ]) }}"
                                       class="btn btn-sm btn-dim btn-danger"
                                       target="_blank"
                                    >
                                        <em class="icon ni ni-file-pdf"></em>
                                        <span> Imprimer le rapport</span>
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
                <table class="table table-bordered table-condensed table-sm table" data-auto-responsive="false">
                    <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col"><span class="sub-text">Nom</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Matricule</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Contact</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Vehicule</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Salaire</span></th>
                    </tr>
                    </thead>
                    <tbody>
                        @if (!empty($states))
                            @foreach( $states->salaries as $salary)
                                <tr class="nk-tb-item">
                                    <td class="nk-tb-col">
                                        <div class="user-card">
                                            <div class="user-info">
                                                <span class="tb-lead">
                                                    {{ $salary->driver->name }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span>{{ $salary->driver->matricule }}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span>{{ $salary->driver->tel }}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span>{{$salary->driver->ActiveVehicle ? $salary->driver->ActiveVehicle->vehicle->registration : '-'}}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span>{{ number_format($salary->amount,0, ' ', ' ') }} CFA</span>
                                    </td>
                                </tr><!-- .nk-tb-item  -->
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <tfoot>
                    <tr class="bg-danger-dim">
                        <td colspan="4" class="text-right fs-14px">TOTAL SALAIRE</td>
                        <td class="text-center fs-14px"> {{ !empty($states) ? number_format($states->salaries()->sum('amount'),0,'',' ') : 0 }} CFA</td>
                    </tr>
                </tfoot>
            </div>
        </div><!-- .card-preview -->
    </div>

@endsection
@section('add_js')
    <script src="{{ asset('assets/js/libs/datatable-btns.js') }}"></script>
@endsection
