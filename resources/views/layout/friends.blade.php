<div class="cd fade" id="friendsModal" tabindex="-1" role="dialog" aria-labelledby="friendsModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="d">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Друзья</h4>
            </div>

            <div class="modal-body ame">
                <div class="up">
                    <ul class="qp cj ca">
                        @foreach($user->friends() as $friend)
                            <li class="b">
                                <div class="qg">
                                    <a class="qk" href="#">
                                        <img class="qi cu" src="{{ $friend->getImageProfile() }}">
                                    </a>

                                    <div class="qh">
                                        <button class="cg fm fx eg">
                                            @if ($user->isFriendWith($friend))
                                                <a href="{{ route('friend.remove', $friend) }}">
                                                    <span class="c aok"></span> Убрать
                                                </a>
                                            @endif
                                        </button>
                                        <strong>{{ $friend->getName() }}</strong>

                                        <p>{{ $friend->getLocation() }}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="cd fade" id="subscribersModal" tabindex="-1" role="dialog" aria-labelledby="subscribersModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="d">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Подписчики</h4>
            </div>

            <div class="modal-body ame">
                <div class="up">
                    <ul class="qp cj ca">
                        @foreach($user->friendsRequests() as $friend)
                            <li class="b">
                                <div class="qg">
                                    <a class="qk" href="#">
                                        <img class="qi cu" src="{{ $friend->getImageProfile() }}">
                                    </a>

                                    <div class="qh">
                                        <button class="cg fm fx eg">
                                            @if (!$user->isFriendWith($friend))
                                                <a href="{{ route('friend.accept', $friend) }}">
                                                    <span class="c aok"></span> Добавить
                                                </a>
                                            @endif
                                        </button>
                                        <strong>{{ $friend->getName() }}</strong>

                                        <p>{{ $friend->getLocation() }}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>