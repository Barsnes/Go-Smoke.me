@extends('layouts.default')

@section('title')
  Create FAQ Entry
@endsection

@section('content')

  <div class="row">
    <div class="col-md-8 offset-2">
      @include('layouts.errors')
      <h1>Create new FAQ entry</h1>
      <hr>
      {!! Form::model($faq, array('route' => array('faq.update', $faq->id), 'method' => 'PUT')) !!}﻿
        @csrf
        {{ csrf_field() }}
<div class="row">
  <div class="col">
    <label for="">Question</label>
    <input class="form-control" type="text" name="question" placeholder="Question" value="{{ $faq->question }}">
  </div>
</div>
<div class="row">
  <div class="col">
    <label for="">Answer</label>
    <input class="form-control" type="text" name="answer" placeholder="Answer" value="{{ $faq->answer }}">
  </div>
</div>
<div class="row">
  <div class="col">
      <label for="category">Category:</label>
      <select name="category" class="form-control" value="{{ $faq->category }}">
        <option disabled selected>{{ $faq->category }}</option>
        <option value="account">Account</option>
        <option value="smokes">Smokes</option>
      </select>
      <label for="active">Active</label>
      <input type="checkbox" name="active" value="1" @if ($faq->active == '1')
        checked
      @endif>
  </div>
</div>
        <button class="btn btn-success" type="submit" style="margin-top:1rem" value="Submit">Submit</button>
      </form>
      <hr>
    </div>
  </div>

@endsection
