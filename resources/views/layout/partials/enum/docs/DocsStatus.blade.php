@if( $status === \App\Enums\Fleet\DocumentStatus::Active)
    <span class="badge badge-dim badge-success">
        <span>{{ \App\Enums\Fleet\DocumentStatus::getDescription($status) }}</span>
    </span>
@else
    <span class="badge badge-dim badge-danger">
        <span>{{ \App\Enums\Fleet\DocumentStatus::getDescription($status) }}</span>
    </span>
@endif
