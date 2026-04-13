@if( $status === \App\Enums\Maintenance\GarageStatus::Pending)
    <span class="badge badge-dim badge-info">
        <span>{{ \App\Enums\Maintenance\GarageStatus::getDescription($status)}}</span>
    </span>
@elseif( $status === \App\Enums\Maintenance\GarageStatus::Ongoing )
    <span class="badge badge-success">
        <span>{{ \App\Enums\Maintenance\GarageStatus::getDescription($status)}}</span>
    </span>
@else
    <span class="badge badge-primary">
        <span>{{ \App\Enums\Maintenance\GarageStatus::getDescription($status)}}</span>
    </span>
@endif
