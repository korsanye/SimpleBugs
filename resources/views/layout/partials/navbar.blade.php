<nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">SimpleBugs</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="{{ set_active('create') }}"><a href="{{ url('create') }}">{{ trans('common.create_issue') }} <span class="sr-only">(current)</span></a></li>
                <!-- <li class="{{ set_active('projects') }}"><a href="{{ url('projects') }}">{{ trans('common.projects') }}</a></li> -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ trans('common.issues') }} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">My issues</a></li>
                        <li><a href="#">By project</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Resolved</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>

            </ul>
            <form class="navbar-form navbar-left" role="search" action="{{ url('search') }}" method="post">
                {!! csrf_field() !!}
                <div class="form-group">
                    <input type="text" name="query" class="form-control" placeholder="{{ trans('common.search') }}" required="required" value="{{ old('query') }}">
                </div>
                <button type="submit" class="btn btn-default">{{ trans('common.submit') }}</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                @can('admin')
                <li><a href="{{ url('admin') }}">{{ trans('common.administration') }}</a></li>
                @endcan
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="https://www.gravatar.com/avatar/{{ md5(Auth::user()->email) }}?s=20&d=mm" class="img-circle profile-image"> {{ Auth::user()->name }} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('me') }}">{{ trans('common.my_profile') }}</a></li>
                        <li><a href="{{ url('me/settings') }}">{{ trans('common.settings') }}</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ url('logout') }}">{{ trans('common.logout') }}</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>