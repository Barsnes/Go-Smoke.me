@extends('layouts.default')

@section('content')
  @foreach ($smokes as $smoke)
  <div class="card" style="width: auto;">
  <div class="card-body">
    <h5 class="card-title">{{ $smoke->title }}</h5>
    <video src="{{ asset('/smokeVideos/' . $smoke->video) }}" controls></video>
    <h6>{{ $smoke->map }}</h6>
  </div>
</div>
  @endforeach
@endsection
