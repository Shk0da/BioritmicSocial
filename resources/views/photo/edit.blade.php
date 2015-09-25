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
                            <div class="action text-center">
                                <form method="post" action="#" enctype="multipart/form-data">
                                    <span>Название</span>
                                    <input type="text" name="name">
                                    {!! csrf_field() !!}
                                    <button type="submit" class="btn btn-link">Создать
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