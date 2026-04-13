@if( $status === \App\Enums\Fleet\VehicleStatus::Available)
    <span class="badge badge-dim badge-primary">
        <em class="icon ni ni-check-circle"></em>
        <span>{{ \App\Enums\Fleet\VehicleStatus::getDescription($status) }}</span>
    </span>
@elseif( $status === \App\Enums\Fleet\VehicleStatus::Garage)
    <span class="badge badge-dim badge-secondary">
        <em class="icon ni ni-alert"></em>
        <span>{{ \App\Enums\Fleet\VehicleStatus::getDescription($status) }}</span>
    </span>
@elseif( $status === \App\Enums\Fleet\VehicleStatus::Reform)
    <span class="badge badge-light">
        <em class="icon ni ni-signout"></em>
        <span>{{ \App\Enums\Fleet\VehicleStatus::getDescription($status) }}</span>
    </span>
@elseif( $status === \App\Enums\Fleet\VehicleStatus::Travel)
    <span class="badge badge-dim badge-info">
        <em class="icon ni ni-clock"></em>
        <span>{{ \App\Enums\Fleet\VehicleStatus::getDescription($status) }}</span>
    </span>
@endif
