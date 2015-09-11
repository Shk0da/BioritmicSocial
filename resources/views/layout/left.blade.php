<div class="go">
    <div class="qw rd aof alt">
        <div class="qy" style="background-image: url(/public/img/iceland.jpg);"></div>
        <div class="qx dj">
            <a data-toggle="modal" href="#changeImage">
                <img class="aog" src="/public/img/avatar-dhg.png">
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
                <li><span class="dp h abt alk"></span>Вы рождены в год <a href="#">{{ $user->getAnimal() }}</a>
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

<div class="cd fade" id="changeImage" tabindex="-1" role="dialog" aria-labelledby="changeImage" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="d">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Изменить изображение профиля</h4>
            </div>

            <div class="modal-body ame js-modalBody">
                <div class="changeImage">
                    <img src="/public/img/avatar-dhg.png">
                </div>
                <div class="ac">
                    <div class="action">
                        Выбрать другое изображение
                        Сохранить
                    </div>
                    <button type="button" class="cg fx fp eg k js-newMsg">Сохранить</button>
                </div>
            </div>
        </div>
    </div>
</div>