<div class="container">
<nav class="navbar navbar-inverse navbar-lg" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
        </button>
        <a class="navbar-brand" href="/computer">WAKE ON LAN</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="navbar-collapse">
        <ul class="nav navbar-nav">
            <li {!! Request::is('computer*') ? 'class="active"' : '' !!}>
                <a href="{{ route('computer.index') }}">My Computers</a>
            </li>
        </ul>
        @if(Auth::guest())
            <form class="navbar-form navbar-right" role="form" method="POST" action="{{ url('/auth/login') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <input type="text" placeholder="Email" class="form-control" name="email" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <input type="password" placeholder="Password" class="form-control" name="password">
                </div>
                <button type="submit" class="btn btn-success">Sign in</button>
            </form>
        @else
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="{{ url('auth/logout') }}">Logout</a>
                </li>
            </ul>
            <p class="navbar-text navbar-right">
                Signed in as {{ Auth::user()->email }}</a>
            </p>
        @endif
    </div><!-- /.navbar-collapse -->
</nav>
</div>