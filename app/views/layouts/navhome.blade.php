<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Riddhi Mittal">
        <meta name="description" content="This website provides information on donation centers for Assam and Meghalaya flood victims.">
        <meta name="keywords" content="assam floods, assam floods 2014, donate to assam, donate to meghalaya">
        <title>Assam and Meghalaya Floods 2014</title>
        {{ HTML::style('//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'); }}
        {{ HTML::style('//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'); }}
        {{ HTML::style("//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.1/css/bootstrapValidator.min.css"); }}
        {{ HTML::style('css/layouts/nav.css'); }}
        @yield('head')
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-55044304-2', 'auto');
          ga('require', 'displayfeatures');
          ga('require', 'linkid', 'linkid.js');
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
              <a class="navbar-brand" href={{ route('howto') }}><span class="fa fa-home fa-fw fa-lg"></span>Home</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-left">
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle navbar-link" id="donate" data-toggle="dropdown"><span class="fa fa-heart-o fa-fw fa-lg"></span>Donate<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href={{ route('donate.supplies') }} data-parent="donate"><span class="fa fa-list-ul fa-fw fa-lg"></span>Supplies</a></li>
                    <li class="divider"></li>
                    <li><a href={{ route('donate') }} data-parent="donate"><span class="fa fa-rupee fa-fw fa-lg"></span>Money</a></li>
                  </ul>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle navbar-link" id="updates" data-toggle="dropdown"><span class="fa fa-search fa-fw fa-lg"></span>Find & Found<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href={{ route('missing.person.report') }} data-parent="updates"><span class="fa fa-male fa-fw fa-lg"></span>Lodge Missing Person Report</a></li>
                    <li class="divider"></li>
                    <li><a href={{ route('found.person.report') }} data-parent="updates"><span class="fa fa-smile-o fa-fw fa-lg"></span>Post Found Person Report</a></li>
                  </ul>
                </li>
                <li><a class="navbar-link" href={{ route('siteimpact') }}><span class="fa fa-bar-chart fa-fw fa-lg"></span>Our Impact</a></li>
              </ul>

              <ul class="nav navbar-nav navbar-right" id="right-nav-section">
                @if ( Auth::check() )
                  <li>
                    <a class="navbar-link" href={{ route('dashboard') }}> 
                      <span id ="auth-username">{{ Auth::user()->fname }}</span>
                      's Dashboard
                      <span class="badge" id="notification-count">{{ Auth::user()->numMessages() }}</span>
                    </a>
                  </li>
                @endif
                @if ( Auth::check() )
                  <li id="log-text"><a class="navbar-link" href={{ route('logout') }}><span class="fa fa-sign-out fa-fw fa-lg"></span>Log Out</a></li>
                @else
                  <li id="log-text"><a class="navbar-link" href={{ route('login') }}><span class="fa fa-sign-in fa-fw fa-lg"></span>Log In</a></li>
                @endif
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle navbar-link" id="about" data-toggle="dropdown">Contact<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href={{ route('about') }} data-parent="about"><span class="fa fa-users fa-fw fa-lg"></span>About Us</a></li>
                    <li class="divider"></li>
                    <li><a href={{ route('contact.me') }} data-parent="about"><span class="fa fa-pencil fa-fw fa-lg"></span>Contact Us</a></li>
                  </ul>
                </li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>


         <a href={{ route('contact.me') }}>
            <div class="floating-help">     
              H<br>
              E<br>
              L<br>
              P<br>
            </div>
        </a>

        @yield('content')
        <div id="footer">
            <div class="container">
                <span>PLEASE NOTE: All data entered will be available to the public and viewable and usable by anyone. We do not review or verify the accuracy of this data.</span>
            </div>
        </div>

        {{ HTML::script('https://code.jquery.com/jquery-1.11.1.min.js'); }}
        {{ HTML::script('http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.js'); }}
        {{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.1/js/bootstrapValidator.min.js'); }}

        <script>
          $(document).ready(function() {

              // ON LOAD make body margin-bottom = footer height
              // and make body padding-top = navbar height
              $('body').css('margin-bottom', $('#footer').css('height'));
              $('body').css('padding-top', $('.navbar').css('height'));
              
              $( window ).resize(function() {
                $('body').css('margin-bottom', $('#footer').css('height'));
                $('body').css('padding-top', $('.navbar').css('height'));
              });

              var url = $(location).attr('href');
              var jq = "a[href='" + url + "']";

              //console.log(jq);

              var jq2 = jq.split('#')[0];

              var make_active_elem = $(jq2);

              make_active_elem.addClass("active-link");

              //console.log(make_active_elem);

              var data_parent = $(jq).data('parent');

              //console.log(data_parent);

              if (data_parent) {
                //console.log("adding active-link to data_parent id");
                $('#'+data_parent).addClass("active-link");
              }

              

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