<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>GoSmokeMe - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('script')
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

    @yield('content')

  </body>
</html>
