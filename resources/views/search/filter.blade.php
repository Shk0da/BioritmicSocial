<div class="go">

    @if( isset($info) )
        <div class="alert pw alert-dismissible st" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            {{ $info }}
        </div>
    @endif

    <div class="qw rd aoj">
        <div class="qx">
            <h5 class="alc text-center">
                Дополнительные параметры совместимости
            </h5>

            <form method="get" action="{{ route('search') }}">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <label class="control-label">Местоположение</label>

                        <div class="form-group">
                            <select class="form-control" name="country">
                                <option value="">Все страны</option>
                                @foreach($user->getCountryList() as $country)
                                    <option value="{{ $country }}"{{ (isset($form['country'])) ? ($form['country'] == $country ? ' selected' : '') : ($country == $user->getCountry() ? ' selected' : '') }}>{{ $country }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('country'))
                                <span class="help-block">{{ $errors->first('country') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <select class="form-control" name="location">
                                <option value="">Все города</option>
                                @foreach($user->getCityList( (isset($form['country'])) ? $form['country'] : ($user->getCountry() ?: null)) as $key => $city)
                                    <option value="{{ $key }}"{{ (isset($form['location'])) ? ($form['location'] == $key ? ' selected' : '') : ($city == $user->getCity() ? ' selected' : '') }}>{{ $city }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('location'))
                                <span class="help-block">{{ $errors->first('location') }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-body">
                        @foreach($filters as $name => $filter)
                            <div class="input-group">
                                <input type="checkbox" name="{{ $name }}"{{ $form[$name] or '' }}>
                                <span title="{{ $filter['description'] }}"> {{ $filter['name'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="input-group">
                            <input type="checkbox" name="zodiac"{{ $form['zodiac'] or '' }}>
                            <span> По знаку зодиака</span>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-body form-inline">
                        <div class="input-group">
                            <input type="checkbox" name="man"{{ $form['man'] or '' }}>
                            <span> Мужчины</span>
                        </div>
                        <div class="input-group">
                            <input type="checkbox" name="woman"{{ $form['woman'] or '' }}>
                            <span> Женчины</span>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-sm gx eg">Показать</button>
            </form>
        </div>
        <div class="ra text-center">
            Дополнительные параметры помогут вам найти людей которые подходят именно Вам!
        </div>
    </div>

</div>