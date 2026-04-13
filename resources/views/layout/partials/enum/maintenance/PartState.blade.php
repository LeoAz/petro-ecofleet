@if( $state === \App\Enums\Maintenance\PartState::InStock)
    <span class="badge badge-dim badge-success">
        <span>{{ \App\Enums\Maintenance\PartState::getDescription($state) }}</span>
    </span>
@else
    <span class="badge badge-dim badge-danger">
        <span>{{ \App\Enums\Maintenance\PartState::getDescription($state) }}</span>
    </span>
@endif
