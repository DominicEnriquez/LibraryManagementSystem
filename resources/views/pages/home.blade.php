@extends('layouts.app')

@section('title', $title)

@section('content')

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">  
    <div class="x_panel">
      <div class="x_title">
        <h2>{{$title}}</small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <form id="form-book-search">
            <div class="col-md-8 col-sm-12 col-xs-12 form-group">
            {!!Form::text('search', null, ['class'=>'form-control first-focus', 'placeholder'=>'Search for ...', 'id'=>'search'])!!}
            </div>
            <div class="col-md-2 col-sm-12 col-xs-12 form-group">
            {!!Form::select('filter', ['all'=>'All', 'title'=>'Title', 'author'=>'Author'], 'title', ['class'=>'form-control', 'id'=>'filter'])!!}
            </div>
            <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                <button type="submit" id="btn-find" class="form-control btn btn-primary">Find</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="row"> 
  <div class="col-md-12 col-sm-12 col-xs-12">
    @include('partials.form_notifications')
    @include('partials.page_notifications')  
    <div class="x_panel">
      <div class="x_title">
        <h2>Book List</small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        {!!Form::open(['route'=>'do-borrow-books', 'id'=>'form-book-list'])!!}
            <table id="dtlist" class="table table-striped table-bordered bulk_action">
              <thead>
                <tr>
                  <th></th>
                  <th>QTY</th>
                  <th>Title</th>
                  <th>Author</th>
                  <th>ISBN</th>                  
                  <th>Shelf Location</th>
                </tr>
              </thead>
            </table>
        {!!Form::close()!!}
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
        searching: false,
        dom: "Bfrtip",
          buttons: [
            {
                text: 'Borrow Selected Books',
                action: function ( e, dt, node, config ) {
                    $('#form-book-list').submit();
                }
            }
          ],
        ajax: {
            url: "{{route('dt-book-list')}}",
            data: function (d) {
                d.search = $('#search').val();
                d.filter = $('#filter').val();
            }
        },
        columns: [
            {data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
            {data: 'quantities', name: 'quantities'},
            {data: 'title', name: 'title'},
            {data: 'author', name: 'author'},
            {data: 'isbn', name: 'isbn'},            
            {data: 'shelf_location', name: 'shelf_location'}
        ]
    });
    
    oTable.on('draw.dt', function() {
      $('input').iCheck({
        checkboxClass: 'icheckbox_flat-green'
      });
    });

   $('#form-book-search').on('submit', function(e) {
        oTable.api().draw();
        e.preventDefault();
   });    
});

</script>
@endsection