<nav class="ck pd ot app-navbar">
    <div class="by">
        <div class="os">
            <button type="button" class="ov collapsed" data-toggle="collapse" data-target="#navbar-collapse-main">
                <span class="cv">Toggle navigation</span>
                <span class="ow"></span>
                <span class="ow"></span>
                <span class="ow"></span>
            </button>
            <a class="e" href="/">
                <img src="/public/img/brand-white.png" alt="brand">
            </a>
        </div>
        <div class="f collapse" id="navbar-collapse-main">

            <ul class="nav navbar-nav st">
                <li class="active">
                    <a href="/">Home</a>
                </li>
                <li>
                    <a href="/id{{$user->id}}">Profile</a>
                </li>
                <li>
                    <a data-toggle="modal" href="#msgModal">Messages</a>
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
                        <img class="cu" src="/public/img/avatar-dhg.png">
                    </button>
                </li>
            </ul>

            <form class="ox oh i" role="search" action="{{ route('search') }}">
                <div class="et">
                    <input type="text" name="query" class="form-control" data-action="grow" placeholder="Поиск">
                </div>
            </form>

            <ul class="nav navbar-nav su sv sw">
                <li><a href="/">Home</a></li>
                <li><a href="/profile/">Profile</a></li>
                <li><a href="/notifications/">Notifications</a></li>
                <li><a data-toggle="modal" href="#msgModal">Messages</a></li>
                <li><a href="{{ route('edit') }}">{{ $user->getName() }}</a></li>
                <li><a href="{{ route('auth.logout') }}">Logout</a></li>
            </ul>

            <ul class="nav navbar-nav hidden">
                <li><a href="{{ route('edit') }}">{{ $user->getName() }}</a></li>
                <li><a href="{{ route('auth.logout') }}">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>