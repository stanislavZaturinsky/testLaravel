@extends('app')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <a href="{{ url('/') }}" class="btn btn-info">Back</a>
        </div>
    </div>

    <h1>Edit user {{ $user->login }}</h1>
    {!! Form::model($user, ['method' => 'post', 'url' => '/users/edit/' . $user->id]) !!}
        {!! Form::hidden('user_id', $user->id) !!}
        @include('users._form')
        <div class="form-group">
            {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
        </div>
    {!! Form::close() !!}

@stop