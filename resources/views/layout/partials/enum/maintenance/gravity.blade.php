@if( $gravity === \App\Enums\Maintenance\Gravity::Low)
    <span class="badge badge-dim badge-success">
        <span>{{ \App\Enums\Maintenance\Gravity::getDescription($gravity)}}</span>
    </span>
@elseif( $gravity === \App\Enums\Maintenance\Gravity::High )
    <span class="badge badge-danger">
        <span>{{ \App\Enums\Maintenance\Gravity::getDescription($gravity)}}</span>
    </span>
@else
    <span class="badge badge-dark">
        <span>{{ \App\Enums\Maintenance\Gravity::getDescription($gravity)}}</span>
    </span>
@endif
