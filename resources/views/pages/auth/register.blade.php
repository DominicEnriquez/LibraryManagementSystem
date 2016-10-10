@extends('layouts.auth')

@section('title', $title)

@section('content')
<div class="form login_form">
    <section class="login_content">
    {!! Form::open(['route'=>'auth::do-register']) !!}
        <h1>{{$title}}</h1>
        @include('partials.form_notifications')
        @include('partials.page_notifications')
        <div>
            {!! Form::text('firstname', null, ['class'=>'form-control first-focus', 'placeholder'=>'First Name']) !!}
        </div>
        <div>
            {!! Form::text('lastname', null, ['class'=>'form-control', 'placeholder'=>'Last Name']) !!}
        </div>
        <div>
            {!! Form::text('middlename', null, ['class'=>'form-control', 'placeholder'=>'Middle Name']) !!}
        </div>
        <div>
            {!! Form::text('contact_number', null, ['class'=>'form-control', 'placeholder'=>'Contact Number']) !!}
        </div>
        <div>
            {!! Form::text('address', null, ['class'=>'form-control', 'placeholder'=>'Address']) !!}
        </div>
        <div>
            {!! Form::text('birthdate', null, ['class'=>'form-control', 'placeholder'=>'Date Of Birth: YYYY-MM-DD']) !!}
        </div>
        <div>
            {!! Form::select('gender', ['male'=>'Male', 'female'=>'Female'], null, ['placeholder'=>'Gender', 'class'=>'form-control']) !!}
        </div>
        <br>
        <div class="divider-dashed"></div>
        <br>
        <div>
            {!! Form::email('email', null, ['class'=>'form-control', 'placeholder'=>'Email']) !!}
        </div>
        <div>
            {!! Form::password('password', ['class'=>'form-control', 'placeholder'=>'Password']) !!}
        </div>
        <div>
            {!! Form::password('password_confirmation', ['class'=>'form-control', 'placeholder'=>'Confirm Password']) !!}
        </div>
        <div class="captcha">
            {!! app('captcha')->display() !!}
        </div>
        <div>
            <button type="submit" class="btn btn-default submit">Submit</button>
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