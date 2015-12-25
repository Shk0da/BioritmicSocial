<div class="go">
    @if( isset($info) )
    <div class="alert pw alert-dismissible st" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        {{ $info }}
    </div>
    @endif

    <div class="qw rd alt st">
        <div class="qx">
            <h5 class="alc">Реклама</h5>
            <div data-grid="images" data-target-height="150">
                <img class="qi" data-width="640" data-height="640" data-action="zoom"
                     src="">
            </div>
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
            © 2015 <a href="#">Bioritmic</a>
        </div>
    </div>
</div>