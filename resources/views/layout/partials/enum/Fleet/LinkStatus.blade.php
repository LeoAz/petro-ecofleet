@if( $status == \App\Enums\Fleet\LinkStatus::Active)
    <span class="badge badge-dim badge-success">
        <span>{{ \App\Enums\Fleet\LinkStatus::getDescription($status) }}</span>
    </span>
@else
    <span class="badge badge-dim badge-dark">
        <span>{{ \App\Enums\Fleet\LinkStatus::getDescription($status) }}</span>
    </span>
@endif
