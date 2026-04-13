@if (flash()->message)
    <div class="alert alert-icon alert-pro {{ flash()->class }} shadow-sm alert-dismissible">
        <em class="icon ni ni-check-circle"></em>
        <strong>Opération reussie avec succès!</strong>
        <p>{{ flash()->message }}</p>
        <button class="close" data-dismiss="alert"></button>
    </div>
@endif
@if ( $errors->isNotEmpty() )
    <div class="alert alert-icon alert-pro alert-danger bg-danger-dim shadow-sm alert-dismissible">
        <em class="icon ni ni-cross-circle"></em>
        <strong>Whoops! Quelques erreurs détectées</strong>
        <ul>
            @foreach ( $errors->all() as $error )
                <li class="text-danger">* {{ $error }}</li>
            @endforeach
        </ul>
        <button class="close" data-dismiss="alert"></button>
    </div>
@endif

