<div class="go">
    @if( isset($info) )
    <div class="alert pw alert-dismissible st" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        {{ $info }}
    </div>
    @endif

    <div class="qw rd alt st">
        <div class="qx">
            <h5 class="alc">Реклама</h5>
            <div>
                <a href="//ya.ru" target="_blank"><img width="250" class="qi" src="/img/adv_temp.jpg"></a>
            </div>
        </div>
    </div>

        @if (count($user->getUserLikes()))
            <div class="qw rd alt st">
                <div class="qx">
                    <h5 class="alc">Лайки
                        <small>· <a href="#">Посмотреть все</a></small>
                    </h5>
                    <ul class="qp anw">

                        @foreach($user->getUserLikes() as $userLikes)
                            <li class="qg all">
                                <a class="qk" href="{{ $userLikes->getProfileLink() }}">
                                    <img class="qi cu" src="{{ $userLikes->getImageProfile() }}">
                                </a>

                                <div class="qh">
                                    <strong>{{ $userLikes->getName() }}</strong>

                                    <div class="anz">
                                        <a class="btn cg ts fx"
                                           @if ($user->isFriendWith($userLikes))
                                           href="{{ route('friend.remove', $userLikes) }}">
                                            <span class="h vb"></span> Убрать

                                            @elseif ($user->hasRequestPending($userLikes))
                                                href="{{ route('friend.remove.request', $userLikes) }}">
                                                Отменить заявку

                                            @elseif (!$user->isFriendWith($userLikes))
                                                href="{{ route('friend.add', $userLikes) }}">
                                                <span class="h vb"></span> Добавить
                                                @if($user->hasFriendRequestReceived($userLikes))
                                                    <br>(подписался на вас)
                                                @endif
                                            @endif
                                        </a>
                                    </div>
                                </div>
                            </li>
                        @endforeach

                    </ul>
                </div>
                <div class="ra">
                    Кажется вы нравитесь этим людям
                </div>
            </div>
        @endif

    <div class="qw rd aoj">
        <div class="qx">
            © 2015 Bioritmic
        </div>
    </div>
</div>