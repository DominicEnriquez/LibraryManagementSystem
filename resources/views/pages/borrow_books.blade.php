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
        {!!Form::open(['route'=>'do-return-books', 'id'=>'form-book-list'])!!}
            <table id="dtlist" class="table table-striped table-bordered bulk_action">
              <thead>
                <tr>
                  <th></th>
                  <th>Title</th>
                  <th>Author</th>
                  <th>Borrowed Date</th>
                  <th>Return Date</th>
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
        ordering: false,
        dom: "Bfrtip",
          buttons: [
            {
                text: 'Return Selected Books',
                action: function ( e, dt, node, config ) {
                    $('#form-book-list').submit();
                }
            }
          ],
        ajax: {
            url: "{{route('dt-borrow-books')}}",
            data: function (d) {
                d.search = $('#search').val();
                d.filter = $('#filter').val();
            }
        },
        columns: [
            {data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
            {data: 'book_trashed.title', name: 'book_trashed.title'},
            {data: 'book_trashed.author', name: 'book_trashed.author'},
            {data: 'created_at', name: 'created_at'},
            {data: 'return_book.expired_at', name: 'return_book.expired_at'}
        ]
    });
    
    oTable.on('draw.dt', function() {
      $('input').iCheck({
        checkboxClass: 'icheckbox_flat-green'
      });
    });
});

</script>
@endsection