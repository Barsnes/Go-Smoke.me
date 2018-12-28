@extends('layouts.default')

@section('title')
  {{ $user->name }}
@endsection

@php
  $smokes = $user->smoke;

  $smokeCount = 0;

  foreach ($smokes as $smoke) {
    $smokeCount += 1;
  }
@endphp

@section('content')

  <div class="container">
    <div class="row mb-3">
      <div class="col">
        <div class="card">
          <div class="card-body">
            <h3 class="card-title">{{ $user->name }}</h3>
            <hr class="border-white">
            @if ($smokeCount == 1)
              <p class="card-text">{{ $user->name }} has posted {{ $smokeCount }} smoke.</p>
            @else
              <p class="card-text">{{ $user->name }} has posted {{ $smokeCount }} smokes.</p>
            @endif
            @guest
            @else
              @if ($user->id == $loggedInUser->id)
                <a href="/smokes/create" class="btn btn-info btn-sm">Add new smoke</a>
              @endif
            @endguest
          </div>
        </div>
      </div>
      <div class="col">
        @guest

        @else
          @if ($user->id == $loggedInUser->id)
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Smokes in Review</h4>
                <hr class="border-white">

              </div>
            </div>
          @endif
        @endguest
      </div>
    </div>
    <div class="row">
      @foreach ($smokes as $smoke)
        <div class="col">
      <div class="card" style="width: 100%;">
        <div class="card-body">
          <h5 class="card-title">{{ $smoke->title }}</h5>
          <video src="{{ asset('/smokeVideos/' . $smoke->video) }}" controls style="width:calc(1920px/6); height: calc(1080px/6)"></video>
          <h5>{{ $smoke->map }}</h5>
          <h6>Difficulty:</h6>
          <div class="progress" style="margin-top:.5rem">
            <div class="progress-bar bg-info" role="progressbar" style="width: {{ $smoke->difficulty }}%" aria-valuenow="{{ $smoke->difficulty }}" aria-valuemin="0" aria-valuemax="100">{{ $smoke->difficulty }}%</div>
          </div>
          <h6 style="margin-top:.5rem" class="text-muted">Created by <a href="/users/{{ $smoke->user->id }}/">{{ $smoke->user->name }}</a></h6>
        </div>
      </div>
        </div>
      @endforeach
    </div>
  </div>

@endsection
