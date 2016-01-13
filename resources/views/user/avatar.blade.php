<div id="crop-avatar" class="">

    <div class="avatar-view" title="Изменить изображение профиля">
        <img class="aog" src="{{$user->getImageProfile()}}" alt="Это Вы">
    </div>

    <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form class="avatar-form" action="{{ route('user.save.image') }}" enctype="multipart/form-data" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" id="avatar-modal-label">Изменить изображение профиля</h4>
                    </div>
                    <div class="modal-body">
                        <div class="avatar-body">

                            <div class="avatar-upload">
                                <input type="hidden" class="avatar-src" name="avatar_src">
                                <input type="hidden" class="avatar-data" name="avatar_data">
                                <span class="btn btn-link fileinput-button">
                                    <span>Выбрать новое изображение</span>
                                    <input id="avatarInput" class="avatar-input" type="file" name="avatar_file" accept="image/*">
                                </span>
                            </div>

                            <div class="row">
                                <div class="col-md-9">
                                    <div class="avatar-wrapper"></div>
                                </div>
                                <div class="col-md-3">
                                    <div class="avatar-preview preview-lg"></div>
                                    <div class="avatar-preview preview-md qi cu"></div>
                                    <div class="avatar-preview preview-sm"></div>
                                </div>
                            </div>

                            <div class="row avatar-btns">
                                <div class="col-md-3">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-primary btn-block avatar-save">Сохранить</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
</div>