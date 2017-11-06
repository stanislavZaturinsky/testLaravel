@extends('app')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <a href="{{ url('/users/show/' . $userId) }}" class="btn btn-info">Back</a>
        </div>
    </div>

    <h1>Create address</h1>
    {!! Form::open(['method' => 'post', 'url' => '/addresses/create/' . $userId]) !!}
        {!! Form::hidden('user_id', $userId) !!}
        @include('addresses._form')
        <div class="form-group">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        </div>
    {!! Form::close() !!}

@stop