@extends('adminlayout.default')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered" width="100%">
        <tr>
            <th>Sl. No.</th>
            <th>Name</th>
            <th>Email</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Phone</th>
            <th>Role</th>
            <th>Status</th>
        </tr>
        @foreach($users as $user)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->age}}</td>
            <td>{{$user->gender}}</td>
            <td>{{$user->phone}}</td>
            <td>{{$user->role}}</td>
            <td>
                @if($user->status == 'inactive')
                    <a href="{{ url('/changeStatus/'.$user->id) }}">
                        <button class="btn btn-success">Activate</button>
                    </a>
                @else
                    <a href="{{ url('/changeStatus/'.$user->id) }}">
                        <button class="btn btn-danger">Deactivate</button>
                    </a>
                @endif
            </td>
        </tr>
        @endforeach
    </table>
@stop
