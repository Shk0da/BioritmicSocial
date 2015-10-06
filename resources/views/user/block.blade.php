<div class="qg">
    <a class="qk" href="#">
        <img class="qi cu" data-action="zoom" src="{{ $people->getImageProfile() }}">
    </a>
    <div class="qh" title="{{ $user->getCompare($people) }}">
        <a class="btn cg ts fx eg"
           @if ($user->isFriendWith($people))
               href="{{ route('friend.remove', $people) }}">
               <span class="h vb"></span> Убрать

            @elseif ($user->hasRequestPending($people))
                href="{{ route('friend.remove.request', $people) }}">
                Отменить заявку

            @elseif (!$user->isFriendWith($people))
                href="{{ route('friend.add', $people) }}">
                <span class="h vb"></span> Добавить
                @if($user->hasFriendRequestReceived($people))
                    <br>(подписался на вас)
                @endif
            @endif
        </a>

        <a href="{{ $people->getProfileLink() }}"><strong>{{ $people->getName() }}</strong>
            {{ $people->getAge() ? "({$people->getAge()} лет)": '' }}
        </a>
        <p>@город  - {{ $people->getLocation() ?: 'не указан' }}</p>
    </div>
</div>