@extends('layouts.auth')

@section('title', $title)

@section('content')
<div class="form login_form">
    <section class="login_content">
        {!! Form::open(['route'=>'auth::do-forgot-password', 'id'=>'login']) !!}
            <h1>{{$title}}</h1>
            @include('partials.form_notifications')
            @include('partials.page_notifications')
            <div>
                {!! Form::email('email', null, ['class'=>'form-control first-focus', 'placeholder'=>'Email']) !!}
            </div>
            <div class="captcha">
                {!! app('captcha')->display() !!}
            </div>
            <div>
                <button type="submit" class="btn btn-default submit pull left">Submit</button>
            </div>

            <div class="clearfix"></div>

            <div class="separator">
                <p class="change_link">Already a member ?
                    <a href="{{route('auth::login')}}" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                    <h1><i class="fa fa-book"></i> {{trans('content.title')}}</h1>
                    <p>{!!trans('content.footer')!!}</p>
                </div>
            </div>
        {!! Form::close() !!}
    </section>
</div>
@endsection