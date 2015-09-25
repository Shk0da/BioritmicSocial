@section('content')
    @include('layout.nav')
    <div class="anp" id="app-growl"></div>
    @include('layout.message')
    @include('layout.friends')
    <div class="by ams">
        <div class="gd">
            @include('layout.left')

            <div class="ha">
                <h3>Ваши фотографии</h3>

                <div class="album">
                    @foreach($albums as $album)

                        <h4>{{ $album['name'] }}</h4>
                        @foreach($album['data'] as $photo)
                            <img class="album photo" data-action="zoom" data-width="1050" data-height="700" src="{{ $photo->path }}" />
                        @endforeach

                    @endforeach
                </div>

            </div>

            <div class="go">
                <div class="qw rd aof alt qx dj">
                    <a data-toggle="modal" href="#newPhoto">
                        Загрузить фото
                    </a>
                </div>
            </div>

            <div class="go">
                <div class="qw rd aof alt qx dj">
                    <a data-toggle="modal" href="#newAlbum">
                        Создать новый альбом
                    </a>
                </div>
            </div>

            <div class="cd fade" id="newAlbum" tabindex="-1" role="dialog" aria-labelledby="newAlbum"
                 aria-hidden="true">
                <div class="modal-dialog imd">
                    <div class="modal-content">
                        <div class="d">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Создание нового альбома</h4>
                        </div>

                        <div class="modal-body ame js-modalBody">
                            <div class="action text-center{{ $errors->has('name') ? ' has-error' : '' }}">
                                <form method="post" action="{{ route('photo.album.create') }}">
                                    <span>Название</span>
                                    <input type="text" name="name">
                                    {!! csrf_field() !!}
                                    <button type="submit" class="btn btn-link">Создать
                                    </button>
                                </form>
                                @if ($errors->has('name'))
                                    <span class="help-block">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@stop