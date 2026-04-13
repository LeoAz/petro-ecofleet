@if( $type == \App\Enums\OpType::CashIn)
    <span class="badge badge-dim badge-success">
        <span>{{ \App\Enums\OpType::getDescription($type) }}</span>
    </span>
@else
    <span class="badge badge-dim badge-danger">
        <span>{{ \App\Enums\OpType::getDescription($type) }}</span>
    </span>
@endif
