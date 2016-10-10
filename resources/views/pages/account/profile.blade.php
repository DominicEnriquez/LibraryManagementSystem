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
        {!!Form::model(auth()->user()->profile, ['route'=>'account::do-profile', 'class'=>'form-horizontal form-label-left'])!!}
        @include('partials.form_notifications')
        @include('partials.page_notifications')
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">First Name <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                {!!Form::text('firstname', null, ['class'=>'form-control col-md-7 col-xs-12'])!!}
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Last Name <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              {!!Form::text('lastname', null, ['class'=>'form-control col-md-7 col-xs-12'])!!}
            </div>
          </div>
          <div class="form-group">
            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Middle Name / Initial</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              {!!Form::text('middlename', null, ['class'=>'form-control col-md-7 col-xs-12'])!!}
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender*</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <p>
                Male:
                {!!Form::radio('gender', 'male', null, ['class'=>'flat'])!!}
                Female:
                {!!Form::radio('gender', 'female', null, ['class'=>'flat'])!!}
              </p>  
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Of Birth <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              {!!Form::date('birthdate', null, ['class'=>'date-picker form-control col-md-7 col-xs-12'])!!}
            </div>
          </div>
          <div class="form-group">
            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Contact Number*</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              {!!Form::text('contact_number', null, ['class'=>'form-control col-md-7 col-xs-12'])!!}
            </div>
          </div>
          <div class="form-group">
            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Address*</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              {!!Form::text('address', null, ['class'=>'form-control col-md-7 col-xs-12'])!!}
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