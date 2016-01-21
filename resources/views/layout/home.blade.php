@section('content')
    @include('layout.nav')
    @include('layout.friends')
    <div class="by ams">
        @include('layout.left')
        @include('layout.wall')
        @include('layout.right')
    </div>
@stop