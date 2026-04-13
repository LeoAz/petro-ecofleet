@if( $status === \App\Enums\Maintenance\InventoryStatus::Open)
    <span class="badge badge-dim badge-primary">
        <span>{{ \App\Enums\Maintenance\InventoryStatus::getDescription($status) }}</span>
    </span>
@else
    <span class="badge badge-secondary">
        <span>{{ \App\Enums\Maintenance\InventoryStatus::getDescription($status) }}</span>
    </span>
@endif
