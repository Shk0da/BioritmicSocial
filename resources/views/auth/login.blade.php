@section('content')
    <div class="container main login">
        <div class="row">
            <div class="col-md-3 col-md-offset-4 panel">
                <form class="form-horizontal" role="form" method="post" action="{{ route('auth.login') }}">
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
                        @if ($errors->has('info'))
                            <span class="help-block">{{$errors->first('info')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember"> Запомнить меня
                            </label>
                        </div>
                    </div>
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <button type="submit" class="btn btn-default">Войти</button>
                        <a href="{{ route('main') }}">Регистрация</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop