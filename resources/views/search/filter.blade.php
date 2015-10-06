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
                <div class="panel-body">
                    <div class="input-group">
                        <input type="text" class="form-control oh i" name="location" placeholder="Город">
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-body">
                        @foreach($filters as $name => $filter)
                            <div class="input-group">
                                <input type="checkbox" name="{{ $name }}">
                                <span title="{{ $filter['description'] }}"> {{ $filter['name'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="input-group">
                            <input type="checkbox" name="zodiac">
                            <span> По знаку зодиака</span>
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