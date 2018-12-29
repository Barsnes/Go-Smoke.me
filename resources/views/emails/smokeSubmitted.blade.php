<head>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<div class="container bg-smoke-y">
    Hello, {{ $smoke->user->name }}!
</div>
<div class="card bg-smoke">
  <div class="card-body">
    <p>This is just an email informing you that your smoke, "<strong>{{ $smoke->title }}</strong>" has been submitted, and is now going through our approval system.<p>
    <p>If you have followed the guidelines listed below, you should be in the green, and can sit back and relax:</p>
    <ul>
      <li>The video must be high quality</li>
      <li>The video must show how to do the smoke in under 1 minute</li>
      <li>The title must be short and concise</li>
    </ul>
  </div>

  <div class="">
    <p>If you did not submit a smoke, please consider <a href="https://go-smoke.me/password/reset">resetting your password</a></p>
  </div>
</div>
