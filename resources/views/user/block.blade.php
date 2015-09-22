<div class="qg">
    <a class="qk" href="#">
        <img class="qi cu" data-action="zoom" src="{{ $user->getImageProfile() }}">
    </a>
    <div class="qh">
        <button class="cg ts fx eg">
            @if($user->hasRequestToFriend())
                <a href="{{ route('friend.remove.request', $user) }}">
                    <span class="h vb"></span> Отменить заявку
                </a>
            @elseif (!$user->hasFriend())
                <a href="{{ route('friend.add', $user) }}">
                    <span class="h vb"></span> Добавить
                </a>
            @endif
        </button>
        <a href="{{ $user->getProfileLink() }}"><strong>{{ $user->getName() }}</strong></a>
        <p>@город  - {{ $user->getLocation() ?: 'не указан' }}</p>
    </div>
</div>