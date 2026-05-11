@extends('layout.app')
@section('content')
    <div class="nk-block nk-block-lg">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    {{ Breadcrumbs::render('warehouse') }}
                    <h5 class="nk-block-title">
                        <em class="icon ni ni-pen"></em>
                        Modifier la piece  - {{ $part->name }}
                    </h5>
                </div>
            </div><!-- .nk-block-between -->
        </div>
    </div>
    @include('layout.partials.flash')

        <div class="card shadow-sm">
            <div class="card-inner">
                <form id="form-create" action="{{ route('maintenance.warehouse.part.update', $part->uuid) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="preview-block">
                        <div class="row gy-4">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Nom de la pièce</label>
                                    <div class="form-control-wrap">
                                        <input name="name" type="text" class="form-control @error('name') error @enderror" id="default-01" placeholder="Nom de la categorie"
                                               value="{{ $part->name }}"
                                        >
                                        @error('name')
                                        <span class="invalid">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">La reference</label>
                                    <div class="form-control-wrap">
                                        <input name="reference" type="text" class="form-control @error('reference') error @enderror" id="default-01" value="{{ $part->reference }}"
                                        >
                                        @error('reference')
                                        <span class="invalid">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Catégorie</label>
                                    <div class="form-control-wrap" data-placeholder = "selectioner la catégorie">
                                        <select  name="category_id" class="form-select @error('category_id') error @enderror" id="default-03">
                                            <option value="{{ $part->category_id }}">{{ $part->category->name }}</option>
                                            @foreach( $categories as $key => $value)
                                                <option value="{{ $key}}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <span class="sub-text-sm text-danger ff-italic">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Prix de la pièce</label>
                                    <div class="form-control-wrap">
                                        <input name="price" type="text" class="form-control @error('price') error @enderror" id="default-01" placeholder="Prix de la pièce"
                                               value="{{ $part->price }}">
                                        @error('price')
                                        <span class="invalid">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Quantité</label>
                                    <div class="form-control-wrap">
                                        <input name="qty" type="text" class="form-control @error('qty') error @enderror" id="default-01" placeholder="Quantité"
                                               value="{{ $part->qty }}">
                                        @error('qty')
                                        <span class="invalid">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label" for="default-07">L'appartenance</label>
                                    <div class="form-control-wrap" data-placeholder = "selectioner l'appartenant">
                                        <select  name="buyer_id" class="form-select @error('buyer_id') error @enderror" id="default-07">
                                            <option value="{{ $part->buyer_id }}">{{ $part->buyer->name ?? '-'}}</option>
                                            @foreach( $buyers as $key => $value)
                                                <option value="{{ $key}}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        @error('buyer_id')
                                        <span class="sub-text-sm text-danger ff-italic">{{ $message }}</span>
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
