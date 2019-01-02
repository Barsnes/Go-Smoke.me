@extends('layouts.default')

@section('title')
  Home
@endsection

@section('content')

<div class="container ">
  <div class="jumbotron bg-smoke">
    <div class="row offset-md-1 offset-sm-0">
      <div class="col">
        <h1 class="display-5">GoSmoke.Me</h1>
        <p class="lead">Your go to website for CSGO smokes</p>
      </div>
    </div>
    <div class="row offset-md-1 offset-sm-0">
      <div class="col-md-6 col-sm-12">
        <form method="POST" role="search" onsubmit="get_search(); return false;">
          @csrf
          <div class="input-group">
              <input id="q" type="text" class="form-control" name="q"
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
  <div class="row mt-5 row-sm-1">
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
            {!! Form::model($smoke, array('route' => array('smokes.destroy', $smoke->id), 'method' => 'PUT')) !!}﻿
              {{ method_field('DELETE') }}
              @csrf
              <button type="submit" class="btn btn-sm btn-danger">Delete</button>
            </form>
          </div>
        </div>
      </div>
    @endif
  @endforeach
  </div>
  <hr class="border-white">
  <div class="row-12">
    <div class="col-md-6 col-sm-12 bg-smoke p-3 mb-5" style="border-radius: 5px">
          <h1 class="card-title">Submit a smoke</h1>
          <hr>
          <ol>
            <li><a href="/register">Create an account</a></li>
            <li>Click "<a href="/smokes/create">submit new smoke</a>"</li>
            <li>Sit and wait for an admin to approve your smoke!</li>
          </ol>
    </div>
  </div>
</div>
<script type="text/javascript">
  function get_search(){
  var q = document.getElementById("q").value;
  var url = "{{ Request::root() }}/search/?q=" + q;
  window.location.href = url;
  }
</script>
@endsection
