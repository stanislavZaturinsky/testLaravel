@extends('app')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Users</h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <a href="{{ url('/users/create') }}" class="btn btn-success">Add user</a>
            </div>
        </div>
    </div>

    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">№</th>
                <th scope="col">ID</th>
                <th scope="col">Login</th>
                <th scope="col">First name</th>
                <th scope="col">Last name</th>
                <th scope="col">Sex</th>
                <th scope="col">Created at</th>
                <th scope="col">Email</th>
                <th width="20%">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($users as $key => $user)
            <tr>
                <td scope="row">{{ ++$key }}</td>
                <td>{{ $user->id }}</td>
                <td>{{ $user->login}}</td>
                <td>{{ $user->firstname}}</td>
                <td>{{ $user->lastname}}</td>
                <td>{{ \App\Users::getSexes()[$user->sex]}}</td>
                <td>{{ date('d-m-Y H:i', strtotime($user->created_at))}}</td>
                <td>{{ $user->email}}</td>
                <td>
                    <a href="{{ url('/users/edit', ['id' => $user->id]) }}" class="btn btn-primary">Edit</a>
                    <a href="{{ url('/users/show', ['id' => $user->id]) }}" class="btn btn-info">Info</a>
                    {!! Form::open(['method' => 'post', 'url' => '/users/delete/' . $user->id, 'style' => 'display:inline',
                                    'onSubmit' => 'confirmDelete()']) !!}
                    {!! csrf_field() !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $users->links() }}

    <script>
        function confirmDelete()
        {
            var x = confirm("Are you sure you want to delete user?");
            if (x) return true;
            else   return false;
        }

    </script>
@stop