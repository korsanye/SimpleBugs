<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SimpleBugs - Login</title>

    <link href="/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="/assets/css/styles.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>


      <div id="login" class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="login well well-sm">
              <div class="center">
                <h1>SimpleBugs</h1>
              </div>

              <form action="{{ url('login') }}" class="login-form" id="UserLoginForm" method="post" accept-charset="utf-8">
                  {!! csrf_field() !!}
                <div class="form-group">
                    @if ( session('error') )

                        <div class="alert alert-danger" role="alert">{{ trans('auth.failed') }}</div>

                    @endif

                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-at" aria-hidden="true"></i></span>
                    <input name="email" required="required" class="form-control" placeholder="Email" maxlength="255" type="email" id="UserEmail" value="{{ old('email') }}">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
                    <input name="password" required="required" class="form-control" placeholder="Password" type="password" id="UserPassword">
                  </div>
                </div>
                <div class="checkbox">
                  <label id="remember-me">
                    <input type="checkbox" name="remember_me" value="1" id="UserRememberMe"> Remember Me?
                  </label>
                </div>
                <div class="form-group">
                  <input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign in">
                </div>

                <small><a href="{{ url('forgotpassword') }}">Forgot password?</a></small>
              </form>
            </div><!--/.login-->
          </div><!--/.span12-->
        </div><!--/.row-fluid-->
      </div><!--/.container-->


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/assets/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>