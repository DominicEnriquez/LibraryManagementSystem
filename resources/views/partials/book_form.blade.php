<div class="form-group">
<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Title <span class="required">*</span>
</label>
<div class="col-md-6 col-sm-6 col-xs-12">
    {!!Form::text('title', null, ['class'=>'form-control col-md-7 col-xs-12'])!!}
</div>
</div>
<div class="form-group">
<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Author <span class="required">*</span>
</label>
<div class="col-md-6 col-sm-6 col-xs-12">
  {!!Form::text('author', null, ['class'=>'form-control col-md-7 col-xs-12'])!!}
</div>
</div>
<div class="form-group">
<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">ISBN <span class="required">*</span></label>
<div class="col-md-6 col-sm-6 col-xs-12">
  {!!Form::text('isbn', null, ['class'=>'form-control col-md-7 col-xs-12'])!!}
</div>
</div>
<div class="form-group">
<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Quantity <span class="required">*</span></label>
<div class="col-md-6 col-sm-6 col-xs-12">
  {!!Form::text('quantities', null, ['class'=>'form-control col-md-7 col-xs-12'])!!}
</div>
</div>
<div class="form-group">
<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Shelf Location <span class="required">*</span></label>
<div class="col-md-6 col-sm-6 col-xs-12">
  {!!Form::text('shelf_location', null, ['class'=>'form-control col-md-7 col-xs-12'])!!}
</div>
</div>