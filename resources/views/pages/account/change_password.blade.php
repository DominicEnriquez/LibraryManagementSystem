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
        {!!Form::open(['route'=>'account::do-change-password', 'class'=>'form-horizontal form-label-left'])!!}
            @include('partials.form_notifications')
            @include('partials.page_notifications')
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="current-password">Current Password
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              {!!Form::password('current_password', ['class'=>'form-control col-md-7 col-xs-12'])!!}
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="current-password">New Password
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              {!!Form::password('password', ['class'=>'form-control col-md-7 col-xs-12'])!!}
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="current-password">Confirm New Password
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              {!!Form::password('password_confirmation', ['class'=>'form-control col-md-7 col-xs-12'])!!}
            </div>
          </div>
          
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button type="submit" class="btn btn-success">Save Changes</button>
            </div>
          </div>

          {!!Form::close()!!}
      </div>
    </div>
  </div>
</div>

@endsection