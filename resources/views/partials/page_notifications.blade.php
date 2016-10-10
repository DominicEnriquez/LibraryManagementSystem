@if( Session::has('success') )
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <i class="icon fa fa-check"></i> {{ Session::get('success') }}
    </div>
@endif

@if( Session::has('error') )
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <i class="icon fa fa-ban"></i> {{ Session::get('error') }}
    </div>
@endif

@if( Session::has('warning') )
    <div class="alert alert-warning alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <i class="icon fa fa-warning"></i> {{ Session::get('warning') }}
    </div>
@endif

@if( Session::has('info') )
    <div class="alert alert-info alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <i class="icon fa fa-info"></i> {{ Session::get('info') }}
    </div>
@endif
