@section('content')
    @include('layout.nav')
    <div class="anp" id="app-growl"></div>
    @include('layout.friends')
    <div class="by ams">
        <div class="gd">
            @include('layout.left')

            <div class="ha">
                <div class="d">
                    <button name="send-message" type="button" class="cg fx fp eg k js-newMsg">Написать сообщение
                    </button>
                    <h4 class="modal-title">Сообщения</h4>
                </div>

                <div class="modal-body ame js-modalBody">
                    <div class="up">

                        <div class="qp cj ca js-msgGroup">
                            @foreach($user->getDialogs() as $dialog)
                                <?php $from = $dialog->getFromUser() ?>
                                    <a href="#" class="b">
                                        <div class="qg">
                                            <span class="qk">
                                                <img class="cu qi" src="{{ $from->getImageProfile() }}">
                                            </span>

                                            <div class="qh">
                                                <strong>{{ $from->getName() }}</strong>
                                                <div class="aoe">
                                                    {{ $dialog->getMessage() }}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                            @endforeach
                        </div>


                        {{---------------------------------------------------}}

                        <div class="hide ali js-conversation">

                            <ul class="qp aoa">
                                <li class="qg aod alt">
                                    <div class="qh">
                                        <div class="aob">
                                            Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis
                                            vestibulum.
                                            Nulla vitae elit libero, a pharetra augue. Maecenas sed diam eget risus
                                            varius
                                            blandit sit amet non magna. Morbi leo risus, porta ac consectetur ac,
                                            vestibulum
                                            at eros. Sed posuere consectetur est at lobortis.
                                        </div>
                                        <div class="aoc">
                                            <small class="dp">
                                                <a href="#">Dave Gamache</a> at 4:20PM
                                            </small>
                                        </div>
                                    </div>
                                    <a class="qj" href="#">
                                        <img class="cu qi" src="/public/img/avatar-dhg.png">
                                    </a>
                                </li>

                                <li class="qg alt">
                                    <a class="qk" href="#">
                                        <img class="cu qi" src="/public/img/avatar-fat.jpg">
                                    </a>

                                    <div class="qh">
                                        <div class="aob">
                                            Cras justo odio, dapibus ac facilisis in, egestas eget quam. Duis mollis,
                                            est
                                            non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec
                                            elit.
                                            Praesent commodo cursus magna, vel scelerisque nisl consectetur et.
                                        </div>
                                        <div class="aob">
                                            Vestibulum id ligula porta felis euismod semper. Aenean lacinia bibendum
                                            nulla
                                            sed consectetur. Cras justo odio, dapibus ac facilisis in, egestas eget
                                            quam.
                                            Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent
                                            commodo
                                            cursus magna, vel scelerisque nisl consectetur et. Nullam quis risus eget
                                            urna
                                            mollis ornare vel eu leo. Morbi leo risus, porta ac consectetur ac,
                                            vestibulum
                                            at eros.
                                        </div>
                                        <div class="aob">
                                            Cras mattis consectetur purus sit amet fermentum. Donec sed odio dui.
                                            Integer
                                            posuere erat a ante venenatis dapibus posuere velit aliquet. Nulla vitae
                                            elit
                                            libero, a pharetra augue. Donec id elit non mi porta gravida at eget metus.
                                        </div>
                                        <div class="aoc">
                                            <small class="dp">
                                                <a href="#">Fat</a> at 4:28PM
                                            </small>
                                        </div>
                                    </div>
                                </li>

                                <li class="qg alt">
                                    <a class="qk" href="#">
                                        <img class="cu qi" src="/public/img/avatar-mdo.png">
                                    </a>

                                    <div class="qh">
                                        <div class="aob">
                                            Etiam porta sem malesuada magna mollis euismod. Donec id elit non mi porta
                                            gravida at eget metus. Praesent commodo cursus magna, vel scelerisque nisl
                                            consectetur et. Etiam porta sem malesuada magna mollis euismod. Morbi leo
                                            risus,
                                            porta ac consectetur ac, vestibulum at eros. Aenean lacinia bibendum nulla
                                            sed
                                            consectetur.
                                        </div>
                                        <div class="aob">
                                            Curabitur blandit tempus porttitor. Integer posuere erat a ante venenatis
                                            dapibus posuere velit aliquet. Duis mollis, est non commodo luctus, nisi
                                            erat
                                            porttitor ligula, eget lacinia odio sem nec elit.
                                        </div>
                                        <div class="aoc">
                                            <small class="dp">
                                                <a href="#">Mark Otto</a> at 4:20PM
                                            </small>
                                        </div>
                                    </div>
                                </li>

                                <li class="qg aod alt">
                                    <div class="qh">
                                        <div class="aob">
                                            Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis
                                            vestibulum.
                                            Nulla vitae elit libero, a pharetra augue. Maecenas sed diam eget risus
                                            varius
                                            blandit sit amet non magna. Morbi leo risus, porta ac consectetur ac,
                                            vestibulum
                                            at eros. Sed posuere consectetur est at lobortis.
                                        </div>
                                        <div class="aoc">
                                            <small class="dp">
                                                <a href="#">Dave Gamache</a> at 4:20PM
                                            </small>
                                        </div>
                                    </div>
                                    <a class="qj" href="#">
                                        <img class="cu qi" src="/public/img/avatar-dhg.png">
                                    </a>
                                </li>

                                <li class="qg alt">
                                    <a class="qk" href="#">
                                        <img class="cu qi" src="/public/img/avatar-fat.jpg">
                                    </a>

                                    <div class="qh">
                                        <div class="aob">
                                            Cras justo odio, dapibus ac facilisis in, egestas eget quam. Duis mollis,
                                            est
                                            non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec
                                            elit.
                                            Praesent commodo cursus magna, vel scelerisque nisl consectetur et.
                                        </div>
                                        <div class="aob">
                                            Vestibulum id ligula porta felis euismod semper. Aenean lacinia bibendum
                                            nulla
                                            sed consectetur. Cras justo odio, dapibus ac facilisis in, egestas eget
                                            quam.
                                            Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent
                                            commodo
                                            cursus magna, vel scelerisque nisl consectetur et. Nullam quis risus eget
                                            urna
                                            mollis ornare vel eu leo. Morbi leo risus, porta ac consectetur ac,
                                            vestibulum
                                            at eros.
                                        </div>
                                        <div class="aob">
                                            Cras mattis consectetur purus sit amet fermentum. Donec sed odio dui.
                                            Integer
                                            posuere erat a ante venenatis dapibus posuere velit aliquet. Nulla vitae
                                            elit
                                            libero, a pharetra augue. Donec id elit non mi porta gravida at eget metus.
                                        </div>
                                        <div class="aoc">
                                            <small class="dp">
                                                <a href="#">Fat</a> at 4:28PM
                                            </small>
                                        </div>
                                    </div>
                                </li>

                                <li class="qg all">
                                    <a class="qk" href="#">
                                        <img class="cu qi" src="/public/img/avatar-mdo.png">
                                    </a>

                                    <div class="qh">
                                        <div class="aob">
                                            Etiam porta sem malesuada magna mollis euismod. Donec id elit non mi porta
                                            gravida at eget metus. Praesent commodo cursus magna, vel scelerisque nisl
                                            consectetur et. Etiam porta sem malesuada magna mollis euismod. Morbi leo
                                            risus,
                                            porta ac consectetur ac, vestibulum at eros. Aenean lacinia bibendum nulla
                                            sed
                                            consectetur.
                                        </div>
                                        <div class="aob">
                                            Curabitur blandit tempus porttitor. Integer posuere erat a ante venenatis
                                            dapibus posuere velit aliquet. Duis mollis, est non commodo luctus, nisi
                                            erat
                                            porttitor ligula, eget lacinia odio sem nec elit.
                                        </div>
                                        <div class="aoc">
                                            <small class="dp">
                                                <a href="#">Mark Otto</a> at 4:20PM
                                            </small>
                                        </div>
                                    </div>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>

            @include('layout.right')
        </div>
    </div>
@stop