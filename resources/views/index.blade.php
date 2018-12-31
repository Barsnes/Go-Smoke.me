@extends('layouts.default')

@section('title')
  Home
@endsection

@section('content')

<div class="container">
  <div class="jumbotron bg-smoke">
    <div class="row offset-1">
      <div class="col">
        <h1 class="display-4">GoSmoke.Me</h1>
        <p class="lead">Your go to website for CSGO smokes</p>
        <hr class="my-4">
      </div>
    </div>
    <div class="row offset-1">
      <div class="col">
        <form method="POST" role="search" onsubmit="get_sell_sheet(); return false;">
          @csrf
          <div class="input-group">
              <input id="q" type="text" class="form-control" style="max-width:50%" name="q"
                  placeholder="Search.. ex: Mirage">
              <button type="submit" class="btn btn-sm btn-info">
                  Search
              </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <hr class="border-white">
  <h1 class="title">Top 3 smokes</h1>
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
@endsection
