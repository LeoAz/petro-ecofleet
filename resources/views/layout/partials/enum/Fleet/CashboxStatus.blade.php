@if( $status == \App\Enums\CashboxStatus::Open)
    <span class="badge badge-dim badge-success">
        <span>{{ \App\Enums\CashboxStatus::getDescription($status) }}</span>
    </span>
@else
    <span class="badge badge-dim badge-danger">
        <span>{{ \App\Enums\CashboxStatus::getDescription($status) }}</span>
    </span>
@endif
