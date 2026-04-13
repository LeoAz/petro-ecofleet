@if( $status === \App\Enums\Maintenance\OrderStatus::Created)
    <span class="badge badge-dim badge-info">
        <span>{{ \App\Enums\Maintenance\OrderStatus::getDescription($status)}}</span>
    </span>
@elseif( $status === \App\Enums\Maintenance\OrderStatus::Validated )
    <span class="badge badge-success">
        <span>{{ \App\Enums\Maintenance\OrderStatus::getDescription($status)}}</span>
    </span>
@else
    <span class="badge badge-primary">
        <span>{{ \App\Enums\Maintenance\OrderStatus::getDescription($status)}}</span>
    </span>
@endif
