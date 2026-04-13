@if( count($breadcrumbs))
    <div class="d-flex bg-light mb-5">
        <div class="p-2">
            <nav>
                <ul class="breadcrumb breadcrumb-arrow">
                    @foreach( $breadcrumbs as $breadcrumb)
                        @if( $breadcrumb->url && !$loop->last)
                            <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                        @else
                            <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
                        @endif
                    @endforeach
                </ul>
            </nav>
        </div>
    </div>
@endif
