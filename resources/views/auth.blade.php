@extends('main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <form class="form-horizontal" role="form" method="post" action="">
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <input type="text" name="name" class="form-control" id="inputName" placeholder="Name">
                        @if ($errors->has('name'))
                            <span class="help-block">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email">
                        @if ($errors->has('email'))
                            <span class="help-block">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input type="password" class="form-control" id="inputPassword" placeholder="Password">
                        @if ($errors->has('password'))
                            <span class="help-block">{{ $errors->first('password') }}</span>
                        @endif
                    </div>

                    {!! csrf_field() !!}

                    <div class="form-group">
                         <button type="submit" class="btn btn-default">Sign up</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop