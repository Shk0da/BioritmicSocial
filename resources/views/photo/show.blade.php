@section('content')
    @include('layout.nav')
    <div class="anp" id="app-growl"></div>
    @include('layout.friends')
    <div class="by ams">
        <div class="gd">
            @include('layout.left')
            <div class="back"><a href="{{ route('photo.edit') }}"><- Назад</a></div>
            <div class="ha">
                <h3>{{ $album['name'] }}</h3>

                <div class="album">
                    @foreach($album['data'] as $photo)
                        <img class="album photo" data-action="zoom" data-width="1050" data-height="700"
                             src="{{ $photo->getUrl() }}"/>
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

            <div class="cd fade" id="newPhoto" tabindex="-1" role="dialog" aria-labelledby="newPhoto"
                 aria-hidden="true">
                <div class="modal-dialog imd">
                    <div class="modal-content">
                        <div class="d">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Загрузка фотографий</h4>
                        </div>

                        <div class="modal-body ame js-modalBody">
                            <div class="action text-center">
                                <img id="photo_preview" class="image-profile-preview" src="">
                                <form method="post" action="{{ route('photo.add' , ['albumId' => $album['id']]) }}"
                                      enctype="multipart/form-data">
                                        <span class="btn btn-link fileinput-button">
                                            <span>Выбрать</span>
                                            <input id="add_photo" type="file" name="image" accept="image/*">
                                        </span>
                                    <input type="hidden" name="album" value="{{ $album['id'] }}">
                                    {!! csrf_field() !!}
                                    <button id="save_add_photo" type="submit" class="btn btn-link">Сохранить
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