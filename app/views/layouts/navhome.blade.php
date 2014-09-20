<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Kashmiri Floods 2014 Person Finder</title>
        {{ HTML::style('http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'); }}
        {{ HTML::style('css/layouts/nav.css'); }}
        @yield('head')
    </head>
    <body>
        <nav class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
<!--               @if ( Auth::check() )
                <a class="navbar-brand" href={{ route('dashboard') }}>Dashboard</a>
              @else
                <a class="navbar-brand" href={{ route('howto') }}>Home</a>
              @endif -->
              <a class="navbar-brand" href={{ route('howto') }}>Home</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li><a class="navbar-link active-link" href={{ route('updates') }}>ARMY Updates</a></li>
                <li><a class="navbar-link" href={{ route('find.and.found') }}>Find & Found</a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle navbar-link" data-toggle="dropdown">Volunteer<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Contribute Now!</a></li>
                    <li class="divider"></li>
                    <li><a href={{ route('contributors') }}>View Contributors</a></li>
                  </ul>
                </li>
                <li><a class="navbar-link" href={{ route('donate') }}>Donate</a></li>
<!--                 <li class="dropdown">
                  <a href="#" class="dropdown-toggle navbar-link" data-toggle="dropdown">Leaderboards<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Top Volunteers</a></li>
                    <li><a href="#">Top Donors</a></li>
                    <li class="divider"></li>
                    <li><a href="#">All Volunteers</a></li>
                    <li><a href="#">All Donors</a></li>
                  </ul>
                </li> -->
                <li><a class="navbar-link" href={{ route('siteimpact') }}>Our Impact</a></li>
              </ul>

              <ul class="nav navbar-nav navbar-right" id="right-nav-section">
                @if ( Auth::check() )
                  <li>
                    <a class="navbar-link" href={{ route('dashboard') }}>Welcome back 
                      <span id ="auth-username">{{ Auth::user()->fname }}</span>
                      <span class="badge" id="notification-count">{{ Auth::user()->numMessages() }}</span>
                    </a>
                  </li>
                @endif
                @if ( Auth::check() )
                  <li id="log-text"><a class="navbar-link" href={{ route('logout') }}>Log Out</a></li>
                @else
                  <li id="log-text"><a class="navbar-link" href={{ route('login') }}>Log In</a></li>
                @endif
                <li><a class="navbar-link" href={{ route('about') }}>About Us</a></li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>

        @yield('content')

        <div id="footer">
            <div class="container">
                <span>PLEASE NOTE: All data entered will be available to the public and viewable and usable by anyone. We do not review or verify the accuracy of this data.</span>
            </div>
        </div>

        <br/>
        {{ HTML::script('https://code.jquery.com/jquery-1.11.1.min.js'); }}
        {{ HTML::script('http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.js'); }}
        @yield('jsinclude')
    </body>
</html>