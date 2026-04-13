@if( $status === \App\Enums\User\UserStatus::Active)
    <span class="badge badge-dim badge-success">
        <span>{{ \App\Enums\User\UserStatus::getDescription($status) }}</span>
    </span>
@else
    <span class="badge badge-dim badge-danger">
        <span>{{ \App\Enums\User\UserStatus::getDescription($status) }}</span>
    </span>
@endif
