<head>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<div class="container bg-smoke-y">
    Hello, {{ $smoke->user->name }}!
</div>
<div class="card bg-smoke">
  <div class="card-body">
    <p>Your smoke, "<strong>{{ $smoke->title }}</strong>" has been approved!<p>
    <p>If you wish to submit a new one, you can do so <a href="https://go-smoke.me/smokes/submit">here</a>!</p>
  </div>
  <div class="">
    <p>If you did not submit a smoke, please consider <a href="https://go-smoke.me/password/reset">resetting your password</a></p>
  </div>
</div>
