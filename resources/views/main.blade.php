<!DOCTYPE html>
<html>
    <head>
        <title>Main</title>
        <meta name="description" content="Main">
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="/public/css/style.css"  media="screen,projection"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <body>
        <div class="container">
            <div class="row padding top15">
                    <div class="col-md-7">
                        <h1>Welcome to Bioritmic!</h1>
                        <p>
                            This WebApp - first <strong>FREE</strong> service 100% recruitment partner!
                        </p>
                    </div>
                    <div class="col-md-5">
                        <div class="card-panel">
                            <form method="post">
                                <div class="input-field">
                                    <input id="email" name="email" type="email">
                                    <label for="email">Email address</label>
                                </div>
                                <div class="input-field">
                                    <input id="password" name="password" type="password">
                                    <label for="password">Password</label>
                                </div>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="waves-effect waves-light btn deep-purple">
                                    Login
                                </button>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
        <script type="text/javascript" src="http://yastatic.net/angularjs/1.3.16/angular.min.js"></script>
    </body>
</html>
