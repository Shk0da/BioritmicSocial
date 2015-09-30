<div class="qg">
    <a class="qk" href="#">
        <img class="qi cu" data-action="zoom" src="{{ $people->getImageProfile() }}">
    </a>
    <div class="qh">
        <button class="cg ts fx eg">
            @if ($user->isFriendWith($people))
                <a href="{{ route('friend.remove', $people) }}">
                    <span class="h vb"></span> Убрать
                </a>
            @elseif ($user->hasRequestPending($people))
                <a href="{{ route('friend.remove.request', $people) }}">
                    Отменить заявку
                </a>
            @elseif (!$user->isFriendWith($people))
                <a href="{{ route('friend.add', $people) }}">
                    <span class="h vb"></span> Добавить
                </a>
            @endif
        </button>
        <a href="{{ $people->getProfileLink() }}"><strong>{{ $people->getName() }}</strong>
            @if($user->hasFriendRequestReceived($people))
                (подписался на вас)
            @endif
            {{ $people->getAge() ? "({$people->getAge()} лет)": '' }}
        </a>
        <p>@город  - {{ $people->getLocation() ?: 'не указан' }}</p>
    </div>
</div>