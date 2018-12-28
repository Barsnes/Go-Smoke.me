@extends('layouts.default')

@section('script')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@endsection
@section('content')

<div class="container mt-5">
  <div class="col">
    <div class="row">
      <h3>Approve Smokes</h3>
    </div>
    <hr class="border-white">
  </div>
  <div class="row mt-5">
  @foreach ($smokes as $smoke)
    @if ($smoke->approved == '0')
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
            <div class="row">
              {!! Form::model($smoke, array('route' => array('smokes.update', $smoke->id), 'method' => 'PUT')) !!}﻿
                @csrf
                <input type="hidden" name="approved" value="1">
                <button type="submit" class="btn btn-sm btn-success">Approve</button>
              </form>
              {!! Form::model($smoke, array('route' => array('smokes.destroy', $smoke->id), 'method' => 'PUT')) !!}﻿
                {{ method_field('DELETE') }}
                @csrf
                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    @endif
  @endforeach
  </div>
</div>

<script type="text/javascript">
$('#submit').click(function() {
  $.ajax({
      url: '{!! Form::model($smoke, array('route' => array('smokes.update', $smoke->id))) !!}﻿',
      type: 'PUT',
      data: {
          approved: '1'
      },
      success: function(msg) {
          alert('Approved');
      }
  });
});
</script>

@endsection
