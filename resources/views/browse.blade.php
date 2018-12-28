@extends('layouts.default')

@section('content')

<div class="container mt-5">
    <h1 class="title">Browse smokes</h1>
    <div class="jumbotron bg-smoke mb-5">
      <div class="search">

      </div>
    </div>
    <hr class="border-white">
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
            </div>
          </div>
        </div>
      @endif
    @endforeach
    </div>
</div>
@endsection
