<div class="ha">
    <ul class="ca qp anw">

        <li class="qg b amk">

            <form method="post" action="{{ route('post.send') }}">
                <div class="input-group{{ $errors->has('post') ? ' has-error' : '' }}">
                    <input type="text" name="post" class="form-control" placeholder="Что у вас нового?">

                    <div class="fj">
                        <button type="button" class="cg fm"><span class="h xh"></span></button>
                    </div>
                </div>
                {{ csrf_field() }}
            </form>
            @if ($errors->has('post'))
                <span class="help-block">{{ $errors->first('post') }}</span>
            @endif

        </li>

        @if (!$posts->count())
            <li class="qg">
                <p class="text-center">Пока нам нечего вам показать</p>
            </li>
        @else
            @foreach ($posts as $post)

                <li class="qg b amk">
                    <a class="qk" href="{{ $post->user->getProfileLink() }}">
                        <img class="qi cu" src="{{ $post->user->getImageProfile() }}">
                    </a>

                    <div class="qh">
                        <div class="aob">
                            <div class="qo">
                                <small class="eg dp">{{ $post->getTimeSend() }}</small>
                                <a href="#">
                                    <small class="eg dp">Лайкнуть <span class="glyphicon glyphicon-heart"></span></small>
                                </a>
                                <a href="#">
                                    <small class="eg dp">Репост <span class="glyphicon glyphicon-share"></span></small>
                                </a>
                                <h5>
                                    <a href="{{ $post->user->getProfileLink() }}">{{ $post->user->getName() }}</a>
                                </h5>
                            </div>
                            <div class="post">
                                {{ $post->getMessage() }}
                            </div>

                            <div class="anx" data-grid="images">
                                <div style="display: none">
                                    <img data-action="zoom" data-width="1050" data-height="700"
                                         src="/public/img/unsplash_1.jpg">
                                </div>

                                <div style="display: none">
                                    <img data-action="zoom" data-width="640" data-height="640"
                                         src="/public/img/instagram_1.jpg">
                                </div>

                                <div style="display: none">
                                    <img data-action="zoom" data-width="640" data-height="640"
                                         src="/public/img/instagram_13.jpg">
                                </div>

                                <div style="display: none">
                                    <img data-action="zoom" data-width="1048" data-height="700"
                                         src="/public/img/unsplash_2.jpg">
                                </div>
                            </div>


                            <ul class="qp all">
                                @foreach ($post->comments as $comment)
                                <li class="qg">
                                    <small class="eg dp">{{ $comment->getTimeSend() }}</small>
                                    <a href="#">
                                        <small class="eg dp"><span class="glyphicon glyphicon-heart"></span></small>
                                    </a>
                                    <a class="qk" href="#">
                                        <img class="qi cu" src="{{ $comment->user->getImageProfile() }}">
                                    </a>

                                    <div class="qh">
                                        <a href="{{ $comment->user->getProfileLink() }}">
                                            <strong>{{ $comment->user->getName() }}: </strong>
                                        </a>
                                        <div>
                                            {{ $comment->getMessage() }}
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>

                            <form method="post" action="{{ route('post.comment' , ['postId' => $post->id]) }}">
                                <div class="input-group{{ $errors->has('comment-'.$post->id) ? ' has-error' : '' }}">
                                    <input type="text" name="comment-{{ $post->id }}" class="form-control" placeholder="Оставить комменатрий">
                                    <div class="fj">
                                        <button type="button" class="cg fm"><span class="h xh"></span></button>
                                    </div>
                                </div>
                                {{ csrf_field() }}
                            </form>
                            @if ($errors->has('comment-'.$post->id))
                                <span class="help-block">{{ $errors->first('comment-'.$post->id) }}</span>
                            @endif

                        </div>
                    </div>
                </li>

            @endforeach

            {!! $posts->render() !!}
        @endif

    </ul>
</div>