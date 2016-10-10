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
              <th>Returned Date</th>  
              <th>Title</th>
              <th>Author</th>
              <th>Charge</th>
              <th>Late</th>              
              <th>Borrowed Date</th>
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
        searching: false,
        ordering: false,
        ajax: {
            url: "{{route('dt-return-books')}}"
        },
        columns: [
            {data: 'return_at', name: 'return_at'},
            {data: 'borrow_book.books.title', name: 'borrow_book.books.title'},
            {data: 'borrow_book.books.author', name: 'borrow_book.books.author'},
            {data: 'charge', name: 'charge'},
            {data: 'total_late', name: 'total_late'},            
            {data: 'created_at', name: 'created_at'}
        ]
    });
});

</script>
@endsection