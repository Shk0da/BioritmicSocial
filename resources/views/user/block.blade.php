<div class="qg">
    <a class="qk" href="#">
        <img class="qi cu" data-action="zoom" src="{{ $user->getImageProfile() }}">
    </a>
    <div class="qh">
        <button class="cg ts fx eg">
            <span class="h vb"></span> Добавить
        </button>
        <a href="{{ $user->getProfileLink() }}"><strong>{{ $user->getName() }}</strong></a>
        <p>@город  - {{ $user->getLocation() ?: 'не указан' }}</p>
    </div>
</div>