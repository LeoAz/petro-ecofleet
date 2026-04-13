@extends('layout.app')
@section('content')
    {{ Breadcrumbs::render('driver') }}
    @include('layout.partials.flash')
    <div class="nk-block-head-sub mb-5">
        <a class="back-to" href="{{ route('cashbox.detail', $box->uuid) }}">
            <em class="icon ni ni-arrow-left"></em>
            <span style="font-size: 25px">Retour Caisse</span>
        </a>
    </div>

    <div class="nk-block nk-block-lg">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h5 class="nk-block-title">
                        <em class="icon ni ni-pen"></em>
                        Modifier la dépense
                    </h5>
                </div>
            </div><!-- .nk-block-between -->
        </div>

        <div class="card shadow-sm">
            <div class="card-inner">
                <form id="form-create" action="{{ route('cashbox.operation-update', [$box->uuid, $operation->uuid]) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="preview-block">
                        <div class="row gy-4">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Le montant</label>
                                    <div class="form-control-wrap">
                                        <input name="amount" type="text" class="form-control @error('amount') error @enderror" id="default-01" value="{{ $operation->amount }}">
                                        @error('amount')
                                        <span class="invalid">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">le bénéficiare</label>
                                    <div class="form-control-wrap">
                                        <input name="beneficiary" type="text" class="form-control @error('beneficiary') error @enderror" id="default-01" value="{{ $operation->beneficiary }}">
                                        @error('beneficiary')
                                        <span class="invalid">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">La description</label>
                                    <div class="form-control-wrap">
                                        <input name="description" type="text" class="form-control @error('description') error @enderror" id="default-01" value="{{ $operation->description }}">
                                        @error('description')
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
        </div><!-- .card-preview -->
    </div>
@stop

