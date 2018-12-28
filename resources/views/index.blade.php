@extends('layouts.default')

@section('title')
  Home
@endsection

@section('content')

<div class="container">
  <div class="jumbotron bg-smoke">
    <h1 class="display-4 offset-1">GoSmoke.Me</h1>
    <p class="lead offset-1">Your go to website for CSGO smokes</p>
    <hr class="my-4 offset-1">
    <p class="offset-1 font-weight-light">It uses utility classes for typography and spacing to space content out within the larger container.</p>
    <p class="lead offset-1">
      <a class="btn btn-primary btn-lg" href="/browse" role="button">Browse</a>
    </p>
  </div>
</div>
@endsection
