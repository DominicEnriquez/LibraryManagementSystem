@extends('layouts.app')

@section('title', $title)

@section('content')

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>{{$title}}</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        {!!Form::open(['route'=>'admin::do-member-add', 'class'=>'form-horizontal form-label-left'])!!}
            @include('partials.form_notifications')
            @include('partials.page_notifications')
            @include('partials.member_form');
        {!!Form::close()!!}
      </div>
    </div>
  </div>
</div>

@endsection