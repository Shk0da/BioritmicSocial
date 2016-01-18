@section('content')
    @include('layout.nav')
    <div class="anp" id="app-growl"></div>
    @include('layout.friends')
    <div class="by ams">
        <div class="gd">
            @include('layout.left')
            <div class="ha">
                <div class="d">
                    <button type="button" class="cg fx fp eg k js-newMsg">
                        Написать сообщение
                    </button>
                    <div class="new-message">
                        @if ($errors->has('message'))
                            <span class="help-block">{{ $errors->first('message') }}</span>
                        @endif
                        <form method="post" action="">
                            <textarea name="message" class="form-control" data-autosize-on="true"
                                      placeholder="Сообщение"></textarea>
                            <div class="row">
                                <div class="col-md-5">
                                    <select class="form-control" name="to">
                                        <option value=""></option>
                                        @foreach($user->friends() as $friend)
                                            <option value="{{ $friend->id }}">
                                                {{ $friend->getName() }}
                                            </option><a class="qk" href="#">
                                                <img class="qi cu" src="{{ $friend->getImageProfile() }}">
                                            </a>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-7 button-send-new-message">
                                    <button type="submit" class="cg fx fp eg k js-sendMsg">
                                        Отправить
                                    </button>
                                </div>
                            </div>
                            {{ csrf_field() }}
                        </form>
                        <div class="row">
                            <a class="col-md-5 js-backMsg">Назад к сообщениям</a>
                        </div>
                    </div>
                    <h4 class="js-DialogsTitle">Сообщения</h4>
                </div>
                <div class="modal-body ame js-Dialogs">
                    <div class="up">
                        <div class="qp cj ca js-msgGroup">
                            @foreach($user->getUserDialogs() as $dialog)
                                <?php $from = $dialog->getFromUser();  if ($from->id == $user->id) $from = $dialog->getToUser()?>
                                <a href="{{ route('chat', $from) }}" class="b">
                                    <div class="qg">
                                            <span class="qk">
                                                <img class="cu qi" src="{{ $from->getImageProfile() }}">
                                            </span>

                                        <div class="qh">
                                            <strong>{{ $from->getName() }}</strong>
                                            <small class="f-right">
                                                {{ $dialog->diffForHumans() }}
                                            </small>
                                            <div class="aoe">
                                                {{ $dialog->getMessage() }}
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @include('layout.right')
        </div>
    </div>
@stop