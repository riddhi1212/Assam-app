<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Kashmiri Floods 2014 Person Finder</title>
        {{ HTML::style('http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'); }}
        {{ HTML::style('css/layouts/nav-style.css'); }}
        @yield('head')
    </head>
    <body>
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href={{ route('home') }}>Kashmir Floods 2014</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li><a href={{ route('updates') }}>ARMY Updates</a></li>
                <li><a href="#">Volunteer</a></li>
                <li><a href="#">Donate</a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Leaderboards<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Top Volunteers</a></li>
                    <li><a href="#">Top Donors</a></li>
                    <li class="divider"></li>
                    <li><a href="#">All Volunteers</a></li>
                    <li><a href="#">All Donors</a></li>
                  </ul>
                </li>
              </ul>

              <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Additional Resources</a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">About Us<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                  </ul>
                </li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>

        @yield('content')

        <div id="footer">
            <div class="container">
                <p>PLEASE NOTE: All data entered will be available to the public and viewable and usable by anyone. We do not review or verify the accuracy of this data.</p>
            </div>
        </div>

        <br/>
        {{ HTML::script('https://code.jquery.com/jquery-1.11.1.min.js'); }}
        {{ HTML::script('http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.js'); }}
        @yield('jsinclude')
    </body>
</html>