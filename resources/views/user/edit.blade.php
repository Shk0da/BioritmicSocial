@section('content')
    @include('layout.nav')
    <div class="anp" id="app-growl"></div>
    @include('layout.message')
    @include('layout.friends')
    <div class="by ams">
        <div class="gd">
            @include('layout.left')

            <div class="ha">
                <h3>Редактирование профиля</h3>

                <form class="form-horizontal" method="post" action="{{ route('user.save') }}">

                    <div class="form-group">
                        <label for="email" class="col-sm-3 control-label">Email</label>
                        <div class="col-sm-9">
                            <input id="email" type="text" class="form-control" value="{{ $user->getEmail() }}" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-3 control-label">Имя</label>
                        <div class="col-sm-9">
                            <input id="name" name="name" type="text" class="form-control" value="{{ $user->getName() }}" placeholder="Имя">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="location" class="col-sm-3 control-label">Дата рождения:</label>

                        <div class="col-sm-9">
                            <select name="birthday[d]" class="btn dropdown-toggle">
                                <option value="{{ (int)$user->getBirthday()[2] }}" selected>{{ $user->getBirthday()[2] or 'День' }}</option>
                                @for($i = 1; $i <= 31; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            <select name="birthday[m]" class="btn dropdown-toggle">
                                <option value="{{ (int)$user->getBirthday()[1] }}" selected>{{ $month[$user->getBirthday()[1]-1] or 'Месяц' }}</option>
                                @foreach( $month as $i => $m)
                                    <option value="{{ $i+1 }}">{{ $m }}</option>
                                @endforeach
                            </select>
                            <select name="birthday[y]" class="btn dropdown-toggle">
                                <option value="{{ (int)$user->getBirthday()[0] }}" selected>{{ $user->getBirthday()[0] or 'Год' }}</option>
                                @for($i = 1939; $i <= date('Y')-14; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="status" class="col-sm-3 control-label">Статус</label>
                        <div class="col-sm-9">
                            <input id="status" name="status" type="text" class="form-control" value="{{ $user->getStatus() }}" placeholder="Статус">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="location" class="col-sm-3 control-label">Город</label>
                        <div class="col-sm-9">
                            <input id="location" name="location" type="text" class="form-control" value="{{ $user->getLocation() }}" placeholder="Город">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="about" class="col-sm-3 control-label">О себе</label>
                        <div class="col-sm-9">
                            <textarea id="about" name="about" type="text" class="form-control" rows="3">{{ $user->getAbout() }}</textarea>
                        </div>
                    </div>

                    {!! csrf_field() !!}

                    <div class="form-group">
                        <div class="col-sm-offset-9 col-sm-2">
                            <button type="submit" class="btn btn-default">Сохранить</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="go">
                <div class="qw rd aof alt qx dj">
                    <a href="/reset">Сбросить пароль</a>
                </div>
            </div>

        </div>
    </div>
@stop