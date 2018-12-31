<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>GoSmokeMe - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-LRlmVvLKVApDVGuspQFnRQJjkv0P7/YFrw84YYQtmYG4nK8c+M+NlmYDCv0rKWpG" crossorigin="anonymous">
    @yield('script')
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.css" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.js"></script>
    <script>
    window.addEventListener("load", function(){
    window.cookieconsent.initialise({
      "palette": {
        "popup": {
          "background": "#44355b",
          "text": "#FFFFFF"
        },
        "button": {
          "background": "#eca72c",
          "text": "#ffffff"
        }
      },
      "theme": "classic",
      "position": "bottom-right"
    })});
    </script>
  </head>
  <body>

<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #ECA72C">
  <div class="container">

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="/">GoSmoke.Me</a>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item">
        @if (request()->path() == '/')
          <a class="nav-link active" href="/">Home</a>
        @else
          <a class="nav-link" href="/">Home</a>
        @endif
      </li>
      <li class="nav-item">
        @if (request()->path() == 'browse')
          <a class="nav-link active" href="/browse">Browse</a>
        @else
          <a class="nav-link" href="/browse">Browse</a>
        @endif
      </li>
    </ul>
  </div>
    <ul class="navbar-nav ml-auto">
        <!-- Authentication Links -->
        @if (isset($loggedInUser->id))
          <li class="nav-item">
              <a style="margin-left:.5rem" class="btn btn-success my-2 my-sm-0" href="/smokes/create">Submit new smoke</a>
          </li>
        @endif
        @guest
            <li class="nav-item">
                <a class="btn btn-outline-info my-2 my-sm-0" style="color: #FFF" href="/login">Login</a>
            </li>
            @if (Route::has('register'))
                <li class="nav-item">
                    <a style="margin-left:.5rem" class="btn btn-success my-2 my-sm-0" href="/register">Register</a>
                </li>
            @endif
        @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="/users/{{ $loggedInUser->id }}">
                      Profile
                  </a>
                  <a class="dropdown-item" href="/smokes/create">
                      Create new smoke
                  </a>
                  @if ($loggedInUser->role == 'admin')
                    <a class="dropdown-item" href="/admin/approve">
                        Approve Smokes
                    </a>
                  @endif
                  <hr style="border: .4px solid #FFF">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest
    </ul>
  </div>
  </nav>

<div style="min-height:100vh">
    @yield('content')
</div>

    <section id="footer">
  		<div class="container pt-5 pb-5">
  			<div class="row text-center text-xs-center text-sm-left text-md-left">
  				<div class="col-xs-12 col-sm-4 col-md-4">
  					<h5>Quick links</h5>
  					<ul class="list-unstyled quick-links">
  						<li><a href="/"><i class="fa fa-angle-double-right"></i>Home</a></li>
  						<li><a href="/browse"><i class="fa fa-angle-double-right"></i>Browse</a></li>
  						<li><a href="/faq"><i class="fa fa-angle-double-right"></i>FAQ</a></li>
  						<li><a href="/register"><i class="fa fa-angle-double-right"></i>Get Started</a></li>
  						<li><a href="/browse"><i class="fa fa-angle-double-right"></i>Videos</a></li>
  					</ul>
  				</div>
  				<div class="col-xs-12 col-sm-4 col-md-4">
  					<h5>Other links</h5>
  					<ul class="list-unstyled quick-links">
  						<li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>ToS</a></li>
  						<li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Press</a></li>
  						<li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>FAQ</a></li>
  						<li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Get Started</a></li>
  						<li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Videos</a></li>
  					</ul>
  				</div>
  				<div class="col-xs-12 col-sm-4 col-md-4">
  					<h5>Social links</h5>
  					<ul class="list-unstyled quick-links">
  						<li><a href="https://github.com/Barsnes/Go-Smoke.me"><i class="fab fa-github"></i></i>Github</a></li>
  						<li><a href="https://twitter.com/_Barsnes"><i class="fab fa-twitter"></i></i>Twitter</a></li>
              <li><a href="https://www.paypal.me/Barsnes" target="_blank"><i class="fas fa-usd-circle"></i>Donate</a></li>
  					</ul>
  				</div>
  			</div>
  			<div class="row">
  				<div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-5">
  					<ul class="list-unstyled list-inline social text-center">
  						{{-- <li class="list-inline-item"><a href="javascript:void();"><i class="fa fa-facebook"></i></a></li> --}}
  						<li class="list-inline-item"><a href="https://twitter.com/_Barsnes" target="_blank"><i class="fab fa-twitter"></i></a></li>
  						<li class="list-inline-item"><a href="https://github.com/Barsnes/Go-Smoke.me" target="_blank"><i class="fab fa-github"></i></a></li>
  						{{-- <li class="list-inline-item"><a href="javascript:void();"><i class="fa fa-google-plus"></i></a></li> --}}
              <li class="list-inline-item"><a href="https://www.paypal.me/Barsnes" target="_blank"><i class="fas fa-usd-circle"></i></a></li>
              <li class="list-inline-item"><a href="mailto:mail@go-smoke.me" target="_blank"><i class="fa fa-envelope"></i></a></li>
  					</ul>
  				</div>
  				</hr>
  			</div>
  			<div class="row">
  				<div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-center text-white">
  					<p class="h6">&copy All right Reversed.<a class="text-green ml-2" href="https://go-smoke.me" target="_blank">GoSmoke.Me</a></p>
            <p>This is a free and open source webapp created by <a href="https://twitter.com/_Barsnes" target="_blank"><strong>Tobias Barsnes</strong></a> <a href="https://www.paypal.me/Barsnes" target="_blank"><br><i class="fas fa-usd-circle"></i> Donate</a></p>
  				</div>
  				</hr>
  			</div>
  		</div>
  	</section>
  </body>

</html>
