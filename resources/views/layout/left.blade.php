<div class="go">

    <div class="qw rd aof alt">
        <div class="qy" style="background-image: url({{$user->getBackground()}});"></div>
        <div class="qx dj">
            @include('user.avatar')
            <h5 class="qz">
                <a class="akt" href="/id{{$user->id}}">{{ $user->getName() }}</a>
            </h5>

            <p class="alt">{{ $user->getStatus() }}</p>

            <ul class="aoh">
                <li class="aoi">
                    <a href="#friendsModal" class="akt" data-toggle="modal">
                        Друзья
                        <h5 class="alh">{{ $user->friends()->count() }}</h5>
                    </a>
                </li>

                <li class="aoi">
                    <a href="#subscribersModal" class="akt" data-toggle="modal">
                        Подписчики
                        <h5 class="alh">{{ $user->friendsRequests()->count() }}</h5>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="qw rd sn sq">
        <div class="qx">
            <h5 class="alc">Информация
                <small>· <a href="{{ route('edit') }}">Редактировать</a></small>
            </h5>
            <ul class="eb tc">
                <li><span class="dp h xg alk"></span>Дата рождения: {{ $user->getStringBirthday() }}
                <li><span class="dp h abt alk"></span>Вы рождены в год <a>{{ $user->getAnimal() }}</a>
                <li><span class="dp h ajv alk"></span>Знак зодиака: <a href="{{ route('search') }}?zodiac=on">{{ $user->getZodiac() }}</a>
                <li><span class="dp h ads alk"></span>Город: <a href="{{ route('search') }}?location={{ $user->profile->location }}">{{ $user->getLocation() }}</a>
            </ul>
        </div>
    </div>

    @if ($user->album()->count())
    <div class="qw rd sn sq">
        <div class="qx">
            <h5 class="alc">Фотографии
                <small>· <a href="{{ route('photo.edit') }}">Редактировать</a></small>
            </h5>
            <div data-grid="images" data-target-height="150">
                @foreach ($user->album()->get() as $album)
                    @if ($preview = $user->photo()->where('album_id', $album->id)->first())
                        <div>
                            <a href="{{ route('photo.album.show' , ['albumId' => $album->id]) }}"><img src="{{ $preview->getUrl() }}" title="{{ $album->name }}"></a>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    @else
        <div class="qw rd sn sq">
            <div class="qx">
                <h5 class="alc">Фотографии
                    <small>· <a href="{{ route('photo.edit') }}">Редактировать</a></small>
                </h5>
                <p class="text-center">У вас еще нет ни одной фотографии...</p>
            </div>
        </div>
    @endif
</div>
