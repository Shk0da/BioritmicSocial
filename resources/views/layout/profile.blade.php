@section('content')
    @include('layout.nav')
    <div class="anr dj"
         style="background-image: url({{$user->getBackground()}});">
        <div class="by">
            <div class="ans">
                <img class="cu qi" src="{{$user->getImageProfile()}}">

                <h3 class="anu">{{$user->getName()}}</h3>

                <p class="ant">
                    {{$user->getStatus()}}
                </p>

                <p class="ant">
                    {{ $user->getAge() }} лет
                    <small>·</small> {{ $user->getLocation() }}
                </p>

                @if ($authUser <> $user)
                    <a class="btn cg ts fx"
                       @if ($authUser->isFriendWith($user))
                       href="{{ route('friend.remove', $user) }}">
                        Убрать из друзей

                        @elseif ($authUser->hasRequestPending($user))
                            href="{{ route('friend.remove.request', $user) }}">
                            Отменить заявку

                        @elseif (!$authUser->isFriendWith($user))
                            href="{{ route('friend.add', $user) }}">
                            Добавить
                        @endif
                    </a>
                @endif

            </div>
        </div>

        <nav class="anv">
            <ul class="nav om" role="tablist">
                <li role="presentation" class="active">
                    <a href="#albums" aria-controls="albums" role="tab" data-toggle="tab">
                        Все фотографии
                    </a>
                </li>
                @foreach($albums as $album)
                    <li role="presentation">
                        <a href="#album{{ $album->id }}" aria-controls="album{{ $album->id }}" role="tab"
                           data-toggle="tab">
                            {{ $album['name'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>
    </div>

    <div class="tab-content">
        <div role="tabpanel" id="albums" class="tab-pane by alw active" data-grid="images">
            @foreach($photos = $user->photo()->notUpload()->get() as $photo)
                <img data-action="zoom" data-width="640" data-height="400" src="{{ $photo->getUrl() }}"/>
            @endforeach
        </div>
        @if ($photos->count() < 1)
            <div class="text-center">У пользователся еще нет загруженных фотографий</div>
        @endif
        @foreach($albums as $album)
            <div role="tabpanel" id="album{{ $album->id }}" class="tab-pane by alw" data-grid="images">
                @foreach($user->photo()->where('album_id', $album->id)->get() as $photo)
                    <img data-action="zoom" data-width="640" data-height="400" src="{{ $photo->getUrl() }}"/>
                @endforeach
            </div>
        @endforeach
    </div>

@stop