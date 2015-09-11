@section('content')
    <div class="container main">
        <div class="row">
            <div class="col-md-8">
                <div class="welcome">
                    <h1>Найди свою идеальную пару</h1>
                    <p>
                        Найди свою половинку раз и навсегда...
                    </p>
                </div>
            </div>
            <div class="col-md-3 panel">
                <form class="form-horizontal" role="form" method="post" action="{{ route('auth.create') }}">
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <input type="text" name="name" class="form-control" id="inputName" placeholder="Имя"
                               value="{{ old('name') }}">
                        @if ($errors->has('name'))
                            <span class="help-block">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email"
                               value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <span class="help-block">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Пароль">
                        @if ($errors->has('password'))
                            <span class="help-block">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    {!! csrf_field() !!}
                    <div class="form-group">
                         <button type="submit" class="btn btn-default">Зарегистрироваться</button>
                    </div>
                </form>
                <p>
                    Уже зарегистрированы?
                    <a href="{{ route('auth.login') }}">Войти</a>
                </p>
            </div>
        </div>
    </div>
@stop