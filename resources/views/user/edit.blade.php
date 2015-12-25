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
                            @if ($errors->has('name'))
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="location" class="col-sm-3 control-label">Дата рождения:</label>

                        <div class="col-sm-9">
                            <select name="birthday[d]" class="btn dropdown-toggle">
                                @for($i = 1; $i <= 31; $i++)
                                    <option value="{{ $i }}"{{ (isset($user->getBirthday()[2]) && $user->getBirthday()[2] == $i) ? ' selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            <select name="birthday[m]" class="btn dropdown-toggle">
                                @foreach( $month as $i => $m)
                                    <option value="{{ $i+1 }}"{{ (isset($user->getBirthday()[1]) && $user->getBirthday()[1] == $i+1) ? ' selected' : '' }}>{{ $m }}</option>
                                @endforeach
                            </select>
                            <select name="birthday[y]" class="btn dropdown-toggle">
                                @for($i = date('Y')-14; $i >= 1939; $i--)
                                    <option value="{{ $i }}"{{ (isset($user->getBirthday()[0]) && $user->getBirthday()[0] == $i) ? ' selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            @if ($errors->has('birthday'))
                                <span class="help-block">{{ $errors->first('birthday') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="gender" class="col-sm-3 control-label">Пол</label>
                        <div class="col-sm-9">
                            <label class="radio-inline">
                                <input type="radio" name="gender" value="1"{{ $user->getIntGender() === 1 ? ' checked' : '' }}> Мужской
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="gender" value="0"{{ $user->getIntGender() === 0 ? ' checked' : '' }}> Женский
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="status" class="col-sm-3 control-label">Статус</label>
                        <div class="col-sm-9">
                            <input id="status" name="status" type="text" class="form-control" value="{{ $user->getStatus() }}" placeholder="Статус">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="country" class="col-sm-3 control-label">Страна</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="country">
                                <option disabled>Выберите страну</option>
                                @foreach($user->getCountryList() as $country)
                                    <option value="{{ $country }}"{{ $country == $user->getCountry() ? ' selected' : '' }}>{{ $country }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('country'))
                                <span class="help-block">{{ $errors->first('country') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="location" class="col-sm-3 control-label">Город</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="location">
                                <option disabled>Выберите город</option>
                                @foreach($user->getCityList($user->getCountry() ?: 'Россия') as $key => $city)
                                    <option value="{{ $key }}"{{ $city == $user->getCity() ? ' selected' : '' }}>{{ $city }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('location'))
                                <span class="help-block">{{ $errors->first('location') }}</span>
                            @endif

                            <script>
                                $(function () {
                                    var country = $('select[name=country]');
                                    var location = $('select[name=location]');

                                    country.on('change', function () {
                                        $.get('{{ route('api', 'getCityList') }}', {country: country.val()})
                                                .done(function (data) {
                                                    if (data != 0) {
                                                        location.empty();
                                                        $.each(data, function (id, name) {
                                                            location.append('<option value="' + id + '">' + name + '</option>');
                                                        });
                                                    }
                                                });
                                    });

                                })
                            </script>

                        </div>
                    </div>

                    <script>

                    </script>

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
                    <a href="{{ route('user.password.reset') }}">Сбросить пароль</a>
                </div>
                <div class="qw rd aof alt qx dj">
                    <a data-toggle="modal" href="#changeBackground">
                        Изменить фон
                    </a>
                </div>
            </div>

            <div class="cd fade" id="changeBackground" tabindex="-1" role="dialog" aria-labelledby="changeBackground"
                 aria-hidden="true">
                <div class="modal-dialog imd">
                    <div class="modal-content">
                        <div class="d">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Изменить фоновое изображение</h4>
                        </div>

                        <div class="modal-body ame js-modalBody">
                            <div class="changeImage">
                                <img id="background_preview" class="image-profile-preview"
                                     src="{{$user->getBackground()}}">
                            </div>
                            <div class="action text-center">
                                <form method="post" action="{{ route('user.save.background') }}"
                                      enctype="multipart/form-data">
                        <span class="btn btn-link fileinput-button">
                            <span>Загрузить другое изображение</span>
                            <input id="background" type="file" name="background" accept="image/*">
                        </span>
                                    {!! csrf_field() !!}
                                    <button id="save_background" type="submit" class="btn btn-link">Сохранить
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@stop