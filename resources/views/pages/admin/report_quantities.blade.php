@extends('layouts.app')

@section('title', $title)

@section('content')

<div class="row"> 
  <div class="col-md-12 col-sm-12 col-xs-12">
    @include('partials.form_notifications')
    @include('partials.page_notifications')  
    <div class="x_panel">
      <div class="x_title">
        <h2>{{$title}}</small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <table id="dtlist" class="table table-striped table-bordered bulk_action">
          <thead>
            <tr>
              <th>Book ID</th>
              <th>Title</th>
              <th>Author</th>
              <th>QTY</th>
              <th>Updated At</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
$(function() {
    var oTable = $('table#dtlist').dataTable({
        order: [[3, 'asc']],
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{route('admin::dt-report-quantities')}}"
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'title', name: 'title'},
            {data: 'author', name: 'author'},
            {data: 'quantities', name: 'quantities'},
            {data: 'updated_at', name: 'updated_at'},
        ]
    });
});

</script>
@endsection