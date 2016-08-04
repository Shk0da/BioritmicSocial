@section('content')
    @include('layout.nav')
    <div class="anp" id="app-growl"></div>
    @include('layout.friends')
    <div class="by ams">
        <div class="gd">
            @include('layout.left')

            <div class="ha">
                <h3>Результаты поиска</h3>
                <div class="search-result">
                    <p>
                        <a href="{{ route('edit') }}">
                            Заполните Ваш профиль</a>, чтобы могли найти подходящих Вам партнеров!
                    </p>
                </div>
            </div>
            @include('search.filter')
        </div>
    </div>
@stop