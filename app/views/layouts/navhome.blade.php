<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Riddhi Mittal">
        <meta name="description" content="This website makes the Indian ARMY Updates of Rescued people, as posted on their Facebook and Twitter accounts, searchable. It also lets people add Missing Person Reports and Found Person Reports.">
        <meta name="keywords" content="kashmir floods, kashmir floods 2014, Indian army, kashmir rescued people, help kashmir">
        <title>Kashmiri Floods 2014 Missing Person Finder</title>
        {{ HTML::style('//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'); }}
        {{ HTML::style('//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'); }}
        {{ HTML::style('css/layouts/nav.css'); }}
        @yield('head')
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-55044304-1', 'auto');
          ga('send', 'pageview');

        </script>
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
              <a class="navbar-brand" href={{ route('howto') }}>Home</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-left">
                <li><a class="navbar-link" href={{ route('updates') }}>ARMY Updates</a></li>
                <li><a class="navbar-link" href={{ route('find.and.found') }}>Find & Found</a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle navbar-link" data-toggle="dropdown">Volunteer<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href={{ route('contributor.add.form') }}>Contribute Now!</a></li>
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
                <li><a class="navbar-link" href={{ route('about') }}>Contact Me</a></li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>

        <div class="floating-help pull-left">
          <a href={{ route('about') }}>
          H<br>
          E<br>
          L<br>
          P<br>
          </a>
        </div>

        @yield('content')

        <div id="footer">
            <div class="container">
                <span>PLEASE NOTE: All data entered will be available to the public and viewable and usable by anyone. We do not review or verify the accuracy of this data.</span>
            </div>
        </div>

        <br/>
        {{ HTML::script('https://code.jquery.com/jquery-1.11.1.min.js'); }}
        {{ HTML::script('http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.js'); }}

        <script>
          $(document).ready(function() {

              var url = $(location).attr('href');
              var jq = "a[href='" + url + "']";

              console.log(jq);

              $(jq).addClass("active-link");

              

              $(".nav a").on("click", function(){
                $(document).find(".active-link").removeClass("active-link");
                 //$(".nav").find(".active-link").removeClass("active-link");
                 $(this).parent().addClass("active-link");
              });
          });
        </script>

        @yield('jsinclude')
    </body>
</html>