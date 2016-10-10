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
              <th>ID</th>
              <th>Title</th>
              <th>Author</th>
              <th>ISBN</th>              
              <th>QTY</th>
              <th>Shelf Location</th>
              <th>Date Created</th>
              <th>Date Updated</th>
              <th>Action</th>
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
        processing: true,
        serverSide: true,
        dom: "Bfrtip",
          buttons: [
            {
                text: 'Create New Book +',
                action: function ( e, dt, node, config ) {
                    window.location = "{{route('admin::book-add')}}";
                }
            }
          ],
        ajax: {
            url: "{{route('admin::dt-book-list')}}"
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'title', name: 'title'},
            {data: 'author', name: 'author'},
            {data: 'isbn', name: 'isbn'},
            {data: 'quantities', name: 'quantities'},
            {data: 'shelf_location', name: 'shelf_location'},
            {data: 'created_at', name: 'created_at'},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'action', name: 'action'},
        ]
    });
});

</script>
@endsection