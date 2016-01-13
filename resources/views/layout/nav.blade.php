<nav class="ck pd ot app-navbar">
    <div class="by">
        <div class="os">
            <button type="button" class="ov collapsed" data-toggle="collapse" data-target="#navbar-collapse-main">
                <span class="cv">Меню</span>
                <span class="ow"></span>
                <span class="ow"></span>
                <span class="ow"></span>
            </button>
            <a class="e" href="/">
                Bioritmic
            </a>
        </div>
        <div class="f collapse" id="navbar-collapse-main">
            <ul class="nav navbar-nav st">
                <li{{ (Route::currentRouteName() == 'main') ? ' class=active' : ''}}>
                    <a href="/">Новости</a>
                </li>
                <li{{ (Route::currentRouteName() == 'profile') ? ' class=active' : ''}}>
                    <a href="/id{{Auth::user()->id}}">Профиль</a>
                </li>
                <li{{ (Route::currentRouteName() == 'messages') ? ' class=active' : ''}}>
                    <a href="{{ route('messages') }}" data-featherlight="ajax">Сообщения</a>
                </li>
                <li{{ (Route::currentRouteName() == 'search') ? ' class=active' : ''}}>
                    <a href="{{ route('search') }}?ideal=on">Найти идеальную пару</a>
                </li>
            </ul>

            <ul class="nav navbar-nav oh ald st">
                <li>
                    <a class="g" href="/notifications/">
                        <span class="h wr"></span>
                    </a>
                </li>
                <li>
                    <button class="cg fm oy ank" data-toggle="popover">
                        <img class="cu" src="{{Auth::user()->getImageProfile()}}">
                    </button>
                </li>
            </ul>

            <form class="ox oh i" role="search" action="{{ route('search') }}">
                <div class="et">
                    <input type="text" name="name" class="form-control" data-action="grow" placeholder="Поиск">
                </div>
            </form>

            <ul class="nav navbar-nav su sv sw">
                <li><a href="/">Новости</a></li>
                <li><a href="/profile/">Профиль</a></li>
                <li><a href="/notifications/">Обновления</a></li>
                <li><a data-toggle="modal" href="#messages">Сообщения</a></li>
                <li><a href="{{ route('edit') }}">{{ Auth::user()->getName() }}</a></li>
                <li><a href="{{ route('auth.logout') }}">Выйти</a></li>
            </ul>

            <ul class="nav navbar-nav hidden">
                <li><a href="{{ route('edit') }}">{{ Auth::user()->getName() }}</a></li>
                <li><a href="{{ route('auth.logout') }}">Выйти</a></li>
            </ul>
        </div>
    </div>
</nav>