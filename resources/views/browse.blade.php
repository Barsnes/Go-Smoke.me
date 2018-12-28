@extends('layouts.default')

@section('content')

<div class="container">
    <h1 class="title">Browse smokes</h1>
    @foreach ($smokes as $smoke)
    <div class="card" style="width: 33.333%;">
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
    @endforeach

</div>
@endsection
