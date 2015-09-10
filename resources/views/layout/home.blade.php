@section('content')
@include('layout.nav')
<div class="anp" id="app-growl"></div>
@include('layout.message')
@include('layout.friends')
<div class="by ams">
    <div class="gd">
        @include('layout.left')
        @include('layout.wall')
        @include('layout.right')
    </div>
</div>
@stop