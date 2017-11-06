@extends('app')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <a href="{{ url('/users/show/' . $userId) }}" class="btn btn-info">Back</a>
        </div>
    </div>

    @if (count($errors) > 0)
        <div class="alert alert-danger error-block-js" style="display: none">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1>Edit address №{{ $address->id}}</h1>
    {!! Form::model($address, ['method' => 'post', 'url' => '/addresses/edit/' . $address->id]) !!}
        {!! Form::hidden('user_id', $userId) !!}
        @include('addresses._form')
    <div class="form-group">
        {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}

@stop