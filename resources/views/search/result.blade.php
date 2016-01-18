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
                    @if ($result->count())
                        @foreach($result as $people)
                            @include('user.block')
                        @endforeach
                    @else
                        Упс, кажется по заданным параметрам никого нет...
                        @if (!$user->getStringBirthday())
                        <p>
                            <a href="{{ route('edit') }}">
                                Укажите дату вашего рождения</a>, чтобы могли найти подходящих Вам партнеров!
                        </p>
                        @endif
                    @endif
                </div>

            </div>
            @include('search.filter')
        </div>
    </div>
@stop