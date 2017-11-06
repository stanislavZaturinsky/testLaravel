<div class="alert alert-danger error-block-js" style="display: none">
    <ul>
    </ul>
</div>

{{--{!! Form::token() !!}--}}
<div class="form-group">
    {!! Form::label('login', 'Login') !!}
    {!! Form::text('login', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('password') !!}
    {!! Form::text('password', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('firstname', 'First name') !!}
    {!! Form::text('firstname', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('lastname', 'Last name') !!}
    {!! Form::text('lastname', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('sex', 'Sex') !!}
    {!! Form::select('sex', \App\Users::getSexes(), null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('email', 'Email') !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>