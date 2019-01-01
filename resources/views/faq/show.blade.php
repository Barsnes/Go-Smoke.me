@extends('layouts.default')

@section('title')
  Faq
@endsection

@section('content')

<div class="container">
  <div class="jumbotron bg-smoke">
    <div class="row offset-1">
      <div class="col">
        <h1 class="display-4">FAQ</h1>
        <p class="lead">If you can't find an answer to your question below, please email us at <a href="mailto:mail@go-smoke.me">mail@go-smoke.me</a></p>
        <hr class="my-4">
        @if (Auth::user() !== null)
        @if (Auth::user()->role == 'admin')
          <a class="btn btn-sm btn-success" href="/faq/create">Add new question</a>
        @endif
        @endif
      </div>
    </div>
  </div>

<div class="row">
  <div class="col">
    <h2>Account</h2>
    @php
      $questionCount = 0;
    @endphp
    @foreach ($faqs as $faq)
      @if ($faq->category == 'account' && $faq->active == '1')
      @php $questionCount ++ @endphp
      <div class="panel-group" id="faqAccordion">
            <div class="panel panel-default ">
                <div class="panel-heading accordion-toggle question-toggle collapsed bg-smoke-y pt-2 pl-3 pr-2 pb-1 mt-1" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question{{ $questionCount }}" style="border-radius: 5px 5px 0 0">
                     <h5 class="panel-title">
                        <a style="color:#FFF" class="ing">{{ $faq->question }}</a>
                      </h5>

                </div>
                <div id="question{{ $questionCount }}" class="panel-collapse collapse" style="height: 0px;">
                    <div class="panel-body bg-smoke p-3" style="border-radius: 0 0 5px 5px">
                       <h5><span class="label label-primary">Answer</span></h5>
                        <p>{!! $faq->answer !!}</p>
                        @if (Auth::user() !== null)
                        @if (Auth::user()->role == 'admin')
                          <a class="btn btn-sm btn-success" href="/faq/{{ $faq->id }}/edit">Edit</a>
                        @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif
      @endforeach
      <hr class="border-white">
      <h2>Smokes</h2>
      @foreach ($faqs as $faq)
        @if ($faq->category == 'smokes' and $faq->active == '1')
        @php $questionCount ++ @endphp
        <div class="panel-group" id="faqAccordion">
              <div class="panel panel-default ">
                  <div class="panel-heading accordion-toggle question-toggle collapsed bg-smoke-y pt-2 pl-3 pr-2 pb-1 mt-1" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question{{ $questionCount }}" style="border-radius: 5px 5px 0 0">
                       <h5 class="panel-title">
                          <a style="color:#FFF" class="ing">{{ $faq->question }}</a>
                        </h5>

                  </div>
                  <div id="question{{ $questionCount }}" class="panel-collapse collapse" style="height: 0px;">
                      <div class="panel-body bg-smoke p-3" style="border-radius: 0 0 5px 5px">
                         <h5><span class="label label-primary">Answer</span></h5>
                          <p>{!! $faq->answer !!}</p>
                          @if (Auth::user() !== null)
                          @if (Auth::user()->role == 'admin')
                            <a class="btn btn-sm btn-success" href="/faq/{{ $faq->id }}/edit">Edit</a>
                          @endif
                          @endif
                      </div>
                  </div>
              </div>
          </div>
          @endif
        @endforeach
    </div>
  </div>
</div>


@endsection
