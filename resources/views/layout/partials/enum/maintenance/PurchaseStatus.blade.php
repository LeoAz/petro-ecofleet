@if( $status === \App\Enums\Maintenance\PurchaseStatus::Validated)
    <span class="badge badge-dim badge-success">
        <span>{{ \App\Enums\Maintenance\PurchaseStatus::getDescription($status) }}</span>
    </span>
@else
    <span class="badge badge-dim badge-danger">
        <span>{{ \App\Enums\Maintenance\PurchaseStatus::getDescription($status) }}</span>
    </span>
@endif
