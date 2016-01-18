@section('content')
    @include('layout.nav')
    <div class="anp" id="app-growl"></div>
    @include('layout.friends')
    <div class="by ams">
        <div class="gd">
            @include('layout.left')

            <div class="ha">
                <div class="d">
                    <a href="{{ route('messages') }}" type="button" class="cg fx fp eg k">
                        Назад к сообщениям
                    </a>
                    <h5 class="js-DialogsTitle">
                        <div class="qg">
                            <a class="qk" href="#">
                                <img class="cj qi cu" src="{{ $to->getImageProfile() }}">
                            </a>
                            <div class="qh">
                                <a href="{{ $to->getProfileLink() }}">
                                    <strong>{{ $to->getName() }}</strong>
                                </a>
                                <p>{{ $to->getLocation() }}</p>
                            </div>
                        </div>
                    </h5>
                </div>

                <div class="modal-body">
                    @if ($errors->has('message'))
                        <span class="help-block">{{ $errors->first('message') }}</span>
                    @endif
                    <form method="post" action="">
                    <textarea class="form-control" data-autosize-on="true" placeholder="Сообщение"
                              name="message"></textarea>
                    <div class="p-btm25">
                        <button type="submit" class="post submit">Отправить</button>
                    </div>
                        {{ csrf_field() }}
                    </form>
                </div>

                <div class="modal-body ame js-Dialogs">
                    <div class="up">
                        <div class="ali js-conversation">

                            <ul class="qp aoa">

                                @foreach($messages as $message)
                                    <?php $from = $message->getFromUser() ?>
                                    @if ($from->id != $user->id)
                                        <li class="qg aod alt">
                                            <div class="qh">
                                                <div class="aob">
                                                    {{ $message->getText() }}
                                                </div>
                                                <div class="aoc">
                                                    <small class="dp">
                                                        <a>{{ $from->getName() }}</a> {{ $message->diffForHumans() }}
                                                    </small>
                                                </div>
                                            </div>
                                            <a class="qj">
                                                <img class="cu qi" src="{{ $from->getImageProfile() }}">
                                            </a>
                                        </li>
                                    @else
                                        <li class="qg alt">
                                            <a class="qk">
                                                <img class="cu qi" src="{{ $from->getImageProfile() }}">
                                            </a>
                                            <div class="qh">
                                                <div class="aob">
                                                    {{ $message->getText() }}
                                                </div>
                                                <div class="aoc">
                                                    <small class="dp">
                                                        <a>{{ $from->getName() }}</a> {{ $message->diffForHumans() }}
                                                    </small>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
            @include('layout.right')
        </div>
    </div>
@stop