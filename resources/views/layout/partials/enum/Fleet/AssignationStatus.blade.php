@if( $status == \App\Enums\Fleet\AssignationStatus::Active)
    <span class="badge badge-dim badge-success">
        <span>{{ \App\Enums\Fleet\AssignationStatus::getDescription($status) }}</span>
    </span>
@else
    <span class="badge badge-dim badge-dark">
        <span>{{ \App\Enums\Fleet\AssignationStatus::getDescription($status) }}</span>
    </span>
@endif
