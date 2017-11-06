@extends('app')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <a href="{{ url('/') }}" class="btn btn-info">Back</a>
        </div>
    </div>

    <h1>Information about user</h1>
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Login</th>
                <th scope="col">First name</th>
                <th scope="col">Last name</th>
                <th scope="col">Sex</th>
                <th scope="col">Created at</th>
                <th scope="col">Email</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->login}}</td>
                <td>{{ $user->firstname}}</td>
                <td>{{ $user->lastname}}</td>
                <td>{{ \App\Users::getSexes()[$user->sex]}}</td>
                <td>{{ date('d-m-Y H:i', strtotime($user->created_at))}}</td>
                <td>{{ $user->email}}</td>
            </tr>
        </tbody>
    </table>

    <h1>Addresses</h1>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <a href="{{ url('/addresses/create/' . $user->id) }}" class="btn btn-success">Add address</a>
            </div>
        </div>
    </div>

    <table class="table table-striped">
        <thead class="thead-dark">
        <tr>
            <th scope="col">№</th>
            <th scope="col">ID</th>
            <th scope="col">Post code</th>
            <th scope="col">Country</th>
            <th scope="col">City</th>
            <th scope="col">Street</th>
            <th scope="col">House</th>
            <th scope="col">Office/Flat</th>
            <th width="20%">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($addresses as $key => $address)
            <tr>
                <td scope="row">{{ ++$key }}</td>
                <td>{{ $address->id }}</td>
                <td>{{ $address->postcode}}</td>
                <td>{{ $address->country}}</td>
                <td>{{ $address->city}}</td>
                <td>{{ $address->street}}</td>
                <td>{{ $address->house}}</td>
                <td>{{ $address->office}}</td>
                <td>
                    <a href="{{ url('/addresses/edit', ['id' => $address->id]) }}" class="btn btn-primary">Edit</a>
                    @if (count($addresses) > 1)
                        {!! Form::open(['method' => 'post', 'url' => '/addresses/delete/' . $address->id, 'style' => 'display:inline',
                                        'onSubmit' => 'confirmDelete()']) !!}
                        {!! csrf_field() !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $addresses->links() }}

    <script>
        function confirmDelete()
        {
            var x = confirm("Are you sure you want to delete address?");
            if (x) return true;
            else   return false;
        }

    </script>

@stop