@extends('app')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <a href="{{ url('/') }}" class="btn btn-info">Back</a>
        </div>
    </div>

    <h1>Create user</h1>
    <h2>User information</h2>
    {!! Form::open(['name' => 'user']) !!}
        @include('users._form')
    {!! Form::close() !!}

    <h2>Address information</h2>
    {!! Form::open(['name' => 'address']) !!}
        @include('addresses._form')
    {!! Form::close() !!}

    <div class="form-group">
        {!! Form::button('Save', ['class' => 'btn btn-primary', 'name' => 'submit']) !!}
    </div>

    <script>
        $(function() {
            $('[name="submit"]').on('click', function(e) {
                e.preventDefault();

                var formData = {
                    login    : $('[name="login"]').val(),
                    password : $('[name="password"]').val(),
                    firstname: $('[name="firstname"]').val(),
                    lastname : $('[name="lastname"]').val(),
                    sex      : $('[name="sex"]').val(),
                    email    : $('[name="email"]').val(),
                    postcode : $('[name="postcode"]').val(),
                    country  : $('[name="country"]').val(),
                    city     : $('[name="city"]').val(),
                    street   : $('[name="street"]').val(),
                    house    : $('[name="house"]').val(),
                    office   : $('[name="office"]').val(),
                    _token   : $('[name="user"]').find('[name="_token"]').val()
                };

                $.ajax({
                    type   : 'post',
                    url    : '/users/create',
                    data   : formData,
                    success: function(data) {
                        if (data.success === true) {
                            window.location.href = '/';
                        }
                    },
                    error: function(data){
                        var errors     = data.responseJSON;
                        var errorBlock = $('.error-block-js');
                        errorBlock.find('ul').html('');
                        $.each(errors, function(key, value){
                            $.each(value, function(key, value){
                                errorBlock.find('ul').append('<li>' + value + '</li>');
                            });
                        });
                        errorBlock.css('display', 'block');
                    }
                });
            });
        });
    </script>
@stop