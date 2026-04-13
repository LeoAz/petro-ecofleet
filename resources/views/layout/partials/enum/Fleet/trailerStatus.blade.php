@if( $status === \App\Enums\Fleet\TrailerStatus::Available )
    <span class="badge badge-dim badge-success">
        <span>{{ \App\Enums\Fleet\TrailerStatus::getDescription($status) }}</span>
    </span>
@elseif( $status === \App\Enums\Fleet\TrailerStatus::Reform )
    <span class="badge badge-dark">
        <span>{{ \App\Enums\Fleet\TrailerStatus::getDescription($status) }}</span>
    </span>
@elseif( $status === \App\Enums\Fleet\TrailerStatus::Linked )
    <span class="badge badge-info">
        <span>{{ \App\Enums\Fleet\TrailerStatus::getDescription($status) }}</span>
    </span>
@else
    <span class="badge badge-light">
        <span>{{ \App\Enums\Fleet\TrailerStatus::getDescription($status) }}</span>
    </span>
@endif
