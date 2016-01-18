<div class="ha">
    <ul class="ca qp anw">

        <li class="qg b amk">

            <form method="post" action="{{ route('post.send') }}" enctype="multipart/form-data">
                <div class="input-group col-xs-12 col-sm-12{{ $errors->has('post') ? ' has-error' : '' }}">

                    <div class="add-photo-button">
                        <span class="h xh fileinput-button">
                            <input type="file" name="attach[]" multiple accept="image/*">
                        </span>
                    </div>

                    <div>
                        <textarea name="post" class="form-control" data-autosize-on="true" placeholder="Что у вас нового?"></textarea>
                    </div>

                    <div>
                        <button type="submit" class="post submit">Отправить</button>
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
                    @if ($post->user->id == $user->id)
                        <a href="{{ route('post.delete', ['postId' => $post->id]) }}" type="button" class="close post">&times;</a>
                    @endif
                    <a class="qk" href="{{ $post->user->getProfileLink() }}">
                        <img class="qi cu" src="{{ $post->user->getImageProfile() }}">
                    </a>

                    <div class="qh">
                        <div class="aob">
                            <div class="qo">
                                <small class="eg dp">{{ $post->diffForHumans() }}</small>
                                <h5>
                                    <a href="{{ $post->user->getProfileLink() }}">{{ $post->user->getName() }}</a>
                                </h5>
                            </div>
                            <div class="post">
                                <p>{{ $post->getMessage() }}</p>
                            </div>

                            @if ($post->getAttach())
                                @foreach ($post->getAttach() as $file)
                                    <div class="anx" data-grid="images">
                                        <div style="display: none">
                                            <img data-action="zoom" data-width="1050" data-height="700"
                                                 src="{{ $file }}">
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                            <div class="text-right">
                                <a href="{{ route('post.like', ['postId' => $post->id]) }}">
                                    <small><span class="glyphicon glyphicon-heart"></span> {{ $post->likes->count() }}</small>
                                </a>
                                @if ($post->user->id <> $user->id)
                                    <a href="{{ route('post.repost', ['postId' => $post->id]) }}">
                                        <small>Репост</small>
                                    </a>
                                @endif
                            </div>
                            <hr>

                            <ul class="qp all">
                                @foreach ($post->comments as $comment)
                                <li class="qg">
                                    @if ($comment->user->id == $user->id)
                                        <a href="{{ route('post.delete', ['postId' => $comment->id]) }}" type="button" class="close post">&times;</a>
                                    @endif
                                    <small class="eg dp">{{ $comment->diffForHumans() }}</small>
                                    <a class="qk" href="#">
                                        <img class="qi cu" src="{{ $comment->user->getImageProfile() }}">
                                    </a>

                                    <div class="qh">
                                        <a href="{{ $comment->user->getProfileLink() }}">
                                            <strong>{{ $comment->user->getName() }}: </strong>
                                        </a>
                                        <div>
                                            {{ $comment->getMessage() }}

                                            @if ($comment->getAttach())
                                                @foreach ($comment->getAttach() as $file)
                                                    <div class="anx" data-grid="images">
                                                        <div style="display: none">
                                                            <img data-action="zoom" data-width="1050" data-height="700"
                                                                 src="{{ $file }}">
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif

                                        </div>
                                    </div>

                                    <div class="text-right">
                                        <a href="{{ route('post.like', ['postId' => $comment->id]) }}">
                                            <small><span class="glyphicon glyphicon-heart"></span> {{ $comment->likes->count() }}</small>
                                        </a>
                                    </div>
                                </li>
                                    <br>
                                @endforeach
                            </ul>

                            @if ($user->isFriendWith($post->user) || $post->user->id == $user->id )
                                <form method="post" action="{{ route('post.comment' , ['postId' => $post->id]) }}" enctype="multipart/form-data">
                                    <div class="input-group col-xs-12 col-sm-12{{ $errors->has('comment-'.$post->id) ? ' has-error' : '' }}">
                                        <div class="add-photo-button">
                                                <span class="h xh fileinput-button">
                                                    <input type="file" name="attach[]" multiple accept="image/*">
                                                </span>
                                        </div>

                                        <div>
                                            <textarea name="comment-{{ $post->id }}" class="form-control"
                                                      placeholder="Оставить комменатрий"></textarea>
                                        </div>

                                        <div>
                                            <button type="submit" class="post submit">Отправить</button>
                                        </div>
                                    </div>
                                    {{ csrf_field() }}
                                </form>
                                @if ($errors->has('comment-'.$post->id))
                                    <span class="help-block">{{ $errors->first('comment-'.$post->id) }}</span>
                                @endif
                            @endif

                        </div>
                    </div>
                </li>

            @endforeach

            {!! $posts->render() !!}
        @endif

    </ul>
</div>