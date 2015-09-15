@section('content')
    @include('layout.nav')
    @include('layout.message')
<div class="anr dj"
     style="background-image: url({{$user->getBackground()}});">
    <div class="by">
        <div class="ans">
            <img class="cu qi" src="{{$user->getImageProfile()}}">
            <h3 class="anu">{{$user->getName()}}</h3>
            <p class="ant">
                {{$user->getStatus()}}
            </p>
        </div>
    </div>

    <nav class="anv">
        <ul class="nav om">
            <li class="active">
                <a href="#">Photos</a>
            </li>
            <li>
                <a href="#">Others</a>
            </li>
            <li>
                <a href="#">Anothers</a>
            </li>
        </ul>
    </nav>
</div>

<div class="by alw" data-grid="images">
    <div>
        <img data-width="640" data-height="400" data-action="zoom" src="/public/img/instagram_5.jpg">
    </div>

    <div>
        <img data-width="640" data-height="640" data-action="zoom" src="/public/img/instagram_6.jpg">
    </div>

    <div>
        <img data-width="640" data-height="640" data-action="zoom" src="/public/img/instagram_7.jpg">
    </div>

    <div>
        <img data-width="640" data-height="640" data-action="zoom" src="/public/img/instagram_8.jpg">
    </div>

    <div>
        <img data-width="640" data-height="640" data-action="zoom" src="/public/img/instagram_9.jpg">
    </div>

    <div>
        <img data-width="640" data-height="640" data-action="zoom" src="/public/img/instagram_10.jpg">
    </div>

    <div>
        <img data-width="640" data-height="400" data-action="zoom" src="/public/img/instagram_11.jpg">
    </div>

    <div>
        <img data-width="640" data-height="640" data-action="zoom" src="/public/img/instagram_12.jpg">
    </div>

    <div>
        <img data-width="640" data-height="400" data-action="zoom" src="/public/img/instagram_13.jpg">
    </div>

    <div>
        <img data-width="640" data-height="640" data-action="zoom" src="/public/img/instagram_14.jpg">
    </div>

    <div>
        <img data-width="640" data-height="640" data-action="zoom" src="/public/img/instagram_15.jpg">
    </div>

    <div>
        <img data-width="640" data-height="640" data-action="zoom" src="/public/img/instagram_16.jpg">
    </div>

    <div>
        <img data-width="640" data-height="640" data-action="zoom" src="/public/img/instagram_17.jpg">
    </div>

    <div>
        <img data-width="640" data-height="640" data-action="zoom" src="/public/img/instagram_18.jpg">
    </div>

    <div>
        <img data-width="640" data-height="400" data-action="zoom" src="/public/img/instagram_1.jpg">
    </div>

    <div>
        <img data-width="640" data-height="640" data-action="zoom" src="/public/img/instagram_2.jpg">
    </div>
</div>
@stop