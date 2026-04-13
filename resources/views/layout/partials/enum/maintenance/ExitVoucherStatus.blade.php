@if( $status === \App\Enums\Maintenance\ExitVoucherStatus::Opened)
    <span class="badge badge-dim badge-primary">
        <span>{{ \App\Enums\Maintenance\ExitVoucherStatus::getDescription($status) }}</span>
    </span>
@else
    <span class="badge badge-success">
        <span>{{ \App\Enums\Maintenance\ExitVoucherStatus::getDescription($status) }}</span>
    </span>
@endif
