@extends('layouts.default')

@section('title')
  @if (isset($query))
    {{ $query }}
  @else
    Search
  @endif
@endsection

@section('content')

<div class="container mt-5">
    <div class="row">
      <div class="col">
        @if (isset($query))
          <h3>Searching for "{{ $query }}"</h3>
        @else
          <h3>Search for a keyword</h3>
        @endif
        <form method="POST" role="search" onsubmit="get_sell_sheet(); return false;">
          @csrf
          <div class="input-group">
              <input id="q" type="text" class="form-control" style="max-width:30%" name="q"
                  placeholder="Search">
              <button type="submit" class="btn btn-sm btn-info">
                  Search
              </button>
          </div>
        </form>
      </div>
    </div>
    <div class="row mt-5">
      @if (isset($smokes))
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
      @endif
    @if (isset($message))
      {{ $message }}
    @endif
    </div>
</div>

<script>
  function get_sell_sheet(){
    var q = document.getElementById("q").value;
    var url = "{{ Request::root() }}/search/?q=" + q;
    window.location.href = url;
  }
</script>
@endsection
