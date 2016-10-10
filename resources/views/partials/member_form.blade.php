<div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">First Name <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        {!!Form::text('firstname', null, ['class'=>'form-control col-md-7 col-xs-12 first-focus'])!!}
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
 
  @if(\Route::currentRouteName() == 'admin::member-add')
      <br>
      <div class="divider-dashed"></div>
      <br>
      <div class="form-group">
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email*</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
          {!!Form::text('email', null, ['class'=>'form-control col-md-7 col-xs-12'])!!}
        </div>
      </div>
      <div class="form-group">
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Password*</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
          {!!Form::password('password', ['class'=>'form-control col-md-7 col-xs-12'])!!}
        </div>
      </div>
      <div class="form-group">
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Confirm Password*</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
          {!!Form::password('password_confirmation', ['class'=>'form-control col-md-7 col-xs-12'])!!}
        </div>
      </div>
  @endif
  
  <div class="ln_solid"></div>
  