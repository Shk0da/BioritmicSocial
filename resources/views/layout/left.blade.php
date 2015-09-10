<div class="go">
    <div class="qw rd aof alt">
        <div class="qy" style="background-image: url(/public/img/iceland.jpg);"></div>
        <div class="qx dj">
            <a href="/id{{$user->id}}">
                <img
                        class="aog"
                        src="/public/img/avatar-dhg.png">
            </a>

            <h5 class="qz">
                <a class="akt" href="/id{{$user->id}}">{{ $user->getName() }}</a>
            </h5>

            <p class="alt">{{ $user->getStatus() }}</p>

            <ul class="aoh">
                <li class="aoi">
                    <a href="#userModal" class="akt" data-toggle="modal">
                        Друзья
                        <h5 class="alh">12M</h5>
                    </a>
                </li>

                <li class="aoi">
                    <a href="#userModal" class="akt" data-toggle="modal">
                        Подписчики
                        <h5 class="alh">1</h5>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="qw rd sn sq">
        <div class="qx">
            <h5 class="alc">Информация
                <small>· <a href="{{ route('edit') }}">Edit</a></small>
            </h5>
            <ul class="eb tc">
                <li><span class="dp h xg alk"></span>Дата рождения: {{ $user->getStringBirthday() }}
                <li><span class="dp h abt alk"></span>Вы рождены в год <a href="#">{{ $user->getChinaZodiac() }}</a>
                <li><span class="dp h ajv alk"></span>Знак зодиака: <a href="#">{{ $user->getZodiac() }}</a>
                <li><span class="dp h ads alk"></span>Город: <a href="#">{{ $user->getLocation() }}</a>
            </ul>
        </div>
    </div>

    <div class="qw rd sn sq">
        <div class="qx">
            <h5 class="alc">Фотографии
                <small>· <a href="#">Edit</a></small>
            </h5>
            <div data-grid="images" data-target-height="150">
                <div>
                    <img data-width="640" data-height="640" data-action="zoom"
                         src="/public/img/instagram_5.jpg">
                </div>

                <div>
                    <img data-width="640" data-height="640" data-action="zoom"
                         src="/public/img/instagram_6.jpg">
                </div>

                <div>
                    <img data-width="640" data-height="640" data-action="zoom"
                         src="/public/img/instagram_7.jpg">
                </div>

                <div>
                    <img data-width="640" data-height="640" data-action="zoom"
                         src="/public/img/instagram_8.jpg">
                </div>

                <div>
                    <img data-width="640" data-height="640" data-action="zoom"
                         src="/public/img/instagram_9.jpg">
                </div>

                <div>
                    <img data-width="640" data-height="640" data-action="zoom"
                         src="/public/img/instagram_10.jpg">
                </div>
            </div>
        </div>
    </div>
</div>