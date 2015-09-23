<div class="qg">
    <a class="qk" href="#">
        <img class="qi cu" data-action="zoom" src="{{ $people->getImageProfile() }}">
    </a>
    <div class="qh">
        <button class="cg ts fx eg">
            @if (!$user->isFriendWith($people))
                <a href="{{ route('friend.add', $people) }}">
                    <span class="h vb"></span> Добавить
                </a>
            @else
                <a href="{{ route('friend.remove', $people) }}">
                    <span class="h vb"></span> Убрать
                </a>
            @endif
        </button>
        <a href="{{ $people->getProfileLink() }}"><strong>{{ $people->getName() }}</strong></a>
        <p>@город  - {{ $people->getLocation() ?: 'не указан' }}</p>
    </div>
</div>