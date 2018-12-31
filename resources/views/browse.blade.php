@extends('layouts.default')

@section('title')
  Browse
@endsection

@section('content')

<div class="container mt-5">
    <h1 class="title">Browse smokes</h1>
    <div class="jumbotron bg-smoke mb-5 pt-3 pb-4">
      <div class="search">
        <h2>Search smokes</h2>
        <div class="row">
          <div class="col col-centered">
            <form method="POST" role="search" onsubmit="get_sell_sheet(); return false;">
              @csrf
              <div class="input-group">
                  <input id="q" type="text" class="form-control" style="max-width:100%" name="q"
                      placeholder="Search.. ex: Mirage">
                  <button type="submit" class="btn btn-sm btn-info">
                      Search
                  </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <hr class="border-white">
    <h1 class="title">Recently added</h1>
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
              @else
                <div class="p-0 m-0" align="right">
                  <a href="/register"><i class="far fa-thumbs-up"></i>{{ $voteCount }}</a>
                </div>
              @endif
            </div>
          </div>
        </div>
      @endif
    @endforeach
    @php
      $pageUrl = request()->fullUrl();
      if (request()->url() == 'http://localhost:8000/browse') {
        $url = str_replace('http://localhost:8000', '', $pageUrl);
      }
      if (request()->url() == 'https://go-smoke.me/browse') {
        $url = str_replace('https://go-smoke.me', '', $pageUrl);
      }

      $currUrl = request()->url();
    @endphp
    <nav aria-label="Page navigation example">
    </div>
    <ul class="pagination justify-content-center">
        <li class="page-item">
          <a id="prev" class="page-link" href="{{ $currUrl }}?page={{ $smokes->currentPage() - 1 }}" aria-label="Previous">
            <span aria-hidden="true"><i class="fal fa-arrow-circle-left"></i></span>
            <span class="sr-only">Previous</span>
          </a>
        </li>
        @if ($url == '/browse?page=1')
          <li class="page-item disabled"><a class="page-link disabled" href="/browse?page=1" tabindex="-1">1</a></li>
        @else
          <li class="page-item"><a class="page-link" href="/browse?page=1">1</a></li>
        @endif
      @if ($url == '/browse?page=2')
        <li class="page-item disabled"><a class="page-link disabled" href="/browse?page=2" tabindex="-1">2</a></li>
      @else
        <li class="page-item"><a class="page-link" href="/browse?page=2">2</a></li>
      @endif
      @if ($url == '/browse?page=3' )
        <li class="page-item disabled"><a class="page-link disabled" href="/browse?page=3" tabindex="-1">3</a></li>
      @else
        <li class="page-item"><a class="page-link" href="/browse?page=3">3</a></li>
      @endif
      <li class="page-item">
        <a class="page-link" href="{{ $currUrl }}?page={{ $smokes->currentPage() + 1 }}" id="next" aria-label="Previous">
          <span aria-hidden="true"><i class="fal fa-arrow-circle-right"></i></span>
          <span class="sr-only">Next</span>
        </a>
      </li>
    </ul>
  </nav>
</div>
@endsection
