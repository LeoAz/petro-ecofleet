@if( $state === \App\Enums\Maintenance\ExitVoucherState::Used)
    <span class="badge badge-dim badge-danger">
        <span>{{ \App\Enums\Maintenance\ExitVoucherState::getDescription($state) }}</span>
    </span>
@else
    <span class="badge badge-dark">
        <span>{{ \App\Enums\Maintenance\ExitVoucherState::getDescription($state) }}</span>
    </span>
@endif
