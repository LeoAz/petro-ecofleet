@if( $status === \App\Enums\Fleet\DriverStatus::Assign)
    <span class="badge badge-dim badge-success">
        <span>{{ \App\Enums\Fleet\DriverStatus::getDescription($status) }}</span>
    </span>
@else
    <span class="badge badge-dim badge-warning">
        <span>{{ \App\Enums\Fleet\DriverStatus::getDescription($status) }}</span>
    </span>
@endif
