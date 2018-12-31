@extends('layouts.default')

@section('title')
  {{ $user->name }}
@endsection

@php
  $smokes = $user->smoke;

  $smokeCount = 0;

  foreach ($smokes as $smoke) {
    if ($smoke->approved == '1') {
      $smokeCount += 1;
    }
  }
@endphp

@section('content')

  <div class="container mt-5">
    <div class="row mb-5">
      <div class="col">
        <div class="card bg-smoke">
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
              <div class="card bg-smoke">
                <div class="card-body">
                  <ul class="list-group">
                    <li class="list-group-item active bg-info">Smokes in review</li>
                    @foreach ($smokes as $smoke)
                      @if ($smoke->approved == '')
                        <li class="list-group-item"><h6>{{ $smoke->title }}</h6></li>
                      @endif
                    @endforeach
                  </ul>
                </div>
              </div>
          @endif
        @endguest
      </div>
    </div>
    <hr class="border-info">
    <div class="row">
      <div class="col">
        <h3 class="text-center">Smokes added by {{ $user->name }}</h3>
      </div>
    </div>
    <div class="row mt-5">
    @foreach ($smokes as $smoke)
      @if ($smoke->approved == '1')
      <div class="col-md-4">
    <div class="card bg-smoke mb-4" style="width: 100%;">
      <div align="center" class="card-body">
        <h5 class="card-title">{{ $smoke->title }}</h5>
        <video src="{{ asset('/smokeVideos/' . $smoke->video) }}" controls style="width:80%"></video>
        <h5>{{ $smoke->map }}</h5>
        <div class="">
          <h6 class="mr-2" style="display:inline-block">Difficulty:</h6>
          <div align="left" class="progress" style="margin-top:.5rem; width: 50%; display:inline-block; height:1rem">
            <div class="progress-bar bg-info" role="progressbar" style="width: {{ $smoke->difficulty }}%" aria-valuenow="{{ $smoke->difficulty }}" aria-valuemin="0" aria-valuemax="100">{{ $smoke->difficulty }}%</div>
          </div>
        </div>
        <h6 style="margin-top:.5rem" class="text-muted">Created by <a href="/users/{{ $smoke->user->id }}/">{{ $smoke->user->name }}</a></h6>
        @php
          $voteCount = 0;
        @endphp
        @foreach ($smoke->vote as $vote)
          @php
            $voteCount++
          @endphp
        @endforeach
        @if (Auth::User())
          <div class="p-0 m-0" align="right">
            <a href="/smoke/vote/{{ $smoke->id }}"><i class="far fa-thumbs-up"></i>{{ $voteCount }}</a>
          </div>
        @endif
      </div>
    </div>
      </div>
      @endif
    @endforeach
    </div>
  </div>

@endsection
