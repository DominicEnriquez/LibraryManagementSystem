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
              <th>Email</th>
              <th>First Name</th>
              <th>Last Name</th>              
              <th>Address</th>
              <th>Age</th>
              <th>Date Created</th>
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
                text: 'Create New Member +',
                action: function ( e, dt, node, config ) {
                    window.location = "{{route('admin::member-add')}}";
                }
            }
          ],
        ajax: {
            url: "{{route('admin::dt-member-list')}}"
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'email', name: 'email'},
            {data: 'profile.firstname', name: 'profile.firstname', orderable: false},
            {data: 'profile.lastname', name: 'profile.lastname', orderable: false},
            {data: 'profile.address', name: 'profile.address', orderable: false},
            {data: 'age', name: 'age', orderable: false},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', searchable: false, orderable: false},
        ]
    });
});

</script>
@endsection