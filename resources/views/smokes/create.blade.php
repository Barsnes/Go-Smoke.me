@extends('layouts.default')

@section('title')
  Create Smoke
@endsection

@section('content')

  <div class="row">
    <div class="col-md-8 offset-2">
      @include('layouts.errors')
      <h1>Send in new smoke</h1>
      <hr>
      <form action="{{ route('smokes.store') }}" method="POST" enctype="multipart/form-data" id="form">
        @csrf
        {{ csrf_field() }}

        <label for="">Title</label>
        <input class="form-control" type="text" name="title" placeholder="Title">

  <div class="row">
    <div class="col">
      <label for="">Video</label>
      <input type="file" name="video" value="" class="form-control">
    </div>
    <div class="col">
        <label for="team_id">Map:</label>
        <select name="map" class="form-control" placeholder="Choose One">
          <option disabled>Choose One</option>
          <option value="Cache">Cache</option>
          <option value="Dust 2">Dust 2</option>
          <option value="Overpass">Overpass</option>
          <option value="Inferno">Inferno</option>
          <option value="Mirage">Mirage</option>
          <option value="Nuke">Nuke</option>
          <option value="Train">Train</option>
        </select>
    </div>
    <div class="col">
      <label for="">Difficulty</label>
      <input type="range" list="tickmarks" class="form-control" name="difficulty">
      <datalist id="tickmarks">
        <option value="0" label="Easy">
        <option value="10">
        <option value="20">
        <option value="30">
        <option value="40">
        <option value="50" label="50%">
        <option value="60">
        <option value="70">
        <option value="80">
        <option value="90">
        <option value="100" label="Hard">
      </datalist>
    </div>
  </div>
        <button class="btn btn-success" type="submit" style="margin-top:1rem" value="Submit">Submit</button>
      </form>
      <hr>
    </div>
  </div>

@endsection
