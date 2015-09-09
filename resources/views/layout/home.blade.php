@extends('main')
@section('content')
@include('layout.nav')
<div class="anp" id="app-growl"></div>
@include('layout.message')
<div class="cd fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="d">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Users</h4>
            </div>

            <div class="modal-body ame">
                <div class="up">
                    <ul class="qp cj ca">
                        <li class="b">
                            <div class="qg">
                                <a class="qk" href="#">
                                    <img class="qi cu" src="/public/img/avatar-fat.jpg">
                                </a>

                                <div class="qh">
                                    <button class="cg fm fx eg">
                                        <span class="c aok"></span> Follow
                                    </button>
                                    <strong>Jacob Thornton</strong>

                                    <p>@fat - San Francisco</p>
                                </div>
                            </div>
                        </li>
                        <li class="b">
                            <div class="qg">
                                <a class="qk" href="#">
                                    <img class="qi cu" src="/public/img/avatar-dhg.png">
                                </a>

                                <div class="qh">
                                    <button class="cg fm fx eg">
                                        <span class="c aok"></span> Follow
                                    </button>
                                    <strong>Dave Gamache</strong>

                                    <p>@dhg - Palo Alto</p>
                                </div>
                            </div>
                        </li>
                        <li class="b">
                            <div class="qg">
                                <a class="qk" href="#">
                                    <img class="qi cu" src="/public/img/avatar-mdo.png">
                                </a>

                                <div class="qh">
                                    <button class="cg fm fx eg">
                                        <span class="c aok"></span> Follow
                                    </button>
                                    <strong>Mark Otto</strong>

                                    <p>@mdo - San Francisco</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="by ams">
    <div class="gd">
        <div class="go">
            <div class="qw rd aof alt">
                <div class="qy" style="background-image: url(/public/img/iceland.jpg);"></div>
                <div class="qx dj">
                    <a href="/application/profile/">
                        <img
                                class="aog"
                                src="/public/img/avatar-dhg.png">
                    </a>

                    <h5 class="qz">
                        <a class="akt" href="/application/profile/">Dave Gamache</a>
                    </h5>

                    <p class="alt">I wish i was a little bit taller, wish i was a baller, wish i had a girl… also.</p>

                    <ul class="aoh">
                        <li class="aoi">
                            <a href="#userModal" class="akt" data-toggle="modal">
                                Friends
                                <h5 class="alh">12M</h5>
                            </a>
                        </li>

                        <li class="aoi">
                            <a href="#userModal" class="akt" data-toggle="modal">
                                Enemies
                                <h5 class="alh">1</h5>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="qw rd sn sq">
                <div class="qx">
                    <h5 class="alc">About
                        <small>· <a href="#">Edit</a></small>
                    </h5>
                    <ul class="eb tc">
                        <li><span class="dp h xg alk"></span>Went to <a href="#">Oh, Canada</a>
                        <li><span class="dp h ajv alk"></span>Became friends with <a href="#">Obama</a>
                        <li><span class="dp h abt alk"></span>Worked at <a href="#">Github</a>
                        <li><span class="dp h acj alk"></span>Lives in <a href="#">San Francisco, CA</a>
                        <li><span class="dp h ads alk"></span>From <a href="#">Seattle, WA</a>
                    </ul>
                </div>
            </div>

            <div class="qw rd sn sq">
                <div class="qx">
                    <h5 class="alc">Photos
                        <small>· <a href="#">Edit</a></small>
                    </h5>
                    <div data-grid="images" data-target-height="150">
                        <div>
                            <img data-width="640" data-height="640" data-action="zoom"
                                 src="/public/img/instagram_5.jpg">
                        </div>

                        <div>
                            <img data-width="640" data-height="640" data-action="zoom"
                                 src="/public/img/instagram_6.jpg">
                        </div>

                        <div>
                            <img data-width="640" data-height="640" data-action="zoom"
                                 src="/public/img/instagram_7.jpg">
                        </div>

                        <div>
                            <img data-width="640" data-height="640" data-action="zoom"
                                 src="/public/img/instagram_8.jpg">
                        </div>

                        <div>
                            <img data-width="640" data-height="640" data-action="zoom"
                                 src="/public/img/instagram_9.jpg">
                        </div>

                        <div>
                            <img data-width="640" data-height="640" data-action="zoom"
                                 src="/public/img/instagram_10.jpg">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="ha">
            <ul class="ca qp anw">

                <li class="qg b amk">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Message">

                        <div class="fj">
                            <button type="button" class="cg fm">
                                <span class="h xh"></span>
                            </button>
                        </div>
                    </div>
                </li>

                <li class="qg b amk">
                    <a class="qk" href="#">
                        <img
                                class="qi cu"
                                src="/public/img/avatar-dhg.png">
                    </a>

                    <div class="qh">
                        <div class="qo">
                            <small class="eg dp">4 min</small>
                            <h5>Dave Gamache</h5>
                        </div>

                        <p>
                            Aenean lacinia bibendum nulla sed consectetur. Vestibulum id ligula porta felis euismod
                            semper. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras justo odio,
                            dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper.
                            Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
                        </p>

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
                            <li class="qg">
                                <a class="qk" href="#">
                                    <img
                                            class="qi cu"
                                            src="/public/img/avatar-fat.jpg">
                                </a>

                                <div class="qh">
                                    <strong>Jacon Thornton: </strong>
                                    Donec id elit non mi porta gravida at eget metus. Vivamus sagittis lacus vel augue
                                    laoreet rutrum faucibus dolor auctor. Donec ullamcorper nulla non metus auctor
                                    fringilla. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Sed
                                    posuere consectetur est at lobortis.
                                </div>
                            </li>
                            <li class="qg">
                                <a class="qk" href="#">
                                    <img
                                            class="qi cu"
                                            src="/public/img/avatar-mdo.png">
                                </a>

                                <div class="qh">
                                    <strong>Mark Otto: </strong>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dapibus, tellus ac
                                    cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet
                                    risus.
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="qg b amk">
                    <a class="qk" href="#">
                        <img
                                class="qi cu"
                                src="/public/img/avatar-fat.jpg">
                    </a>

                    <div class="qh">
                        <div class="aob">
                            <div class="qo">
                                <small class="eg dp">12 min</small>
                                <h5>Jacob Thornton</h5>
                            </div>
                            <p>
                                Donec id elit non mi porta gravida at eget metus. Integer posuere erat a ante venenatis
                                dapibus posuere velit aliquet. Cum sociis natoque penatibus et magnis dis parturient
                                montes, nascetur ridiculus mus. Morbi leo risus, porta ac consectetur ac, vestibulum at
                                eros. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            </p>
                        </div>
                    </div>
                </li>

                <li class="qg b amk">
                    <a class="qk" href="#">
                        <img
                                class="qi cu"
                                src="/public/img/avatar-mdo.png">
                    </a>

                    <div class="qh">
                        <div class="qo">
                            <small class="eg dp">34 min</small>
                            <h5>Mark Otto</h5>
                        </div>

                        <p>
                            Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod
                            semper. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Etiam
                            porta sem malesuada magna mollis euismod. Donec sed odio dui.
                        </p>

                        <div class="anx" data-grid="images">
                            <img style="display: none" data-width="640" data-height="640" data-action="zoom"
                                 src="/public/img/instagram_3.jpg">
                        </div>

                        <ul class="qp">
                            <li class="qg">
                                <a class="qk" href="#">
                                    <img
                                            class="qi cu"
                                            src="/public/img/avatar-dhg.png">
                                </a>

                                <div class="qh">
                                    <strong>Dave Gamache: </strong>
                                    Donec id elit non mi porta gravida at eget metus. Vivamus sagittis lacus vel augue
                                    laoreet rutrum faucibus dolor auctor. Donec ullamcorper nulla non metus auctor
                                    fringilla. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Sed
                                    posuere consectetur est at lobortis.
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <div class="go">
            <div class="alert pw alert-dismissible st" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <a class="ps" href="/application/profile">Visit your profile!</a> Check your self, you aren't looking
                too good.
            </div>

            <div class="qw rd alt st">
                <div class="qx">
                    <h5 class="alc">Sponsored</h5>

                    <div data-grid="images" data-target-height="150">
                        <img class="qi" data-width="640" data-height="640" data-action="zoom"
                             src="/public/img/instagram_2.jpg">
                    </div>
                    <p><strong>It might be time to visit Iceland.</strong> Iceland is so chill, and everything looks
                        cool here. Also, we heard the people are pretty nice. What are you waiting for?</p>
                    <button class="cg ts fx">Buy a ticket</button>
                </div>
            </div>

            <div class="qw rd alt st">
                <div class="qx">
                    <h5 class="alc">Likes
                        <small>· <a href="#">View All</a></small>
                    </h5>
                    <ul class="qp anw">
                        <li class="qg all">
                            <a class="qk" href="#">
                                <img
                                        class="qi cu"
                                        src="/public/img/avatar-fat.jpg">
                            </a>

                            <div class="qh">
                                <strong>Jacob Thornton</strong> @fat
                                <div class="anz">
                                    <button class="cg ts fx">
                                        <span class="h vb"></span> Follow
                                    </button>
                                </div>
                            </div>
                        </li>
                        <li class="qg">
                            <a class="qk" href="#">
                                <img
                                        class="qi cu"
                                        src="/public/img/avatar-mdo.png">
                            </a>

                            <div class="qh">
                                <strong>Mark Otto</strong> @mdo
                                <div class="anz">
                                    <button class="cg ts fx">
                                        <span class="h vb"></span> Follow
                                    </button>
                                    </button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="ra">
                    Dave really likes these nerds, no one knows why though.
                </div>
            </div>

            <div class="qw rd aoj">
                <div class="qx">
                    © 2015 Bootstrap

                    <a href="#">About</a>
                    <a href="#">Help</a>
                    <a href="#">Terms</a>
                    <a href="#">Privacy</a>
                    <a href="#">Cookies</a>
                    <a href="#">Ads </a>

                    <a href="#">info</a>
                    <a href="#">Brand</a>
                    <a href="#">Blog</a>
                    <a href="#">Status</a>
                    <a href="#">Apps</a>
                    <a href="#">Jobs</a>
                    <a href="#">Advertise</a>
                </div>
            </div>
        </div>
    </div>
</div>
@stop